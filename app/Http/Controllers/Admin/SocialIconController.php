<?php

namespace App\Http\Controllers\Admin;

use App\Models\SocialPlatform;
use App\Library\CommonFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialIconValidationRequest;

class SocialIconController extends Controller
{
    public function index(){
        $socialIcons = SocialPlatform::where('status', 1)->get();
        return view('layouts.admin.dashboard.social-icon.index', compact('socialIcons'));
    }

    public function create(){
        return view('layouts.admin.dashboard.social-icon.add');
    }

    public function store(SocialIconValidationRequest $request){
        $validated = $request->validated();
        $logo = $request->file('logo');
        if ($logo != '') {
            $logoname = CommonFunctions::imageUpload($logo, 'media/uploads/social-icon');
            $validated['logo'] = $logoname;
        }
        SocialPlatform::create($validated);
        return to_route('admin.social-icon.index')->with('success', 'Social Icon Created Successfully');
    }

    public function edit($id){
        $socialIcon = SocialPlatform::where('id', $id)->where('status', 1)->first();
        if(!empty($socialIcon)){
            return view('layouts.admin.dashboard.social-icon.edit', compact('socialIcon'));
        }
        abort(404);
    }

    public function update(SocialIconValidationRequest $request, $id){
        $validated = $request->validated();
        $socialIcon = SocialPlatform::where('id', $id)->where('status', 1)->first();
        if(!empty($socialIcon)){
            $logo = $request->file('logo');
            if ($logo != '') {
                $logoname = CommonFunctions::imageUpload($logo, 'media/uploads/social-icon');
                $validated['logo'] = $logoname;
            }
            $socialIcon->update($validated);
            return to_route('admin.social-icon.index')->with('success', 'Social Icon Updated successfully');
        }
        abort(404);
    }

    public function destroy($id){
        $delete = SocialPlatform::findOrFail($id);
        $delete->status = 2;
        $delete->update();
        return back()->with('success', 'Social Icon deleted successfully');
    }
   
}
