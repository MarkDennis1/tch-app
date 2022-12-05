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
    cat_id: "",
    user_id: "",
    first_name: "",
    last_name: "",
    address: "",
    phone_number: "",
    age: "",
    email: "",
    citizenship: "",
    occupation: "",
    radioQuestion: "",
    parseRadioQuestion: null,
});

const showModal = ref(false);

const openModal = (adopt) => {
    showModal.value = true;
    form.cat_id = adopt.cat_id;
    form.user_id = adopt.user_id;
    form.first_name = adopt.first_name;
    form.last_name = adopt.last_name;
    form.address = adopt.address;
    form.phone_number = adopt.phone_number;
    form.age = adopt.age;
    form.email = adopt.email;
    form.citizenship = adopt.citizenship;
    form.occupation = adopt.occupation;
    form.radioQuestion = adopt.radioQuestion;
    form.parseRadioQuestion = JSON.parse(adopt.radioQuestion);
};

const closeModal = () => {
    form.reset();
    showModal.value = false;
};

const onDestroy = (id) => {
    if (confirm("Are you sure?")) {
        Inertia.delete(route("adopts.destroy", id));
    }
};

const dis = (id) => {
    if (confirm(id)) {
    }
};

const onAccept = (id) => {
    form.id = id;
    form.put(route("adopts.update", form.id));
};

defineProps({
    adopts: Array,
});
</script>

<template>
    <AppLayout title="Cat">
        <Modal :show="showModal" maxWidth="lg">
            <form @submit.prevent="onAccept" class="p-4">
                <div class="flex items-center justify-between px-3">
                    <h1 class="font-bold text-xl">Adoption Details</h1>

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
                            for="cat_id"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Cat ID</label
                        >
                        <input
                            disabled
                            type="text"
                            id="cat_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.cat_id"
                        />
                        <InputError :message="form.errors.cat_id" />
                    </div>
                    <div class="m-6">
                        <label
                            for="user_id"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >User ID</label
                        >
                        <input
                            disabled
                            type="text"
                            id="user_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.user_id"
                        />
                        <InputError :message="form.errors.user_id" />
                    </div>
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
                            for="address"
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
                            for="age"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Age</label
                        >
                        <input
                            disabled
                            type="text"
                            id="age"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.age"
                        />
                        <InputError :message="form.errors.age" />
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
                            for="citizenship"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Citizenship</label
                        >
                        <input
                            disabled
                            type="text"
                            id="citizenship"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.citizenship"
                        />
                        <InputError :message="form.errors.citizenship" />
                    </div>
                    <div class="m-6">
                        <label
                            for="occupation"
                            class="block mb-2 text-sm font-medium text-gray-900"
                            >Occupation</label
                        >
                        <input
                            disabled
                            type="text"
                            id="occupation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            v-model="form.occupation"
                        />
                        <InputError :message="form.errors.occupation" />
                    </div>
                    <div class="m-6" v-for="object in form.parseRadioQuestion">
                        <label
                            for="occupation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >{{ object.question }}</label
                        >
                        <div class="flex items-start mb-6">
                            <div class="flex items-center mb-4">
                                <input
                                    disabled
                                    v-model="object.answer"
                                    :id="object.question"
                                    type="radio"
                                    v-bind:value="object.answer"
                                    :name="object.question"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                />
                                <label
                                    :for="object.question"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >{{ object.answer ? "Yes" : "No" }}</label
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end py-4 px-6">
                    <button
                        type="submit"
                        class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                    >
                        Save
                    </button>
                </div>
            </form>
        </Modal>

        <template #header>
            <BreadCrumbs :folders="['Adoption Requests']" />
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Adoption Requests
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
                                class="text-xs text-center text-gray-700 uppercase bg-gray-50 -gray-700 -gray-400"
                            >
                                <tr>
                                    <!-- // protected $fillable = [
                                    //     'cat_id',
                                    //     'user_id',
                                    //     'first_name',
                                    //     'last_name',
                                    //     'address',
                                    //     'phone_number',
                                    //     'age',
                                    //     'email',
                                    //     'citizenship',
                                    //     'occupation',
                                    //     'radioQuestion',
                                    //     'is_accepted', -->
                                    <th
                                        scope="col"
                                        class="text-start py-3 px-6"
                                    >
                                        Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Contact Number
                                    </th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th scope="col" class="py-3 px-6">
                                        Address
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Pet ID
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Status
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr
                                    v-for="adopt in adopts"
                                    :key="adopt.id"
                                    class="bg-white border-b -gray-700 hover:bg-gray-50"
                                >
                                    <td class="text-start py-4 px-6">
                                        {{
                                            adopt.first_name +
                                            " " +
                                            adopt.last_name
                                        }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ adopt.phone_number }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ adopt.email }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ adopt.address }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ adopt.cat_id }}
                                    </td>
                                    <td :class="`${adopt.is_accepted ? 'text-green-600' : 'text-slate-600'} font-bold py-4 px-6`">
                                        {{
                                            adopt.is_accepted
                                                ? "Accepted"
                                                : "Pending"
                                        }}
                                    </td>

                                    <td
                                        v-if="!adopt.is_accepted"
                                        class="flex items-center gap-1 py-4 px-6"
                                    >
                                        <button
                                            @click="openModal(adopt)"
                                            type="button"
                                            class="flex items-center gap-1 py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            View
                                        </button>
                                        <button
                                            @click="onAccept(adopt.id)"
                                            type="button"
                                            class="flex items-center gap-1 py-2 px-3 text-xs font-medium text-center text-white bg-green-700 hover:bg-green-800 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            Accept
                                        </button>
                                        <button
                                            @click="onDestroy(adopt.id)"
                                            class="flex items-center gap-1 py-2 px-3 text-xs font-medium text-center text-white bg-red-700 hover:bg-red-800 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                    <td
                                        v-if="adopt.is_accepted"
                                        class="flex justify-center items-center gap-1 py-4 px-6"
                                    >
                                        <button
                                            @click="openModal(adopt)"
                                            type="button"
                                            class="flex items-center gap-1 py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            View
                                        </button>
                                        <button
                                            @click="onDestroy(adopt.id)"
                                            class="flex items-center gap-1 py-2 px-3 text-xs font-medium text-center text-white bg-red-700 hover:bg-red-800 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="text-center text-xl w-full p-4"
                            v-if="adopts.length == 0"
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
