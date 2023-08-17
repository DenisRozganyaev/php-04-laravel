<?php

namespace App\Http\Controllers;

use App\Models\Attributes\Brand;
use App\Models\Attributes\Color;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use Illuminate\Http\Request;
use PhpParser\Builder;

class ProductsController extends Controller
{
    public function index(Request $request, ProductRepositoryContract $repository)
    {
        $products = $repository->paginate(8, $request);
        $colors = Color::withExists('products')->get();
        $brands = Brand::all();

        return view('products/index', compact('products', 'colors', 'brands'));
    }

    public function show(Request $request, Product $product, ProductRepositoryContract $repository)
    {
        $product = $repository->get($product, $request);

        return view('products/show', compact('product'));
    }
}
