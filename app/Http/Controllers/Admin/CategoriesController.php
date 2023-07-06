<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate(5);

        return view('admin/categories/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin/categories/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategory $request)
    {
        $fields = $request->validated();
        $fields['slug'] = Str::of($fields['name'])->slug('-');

        Category::create($fields);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();

        return view('admin/categories/edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategory $request, Category $category)
    {
        $category->updateOrFail($request->validated());

        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->middleware('permission:' . config('permission.access.categories.delete'));

        if ($category->childs()->exists()) {
            $category->childs()->update(['parent_id' => null]);
        }

        $category->deleteOrFail();

        return redirect()->route('admin.categories.index');
    }
}
