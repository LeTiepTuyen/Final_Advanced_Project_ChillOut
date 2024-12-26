<?php

namespace Tests\Feature\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index method to retrieve a list of orders.
     */
    public function test_can_retrieve_list_of_orders()
    {
        // Arrange
        Order::factory()->count(5)->create();

        // Act
        $response = $this->getJson(route('orders.index'));

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'name', 'address', 'zipcode', 'city', 'country']]]);
    }

    /**
     * Test show method to retrieve a single order.
     */
    public function test_can_retrieve_single_order()
    {
        // Arrange
        $order = Order::factory()->create();

        // Act
        $response = $this->getJson(route('orders.show', $order->id));

        // Assert
        $response->assertStatus(200)
            ->assertJson(['data' => ['id' => $order->id, 'name' => $order->name]]);
    }

    /**
     * Test store method to create a new order.
     */
    public function test_can_create_order()
    {
        // Arrange
        $user = User::factory()->create();
        $data = [
            'user_id' => $user->id,
            'name' => 'John Doe',
            'address' => '123 Street',
            'zipcode' => '12345',
            'city' => 'Sample City',
            'country' => 'Sample Country',
        ];

        // Act
        $response = $this->postJson(route('orders.store'), $data);

        // Assert
        $response->assertStatus(201)
            ->assertJson(['data' => ['name' => 'John Doe', 'address' => '123 Street']]);
        $this->assertDatabaseHas('orders', $data);
    }

    /**
     * Test update method to modify an existing order.
     */
    public function test_can_update_order()
    {
        // Arrange
        $order = Order::factory()->create();
        $updateData = ['name' => 'Updated Name'];

        // Act
        $response = $this->putJson(route('orders.update', $order->id), $updateData);

        // Assert
        $response->assertStatus(200)
            ->assertJson(['data' => ['id' => $order->id, 'name' => 'Updated Name']]);
        $this->assertDatabaseHas('orders', $updateData);
    }

    /**
     * Test destroy method to delete an order.
     */
    public function test_can_delete_order()
    {
        // Arrange
        $order = Order::factory()->create();

        // Act
        $response = $this->deleteJson(route('orders.destroy', $order->id));

        // Assert
        $response->assertStatus(200)
            ->assertJson(['message' => 'Order deleted successfully']);
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}
