<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(rand(1, 3), true);
        $slug = Str::of($name)->slug('-');

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => fake()->sentences(rand(1, 5), true),
        ];
    }

    public function withParent(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => Category::all()->random()?->id
            ];
        });
    }
}
