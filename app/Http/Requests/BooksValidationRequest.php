<?php

namespace App\Http\Requests;

use App\Models\BookGallery;
use App\Models\BookPdfImage;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BooksValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd(request()->all());
        $id = $this->route('id');
  
        $slugRule = [
            'nullable',
            'string',
            'max:200',
        ];
        $imagesArrayRule='';
        $imagesRule='';

        $pdfImagesArrayRule='';
        $pdfImagesRule='';


        if (!empty($id)) {
            // update
            array_push($slugRule,
                Rule::unique('books', 'slug')->where(function ($query) {
                    return $query->where('status', 1);
                })->ignore($id, 'id')
            );
            $imagesRule = 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
            $oldGalleries = BookGallery::where('book_id', $id)->count();
            $removedGalleries = 0;
            if(isset(request()->remove_book_images)){
                $removedGalleries = count(request()->remove_book_images);
            }
            if($oldGalleries > $removedGalleries){
                $imagesArrayRule = 'nullable|array';
            }else{
                $imagesArrayRule = 'required|array';
            }

            $pdfImagesRule = 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
            $oldPdfImages = BookPdfImage::where('book_id', $id)->count();
            $removedPdfImages = 0;
            if(isset(request()->remove_pdf_images)){
                $removedPdfImages = count(request()->remove_pdf_images);
            }
            if($oldPdfImages > $removedPdfImages){
                $pdfImagesArrayRule = 'nullable|array';
            }else{
                $pdfImagesArrayRule = 'nullable|array';
            }
        } else {
            // insert
            array_push($slugRule,
                Rule::unique('books', 'slug')->where(function ($query) {
                    return $query->where('status', 1);
                })
            );
            $imagesRule = 'required|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
            $imagesArrayRule = 'required|array';
            $pdfImagesRule = 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
            $pdfImagesArrayRule = 'nullable|array';
        }

        return  [
            'cat_id' => 'required|array',
            'cat_id.*' => 'integer|exists:categories,id',
            'author_id' => 'nullable|array',
            'author_id.*' => 'nullable|integer',
            'title'=>'required|string|max:200',
            'slug'=>$slugRule,
            'short_description' => 'nullable|string|max:60000',
            'description' => 'nullable|string|max:60000',
            'status' => 'required|in:1,2',
            'pre_order' => 'required|in:1,2',
            'show_en_name' => 'required|in:1,2',
            'image_path' => $imagesArrayRule,
            'image_path.*' => $imagesRule,
            'pdf_image_path' => $pdfImagesArrayRule,
            'pdf_image_path.*' => $pdfImagesRule,
            'publisher_id' => 'nullable|integer',
            'country_id' => 'nullable|integer',
            'edition' => 'nullable|string|max:255',
            'page_no' => 'nullable|numeric|min:1',
            'cover' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:5000',
            'pdf_file' => 'nullable|mimes:pdf|max:5120',
            'regular_price' => 'nullable|numeric|min:0',
            'sale_price' => 'required|numeric|min:0|lte:regular_price',
            'discounted_price' => 'nullable|numeric|min:0',
            'discounted_percent' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer',
            'tag_id' => 'nullable|array',
            'tag_id.*' => 'nullable|string',
            'isbn_no' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('books', 'isbn_no')->where(function ($query) {
                    return $query->where('status', 1);
                })->ignore($id),
            ],
        ];
    }

}
