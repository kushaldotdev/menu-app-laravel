<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


Route::get('/test', function () {
    return response()->json(['message' => 'Welcome to Menu-App API']);
});


Route::prefix('categories')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'getAllMainCategories'); // Get all main categories
    Route::get('{main_category_id}/subcategories', 'getSubCategoriesByMainCategoryId'); // Get subcategories of a main category
});

Route::prefix('categories/{sub_category_id}')->controller(ProductController::class)->group(function () {
    Route::get('/products', 'getProductsBySubCategoryId'); // Get products under a subcategory
});
