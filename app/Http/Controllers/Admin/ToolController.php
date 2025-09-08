<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ToolController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file (you can change validation as per your needs)
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', 
        ]);

        // Store the image in the 'public' disk (adjust as needed)
        $image = $request->file('upload');

        $uploadDirectory = "media/uploads/ckeditor_images";
        if ($request->has('uploadDirectory') && !empty($request->input('uploadDirectory'))) {
            // $uploadDirectory = $request->input('uploadDirectory');  
            $uploadDirectory = $request->input('uploadDirectory');
        }

        // Return a JSON response with the file URL

        $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        $f_n = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), '-');
        $imageName = $f_n . '-' . time() . '.' . $ext;
        $image->move($uploadDirectory, $imageName);

        $url = url($uploadDirectory, $imageName);


        return response()->json(['fileName' => $imageName, 'uploaded' => 1, 'url' => $url]);
    }
}
