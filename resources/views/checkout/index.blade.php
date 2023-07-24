<x-app-layout>
    <div class="h-screen bg-gray-100 pt-20">
        <h1 class="mb-10 text-center text-2xl font-bold">Cart</h1>
        <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
            <div class="rounded-lg md:w-2/3 justify-between mb-6 rounded-lg bg-white p-6 shadow-md flex justify-stretch items-stretch">
                <form method="POST" id="checkout-form" class="w-full" action="#">
                    @csrf


                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="surname" :value="__('Surname')" />
                        <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autocomplete="surname" />
                        <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="city" :value="__('City')" />
                        <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autocomplete="city" />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                </form>
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
                <hr class="my-4"/>
                @include('checkout.payments.paypal')
            </div>
        </div>
    </div>
</x-app-layout>
