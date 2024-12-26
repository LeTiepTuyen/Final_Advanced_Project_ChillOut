<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderItemModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if an order item belongs to an order.
     */
    public function test_order_item_belongs_to_order()
    {
        // Arrange: Create an order and an order item
        $order = Order::factory()->create();
        $orderItem = OrderItem::factory()->create(['order_id' => $order->id]);

        // Act: Fetch the related order from the order item
        $relatedOrder = $orderItem->order;

        // Assert: Verify the relation is correct
        $this->assertInstanceOf(Order::class, $relatedOrder);
        $this->assertEquals($order->id, $relatedOrder->id);
    }

    /**
     * Test if an order item belongs to a product.
     */
    public function test_order_item_belongs_to_product()
    {
        // Arrange: Create a product and an order item
        $product = Product::factory()->create();
        $orderItem = OrderItem::factory()->create(['product_id' => $product->id]);

        // Act: Fetch the related product from the order item
        $relatedProduct = $orderItem->product;

        // Assert: Verify the relation is correct
        $this->assertInstanceOf(Product::class, $relatedProduct);
        $this->assertEquals($product->id, $relatedProduct->id);
    }

    /**
     * Test if the fillable attributes are correct.
     */
    public function test_order_item_has_correct_fillable_attributes()
    {
        // Arrange: Create an OrderItem instance
        $orderItem = new OrderItem();

        // Assert: Verify the fillable attributes
        $this->assertEquals(
            ['order_id', 'product_id', 'created_at'],
            $orderItem->getFillable()
        );
    }
}
