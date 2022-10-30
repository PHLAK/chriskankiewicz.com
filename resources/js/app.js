import { createApp } from 'vue/dist/vue.esm-browser';
import { prismInit } from '@/prism.js';

import HttpRequestComponent from '@/components/HttpRequestComponent.vue';

createApp({
    components: { HttpRequestComponent },

    data: () => ({
        menuOpen: false
    }),

    computed: {
        menuClosed() {
            return ! this.menuOpen;
        }
    }
}).mount('#app');

prismInit();
