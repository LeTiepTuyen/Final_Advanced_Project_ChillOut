<?php

namespace Tests\Feature\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    /**
     * Test index method to retrieve a list of addresses.
     */
    public function test_can_retrieve_list_of_addresses()
    {
        // Arrange
        Address::factory()->count(5)->create();

        // Act
        $response = $this->getJson(route('addresses.index'));

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [['id', 'user_id', 'name', 'address', 'zipcode', 'city', 'country']],
            ]);
    }

    /**
     * Test show method to retrieve a single address.
     */
    public function test_can_retrieve_single_address()
    {
        // Arrange
        $address = Address::factory()->create();

        // Act
        $response = $this->getJson(route('addresses.show', $address->id));

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'data' => ['id' => $address->id, 'name' => $address->name],
            ]);
    }

    /**
     * Test store method to create a new address.
     */
    public function test_can_create_address()
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
        $response = $this->postJson(route('addresses.store'), $data);

        // Assert
        $response->assertStatus(201)
            ->assertJson([
                'data' => ['name' => 'John Doe', 'address' => '123 Street'],
            ]);
        $this->assertDatabaseHas('addresses', $data);
    }

    /**
     * Test update method to modify an existing address.
     */
    public function test_can_update_address()
    {
        // Arrange
        $address = Address::factory()->create();
        $updateData = ['name' => 'Updated Name'];

        // Act
        $response = $this->putJson(route('addresses.update', $address->id), $updateData);

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'data' => ['id' => $address->id, 'name' => 'Updated Name'],
            ]);
        $this->assertDatabaseHas('addresses', $updateData);
    }

    /**
     * Test destroy method to delete an address.
     */
    public function test_can_delete_address()
    {
        // Arrange
        $address = Address::factory()->create();

        // Act
        $response = $this->deleteJson(route('addresses.destroy', $address->id));

        // Assert
        $response->assertStatus(200)
            ->assertJson(['message' => 'Address deleted successfully']);
        $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
    }
}
