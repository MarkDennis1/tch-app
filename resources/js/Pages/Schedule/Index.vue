<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Components/Modal.vue";
import InputError from "@/Components/InputError.vue";

import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import BreadCrumbs from "../../Components/BreadCrumbs.vue";

const form = useForm({
    id: "",
    title: "",
    first_name: "",
    last_name: "",
    phone_number: "",
    email: "",
    animal_id: "",
    animal_name: "",
    address: "",
    appointment: "",
});

const showModal = ref(false);
const refIsEdit = ref(false);

const openModal = (isEdit, schedule = null) => {
    showModal.value = true;
    refIsEdit.value = isEdit;
    if (isEdit) {
        form.id = schedule.id;
        form.title = "Schedule Details";
        form.first_name = schedule.first_name;
        form.last_name = schedule.last_name;
        form.phone_number = schedule.phone_number;
        form.email = schedule.email;
        form.animal_id = schedule.animal_id;
        form.animal_name = schedule.animal_name;
        form.address = schedule.address;
        form.appointment = schedule.appointment;
    } else {
        form.title = "Add New schedule";
    }
};

const closeModal = () => {
    form.reset();
    showModal.value = false;
};

const onDestroy = (id) => {
    if (confirm("Are you sure?")) {
        Inertia.delete(route("schedules.destroy", id));
    }
};

const onSubmit = () => {
    if (refIsEdit.value) {
        form.put(route("schedules.update", form.id), {
            onSuccess: () => {
                closeModal();
            },
        });
    } else {
        form.post(route("schedules.store"), {
            onSuccess: () => {
                closeModal();
            },
        });
    }
};

defineProps({
    schedules: Array,
});
</script>

<template>
    <AppLayout title="schedule">
        <Modal :show="showModal" maxWidth="lg">
            <div class="flex items-center justify-between px-4 pt-2">
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
            <form @submit.prevent="onSubmit" class="px-4">
                <hr class="my-8 h-px bg-gray-200 border-0 dark:bg-gray-700" />

                <div class="overflow-auto h-[72vh]">
                    <div class="m-6">
                        <label
                            for="first_name"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >First Name</label
                        >
                        <input
                            disabled
                            type="text"
                            id="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.first_name"
                        />
                        <InputError :message="form.errors.first_name" />
                    </div>
                    <div class="m-6">
                        <label
                            for="last_name"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Last Name</label
                        >
                        <input
                            disabled
                            type="text"
                            id="last_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.last_name"
                        />
                        <InputError :message="form.errors.last_name" />
                    </div>
                    <div class="m-6">
                        <label
                            for="phone_number"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Phone Number</label
                        >
                        <input
                            disabled
                            type="text"
                            id="phone_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.phone_number"
                        />
                        <InputError :message="form.errors.phone_number" />
                    </div>
                    <div class="m-6">
                        <label
                            for="email"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Email</label
                        >
                        <input
                            disabled
                            type="text"
                            id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.email"
                        />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="m-6">
                        <label
                            for="animal_id"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Animal ID</label
                        >
                        <input
                            disabled
                            type="text"
                            id="animal_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.animal_id"
                        />
                        <InputError :message="form.errors.animal_name" />
                    </div>
                    <div class="m-6">
                        <label
                            for="animal_name"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Animal Name</label
                        >
                        <input
                            disabled
                            type="text"
                            id="animal_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.animal_name"
                        />
                        <InputError :message="form.errors.animal_name" />
                    </div>

                    <div class="m-6">
                        <label
                            for="tags"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Address</label
                        >
                        <input
                            disabled
                            type="text"
                            id="address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.address"
                        />
                        <InputError :message="form.errors.address" />
                    </div>

                    <div class="m-6">
                        <div class="relative">
                            <div
                                class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </div>
                            <input
                                disabled
                                datepicker
                                datepicker-orientation="bottom right"
                                type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date"
                                v-model="form.appointment"
                            />
                        </div>

                        <InputError :message="form.errors.appointment" />
                    </div>
                </div>
                <hr class="my-8 h-px bg-gray-200 border-0 dark:bg-gray-700" />
            </form>
        </Modal>

        <template #header>
            <BreadCrumbs :folders="['Schedules']" />
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Schedules
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
                        </div>
                        <table
                            class="w-full text-sm text-left text-gray-500 -gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 -gray-700 -gray-400"
                            >
                                <tr>
                                    <th scope="col" class="py-3 px-6">Name</th>
                                    <th scope="col" class="py-3 px-6">
                                        Phone Number
                                    </th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th scope="col" class="py-3 px-6">
                                        appointment Date
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Pet ID
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="schedule in schedules"
                                    :key="schedule.id"
                                    class="bg-white border-b -gray-700 hover:bg-gray-50"
                                >
                                    <td class="py-4 px-6">
                                        {{
                                            schedule.first_name +
                                            " " +
                                            schedule.last_name
                                        }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ schedule.phone_number }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ schedule.email }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ schedule.appointment }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ schedule.animal_id }}
                                    </td>
                                    <td class="flex gap-1 py-4 px-6">
                                        <button
                                            @click="openModal(true, schedule)"
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
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                                                />
                                            </svg>
                                        </button>
                                        <button
                                            @click="onDestroy(schedule.id)"
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
                        <div
                            class="text-center text-xl w-full p-4"
                            v-if="schedules.length == 0"
                        >
                            You have no pending adoption request..
                        </div>
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
