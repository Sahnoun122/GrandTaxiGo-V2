import 'bootstrap/dist/css/bootstrap.min.css';  
import 'bootstrap'; 

import { Tooltip, Toast, Popover } from 'bootstrap';

import axios from 'axios';
window.axios = axios; 

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js'); 

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY, 
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1', 
    encrypted: true
});


