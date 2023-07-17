<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {

    }

    public function show(Category $category)
    {
        $products = $category->products()->paginate(4);
    }
}
