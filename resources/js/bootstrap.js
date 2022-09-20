import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
     wsHost: window.location.hostname,
     wsPort: 6001,
     forceTLS: false,
     disableStats: true,
 });

 window.Echo.private('event').listen('RealTimeEvent', (e) => console.log('RealTimeEvent: channel: event -> ' + e.message));

 window.Echo.private('channel-dom-libre').listen('DomicilioLibreEvent', (e) => console.log('DomicilioLibreEvent: channel: channel-dom-libre -> ' + e.message));

 window.Echo.private('App.Models.User.5')
 .notification((notification) => {
   console.log(notification.message);
 });


