<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;

interface ProductRepositoryContract
{
    public function create(CreateProductRequest $request): Product|false;
}
