import Vue from 'vue';

/** Import Vue components */
import HttpRequestComponent from './components/HttpRequestComponent.vue';

/** Create root Vue instance */
new Vue({
    el: '#app',

    components: { HttpRequestComponent },

    data: () => ({
        menuOpen: false
    }),

    computed: {
        menuClosed() {
            return !this.menuOpen;
        }
    }
});
