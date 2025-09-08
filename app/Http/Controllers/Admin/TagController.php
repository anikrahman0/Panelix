<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagValidationRequest;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::filter(request(['search']))->where('status', 1)->latest()->paginate(20);
        return view('layouts.admin.dashboard.tag.index', compact('tags'));
    }

    public function create(){
        return view('layouts.admin.dashboard.tag.add');
    }

    public function store(TagValidationRequest $request){
        $validated = $request->validated();
        $validated['slug']= Str::slug($validated['slug'], '-',' ');
        Tag::create($validated);
        return to_route('admin.tag.index')->with('success', 'Tag Created Successfully');
    }

    public function edit($id){
        $tag=Tag::where('id', $id)->where('status', 1)->first();
        if(!empty($tag)){
            return view('layouts.admin.dashboard.tag.edit', compact('tag'));
        }
        abort(404);
    }

    public function update(TagValidationRequest $request, $id){
        $validated = $request->validated();
        $validated['slug']= Str::slug($validated['slug'], '-',' ');
        $tag = Tag::where('id', $id)->where('status', 1)->first();
        if(!empty($tag)){
            $tag->update($validated);
            return to_route('admin.tag.index')->with('success', 'Tag Updated successfully');
        }
        abort(404);
    }

    public function destroy($id){
        $delete = Tag::findOrFail($id);
        $delete->status = 2;
        $delete->update();
        return back()->with('success', 'Tag deleted successfully');
    }

    public function get(Request $request){
        $tags = Tag::where('status', 1)
        ->where('name', 'like', '%'. $request->input('term', '') . '%')
        ->get(['id', 'name']);
        return response()->json([
            'results' => $tags->map(function($tag) {
                return ['id' => $tag->id, 'text' => $tag->name];
            })
        ]);
    }
}
