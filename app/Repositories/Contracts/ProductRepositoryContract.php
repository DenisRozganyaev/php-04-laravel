<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface ProductRepositoryContract
{
    public function create(CreateProductRequest $request): Product|false;
    public function update(Product $product, UpdateProductRequest $request): bool;

    public function get(Product $product, Request $request): Product;

    public function paginate(int $perPage, Request $request): LengthAwarePaginator;
}
