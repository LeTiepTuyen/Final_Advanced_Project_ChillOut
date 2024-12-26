<?php

namespace Tests\Feature\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    /**
     * Test index method to retrieve a list of products.
     */
    public function test_can_retrieve_list_of_products()
    {
        // Arrange
        Product::factory()->count(5)->create();

        // Act
        $response = $this->getJson(route('products.index'));

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'title', 'description', 'short_description', 'url', 'price']]]);
    }

    /**
     * Test show method to retrieve a single product.
     */
    public function test_can_retrieve_single_product()
    {
        // Arrange
        $product = Product::factory()->create();

        // Act
        $response = $this->getJson(route('products.show', $product->id));

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'data' => ['id' => $product->id, 'title' => $product->title],
            ]);
    }

    /**
     * Test store method to create a new product.
     */
    public function test_can_create_product()
    {
        // Arrange
        $data = [
            'title' => 'New Product',
            'description' => 'This is a test product.',
            'short_description' => 'Test product.',
            'url' => 'https://example.com/product',
            'price' => 99.99,
        ];

        // Act
        $response = $this->postJson(route('products.store'), $data);

        // Assert
        $response->assertStatus(201)
            ->assertJson(['data' => ['title' => 'New Product', 'price' => 99.99]]);
        $this->assertDatabaseHas('products', $data);
    }

    /**
     * Test update method to modify an existing product.
     */
    public function test_can_update_product()
    {
        // Arrange
        $product = Product::factory()->create();
        $updateData = ['title' => 'Updated Product'];

        // Act
        $response = $this->putJson(route('products.update', $product->id), $updateData);

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'data' => ['id' => $product->id, 'title' => 'Updated Product'],
            ]);
        $this->assertDatabaseHas('products', $updateData);
    }

    /**
     * Test destroy method to delete a product.
     */
    public function test_can_delete_product()
    {
        // Arrange
        $product = Product::factory()->create();

        // Act
        $response = $this->deleteJson(route('products.destroy', $product->id));

        // Assert
        $response->assertStatus(200)
            ->assertJson(['message' => 'Product deleted successfully']);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
