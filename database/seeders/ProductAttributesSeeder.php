<?php

namespace Database\Seeders;

use App\Models\Attributes\Brand;
use App\Models\Attributes\Color;
use Illuminate\Database\Seeder;

class ProductAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory(5)->create();
        Color::factory(15)->create();
    }
}
