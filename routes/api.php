<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackMessageController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialAuthController;

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
    Route::post('register', 'register'); // Register a new user
    Route::post('login', 'login'); // Login a user
    Route::post('refresh', 'refresh')->middleware('auth:api'); // Refresh token
    Route::post('logout', 'logout')->middleware('auth:api'); // Logout
});

Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider']); // Redirect to oauth provider
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']); // Handle oauth callback

Route::middleware('auth:api')->get('/user/me', function (Request $request) {
    return $request->user();  //get authenticated user data
});
