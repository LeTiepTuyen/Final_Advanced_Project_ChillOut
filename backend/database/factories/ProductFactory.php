<?php


namespace Database\Factories;


use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;


    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'short_description' => $this->faker->sentence(),
            // 'url' => $this->faker->imageUrl(640, 480, 'products', true, 'Test Product'),
            'url' => 'https://www.optimized-rlmedia.io/is/image/PoloGSI/s7-60200402A2310_alternate1?$rl_enh_1x1_zoom$',
            'price' => $this->faker->randomFloat(2, 10, 500),
            'created_at' => now(),
        ];
    }
}
