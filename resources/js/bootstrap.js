import axios from 'axios';
import Echo from 'laravel-echo';
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm'; // 👈 Add this

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
    forceTLS: false,
    enabledTransports: ['ws'],
});

// 👇 This connects Livewire to Echo
Livewire.start();


window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('✅ Echo connected to Reverb');
});
