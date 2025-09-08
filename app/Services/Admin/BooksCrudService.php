<?php
namespace App\Services\Admin;

use App\Models\Tag;
use App\Models\Book;
use App\Models\Author;
use App\Models\Country;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\BookAuthor;
use App\Models\BookGallery;
use Illuminate\Support\Str;
use App\Library\CacheHelper;
use App\Models\BookCategory;
use App\Models\BookPdfImage;
use Illuminate\Http\Request;
use App\Library\ImageFunctions;
use App\Library\CommonFunctions;
use App\Models\BookStockHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\BooksValidationRequest;

class BooksCrudService
{
    // public static $book, $data = array();

    public static function listBooks()
    {
        $data['all_books'] = Book::with([
                'categories.parent.parent.parent',
                'authors'
            ])
            ->where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();

        $data['books'] = Book::filter(request(['filter_book', 'filter_category']))
            ->with([
                'categories.parent.parent.parent',
                'authors'
            ])
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(20);

        $data['categories'] = Category::where('status', 1)->orderBy('id', 'ASC')->get();

        Session::put('product_page_session', request()->query('page', 1));

        return $data;
    }

    public static function createBook()
    {
        // Get active categories
        $data['categories'] = Category::select('id', 'title', 'parent_id')
            ->where('status', 1)
            ->get();
        $oldCategories = request()->old('cat_id', []);
        $data['categoryIDs'] = $oldCategories;

        $oldTags = request()->old('tag_id', []);
        $tagsOptions = [];
        foreach ($oldTags as $t) {
            $tagsOptions[] = array('id' => $t, 'name' => $t);
        }
        $data['tagsValue'] = $oldTags;
        $data['tagsOptions'] = $tagsOptions;

        // Get active authors
        $data['authors'] = Author::select('id', 'name', 'en_name')
            ->where('status', 1)
            ->get();
        $oldAuthors = request()->old('author_id', []);
        $data['authorIDs'] = $oldAuthors;

        $data['publishers'] = Publisher::select('id', 'title')
            ->where('status', 1)
            ->get();
            
        $data['countries'] = Country::select('id', 'country_name')
            ->where('status', 1)
            ->get();

        $data['coverTypes'] = collect([
            ['id' => 'Hard Cover', 'title' => 'Hard Cover'],
            ['id' => 'Paper Back', 'title' => 'Paper Back'],
        ]);

        return $data;
    }

    public static function storeBook(BooksValidationRequest $request){
        $validated = $request->validated();
        $gallery_images = [];
        $pdf_images = [];
        $modelName = 'App\Models\Book';
        $slugColumn = 'slug';
        if (!empty($validated['slug'])) {
            $slug = CommonFunctions::generate_unique_slug($validated['slug'], $modelName, $slugColumn);
        } else {
            $slug = CommonFunctions::generate_unique_slug($validated['title'], $modelName, $slugColumn);
        }

        if ($request->hasFile('image_path')) {
            $gallery_images = $validated['image_path'];
        }
        if ($request->hasFile('pdf_image_path')) {
            $pdf_images = $validated['pdf_image_path'];
        }
        // Handle pdf upload
        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = CommonFunctions::imageUpload($request->file('pdf_file'), 'media/uploads/books/pdfs');
        }
        $validated['slug'] = $slug;

        $allTag = [];
        if (!empty($request->tag_id)) {
            $allTag = $validated['tag_id'];
        }

        
        if (!empty($validated['sale_price'])) {
            $regularPrice = $validated['regular_price'];
            $salePrice = $validated['sale_price'];
            $discountData = self::calculateDiscount($regularPrice, $salePrice);
            $validated['discounted_price'] = $discountData['discounted_price'];
            $validated['discounted_percent'] = $discountData['discounted_percent'];
        }

        unset( $validated['image_path'], $validated['cat_id'], $validated['tag_id'], $validated['author_id'], $validated['pdf_image_path'] ); 
        // Create book
        $book = Book::create($validated);

        if ($book) {
            $book_id = $book->id;
            $note = "Stock increased by +" . $validated['quantity'] . "." . "Changes by admin " . auth()->guard('admin')->user()->name;
            BookStockHistory::create([
                'book_id' => $book_id,
                'type' => 'increase',
                'quantity' => $book->quantity,
                'note' => $note
            ]);

            if (!empty($request->cat_id)) {
                // Normalize to an array
                $catIds = is_array($request->cat_id) ? $request->cat_id : [$request->cat_id];

                foreach ($catIds as $catId) {
                    BookCategory::create([
                        'book_id' => $book_id,
                        'cat_id' => $catId,
                    ]);
                }
            }

            // store gallery images
            if (!empty($gallery_images)) {
                self::storeBookGallery($gallery_images, $book_id);
            }
            // store pdf images
            if (!empty($pdf_images)) {
                self::storePdfImages($pdf_images, $book_id);
            }

            if (!empty($request->author_id)) {
                // Normalize to an array
                $authorIds = is_array($request->author_id) ? $request->author_id : [$request->author_id];

                foreach ($authorIds as $authorId) {
                    BookAuthor::create([
                        'book_id' => $book_id,
                        'author_id' => $authorId,
                    ]);
                }
            }

            $newTags = [];
            foreach ($allTag as $tagName) {
                // If the tag already exists, add it to existingTags
                $tag = Tag::firstOrCreate(['name' => $tagName], ['slug' => Str::slug($tagName, '-', ' ')]); // Will find or create the tag
                $newTags[] = $tag->id;
            }
            $book->tags()->sync($newTags);
        }

        // Prepare data to return
        $data['book'] = $book;
        $data['message'] = 'Book added successfully';
        self::bookCacheRemove($book->id);
        return $data;
    }

    public static function editBook($id)
    {
        // Get the book record with its relations
        $book = Book::with(['categories', 'tags', 'authors', 'gallery'])->findOrFail($id);

        $data = [];

        // 1. Categories
        $data['categories'] = Category::select('id', 'title', 'parent_id')
            ->where('status', 1)
            ->get();
        $oldCategories = request()->old('cat_id', $book->categories->pluck('id')->toArray());
        $data['categoryIDs'] = $oldCategories;

        // 2. Tags
        $bookTagNames = $book->tags->pluck('name')->toArray();
        $oldTags = request()->old('tag_id', $bookTagNames);
        $tagsOptions = [];
        foreach ($oldTags as $t) {
            $tagsOptions[] = ['id' => $t, 'name' => $t];
        }
        $data['tagsValue'] = $oldTags;
        $data['tagsOptions'] = $tagsOptions;

        // 3. Authors
        $data['authors'] = Author::select('id', 'name', 'en_name')
            ->where('status', 1)
            ->get();
        $oldAuthors = request()->old('author_id', $book->authors->pluck('id')->toArray());
        $data['authorIDs'] = $oldAuthors;

        // 4. Publishers
        $data['publishers'] = Publisher::select('id', 'title')
            ->where('status', 1)
            ->get();

        // 5. Countries
        $data['countries'] = Country::select('id', 'country_name')
            ->where('status', 1)
            ->get();
        
        $data['coverTypes'] = collect([
            ['id' => 'Hard Cover', 'title' => 'Hard Cover'],
            ['id' => 'Paper Back', 'title' => 'Paper Back'],
        ]);

        // 6. Pass the book itself
        $data['book'] = $book;

        return $data;
    }

    public static function updateBook(BooksValidationRequest $request, $id)
    {
        $validated = $request->validated();
        $gallery_images = [];
        $pdf_images = [];
        $modelName = 'App\Models\Book';
        $slugColumn = 'slug';

        $book = Book::findOrFail($id);

        $oldQuantity = $book->quantity;

        if (!empty($validated['slug'])) {
            $slug = CommonFunctions::generate_unique_slug($validated['slug'], $modelName, $slugColumn, $id);
        } else {
            $slug = CommonFunctions::generate_unique_slug($validated['title'], $modelName, $slugColumn, $id);
        }
        $validated['slug'] = $slug;

        if (!empty($request->image_path)) {
                $gallery_images = $validated['image_path'];
            }
        if (!empty($request->pdf_image_path)) {
                $pdf_images = $validated['pdf_image_path'];
            }

        $allTag = [];
        if (!empty($request->tag_id)) {
            $allTag = $validated['tag_id'];
        }

        // Handle PDF upload
        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = CommonFunctions::imageUpload($request->file('pdf_file'), 'media/uploads/books/pdfs');
        } else {
            $validated['pdf_file'] = $request->input('old_pdf_file');
        }

         // Calculate discount if sale price exists
        if (!empty($validated['sale_price'])) {
            $regularPrice = $validated['regular_price'];
            $salePrice = $validated['sale_price'];
            $discountData = self::calculateDiscount($regularPrice, $salePrice);
            $validated['discounted_price'] = $discountData['discounted_price'];
            $validated['discounted_percent'] = $discountData['discounted_percent'];
        }

        unset( $validated['image_path'], $validated['cat_id'], $validated['tag_id'], $validated['author_id'], $validated['pdf_image_path']); 

        // Update the book
        $book->update($validated);

        if ($book) {
                $book_id = $book->id;
                $changeAmount = abs($book->quantity - $oldQuantity);

                if ($oldQuantity > $book->quantity) {
                    $changeType = 'decrease';
                    $note = "Books have decreased by -$changeAmount. Changed by admin " . auth()->guard('admin')->user()->name;
                } elseif ($oldQuantity < $book->quantity) {
                    $changeType = 'increase';
                    $note = "Books have increased by +$changeAmount. Changed by admin " . auth()->guard('admin')->user()->name;
                } else {
                    // No change in quantity
                    $changeType = null;
                    $note = "No changes in stock.";
                }
                if ($changeType) {
                    BookStockHistory::create([
                        'book_id' => $book_id,
                        'type' => 'increase',
                        'quantity' => $changeAmount,
                        'note' => $note
                    ]);
                }

                BookCategory::where('book_id', $book_id)->delete();
                if (!empty($request->cat_id)) {
                    $catIds = is_array($request->cat_id) ? $request->cat_id : [$request->cat_id];
                    foreach ($catIds as $catId) {
                        BookCategory::create([
                            'book_id' => $book_id,
                            'cat_id' => $catId,
                        ]);
                    }
                }

                // Update authors
                BookAuthor::where('book_id', $book_id)->delete();
                if (!empty($request->author_id)) {
                    $authorIds = is_array($request->author_id) ? $request->author_id : [$request->author_id];
                    foreach ($authorIds as $authorId) {
                        BookAuthor::create([
                            'book_id' => $book_id,
                            'author_id' => $authorId,
                        ]);
                    }
                }

                // image gallery update
                if (!empty($request->remove_book_images)) {
                    BookGallery::whereIn('id', $request->remove_book_images)->delete();
                }
                // store gallery images
                if (!empty($gallery_images)) {
                    self::storeBookGallery($gallery_images, $book_id);
                }

                // pdf images update
                if (!empty($request->remove_pdf_images)) {
                    BookPdfImage::whereIn('id', $request->remove_pdf_images)->delete();
                }
                // store pdf images
                if (!empty($pdf_images)) {
                    self::storePdfImages($pdf_images, $book_id);
                }

                $newTags = [];
                foreach ($allTag as $tagName) {
                    // If the tag already exists, add it to existingTags
                    $tag = Tag::firstOrCreate(['name' => $tagName], ['slug' => Str::slug($tagName, '-', ' ')]);
                    $newTags[] = $tag->id;
                }
                $book->tags()->sync($newTags);
            }

        // Prepare data to return
        $data['book'] = $book;
        $data['message'] = 'Book updated successfully';
        self::bookCacheRemove($book->id);
        return $data;
    }
    public static function deleteBook($id)
    {
        $delete = Book::findOrFail($id);
        $delete->status = 2; // Assuming 2 means deleted or inactive
        $delete->update();
        $data['message'] = 'Book deleted successfully';
        self::bookCacheRemove($id);
        return $data;
    }

    // private static function storeBookGallery($gallery_images, $book_id)
    // {
    //     if (!empty($gallery_images)) {
    //         $imgData = [];
    //         foreach ($gallery_images as $image) {
    //             $imageName = CommonFunctions::imageUpload($image, 'media/uploads/books');
    //             // Prepare data for bulk insert
    //             $imgData[] = [
    //                 'book_id' => $book_id,
    //                 'img_path' => $imageName,
    //             ];
    //         }

    //         // Bulk insert if we have images
    //         if (!empty($imgData)) {
    //             DB::table('book_galleries')->insert($imgData);
    //         }
    //     }
    // }

    private static function storeBookGallery($gallery_images, $book_id)
    {
        if (!empty($gallery_images)) {
            $imgData = [];
            foreach ($gallery_images as $image) {
                $imagePaths = ImageFunctions::uploadAndResize(
                    $image, 'media/uploads/books',
                    [
                        'small' => ['width' => 158],
                        'thumb' => ['width' => 72],
                    ]
                );              
                // Prepare data for bulk insert with all three image sizes
                $imgData[] = [
                    'book_id' => $book_id,
                    'img_path' => $imagePaths['original'],      // Original size
                    'img_sm_path' => $imagePaths['small'],       // Mobile size (480px width)
                    'img_thumb_path' => $imagePaths['thumb'],    // Tablet size (768px width)
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Bulk insert if we have images
            if (!empty($imgData)) {
                DB::table('book_galleries')->insert($imgData);
            }
        }
    }
    private static function storePdfImages($pdf_images, $book_id)
    {
        if (!empty($pdf_images)) {
            $imgData = [];
            foreach ($pdf_images as $image) {
                $imageName = CommonFunctions::imageUpload($image, 'media/uploads/books/pdfs');
                // Prepare data for bulk insert
                $imgData[] = [
                    'book_id' => $book_id,
                    'pdf_image_path' => $imageName,
                ];
            }

            // Bulk insert if we have images
            if (!empty($imgData)) {
                DB::table('book_pdf_images')->insert($imgData);
            }
        }
    }

    private static function calculateDiscount($regularPrice, $salePrice)
    {
        if(!empty($regularPrice)) {
            $discountedPrice = $regularPrice - $salePrice;
            $discountedPercent = $regularPrice > 0
                ? round(($discountedPrice / $regularPrice) * 100, 2)
                : 0;
    
            return [
                'discounted_price' => $discountedPrice,
                'discounted_percent' => $discountedPercent,
            ];
        }
    }

    public static function getBooks(Request $request)
    {
        $term = $request->input('term', '');

        $books = Book::where('status', 1)
            ->where('title', 'like', '%' . $term . '%')
            ->get(['id', 'title']);

        $data['results'] = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'text' => $book->title,
            ];
        });

        return $data;
    }

    public static function bookCacheRemove($id = null){
        CacheHelper::forget('newly_published_books');
        CacheHelper::forget('pre_ordered_books');
        CacheHelper::forget('see_more_books_'.$id);
    } 
}