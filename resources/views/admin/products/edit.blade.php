<x-admin-layout>

    <div class="w-full px-6 py-6 mx-auto">
        <!-- table 1 -->

        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0">
                            <div class="container mx-auto py-8">
                                <h1 class="text-2xl font-bold mb-6 text-center">Update product</h1>
                                <form class="w-full max-w-sm mx-auto bg-white p-8 rounded-md shadow-md"
                                      action="{{route('admin.products.update', $product)}}"
                                      enctype="multipart/form-data"
                                      method="POST">
                                    @csrf
                                    @method('PUT')

                                    @if (!empty($categories))
                                        <div class="mb-4">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="categories">Categories</label>
                                            <select name="categories[]"
                                                    id="categories"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                                    multiple
                                            >
                                                <option value=""></option>
                                                @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}"
                                                        @if(in_array($cat->id, $productCategories)) selected @endif
                                                    >{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                                        </div>
                                    @endif
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                               for="SKU">SKU</label>
                                        <input
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                            type="text" id="SKU" name="SKU" placeholder="NS228JG" value="{{ $product->SKU }}">
                                        <x-input-error :messages="$errors->get('SKU')" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                               for="title">Title</label>
                                        <input
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                            type="text" id="title" name="title" placeholder="Product title" value="{{ $product->title }}">
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                                        <textarea
                                            rows="4"
                                            name="description"
                                            id="description"
                                            placeholder="Type your message"
                                            class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        >{{ $product->description }}</textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                               for="price">Price</label>
                                        <input
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                            type="text" id="price" name="price" placeholder="22.25" value="{{ $product->price }}">
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                               for="discount">Discount</label>
                                        <input
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                            type="number" id="discount" name="discount" placeholder="22" min="0" max="100" value="{{ $product->discount }}">
                                        <x-input-error :messages="$errors->get('discount')" class="mt-2" />
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                               for="quantity">Quantity</label>
                                        <input
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                            type="number" id="quantity" name="quantity" placeholder="5" min="0" value="{{ $product->quantity }}">
                                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                                    </div>

                                    <div class="mb-4">
                                        <img src="{{ $product->thumbnailUrl }}" id="thumbnail-preview" style="display: block">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                               for="thumbnail">Thumbnail</label>
                                        <input
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                            type="file" id="thumbnail" name="thumbnail">
                                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                                    </div>

                                    <div class="mb-4 images-wrapper">
                                        @foreach($product->images as $image)
                                            @if(Storage::has($image->path))
                                                <div class="mb-4" style="position: relative">
                                                    <img src="{{ $image->url }}" class="card-img-top" style="width: 100%; margin: 0 auto; display: block;">
                                                    <x-button href="#"
                                                              color-type="danger"
                                                              class="py-1 px-2 remove-image"
                                                              style="position: absolute; top: 0; right: 0"
                                                              data-route="{{ route('ajax.images.delete', $image) }}"
                                                    >
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </x-button>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2"
                                               for="images">Images</label>
                                        <input
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                                            type="file" id="images" name="images[]" multiple>
                                    </div>

                                    <x-button action="submit" type="button" class="w-full m-0 font-bold">Update
                                        Product
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
