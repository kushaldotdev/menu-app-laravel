<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackMessageController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return response()->json(['message' => 'Welcome to Menu-App API']);
});


Route::prefix('categories')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'getAllMainCategories'); // Get all main categories
    Route::get('{main_category_href}/subcategories', 'getSubCategoriesByMainCategoryId'); // Get subcategories of a main category
});
Route::post('feedback', [FeedbackMessageController::class, 'storeFeedbackMessage']); // Store feedback message
Route::get('feedbacks', [FeedbackMessageController::class, 'getAllFeedbackMessages']); // Get all feedback messages


Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('refresh', 'refresh')->middleware('auth:api');
    Route::post('logout', 'logout')->middleware('auth:api');
});
