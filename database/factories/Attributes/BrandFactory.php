<?php

namespace Database\Factories\Attributes;

use App\Enums\Country;
use App\Models\Attributes\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $key = array_rand(Country::cases());
        return [
            'name' => fake()->company(),
            'description' => fake()->sentences(rand(2,5), true),
            'country' => Country::cases()[$key]->value
        ];
    }
}
