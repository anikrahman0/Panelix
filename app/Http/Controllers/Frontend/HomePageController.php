<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Services\Frontend\HomePageService;

class HomePageController extends Controller
{
    
    protected $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index(HomePageService $homePageService) {
        $data = $homePageService->getHomePageData();
        return view('layouts.frontend.pages.index',$data);
    }

    public function scrollCategories(Request $request)
    {
        $skipId = $request->get('skip_id');
        $cursor = $request->get('cursor');

        $categories = $this->categoryService->scrollCategories($cursor, $skipId);

        $category = $categories->items()[0] ?? null;

        if ($request->ajax()) {
            if (!$category) {
                return response()->json([
                    'html' => '',
                    'next_cursor' => null,
                ]);
            }

            $html = $this->categoryService->renderCategoryComponent($category);

            return response()->json([
                'html' => $html,
                'next_cursor' => $categories->nextCursor()?->encode(),
            ]);
        }

        return response()->json([
            'error' => 'Something went wrong'
        ]);
    }
}
