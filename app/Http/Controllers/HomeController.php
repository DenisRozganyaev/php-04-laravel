<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
//        dd(app()->currentLocale());
        $categories = Category::take(6)->get();
        $products = Product::orderByDesc('id')->available()->take(8)->get();

        return view('home', compact('categories', 'products'));
    }
}
