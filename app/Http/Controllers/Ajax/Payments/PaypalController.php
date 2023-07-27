<?php

namespace App\Http\Controllers\Ajax\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Services\Contracts\PaypalServiceContract;

class PaypalController extends Controller
{
    public function create(CreateOrderRequest $request, PaypalServiceContract $paypal)
    {
        return app()->call([$paypal, 'create'], compact('request'));
    }

    public function capture(string $vendorOrderId, PaypalServiceContract $paypal)
    {
        return app()->call([$paypal, 'capture'], compact('vendorOrderId'));
    }
}
