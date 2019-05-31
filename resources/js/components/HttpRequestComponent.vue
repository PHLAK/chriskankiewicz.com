<template>
    <div class="flex flex-col border-2 border-gray-800 shadow-solid-gray-800 overflow-hidden h-full w-full">
        <div class="flex justify-between items-center bg-gray-800 border-b-2 border-gray-800 p-4">

            <div class="rounded bg-gray-200 overflow-hidden">
                <span class="font-mono text-xl pl-2">
                    GET
                </span>

                <select v-model="selected" class="font-mono text-lg bg-transparent pr-2 py-2">
                    <option v-for="option in options" v-bind:value="option" v-bind:key="option.path">
                        {{ option.text }}
                    </option>
                </select>
            </div>

            <button v-on:click="makeRequest" class="bg-teal-600 px-4 py-2 rounded text-white hover:bg-teal-700">
                Fetch {{ selected.text }}
            </button>
        </div>

        <textarea v-model="responseBody" class="flex-grow block font-mono p-4 w-full h-64" readonly></textarea>

        <div class="bg-gray-200 border-t-2 border-gray-800 p-4 text-center">
            <a :href="docsHref" class="text-sm underline">
                View {{ this.selected.text }} Documentation
            </a>
        </div>
    </div>
</template>

<script>
    module.exports = {
        data: function () {
            let options = [
                { text: 'Skills', path: '/api/skill' },
                { text: 'Education', path: '/api/education' },
                { text: 'Experience', path: '/api/experience' },
                { text: 'Projects', path: '/api/project' },
            ];

            return {
                selected: options[0],
                options: options,
                responseBody: this.$slots.default[0].text.trim()
            }
        },
        computed: {
            docsHref: function () {
                return '/docs#tag/' + this.selected.text;
            }
        },
        methods: {
            makeRequest: function () {
                axios.get(this.selected.path).then(
                    response => this.responseBody = JSON.stringify(response.data, null, 2)
                ).catch(
                    response => console.log(response)
                );
            }
        }
    }
</script>
