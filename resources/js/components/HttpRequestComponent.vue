<script setup>
import { defineProps, ref, computed } from 'vue/dist/vue.esm-browser';
import axios from 'axios';

const props = defineProps({
    'requestPath': { required: true, type: String },
    'title': { required: true, type: String },
});

const responseBody = ref('');

const docsHref = computed(() => {
    return `/docs#tag/${props.title}`;
});

async function makeRequest() {
    try {
        var response = await axios.get(props.requestPath);
    } catch (error) {
        console.error(error);

        return;
    }

    responseBody.value = JSON.stringify(response.data, null, 2);
}
</script>

<template>
    <div class="border-2 border-gray-800 shadow-solid-gray-800 overflow-hidden">
        <div class="flex justify-between items-center bg-gray-800 border-b-2 border-gray-800 p-4">
            <span class="font-mono text-white sm:text-xl">
                GET {{ requestPath }}
            </span>

            <button class="bg-teal-600 px-4 py-2 rounded text-white transition-transform hover:scale-110 focus:bg-teal-700" @click="makeRequest">
                Send
            </button>
        </div>

        <textarea :value="responseBody" placeholder="// Make a request to view the response" class="block font-mono p-4 w-full h-64 resize-y whitespace-pre" readonly />

        <div class="bg-gray-100 border-t-2 border-gray-800 p-4 text-center">
            <a :href="docsHref" class="text-sm underline">
                View {{ title }} Documentation
            </a>
        </div>
    </div>
</template>
