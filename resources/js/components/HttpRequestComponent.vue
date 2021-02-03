<template>
    <div class="border-2 border-gray-800 shadow-solid-gray-800 overflow-hidden">
        <div class="flex justify-between items-center bg-gray-800 border-b-2 border-gray-800 p-4">
            <span class="font-mono text-white sm:text-xl">
                GET {{ requestPath }}
            </span>

            <button v-on:click="makeRequest" class="bg-teal-600 px-4 py-2 rounded text-white transform transition-transform hover:scale-110 focus:bg-teal-700">
                Send
            </button>
        </div>

        <textarea v-model="responseBody" class="block font-mono p-4 w-full h-64 resize-y whitespace-pre" readonly></textarea>

        <div class="bg-gray-100 border-t-2 border-gray-800 p-4 text-center">
            <a :href="docsHref" class="text-sm underline">
                View {{ title }} Documentation
            </a>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data: function () {
        return {
            responseBody: this.$slots.default[0].text.trim()
        };
    },
    computed: {
        docsHref() {
            return `/docs#tag/${this.title}`;
        }
    },
    props: ['request-path', 'title'],
    methods: {
        makeRequest() {
            axios.get(this.requestPath).then(
                response => this.responseBody = JSON.stringify(response.data, null, 2)
            ).catch(
                response => console.log(response)
            );
        }
    }
};
</script>
