<script setup>
import { ref } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import OverlayPanel from 'primevue/overlaypanel';
import Button from 'primevue/button';
const props = defineProps({
    posts: Array
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-4 grid grid-cols-6 gap-2 bg-purple-100 ">

                        <div v-for="(post, index) in posts" :key="post.id">
                            <div class="flex items-center justify-around">
                                <div class="bg-white p-4 rounded-lg">
                                    <img :src="'/storage/' + post.image_path" alt=""
                                        class="h-40 w-40 hover:scale-110 transition duration-300 ease-out rounded-2xl">
                                    <h1>{{ post.title }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <img :src="'/storage/' + post.image_path" alt=""
                    class="h-40 w-40 hover:scale-110 transition duration-300 ease-out rounded-2xl"> -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style>
.triangle {
    clip-path: polygon(50% 0%, 80% 10%, 100% 35%, 100% 70%, 80% 90%, 50% 100%, 20% 90%, 0% 70%, 0% 35%, 20% 10%);
}
</style>