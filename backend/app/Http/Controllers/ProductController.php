<?php

namespace App\Http\Controllers;

use App\Services\ErrorHandler;
use App\Services\LogHandler;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Get all products
    public function getAllProducts()
    {
        LogHandler::logInfo('Fetching all products');

        // Ensure the "products" table exists
        ErrorHandler::ensureTableExists('products');

        $products = Product::all();

        // Abort if no products found
        ErrorHandler::abortIfEmpty($products, 'No products found');

        LogHandler::logInfo('Products retrieved successfully', ['count' => $products->count()]);

        return response()->json([
            'success' => true,
            'data' => $products,
            'count' => $products->count()
        ], 200);
    }

    // Search products by name
    public function searchByName(Request $request)
    {
        $name = $request->query('name', '');
        LogHandler::logInfo('Searching products', ['search_term' => $name]);

        // Validate query parameter
        if (!$name) {
            ErrorHandler::abortWithLog('Search term is missing', 'Search term is required');
        }

        // Ensure the "products" table exists
        ErrorHandler::ensureTableExists('products');

        $products = Product::where('title', 'LIKE', '%' . $name . '%')->take(5)->get();

        // Abort if no products found
        ErrorHandler::abortIfEmpty($products, 'No products found', ['search_term' => $name]);

        LogHandler::logInfo('Products found', ['search_term' => $name, 'count' => $products->count()]);

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    // Get product by ID
    public function getProductById($id)
    {
        LogHandler::logInfo('Fetching product', ['product_id' => $id]);

        // Validate the ID
        ErrorHandler::validateId($id);

        // Ensure the "products" table exists
        ErrorHandler::ensureTableExists('products');

        $product = Product::find($id);

        // Abort if product not found
        ErrorHandler::abortIfEmpty(collect($product), 'Product not found', ['product_id' => $id]);

        LogHandler::logInfo('Product retrieved successfully', ['product_id' => $id]);

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }
}
