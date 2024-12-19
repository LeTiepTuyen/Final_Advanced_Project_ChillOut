<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Shared log error function
    private function logError($message, $context = [])
    {
        Log::error($message, $context);
    }

    // Shared function to validate product IDs
    private function validateProductIds($productIds)
    {
        $existingProducts = Product::whereIn('id', $productIds)->pluck('id');

        if ($existingProducts->count() !== $productIds->count()) {
            $this->logError('Invalid product IDs provided', [
                'product_ids_sent' => $productIds,
                'valid_product_ids' => $existingProducts
            ]);
            abort(403, 'One or more product IDs are invalid'); // Changed from 400 to 403
        }
    }

    // Get all orders by user
    public function getAllOrdersByUser($userId)
    {
        Log::info('Fetching all orders for user.', ['user_id' => $userId]);

        $orders = Order::with(['orderItems.product'])->where('user_id', $userId)->get();

        if ($orders->isEmpty()) {
            Log::warning('No orders found for user.', ['user_id' => $userId]);
            abort(404, 'No orders found');
        }

        Log::info('Orders fetched successfully.', ['user_id' => $userId, 'order_count' => $orders->count()]);

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    // Create a new order
    public function createOrder(Request $request)
    {
        Log::info('Attempting to create a new order.', ['request_data' => $request->all()]);

        // Validate request data
        $data = $request->validate([
            'userId' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'zipcode' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'items' => 'required|array',
            'items.*.productId' => 'required|integer',
        ]);

        // Validate product IDs
        $productIds = collect($data['items'])->pluck('productId');
        $this->validateProductIds($productIds);

        // Create the order
        $order = Order::create([
            'user_id' => $data['userId'],
            'name' => $data['name'],
            'address' => $data['address'],
            'zipcode' => $data['zipcode'],
            'city' => $data['city'],
            'country' => $data['country'],
        ]);

        // Create order items
        foreach ($data['items'] as $item) {
            $order->orderItems()->create(['product_id' => $item['productId']]);
        }

        Log::info('Order created successfully.', ['order_id' => $order->id, 'user_id' => $data['userId']]);

        return response()->json([
            'success' => true,
            'data' => $order->load('orderItems.product')
        ], 201);
    }
}
