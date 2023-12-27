<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from 'laravel-precognition-vue-inertia';
import InputText from 'primevue/inputtext';
import FileUpload from 'primevue/fileupload';
import ProgressBar from 'primevue/progressbar';
import Badge from 'primevue/badge';
import Button from 'primevue/button';
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';


const toast = useToast();

const imageUrl = ref(null);

const handleFileChange = (event) => {
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = (e) => {
            imageUrl.value = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
        form.image = fileInput.files[0];
    }
};
//  route('post.store')
const form = useForm('post', route('post.store'), {
    title: '',
    image: null,
});

const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
});
</script>

<template>
    <Head title="Welcome" />

    <AppLayout title="welcome">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criar Post
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex items-center justify-center m-8 font-bold">
                        <div class="flex justify-center">
                            <!-- <InputText type="text" v-model="value" /> -->
                            <form @submit.prevent="submit" enctype="multipart/form-data">
                                <div class="flex items-center justify-center">
                                    <Toast />
                                    <label class=" text-purple-600">Título</label>
                                    <InputText type="text" v-model="form.title" class="m-4 px-2 py-1 border-purple-600 focus:ring focus:ring-purple-300 text-purple-600" 
                                        @change="form.validate('title')" />
                                    <div v-if="form.invalid('title')" class=" text-red-500" >
                                        {{ form.errors.title }}
                                    </div>
                                </div>
                                <div>
                                    <Toast />
                                    <input type="file" @change="handleFileChange" class=" text-purple-600">
                                    <button type="submit" class="bg-green-500 text-white m-4 px-2 py-1 rounded-xl hover:bg-purple-600 ">Criar</button>
                                    <img :src="imageUrl" alt="Imagem" v-if="imageUrl" class="w-40">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
