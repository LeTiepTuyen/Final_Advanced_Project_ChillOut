<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductImageModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a product image belongs to a product.
     */
    public function test_product_image_belongs_to_product()
    {
        // Arrange: Create a product and a related product image
        $product = Product::factory()->create();
        $productImage = ProductImage::factory()->create(['product_id' => $product->id]);

        // Act: Fetch the related product from the product image
        $relatedProduct = $productImage->product;

        // Assert: Verify the relationship
        $this->assertInstanceOf(Product::class, $relatedProduct);
        $this->assertEquals($product->id, $relatedProduct->id);
    }

    /**
     * Test if the product image has correct fillable attributes.
     */
    public function test_product_image_has_correct_fillable_attributes()
    {
        // Arrange: Create a ProductImage instance
        $productImage = new ProductImage();

        // Assert: Verify the fillable attributes
        $this->assertEquals(
            ['product_id', 'url'],
            $productImage->getFillable()
        );
    }
}
