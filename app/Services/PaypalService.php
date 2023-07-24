<?php

namespace App\Services;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\Contracts\OrderRepositoryContract;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal;

class PaypalService implements Contracts\PaypalServiceContract
{
    const PAYMENT_SYSTEM = 'PAYPAL';

    protected PayPal $payPalClient;

    public function __construct()
    {
        $this->payPalClient = new PayPal();
        $this->payPalClient->setApiCredentials(config('paypal'));
        $this->payPalClient->setAccessToken($this->payPalClient->getAccessToken());
    }

    public function create(CreateOrderRequest $request, OrderRepositoryContract $repository)
    {
        try {
            DB::beginTransaction();
            $total = Cart::instance('cart')->total();
            $paypalOrder = $this->createPaymentOrder($total);
            $request = array_merge(
                $request->validated(),
                [
                    'total' => $total
                ]
            );
            $order = $repository->create($request);

            DB::commit();
            return response()->json($order);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->errorHandler($exception);
        }
    }

    public function capture(string $vendorOrderId, OrderRepositoryContract $repository)
    {
        try {
            DB::beginTransaction();


            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->errorHandler($exception);
        }
    }

    protected function createPaymentOrder($total): array
    {
        return $this->payPalClient->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency' => config('paypal.currency'),
                        'value' => $total
                    ]
                ]
            ]
        ]);
    }

    protected function errorHandler(\Exception $exception)
    {
        logs()->warning($exception);
        return response()->json(['error' => $exception->getMessage()], 422);
    }
}
