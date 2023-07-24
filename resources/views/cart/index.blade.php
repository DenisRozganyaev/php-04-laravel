<x-app-layout>
    <div class="h-screen bg-gray-100 pt-20">
        <h1 class="mb-10 text-center text-2xl font-bold">Cart</h1>
        <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
            <div class="rounded-lg md:w-2/3">
                @foreach(Cart::instance('cart')->content() as $product)
                    <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                        <img
                            src="{{ $product->model->thumbnailUrl }}"
                            alt="product-image" class="w-full rounded-lg sm:w-40"/>
                        <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                            <div class="mt-5 sm:mt-0">
                                <h2 class="text-lg font-bold text-gray-900"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h2>
                                <p class="text-sm">${{ $product->price }}</p>
                            </div>
                            <div class="mt-4 flex flex-col items-end justify-end sm:space-y-6 sm:mt-0 sm:space-x-6">
                                <form class="flex items-center border-gray-100">
                                    <button data-action="decrement"
                                        class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"
                                    > - </button>
                                    <input class="product-count h-8 w-8 border bg-white text-center text-xs outline-none" type="number"
                                           value="{{ $product->qty }}"
                                           min="1"
                                           max="{{$product->model->quantity}}"
                                    />
                                    <button data-action="increment"
                                        class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50"> + </button>
                                </form>
                                <div class="flex items-center space-x-4">
                                    <p class="text-sm"><b>Total: </b>${{ $product->subtotal }}</p>
                                    <form action="{{ route('cart.remove') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="rowId" value="{{$product->rowId}}" />
                                        <button class="p-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Sub total -->
            <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                <div class="mb-2 flex justify-between">
                    <p class="text-gray-700">Subtotal</p>
                    <p class="text-gray-700">${{ Cart::instance('cart')->subtotal() }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-700">Tax</p>
                    <p class="text-gray-700">${{ Cart::instance('cart')->tax() }}</p>
                </div>
                <hr class="my-4"/>
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <div class="flex flex-col items-end">
                        <p class="mb-1 text-lg font-bold">${{ Cart::instance('cart')->total() }}</p>
                        <p class="text-sm text-gray-700">including Tax</p>
                    </div>
                </div>
                <x-button href="{{route('checkout')}}" class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">
                    Check out
                </x-button>
            </div>
        </div>
    </div>
    @vite(['resources/js/counter.js'])
</x-app-layout>
