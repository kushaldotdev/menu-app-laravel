<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Get all products for a given subcategory.
     */
    public function getProductsBySubCategoryId($sub_category_id)
    {
        $sub_category = Category::whereNotNull('parent_category_id')
            ->with('products')
            ->find($sub_category_id);

        if (!$sub_category) {
            return response()->json([
                'error' => 'Subcategory not found or does not exist.'
            ], 404);
        }

        if ($sub_category->products->isEmpty()) {
            return response()->json([
                'sub_category' => $sub_category->category_name,
                'message' => 'No products found for this subcategory.',
                'products' => []
            ], 200);
        }

        return response()->json([
            'sub_category' => $sub_category->category_name,
            'products' => $sub_category->products
        ]);
    }
}
