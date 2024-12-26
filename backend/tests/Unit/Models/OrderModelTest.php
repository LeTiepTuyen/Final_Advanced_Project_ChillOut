<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if an order can have multiple order items.
     */
    public function test_order_can_have_multiple_items()
    {
        // Arrange: Create an Order with related OrderItems
        $order = Order::factory()
            ->has(OrderItem::factory()->count(5), 'items')
            ->create();

        // Act: Get the items of the order
        $items = $order->items;

        // Assert: Check if the items are of correct count and type
        $this->assertCount(5, $items);
        $this->assertInstanceOf(OrderItem::class, $items->random());
    }

    /**
     * Test if the order has correct fillable attributes.
     */
    public function test_order_has_correct_fillable_attributes()
    {
        // Arrange: Create an Order instance
        $order = new Order();

        // Assert: Ensure the fillable attributes match the expected array
        $this->assertEquals(
            ['user_id', 'name', 'address', 'zipcode', 'city', 'country', 'created_at'],
            $order->getFillable()
        );
    }

    /**
     * Test if the order primary key is non-incrementing and of type string.
     */
    public function test_order_primary_key_is_non_incrementing_and_string()
    {
        // Arrange: Create an Order instance
        $order = new Order();

        // Assert: Check primary key properties
        $this->assertFalse($order->incrementing);
        $this->assertEquals('string', $order->getKeyType());
    }
}
