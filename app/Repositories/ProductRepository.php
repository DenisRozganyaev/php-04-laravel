<?php

namespace App\Repositories;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Repositories\Contracts\ImageRepositoryContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductRepository implements Contracts\ProductRepositoryContract
{
    public function __construct(protected ImageRepositoryContract $imageRepository){}

    public function create(CreateProductRequest $request): Product|false
    {
        try {
            DB::beginTransaction();

            $data = $this->formatRequestData($request);
            $data['attributes'] = array_merge(
                $data['attributes'],
                ['slug' => Str::of($data['attributes']['title'])->slug('-')->value()]
            );
            ksort($data['attributes']);
            $product = Product::create($data['attributes']);
            $this->setCategories($product, $data['categories']);
            $this->imageRepository->attach(
                $product, 'images', $data['attributes']['images'],
                $data['attributes']['slug']
            );

            DB::commit();

            return $product;
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    protected function formatRequestData(CreateProductRequest $request): array
    {
        return [
            'attributes' => collect($request->validated())->except(['categories'])->toArray(),
            'categories' => $request->get('categories', [])
        ];
    }

    protected function setCategories(Product $product, array $categories = [])
    {
        if (!empty($categories)) {
            $product->categories()->attach($categories);
        }
    }
}
