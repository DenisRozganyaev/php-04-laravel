<?php

namespace App\Repositories;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
            $data['attributes'] = $this->addSlugToAttributes($data['attributes']);
            ksort($data['attributes']);
            $product = Product::create($data['attributes']);
            $this->setProductData($product, $data);

            DB::commit();

            return $product;
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }
    public function update(Product $product, UpdateProductRequest $request): bool
    {
        try {
            \DB::beginTransaction();

            $data = $this->formatRequestData($request);

            if ($data['attributes']['title'] && $data['attributes']['title'] !== $product->title) {
                $data['attributes'] = $this->addSlugToAttributes($data['attributes']);
            }

            $product->update($data['attributes']);
            $this->setProductData($product, $data);

            \DB::commit();

            return true;
        } catch (\Exception $exception) {
            \DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    protected function formatRequestData(CreateProductRequest|UpdateProductRequest $request): array
    {
        return [
            'attributes' => collect($request->validated())->except(['categories'])->toArray(),
            'categories' => $request->get('categories', [])
        ];
    }

    protected function setProductData(Product $product, array $data)
    {
        $this->setCategories($product, $data['categories']);
        $this->attachImages($product, $data['attributes']['images'] ?? []);
    }

    public function setCategories(Product $product, array $categories = []): void
    {
        if ($product->categories()->exists()) {
            $product->categories()->detach();
        }

        if (!empty($categories)) {
            $product->categories()->attach($categories);
        }
    }

    protected function attachImages(Product $product, array $images = [])
    {
        $this->imageRepository->attach($product, 'images', $images, $product->slug);
    }

    protected function addSlugToAttributes(array $attributes): array
    {
        return array_merge(
            $attributes,
            ['slug' => Str::of($attributes['title'])->slug('-')->value()]
        );
    }
}
