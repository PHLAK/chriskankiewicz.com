<template>
    <div class="rounded-lg border-2 border-gray-800 shadow-solid-gray-800 overflow-hidden w-full my-8">
        <div class="flex justify-between bg-gray-800 border-b-2 border-gray-800 p-4">
           <span class="font-mono text-white text-xl leading-loose">
                GET /api/skill
            </span>

            <button v-on:click="getSkills" class="bg-teal-600 px-4 py-2 rounded text-white hover:shadow-lg">
                Get Skills
            </button>
        </div>

        <textarea v-model="skills" class="font-mono p-4 w-full h-64" readonly></textarea>

        <div class="bg-gray-200 border-t-2 border-gray-800 p-4 text-center">
            <a href="/docs#tag/Skill" class="underline">
                Skills Documentation
            </a>
        </div>
    </div>
</template>

<script>
    module.exports = {
        data: function() {
            return {
                skills: 'Test message; please ignore'
            }
        },
        methods: {
            getSkills: function() {
                axios.get('/api/skill').then(
                    response => this.skills = JSON.stringify(response.data, null, 2)
                ).catch(
                    response => console.log(response)
                );
            }
        }
    }
</script>
