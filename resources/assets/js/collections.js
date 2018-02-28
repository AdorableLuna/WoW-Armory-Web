window.Vue = require('vue');
window.axios = window.axios = require('axios');
window.$ = window.jQuery = require('jquery');

import Collections from './components/collections';

const app = new Vue({
    el: '#main',
    data: {
        petSlots: petSlots,
        pets: pets,
        mounts: mounts
    },
    components: {
        Collections
    }
});
