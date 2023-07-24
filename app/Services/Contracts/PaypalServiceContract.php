<?php

namespace App\Services\Contracts;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\Contracts\OrderRepositoryContract;

interface PaypalServiceContract
{
    public function create(CreateOrderRequest $request, OrderRepositoryContract $repository);
    public function capture(string $vendorOrderId, OrderRepositoryContract $repository);
}
