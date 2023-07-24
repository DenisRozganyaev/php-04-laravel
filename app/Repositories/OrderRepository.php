<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository implements Contracts\OrderRepositoryContract
{

    public function create(array $data): Order|bool
    {
        dd($data);
    }
}
