<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Components/Modal.vue";
import InputError from "@/Components/InputError.vue";
import BreadCrumbs from "@/Components/BreadCrumbs.vue";
import { ref } from "vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";

const showModal = ref(false);

const form = useForm({
    catID: "",
    catImg: "",
    catName: "",
    catAge: "",
    catTags: "",
    catColor: "",
    userID: "",
    fname: "",
    lname: "",
    address: "",
    phoneNumber: "",
    age: "",
    email: "",
    citizenship: "",
    occupation: "",
    radioQuestion: [
        {
            question: "Does anyone in the household have allergies?",
            answer: false,
        },
        {
            question: "Do you own or rent your residence?",
            answer: false,
        },
        {
            question: "Is the cat for yourself?",
            answer: false,
        },
        {
            question: "Are you 18 years old and above?",
            answer: false,
        },
        // {
        //     question: "If not, please profive your parent or guardian's name?",
        //     answer: "",
        // },
        {
            question: "Have you ever adopted from The Cat House?",
            answer: false,
        },
        {
            question: "Are you interested in adopting a cat?",
            answer: false,
        },
    ],
    jsonRadioQuestion: "",
});

const closeModal = () => {
    showModal.value = false;
    form.reset();
};

const openModal = (cat, userID) => {
    showModal.value = true;
    form.catID = cat.id;
    form.catImg = cat.image_path;
    form.catAge = cat.age_category;
    form.catColor = cat.color;
    form.catTags = cat.tags;
    form.catName = cat.name;
    form.userID = userID;
};

const onSubmit = () => {
    form.jsonRadioQuestion = JSON.stringify(form.radioQuestion);
    form.post(route("adopts.store"), {
        onSuccess: () => {
            closeModal();
        },
    });
};

defineProps({
    cats: Array,
});
</script>

<template>
    <AppLayout title="Adopt">
        <Modal :show="showModal">
            <div class="p-4">
                <div class="flex items-center justify-between py-1 px-4">
                    <h1 class="font-bold text-xl">Apply now</h1>

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
                    <div class="h-[72vh] overflow-auto">
                        <div
                            class="flex justify-between items-center gap-2 px-4 py-6"
                        >
                            <img
                                :src="form.catImg"
                                class="w-6/12 rounded-full"
                            />
                            <div class="w-6/12 text-center">
                                <p class="font-bold">{{ form.catName }}</p>
                                <p class="">{{ form.catAge }}</p>
                                <p class="">{{ form.catTags }}</p>
                                <p class="">{{ form.catColor }}</p>
                            </div>
                        </div>
                        <div class="flex justify-center p-4">
                            <InputError :message="form.errors.catID" />
                        </div>
                        
                        <div class="flex justify-between items-center gap-3">
                            <div class="mb-6 w-full">
                                <label
                                    for="fname"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >First Name</label
                                >
                                <input
                                    type="text"
                                    id="fname"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.fname"
                                />
                                <InputError :message="form.errors.fname" />
                            </div>
                            <div class="mb-6 w-full">
                                <label
                                    for="lname"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Last Name</label
                                >
                                <input
                                    type="text"
                                    id="lname"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.lname"
                                />
                                <InputError :message="form.errors.lname" />
                            </div>
                        </div>

                        <div class="flex justify-between items-center gap-3">
                            <div class="mb-6 w-full">
                                <label
                                    for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Address</label
                                >
                                <input
                                    type="text"
                                    id="address"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.address"
                                />
                                <InputError :message="form.errors.address" />
                            </div>
                            <div class="mb-6 w-full">
                                <label
                                    for="number"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Phone Number</label
                                >
                                <input
                                    type="number"
                                    id="number"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.phoneNumber"
                                />
                                <InputError
                                    :message="form.errors.phoneNumber"
                                />
                            </div>
                        </div>

                        <div class="flex justify-between items-center gap-3">
                            <div class="mb-6 w-full">
                                <label
                                    for="age"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Age</label
                                >
                                <input
                                    type="number"
                                    id="age"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.age"
                                />
                                <InputError :message="form.errors.age" />
                            </div>
                            <div class="mb-6 w-full">
                                <label
                                    for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Email Address</label
                                >
                                <input
                                    type="email"
                                    id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.email"
                                />
                                <InputError :message="form.errors.email" />
                            </div>
                        </div>

                        <div class="flex justify-between items-center gap-3">
                            <div class="mb-6 w-full">
                                <label
                                    for="citizenship"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Citizenship</label
                                >
                                <input
                                    type="text"
                                    id="citizenship"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.citizenship"
                                />
                                <InputError
                                    :message="form.errors.citizenship"
                                />
                            </div>
                            <div class="mb-6 w-full">
                                <label
                                    for="occupation"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Occupation</label
                                >
                                <input
                                    type="text"
                                    id="occupation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.occupation"
                                />
                                <InputError :message="form.errors.occupation" />
                            </div>
                        </div>
                        <div v-for="question in form.radioQuestion">
                            <label
                                for="occupation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >{{ question.question }}</label
                            >
                            <div class="flex items-start mb-6">
                                <div class="flex items-center mb-4">
                                    <input
                                        v-model="question.answer"
                                        id="readio-yes"
                                        type="radio"
                                        :value="true"
                                        :name="question.question"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    />
                                    <label
                                        for="readio-yes-1"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >Yes</label
                                    >
                                </div>
                            </div>
                            <div class="flex items-start mb-6">
                                <div class="flex items-center mb-4">
                                    <input
                                        v-model="question.answer"
                                        id="radio-no"
                                        type="radio"
                                        :value="false"
                                        :name="question.question"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    />
                                    <label
                                        for="radio-no"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >No</label
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end py-1 px-4">
                        <button
                            type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </Modal>

        <template #header>
            <BreadCrumbs :folders="['Adopt']" />
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Adoptable Cats
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4"
                >
                    <div class="flex justify-end items-center">
                        <Link
                            :href="route('adopts.create')"
                            type="button"
                            class="flex gap-1 justify-center items-center py-2 px-3 text-sm font-medium text-center rounded-lg text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300"
                        >
                            <h2>My Adoption Request</h2>
                        </Link>
                    </div>

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 place-content-center"
                    >
                        <button
                            @click="openModal(cat, $page.props.user.id)"
                            v-for="cat in cats"
                            class="p-4 border-2 rounded-xl m-2 drop-shadow-md"
                        >
                            <img
                                class="w-stretch object-fit rounded-xl"
                                :src="cat.image_path"
                            />
                            <div class="text-start mt-4">
                                <p class="text-lg">
                                    <span class="font-bold">Cat ID: </span>
                                    <span>{{ cat.id }}</span>
                                </p>
                                <p class="">
                                    <span class="font-bold">Name: </span>
                                    <span>{{ cat.name }}</span>
                                </p>
                                <p class="">
                                    <span class="font-bold">Color: </span>
                                    <span>{{ cat.age_category }}</span>
                                </p>
                                <p class="">
                                    <span class="font-bold"> Tags: </span>
                                    <span
                                        class="keep-all px-2 mx-1 rounded-full text-sm bg-slate-400"
                                        v-for="tag in cat.tags.split(',')"
                                        >{{ tag }}</span
                                    >
                                </p>
                                <p class="">
                                    <span class="font-bold">Color: </span>
                                    <span>{{ cat.color }}</span>
                                </p>
                            </div>
                        </button>
                        <div v-if="cats.length == 0">
                            No cats available today, comeback tommorow.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
