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
    public function searchByName(Request $request)
{
    try {
        $name = $request->query('name', '');
        $products = Product::where('title', 'LIKE', '%' . $name . '%')->take(5)->get();

        if ($products->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No products found',
                'data' => []
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error searching products',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function getProductById($id)
{
    try {
        // Tìm sản phẩm theo ID và nạp quan hệ 'images'
        $product = Product::with('images')->find($id);

        // Nếu sản phẩm không tồn tại, trả về phản hồi 404
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        // Trả về chi tiết sản phẩm
        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);

    } catch (\Exception $e) {
        // Bắt các lỗi không mong muốn
        return response()->json([
            'success' => false,
            'message' => 'Error fetching product',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
