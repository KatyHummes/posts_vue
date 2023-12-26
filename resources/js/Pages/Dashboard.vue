<script setup>
import { ref } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import OverlayPanel from 'primevue/overlaypanel';
import Button from 'primevue/button';
const props = defineProps({
    posts: Array
});

const op = ref();

const toggle = (event) => {
    op.value.toggle(event);
}
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
                    {{ posts }}
                    <div class="p-4 grid grid-cols-6 gap-2 bg-purple-100 ">
                       <!-- 
                        <div v-for="(post, index) in posts" :key="post.id">
                            <div class="flex items-center justify-around">
                                <h1>{{ post.title }}</h1>
                                <OverlayPanel :ref="el => setOpRef(el, index)">
                                    teste
                                </OverlayPanel>
                                <Button type="button" icon="pi pi-image" label="Image"
                                    @click="event => toggle(index, event)" >
                            </div> --> 
                    </div>
                    <!-- <button type="button" @click="toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>
                    </button> -->
                </div>
                <!-- <img :src="'/storage/' + post.image_path" alt=""
                    class="h-40 w-40 hover:scale-110 transition duration-300 ease-out rounded-2xl"> -->
            </div>
        </div>
    </AppLayout>
</template>
<style>
.triangle {
    clip-path: polygon(50% 0%, 80% 10%, 100% 35%, 100% 70%, 80% 90%, 50% 100%, 20% 90%, 0% 70%, 0% 35%, 20% 10%);
}
</style>