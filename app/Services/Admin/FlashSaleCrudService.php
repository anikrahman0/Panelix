<?php
namespace App\Services\Admin;

use App\Models\Book;
use App\Models\FlashSale;
use App\Models\BookFlashSale;
use App\Library\CommonFunctions;
use App\Http\Requests\FlashSaleValidationRequest;

class FlashSaleCrudService
{
    public static function listFlashSales()
    {
        $flashSales = FlashSale::filter(request(['search']))->with('books')->published()->paginate(20);
        $data['flashSales'] = $flashSales;
        return $data;
    }

    public static function createFlashSale()
    {
        // Get active books
        $data['books'] = Book::select('id', 'title')->published()->get();
        $oldBooks = request()->old('book_id', []);
        $data['bookIDs'] = $oldBooks;

        return $data;
    }

    public static function editFlashSale($id)
    {
        $flashSale = FlashSale::with('books')->where('id', $id)->published()->firstOrFail();
        $data['flashSale'] = $flashSale;
        $data['books'] = Book::select('id', 'title')->where('status', 1)->get();
        $oldBooks = request()->old('book_id', $flashSale->books->pluck('id')->toArray());
        $data['bookIDs'] = $oldBooks;

        return $data;
    }
    public static function storeFlashSale(FlashSaleValidationRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = CommonFunctions::imageUpload($request->file('image_path'), 'media/uploads/flash-sales');
        }

        unset( $validated['book_id'], ); 

        // Create book bundle
        $flashSale = FlashSale::create($validated);

        if ($flashSale) {
            if (!empty($request->book_id)) {
                // Normalize to an array
                $bookIds = is_array($request->book_id) ? $request->book_id : [$request->book_id];

                foreach ($bookIds as $bookId) {
                    BookFlashSale::create([
                        'book_id' => $bookId,
                        'sale_id' => $flashSale->id,
                    ]);
                }
            }
        }

        // Prepare data to return
        $data['flashSale'] = $flashSale;
        $data['message'] = 'Flash Sale added successfully';

        return $data;
    }
    public static function updateFlashSale(FlashSaleValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $flashSale = FlashSale::with('books')->where('id', $id)->published()->first();
        if (!$flashSale) {
            abort(404);
        }
        // Handle image upload
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = CommonFunctions::imageUpload($request->file('image_path'), 'media/uploads/flash-sales');
        } else {
            $validated['image_path'] = $request->input('old_image_path');
        }

        unset( $validated['book_id'], );

        // Update book bundle
        $flashSale->update($validated);

        if($flashSale){
            // Update books
            BookFlashSale::where('sale_id', $flashSale->id)->delete();
            if (!empty($request->book_id)) {
                $bookIds = is_array($request->book_id) ? $request->book_id : [$request->book_id];
                foreach ($bookIds as $bookId) {
                    BookFlashSale::create([
                        'book_id' => $bookId,
                        'sale_id' => $flashSale->id,
                    ]);
                }
            }
        }
        // Prepare data to return
        $data['flashSale'] = $flashSale;
        $data['message'] = 'Flash Sale updated successfully';

        return $data;
    }
    public static function deleteFlashSale($id)
    {
        $delete = FlashSale::findOrFail($id);
        $delete->status = 2;
        $delete->update();

        $data['message'] = 'Flash Sale deleted successfully';

        return $data;
    }
}