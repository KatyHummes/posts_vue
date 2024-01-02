<script setup>
import { useForm } from 'laravel-precognition-vue-inertia';
import { ref } from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from 'primevue/button';
import Modal from '@/Components/Modal.vue';
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const toast = useToast();

const props = defineProps({
    posts: Array
});

const posts = props.posts;

const popoverVisibility = ref({});

const togglePopover = (postId) => {
    popoverVisibility.value[postId] = !popoverVisibility.value[postId];
};

// confg da modal deletar posts
const showDeletePostConfirmModal = ref(false);
const formDeletePost = ref(null);
const openDeletePostConfirmModal = (id) => {
    formDeletePost.value = useForm('delete', `/deletar-post/${id}`, {
        id: id,
    });
    showDeletePostConfirmModal.value = true;
};
const closeDeletePostConfirmModal = () => {
    showDeletePostConfirmModal.value = false;
};
const deletePost = () => {
    formDeletePost.value.submit({
        preserveScroll: true,
        onSuccess: () => {
            closeDeletePostConfirmModal();
            toast.success("Post deletado com Sucesso!", {
                position: 'top-right',
            });
        },
        onError: () => {
            toast.error("Erro ao deletar Post!", {
                position: 'top-right',
            });
        }
    });
};

// confg da modal editar posts
const post = ref();
const showUpdatePostModal = ref(false);
const formUpdatePost = ref(null);

const openUpdatePostModal = (postData) => {
    console.log('entrou na função', postData);
    post.value = postData;

    formUpdatePost.value = useForm('post', `/editar-post/${postData.id}`, {
        title: postData.title,
        image_path: postData.image_path,
    });
    showUpdatePostModal.value = true;
};

const closeUpdatePostModal = () => {
    showUpdatePostModal.value = false;
};

// const handleFileChange = (event) => {
//     formUpdatePost.value.image_path = event.target.files[0];
// };

const updatePost = () => {
    console.log('entrou na função updatePost');
    formUpdatePost.value.submit({
        preserveScroll: true,
        onSuccess: () => {
            closeUpdatePostModal();
            toast.success("Post atualizado com Sucesso!", {
                position: 'top-right',
            });
        },
        onError: () => {
            toast.error("Erro ao atualizar Post!", {
                position: 'top-right',
            });
        }
    });
};
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
                                <div class="bg-white p-4 rounded relative">
                                    <div class="flex justify-between">
                                        <h1>{{ post.title }}</h1>
                                        <button @click="togglePopover(post.id)" class="...">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <img :src="'/storage/' + post.image_path" alt=""
                                        class="max-h-40 w-40 hover:scale-110 transition duration-300 ease-out rounded-2xl">
                                    <div v-if="popoverVisibility[post.id]" :id="'popover-click-' + post.id"
                                        class="absolute top-10 right-5 w-fit bg-white border rounded-lg">

                                        <button @click="openUpdatePostModal(post)" type="button"
                                            class=" gap-4 flex justify-center items-center m-4 hover:text-green-500">
                                            <h1>Editar</h1>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                        <button @click="openDeletePostConfirmModal(post.id)" type="button"
                                            class="gap-2 flex justify-center items-center m-4 hover:text-red-500">
                                            <h1>Deletar</h1>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6  m-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>

    <!-- modal para deletar posts -->
    <Modal :show="showDeletePostConfirmModal" @close="closeDeletePostConfirmModal">
        <form @submit.prevent="deletePost()" class="bg-[var(--surface-50)] p-4">
            <h2 class="flex items-center justify-center p-4 m-4 font-bold text-slate-950">Tem certeza que deseja
                excluir esta Pessoa?</h2>
            <div class="flex justify-between mt-12">
                <button type="button"
                    class="inline-flex items-center px-4 py-2 bg-red-500 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-[var(--red-700)] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                    @click="closeDeletePostConfirmModal">Cancelar</button>
                <button type="submit"
                    class="inline-flex items-center px-8 py-4 bg-green-500 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-[var(--green-700)] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Excluir
                </button>
            </div>
        </form>
    </Modal>

    <!-- Modal de Editar Pessoa -->
    <Modal :show="showUpdatePostModal" @close="closeUpdatePostModal" :max-width="'4xl'">
        <div class="flex items-start justify-between p-4 border-b rounded-t">
            <h3 class="text-xl font-semibold text-slate-950 ">
                Editar Post
            </h3>
            <button @click="closeUpdatePostModal" type="button"
                class="text-gray-400 bg-transparent hover:bg-slate-600 hover:text-red-500 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="p-6 bg-slate-100">
            <form @submit.prevent="updatePost">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-900 text-sm font-bold mb-2" for="title">
                            Título
                        </label>
                        <input v-model="formUpdatePost.title" type="text" id="title" name="title"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-900 text-sm font-bold mb-2" for="image_path">
                            alterar imagem
                        </label>
                        <input type="file" id="image_path" name="image_path" @change="handleFileChange"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <img :src="'/storage/' + post.image_path" alt="" class="max-h-40 w-40 hover:scale-110 transition duration-300 ease-out rounded-2xl">
                    </div>
                </div>
                <div class="flex justify-between mt-12">
                    <Button @click="closeUpdatePostModal" type="button"
                        class="inline-flex items-center px-4 py-2 bg-red-500 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Cancelar
                    </Button>
                    <Button type="submit"
                        class="inline-flex items-center px-8 py-4 bg-green-500 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Salvar att
                    </Button>
                </div>
            </form>
        </div>
    </Modal>
</template>
<style>
.triangle {
    clip-path: polygon(50% 0%, 80% 10%, 100% 35%, 100% 70%, 80% 90%, 50% 100%, 20% 90%, 0% 70%, 0% 35%, 20% 10%);
}
</style>