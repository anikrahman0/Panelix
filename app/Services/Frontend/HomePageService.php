<?php

namespace App\Services\Frontend;

use App\Models\Book;
use App\Services\BookService;
use App\Services\AuthorService;
use App\Services\BundleService;
use App\Services\SliderService;
use App\Constants\CacheLifetime;
use App\Services\CategoryService;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Cache;

class HomePageService{

    protected $bookService, $categoryService, $settingsService, $sliderService, $authorService, $bundleService;

    public  function __construct(
        BookService $bookService, 
        CategoryService $categoryService, 
        SettingsService $settingsService, 
        SliderService $sliderService, 
        AuthorService $authorService,
        BundleService $bundleService
    )
    {
        $this->bookService = $bookService;
        $this->categoryService = $categoryService;   
        $this->settingsService = $settingsService;
        $this->sliderService = $sliderService;
        $this->authorService = $authorService;
        $this->bundleService = $bundleService;
    }
    public function getHomePageData(){
        return [
            'newlyPublishedBooks' => $this->bookService->newlyPublishedBooks(),
            'preOrderedBooks'     => $this->bookService->preOrderedBooks(),
            'getCategoryBooks'    => Cache::remember('home_category_books', CacheLifetime::ONE_DAY, function () { return $this->categoryService->getCategoryBooks();}),
            'latestCategories'    => Cache::remember('home_latest_categories', CacheLifetime::ONE_DAY, function () { return $this->categoryService->latestCategories(10);}),
            'scrollCategories'    => $this->categoryService->scrollCategories(),
            'getHomeBanners'      => $this->settingsService->getHomeBanners(),
            'getSliders'          => $this->sliderService->getSliders(),
            'getAuthors'          => Cache::remember('home_authors', CacheLifetime::ONE_DAY, function () { return $this->authorService->getAuthors(10);}),
            'getBundles'          => Cache::remember('home_bundles', CacheLifetime::ONE_DAY, function () { return $this->bundleService->getBundles();})
        ];      
    }
}