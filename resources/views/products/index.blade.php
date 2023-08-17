<x-app-layout>
    <section class="bg-white py-8">

        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                       href="#">
                        Store
                    </a>

                    <div class="flex items-center" id="store-nav-content">

                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24">
                                <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z"/>
                            </svg>
                        </a>

                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24">
                                <path
                                    d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z"/>
                            </svg>
                        </a>

                    </div>
                </div>
            </nav>
        </div>
    </section>
    <section class="bg-white">
        <div class="container px-6 py-8 mx-auto">
            <div class="lg:flex lg:-mx-2">
                <div class="lg:w-4/12" style="border-right: 1px solid">
                    <form class="space-y-3 lg:px-2 lg:space-y-4"
                          method="GET"
                          action="{{route('products.index')}}"
                    >
                        <label class='text-gray-600'>Colors</label>
                        <div class="flex flex-wrap align-items-start justify-start">
                            @foreach($colors as $color)
                                <div
                                    class="mr-4 last:mr-0 mb-2 block p-1 border-2 border-gray-500 rounded-full transition ease-in duration-300"
                                    style="display: flex"
                                >
                                    <input
                                        type="radio"
                                        id="color_{{$color->id}}"
                                        style="display: none"
                                        name="color"
                                        class="filter-color"
                                        value="{{$color->id}}"
                                        {{request()->get('color', '') == $color->id ? 'checked' : ''}}
                                    >
                                    <label for="color_{{$color->id}}"
                                           class="block w-6 h-6 rounded-full cursor-pointer"
                                           style="display: block; background-color: {{$color->hex}}"
                                    ></label>
                                </div>
                            @endforeach
                        </div>
                        <!-- component -->
                        <div class='flex flex-wrap align-items-start justify-start'>
                            <label for="brands" class='text-gray-600'>Brands</label>
                            <select id="brands" name="brands[]" style="min-height: 250px; width: 100%" multiple>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}"
                                            @if(in_array($brand->id, request()->get('brands', []))) selected @endif
                                    >{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-button action="submit" type="button" class="w-full m-0 font-bold" style="margin: 1rem 0 0;">
                            Filter
                        </x-button>
                    </form>
                    <form class="space-y-3 lg:px-2 lg:space-y-4"
                          method="GET"
                          action="{{route('products.index')}}"
                    >
                        <x-button action="submit" colorType="warning" type="button" class="w-full m-0 font-bold"
                                  style="margin: 1rem 0 0;">Reset
                        </x-button>
                    </form>
                </div>
                <div class="mt-6 lg:mt-0 lg:px-2 lg:w-8/12  mx-auto flex items-center flex-wrap pt-4 pb-12">
                    @foreach($products as $product)
                        <x-product-grid :product="$product"/>
                    @endforeach
                    <br>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
