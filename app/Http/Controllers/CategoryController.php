<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;



class CategoryController extends Controller
{

    /**
     * Get all main categories (parent_category_id = NULL).
     */
    public function getAllMainCategories()
    {
        $main_categories = Category::whereNull('parent_category_id')
            ->orderByDesc('updated_at')
            ->get();

        if ($main_categories->isEmpty()) {
            return response()->json([
                'message' => 'No main categories found.'
            ], 200);
        }

        return response()->json([
            'main_categories' => $main_categories
        ]);
    }

    /**
     * Get subcategories for a given main category.
     */
    public function getSubCategoriesByMainCategoryId($main_category_href)
    {
        // Fetch the main category
        $category = Category::whereNull('parent_category_id')
            ->with('subcategories')
            ->with('subcategories.products')
            ->where('category_href', $main_category_href)
            ->first();

        if (!$category) {
            return response()->json([
                'error' => 'Main category not found or does not exist.'
            ], 404);
        }

        return response()->json([
            'main_category' => $category->category_name,
            'main_category_href' => $category->category_href,
            'subCategories' => $category->subcategories
        ]);
    }
}
