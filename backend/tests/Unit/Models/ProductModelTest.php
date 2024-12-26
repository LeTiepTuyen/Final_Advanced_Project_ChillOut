<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a product can have multiple images.
     */
    public function test_product_can_have_multiple_images()
    {
        // Arrange: Create a product with related images
        $product = Product::factory()
            ->has(ProductImage::factory()->count(3), 'images')
            ->create();

        // Act: Fetch the related images
        $images = $product->images;

        // Assert: Verify the images relationship
        $this->assertCount(3, $images);
        $this->assertInstanceOf(ProductImage::class, $images->random());
    }

    /**
     * Test if a product can have multiple order items.
     */
    public function test_product_can_have_multiple_order_items()
    {
        // Arrange: Create a product with related order items
        $product = Product::factory()
            ->has(OrderItem::factory()->count(5), 'orderItems')
            ->create();

        // Act: Fetch the related order items
        $orderItems = $product->orderItems;

        // Assert: Verify the order items relationship
        $this->assertCount(5, $orderItems);
        $this->assertInstanceOf(OrderItem::class, $orderItems->random());
    }

    /**
     * Test if the product has correct fillable attributes.
     */
    public function test_product_has_correct_fillable_attributes()
    {
        // Arrange: Create a Product instance
        $product = new Product();

        // Assert: Verify the fillable attributes
        $this->assertEquals(
            ['title', 'description', 'short_description', 'url', 'price', 'created_at'],
            $product->getFillable()
        );
    }
}
