<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ThankYouPageController extends Controller
{
    /**
     * @param Order $order
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function paypal(Order $order)
    {
        $order->loadMissing(['user', 'transaction', 'products']);

        Cart::instance('cart')->destroy();

        return view('thankyou/summary', compact('order'));
    }
}
