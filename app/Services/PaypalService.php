<?php

namespace App\Services;

use App\Enums\PaymentSystem;
use App\Enums\TransactionStatus;
use App\Http\Requests\CreateOrderRequest;
use App\Repositories\Contracts\OrderRepositoryContract;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal;

class PaypalService implements Contracts\PaypalServiceContract
{
    protected PayPal $payPalClient;

    const COMPLETED = "COMPLETED";

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
                    'vendor_order_id' => $paypalOrder['id'],
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

            $result = $this->payPalClient->capturePaymentOrder($vendorOrderId);
            $order = $repository->setTransaction(
                $vendorOrderId,
                PaymentSystem::Paypal,
                $this->convertStatus($result['status'])
            );
            $result['orderId'] = $order->id;
            DB::commit();

            \App\Events\OrderCreated::dispatch($order);

            return response()->json($order);
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
                        'currency_code' => config('paypal.currency'),
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

    protected function convertStatus(string $status): TransactionStatus
    {
        return match($status) {
            static::COMPLETED, "APPROVED" => TransactionStatus::Success,
            "CREATED", "SAVED" => TransactionStatus::Pending,
            default => TransactionStatus::Canceled
        };
    }
}
