<?php

namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderRepositoryContract
{
    public function create(array $data): Order|bool;
}
