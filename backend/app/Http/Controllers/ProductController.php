<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Get all products with optional search functionality.
    */
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%$search%");
            })
            ->paginate(30);

        Log::info('Products retrieved successfully', ['count' => $products->total()]);

        return ProductResource::collection($products);
    }

    /**
     * Get a single product by ID.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

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
        $product = Product::findOrFail($id);

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
        $product = Product::findOrFail($id);

        $product->delete();

        Log::info('Product deleted successfully', ['product_id' => $id]);

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
