<?php
namespace App\Services\Admin;


use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Library\CommonFunctions;
use App\Models\BookRatingReview;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CategoryValidationRequest;
use App\Library\CacheHelper;

class BookReviewService
{
    public static function getAllReviewsPaginated()
    {
        $data['reviews'] = BookRatingReview::with(['user', 'book'])->latest()->paginate(20);
        return $data;
    }

    public static function createReview()
    {
        return [
            'users' => User::published()->get(),
            'books' => Book::published()->get(),
        ];
    }

    public static function storeReview($request)
    {
        if(count($request['book_id']) > 0){
            foreach($request['book_id'] as $book_id){
                BookRatingReview::create([
                    'book_id' => $book_id,
                    'user_id' => $request['user_id'],
                    'user_rating' => $request['user_rating'],
                    'comments' => $request['comments'],
                    'approval' => 1,
                ]);
            }
        }
    }

    public static function editReview($id)
    {
        $data['review'] = BookRatingReview::findOrFail($id);
        $data['users'] = User::published()->get();
        $data['books'] = Book::published()->get();

        return $data;
    }

    public static function updateReview($request, $id)
    {
        $review = BookRatingReview::findOrFail($id);
        $review->update([
            'book_id' => $request['book_id'],
            'user_id' => $request['user_id'],
            'user_rating' => $request['user_rating'],
            'comments' => $request['comments'],
        ]);
    }
        public static function approveReview($id)
        {
            $review = BookRatingReview::find($id);

            if (!$review) {
                return response()->json(['message' => 'Review not found'], 404);
            }

            // Toggle approval status
            $review->approval = $review->approval == 2 ? 3 : 2;
            $review->save();
            CacheHelper::forget('book_reviews_'.$review->book_id);
            return response()->json(['message' => 'Review updated successfully']);
        }

    public static function deleteReview($id)
    {
        $review = BookRatingReview::findOrFail($id);
        if ($review) {
            $review->delete();
            return response()->json(['message' => 'Review deleted successfully']);
        }
        return response()->json(['message' => 'Review not found'], 404);
    }
}