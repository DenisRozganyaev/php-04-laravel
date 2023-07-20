<x-app-layout>
    <!-- component -->
    <section class="text-gray-700 body-font overflow-hidden bg-white product-page">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200"
                     src="{{ $product->thumbnailUrl }}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    @if ($product->categories)
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">
                            @foreach($product->categories as $category)
                                <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                            @endforeach
                        </h2>
                    @endif
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->title }}</h1>
                    <div class="flex mb-4">
                        <div class="flex items-center">
                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2"
                                 class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                            <span class="text-gray-600 ml-3">4 Reviews</span>
                        </div>
                    </div>
                    <p class="leading-relaxed">{{ $product->description }}</p>

                    <div class="flex align-items-center justify-between">
                        <div class="flex items-center justify-start w-60">
                            @if($product->price !== $product->endPrice)
                                <span class="title-font font-medium text-2xl line-through text-red-400 mr-5">${{ $product->price }}</span>
                            @endif
                            <span class="title-font font-medium text-2xl text-gray-900">${{ $product->endPrice }}</span>
                        </div>
                        <button
                            class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 class="w-5 h-5" viewBox="0 0 24 24">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('cart.add', $product) }}" class="flex align-items-center justify-end w-full"
                          method="post">
                        @csrf
                        <!-- component -->
                        <div class="custom-number-input w-70 flex items-end justify-content-end">
                            <div class="flex-column items-center justify-center">
                                <label for="custom-input-number" class="w-full text-gray-700 text-sm font-semibold">Counter
                                    Input</label>
                                <div class="flex flex-row h-10 w-75 rounded-lg relative bg-transparent mt-1">
                                    <button data-action="decrement"
                                            class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                        <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input type="number"
                                           min="1"
                                           max="{{$product->quantity}}"
                                           class="product-count outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                           name="quantity"
                                           value="1"
                                    />
                                    <button data-action="increment"
                                            class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                        <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                            </div>
                            <button type="submit"
                                    class="ml-5 h-10 ml-auto w-full text-center text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">
                                Buy
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($product->images)
            <div class="container px-5 py-24 mx-auto">
                <!-- component -->
                <!-- This is an example component -->
                <div class="max-w-2xl mx-auto">

                    <div id="default-carousel" class="relative" data-carousel="static">
                        <!-- Carousel wrapper -->
                        <div class="overflow-hidden relative h-56 rounded-lg sm:h-96 xl:h-96 2xl:h-96">
                            <!-- Item 1 -->
                            @foreach($product->images as $image)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <span
                                        class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                                    <img src="{{ $image->url }}"
                                         class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                                         alt="...">
                                </div>
                            @endforeach
                        </div>
                        <!-- Slider indicators -->
                        <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                            @for($i = 0; $i < $product->images->count(); $i++)
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                                        aria-label="Slide {{ $i }}" data-carousel-slide-to="{{ $i }}"></button>
                            @endfor
                        </div>
                        <!-- Slider controls -->
                        <button type="button"
                                class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                data-carousel-prev>
                        <span
                            class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path></svg>
                            <span class="hidden">Previous</span>
                        </span>
                        </button>
                        <button type="button"
                                class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                                data-carousel-next>
                        <span
                            class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path></svg>
                            <span class="hidden">Next</span>
                        </span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </section>
    @vite(['resources/js/counter.js'])
</x-app-layout>
