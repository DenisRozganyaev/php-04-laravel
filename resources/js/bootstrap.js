/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;
window.axios.defaults.withCredentials = true;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import $ from 'jquery'
window.$ = $;
import 'flowbite';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    forceTLS: false,
});
Pusher.logToConsole = true;

// window.Echo.private(`App.Models.User.${window.userID}`)
window.Echo.private(`my-channel`)
    .listen('UserNotify', (e) => {
        alert(e.message)
    })

//
// const pusher = new Pusher('1fe5bc5f5b99a66080b1', {
//     cluster: 'eu'
// });
//
// const channel = pusher.subscribe('my-channel');
// channel.bind('my-event', function(data) {
//     alert(JSON.stringify(data));
// });
