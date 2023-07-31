<x-app-layout>
    <section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
        <div class="flex flex-col justify-center h-full">
            <!-- Table -->
            <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800">Thank
                        you {{ $order->user->name }} {{ $order->user->surname }}!</h3>
                    <h4 class="font-semibold text-gray-800">Currently your order in process</h4>
                    <h4 class="font-semibold text-gray-800">Order total: <strong>{{ $order->total }}
                            $</strong></h4>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Product</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Qty</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Price</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Total</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                            @foreach($order->products as $product)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">
                                                <img class="rounded-full" src="{{ $product->thumbnailUrl }}"
                                                     width="40" height="40" alt="Alex Shatov">
                                            </div>
                                            <div class="font-medium text-gray-800"><a
                                                    href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $product->pivot->quantity }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $product->pivot->single_price }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div
                                            class="text-left">{{ $product->pivot->single_price * $product->pivot->quantity }}</div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <x-button href="{{route('home')}}"
                      class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium w-25 text-blue-50 hover:bg-blue-600">
                Back to the home page
            </x-button>
        </div>
    </section>
</x-app-layout>
