<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    // Get all orders by user
    public function getAllOrdersByUser($userId)
    {
        $orders = Order::with(['orderItems.product'])->where('user_id', $userId)->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found'], 404);
        }

        return response()->json($orders, 200);
    }

    // Create a new order
    public function createOrder(Request $request)
    {
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

        // Check if all products exist
        $productIds = collect($data['items'])->pluck('productId');
        $existingProducts = Product::whereIn('id', $productIds)->pluck('id');

        if ($existingProducts->count() !== $productIds->count()) {
            return response()->json(['message' => 'One or more product IDs are invalid'], 400);
        }

        // Create the order
        $order = Order::create([
            'user_id' => $data['userId'],
            'name' => $data['name'],
            'address' => $data['address'],
            'zipcode' => $data['zipcode'],
            'city' => $data['city'],
            'country' => $data['country'],
        ]);

        foreach ($data['items'] as $item) {
            $order->orderItems()->create(['product_id' => $item['productId']]);
        }

        return response()->json($order->load('orderItems.product'), 201);
    }
}
