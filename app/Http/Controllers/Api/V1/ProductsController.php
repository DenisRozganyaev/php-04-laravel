<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Products\IndexRequest;
use App\Http\Resources\Products\ProductsCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validated();
        $request = Product::with(['categories', 'images']);

        if ($data['order_column']) {
            $request->orderBy(
                $data['order_column'],
                $data['order_direction'] ?? 'asc'
            );
        }

        $result = $request->paginate($data['limit'] ?? 10);

        return (new ProductsCollection($result))
            ->additional([
                'meta_data' => [
                    'total' => $result->total(),
                    'per_page' => $result->perPage(),
                    'page' => $result->currentPage(),
                    'to' => $result->lastPage(),
                    'path' => $result->path()
                ]
            ]);
    }
}
