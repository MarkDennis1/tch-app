<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Components/Modal.vue";
import InputError from "@/Components/InputError.vue";
import BreadCrumbs from "@/Components/BreadCrumbs.vue";

import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const form = useForm({
    id: "",
    title: "",
    name: "",
    gender: "",
    age_category: "",
    tags: "",
    color: "",
    image_path: "",
});

const showModal = ref(false);
const refIsEdit = ref(false);

const openModal = (isEdit, cat = null) => {
    showModal.value = true;
    refIsEdit.value = isEdit;
    if (isEdit) {
        form.id = cat.id;
        form.title = "Edit Cat";
        form.name = cat.name;
        form.gender = cat.gender;
        form.age_category = cat.age_category;
        form.tags = cat.tags;
        form.color = cat.color;
        form.image_path = cat.image_path;
    } else {
        form.title = "Add New Cat";
    }
};

const closeModal = () => {
    form.reset();
    showModal.value = false;
};

const onDestroy = (id) => {
    if (confirm("Are you sure?")) {
        console.log(id);
        Inertia.delete(route("cats.destroy", id));
    }
};

const onSubmit = () => {
    if (refIsEdit.value) {
        form.put(route("cats.update", form.id), {
            onSuccess: () => {
                closeModal();
            },
        });
    } else {
        form.post(route("cats.store"), {
            onSuccess: () => {
                closeModal();
            },
        });
    }
};

defineProps({
    cats: Array,
});
</script>

<template>
    <AppLayout title="Cat">
        <Modal :show="showModal" maxWidth="lg">
            <form @submit.prevent="onSubmit" class="p-4">
                <div class="flex items-center justify-between px-3">
                    <h1 class="font-bold text-xl">{{ form.title }}</h1>

                    <button @click="closeModal" type="button" class="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-9 h-9"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </button>
                </div>
                <div class="h-[72vh] overflow-auto">
                    <div class="m-6">
                        <label
                            for="image_path"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Image</label
                        >
                        <div class="flex justify-center items-center mb-2">
                            <img
                                v-if="form.title == 'Edit Cat'"
                                id="modalImg"
                                class="rounded-full w-60 h60"
                                :src="form.image_path"
                            />
                        </div>

                        <input
                            v-if="form.title == 'Add New Cat'"
                            @input="form.image_path = $event.target.files[0]"
                            class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="image_path"
                            accept="image/png, image/jpeg"
                            type="file"
                        />
                        <InputError :message="form.errors.image_path" />
                    </div>
                    <div class="m-6">
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Name</label
                        >
                        <input
                            type="text"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.name"
                        />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="m-6">
                        <label
                            for="gender"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Gender</label
                        >
                        <select
                            id="gender"
                            v-model="form.gender"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        >
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <InputError :message="form.errors.gender" />
                    </div>
                    <div class="m-6">
                        <label
                            for="age_category"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Age Category</label
                        >
                        <select
                            id="age_category"
                            v-model="form.age_category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        >
                            <option value="Adult">Adult</option>
                            <option value="Young">Young</option>
                            <option value="Kitten">Kitten</option>
                        </select>
                        <InputError :message="form.errors.age_category" />
                    </div>

                    <div class="m-6">
                        <label
                            for="tags"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Tags (Separated by comma ",")</label
                        >
                        <input
                            type="text"
                            id="tags"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.tags"
                        />
                        <InputError :message="form.errors.tags" />
                    </div>

                    <div class="m-6">
                        <label
                            for="color"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Color</label
                        >
                        <input
                            type="text"
                            id="color"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.color"
                        />
                        <InputError :message="form.errors.color" />
                    </div>
                </div>
                <div class="flex items-center justify-end py-4 px-6">
                    <button
                        type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                    >
                        Save
                    </button>
                </div>
            </form>
        </Modal>

        <template #header>
            <BreadCrumbs :folders="['Cat']" />
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cats
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="overflow-x-auto relative shadow-md sm:rounded-lg"
                    >
                        <div
                            class="p-4 bg-white flex justify-between items-center"
                        >
                            <label for="table-search" class="sr-only"
                                >Search</label
                            >
                            <!-- <div class="relative mt-1">
                                <div
                                    class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                                >
                                    <svg
                                        class="w-5 h-5 text-gray-500"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="table-search"
                                    class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Search for items"
                                />
                            </div> -->

                            <button
                                @click="openModal(false)"
                                type="button"
                                class="flex gap-1 justify-center items-center py-2 px-3 text-sm font-medium text-center rounded-lg text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300"
                            >
                                <h2>Add Cat</h2>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </button>
                        </div>
                        <table
                            class="w-full text-sm text-left text-gray-500 -gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 -gray-700 -gray-400"
                            >
                                <tr>
                                    <th scope="col" class="py-3 px-6">Image</th>
                                    <th scope="col" class="py-3 px-6">Name</th>
                                    <th scope="col" class="py-3 px-6">
                                        Gender
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Age Category
                                    </th>
                                    <th scope="col" class="py-3 px-6">Tags</th>
                                    <th scope="col" class="py-3 px-6">Color</th>
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="cat in cats"
                                    :key="cat.id"
                                    class="bg-white border-b -gray-700 hover:bg-gray-50"
                                >
                                    <td class="p-4 w-4">
                                        <img
                                            class="rounded-full"
                                            :src="cat.image_path"
                                            :alt="cat.name"
                                        />
                                        <!-- {{ cat.image_path }} -->
                                    </td>
                                    <td class="py-4 px-6">{{ cat.name }}</td>
                                    <td class="py-4 px-6">{{ cat.gender }}</td>
                                    <td class="py-4 px-6">
                                        {{ cat.age_category }}
                                    </td>
                                    <td class="py-4 px-6">{{ cat.tags }}</td>
                                    <td class="py-4 px-6">{{ cat.color }}</td>
                                    <td class="flex gap-1 py-4 px-6">
                                        <button
                                            @click="openModal(true, cat)"
                                            type="button"
                                            class="flex items-center gap-1 py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-4 h-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                                />
                                            </svg>
                                        </button>
                                        <button
                                            @click="onDestroy(cat.id)"
                                            type="button"
                                            class="flex items-center gap-1 py-2 px-3 text-xs font-medium text-center text-white bg-red-700 hover:bg-red-800 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-4 h-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <nav
                            class="flex justify-between items-center p-4"
                            aria-label="Table navigation"
                        >
                            <span class="text-sm font-normal text-gray-500"
                                >Showing
                                <span class="font-semibold text-gray-900"
                                    >1-10</span
                                >
                                of
                                <span class="font-semibold text-gray-900"
                                    >1000</span
                                ></span
                            >
                            <ul class="inline-flex items-center -space-x-px">
                                <li>
                                    <a
                                        href="#"
                                        class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                                    >
                                        <span class="sr-only">Previous</span>
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                                        >1</a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                                        >2</a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        aria-current="page"
                                        class="z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700"
                                        >3</a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                                        >...</a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                                        >100</a
                                    >
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 -gray-700"
                                    >
                                        <span class="sr-only">Next</span>
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
