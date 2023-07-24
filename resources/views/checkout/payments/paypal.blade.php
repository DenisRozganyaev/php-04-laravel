<!-- Set up a container element for the button -->
<div id="paypal-button-container"></div>

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . env('PAYPAL_MODE') . '.client_id') }}&currency={{ config('paypal.currency') }}"></script>

@vite(['resources/js/payment/paypal.js'])
