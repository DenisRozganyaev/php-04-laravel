<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart/index');
    }

    public function add(Request $request, Product $product)
    {
        Cart::instance('cart')->add(
            $product,
            $request->get('quantity', 1)
        );

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'rowId' => ['required', 'string']
        ]);

        Cart::instance('cart')->remove($data['rowId']);

        return redirect()->back();
    }

    /**
     * Update count per product inside cart
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function countUpdate(Request $request, Product $product)
    {

    }
}
