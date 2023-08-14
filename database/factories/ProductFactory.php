<?php

namespace Database\Factories;

use App\Models\Attributes\Brand;
use App\Models\Attributes\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->words(rand(1, 3), true);
        $slug = Str::of($title)->slug('-');

        $brand = Brand::all()->random();

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => fake()->sentences(rand(1, 5), true),
            'SKU' => fake()->unique()->ean13(),
            'price' => fake()->randomFloat(2, 10, 100),
            'discount' => rand(0, 90),
            'quantity' => rand(0, 15),
            'thumbnail' => fake()->imageUrl(),
            'brand_id' => $brand->id
        ];
    }

    public function withColor()
    {
        return $this->state(function (array $attributes) {
            return $attributes;
        })->afterCreating(function(Product $product) {
            $colors = Color::all()->random(rand(2, 4));
            $colors->each(function(Color $color) use ($product) {
                $product->colors()->attach($color, [
                    'price' => fake()->randomFloat(
                        2,
                        ($product->price - 5),
                        ($product->price + 5)
                    ),
                    'quantity' => rand(0, 15)
                ]);
            });
        });
    }
}
