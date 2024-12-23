<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Get all orders with optional search functionality.
     */
    public function index(Request $request)
    {
        $orders = Order::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%$search%");
            })
            ->paginate(30);

        Log::info('Orders retrieved successfully', ['count' => $orders->total()]);

        return OrderResource::collection($orders);
    }

    /**
     * Get a single order by ID.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        Log::info('Order retrieved successfully', ['order_id' => $id]);

        return new OrderResource($order);
    }

    /**
     * Create a new order.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|uuid',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'zipcode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $order = Order::create($validated);

        Log::info('Order created successfully', ['order_id' => $order->id]);

        return new OrderResource($order);
    }

    /**
     * Update an existing order.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'nullable|uuid',
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'zipcode' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $order->update($validated);

        Log::info('Order updated successfully', ['order_id' => $order->id]);

        return new OrderResource($order);
    }

    /**
     * Delete an order by ID.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        Log::info('Order deleted successfully', ['order_id' => $id]);

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
