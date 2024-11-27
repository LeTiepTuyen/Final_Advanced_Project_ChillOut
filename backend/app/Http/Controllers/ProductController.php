<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    // Get all products
    public function getAllProducts()
    {
        try {
            // Debug connection
            \Log::info('Database connection: ' . config('database.default'));
            \Log::info('Database config: ' . json_encode(config('database.connections.pgsql')));
            
            // Check if table exists
            \Log::info('Table exists: ' . Schema::hasTable('products'));
            
            // Get table columns
            \Log::info('Table columns: ' . json_encode(Schema::getColumnListing('products')));
            
            $products = Product::all();
            \Log::info('Products count: ' . $products->count());
            \Log::info('Products data: ' . json_encode($products));
            
            return response()->json([
                'success' => true,
                'data' => $products,
                'count' => $products->count()
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error fetching products: ' . $e->getMessage());
            \Log::error('Error trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching products',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Search products by name
    public function searchByName($name)
    {
        $products = Product::where('title', 'LIKE', '%' . $name . '%')->take(5)->get();
        return response()->json($products, 200);
    }

    // Get product by ID
    public function getProductById($id)
    {
        $product = Product::with('images')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }
}
