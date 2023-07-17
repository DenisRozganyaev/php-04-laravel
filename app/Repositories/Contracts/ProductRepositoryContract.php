<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

interface ProductRepositoryContract
{
    public function create(CreateProductRequest $request): Product|false;
    public function update(Product $product, UpdateProductRequest $request): bool;
}
