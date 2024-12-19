<?php

namespace App\Http\Controllers;

use App\Services\ErrorHandler;
use App\Services\LogHandler;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Get all products with optional search functionality.
     */
    public function getAllProducts(Request $request)
    {
        $search = $request->get('search', '');
        LogHandler::logInfo('Fetching all products', ['search_term' => $search]);

        // Ensure the "products" table exists
        ErrorHandler::ensureTableExists('products');

        $products = Product::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%$search%");
            })
            ->paginate(30);

        // Abort if no products found
        // ErrorHandler::abortIfEmpty($products, 'No products found', ['search_term' => $search]);

        LogHandler::logInfo('Products retrieved successfully', ['count' => $products->total()]);

        return ProductResource::collection($products);
    }

    /**
     * Get a single product by ID.
     */
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

        return new ProductResource($product);
    }
}
