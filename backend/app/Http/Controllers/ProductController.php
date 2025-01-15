<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache; // Đừng quên thêm thư viện Cache
use App\Exceptions\ProductNotFoundException;

class ProductController extends Controller
{
    /**
     * Get all products with optional search functionality.
     */
    public function index(Request $request)
    {
        $query = $request->get('query', '');
        $cacheKey = 'products_' . hash('sha256', $query ?: 'default');

        Log::info("Using Redis cache connection: " . env('REDIS_CACHE_CONNECTION'));


        $products = Cache::store('redis')->get($cacheKey);

        if (!$products) {
            Log::info("Cache miss: Retrieving products from database");

            if ($query) {
                $products = Product::search($query)->paginate(50);
            } else {
                $products = Product::query()->paginate(50);
            }

            Cache::store('redis')->put($cacheKey, $products, 600);
            Log::info("Cache miss: Products saved to cache");
        } else {
            Log::info("Cache hit: Retrieved products from cache");
        }

        return ProductResource::collection($products);
    }


    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new ProductNotFoundException($id);
        }

        Log::info('Product retrieved successfully', ['product_id' => $id]);

        return new ProductResource($product);
    }

    /**
     * Create a new product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'url' => 'nullable|url',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($validated);

        Log::info('Product created successfully', ['product_id' => $product->id]);

        return new ProductResource($product);
    }

    /**
     * Update an existing product.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new ProductNotFoundException($id);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'url' => 'nullable|url',
            'price' => 'nullable|numeric',
        ]);

        $product->update($validated);

        Log::info('Product updated successfully', ['product_id' => $product->id]);

        return new ProductResource($product);
    }

    /**
     * Delete a product by ID.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new ProductNotFoundException($id);
        }

        $product->delete();

        Log::info('Product deleted successfully', ['product_id' => $id]);

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
