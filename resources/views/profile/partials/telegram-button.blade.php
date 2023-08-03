<h4>Get info about your orders and our discounts in telegram!</h4>
<script async src="https://telegram.org/js/telegram-widget.js?22"
        data-telegram-login="{{env('TELEGRAM_BOT_NAME', '')}}"
        data-size="large"
        data-auth-url="{{route('callbacks.telegram')}}"
        data-request-access="write"
></script>
