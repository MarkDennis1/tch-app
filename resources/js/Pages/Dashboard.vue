<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import BreadCrumbs from "@/Components/BreadCrumbs.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    catCount: String,
    adoptionCount: String,
    scheduleCount: String,
    volunteerCount: String,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <BreadCrumbs />
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <dl
                        v-if="$page.props.user.role.includes('admin')"
                        class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-4 dark:text-white sm:p-8"
                    >
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">
                                {{ adoptionCount }}
                            </dt>
                            <dd
                                class="font-light text-gray-500 dark:text-gray-400"
                            >
                                Adoption Requests
                            </dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">
                                {{ scheduleCount }}
                            </dt>
                            <dd
                                class="font-light text-gray-500 dark:text-gray-400"
                            >
                                Schedules
                            </dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">
                                {{ volunteerCount }}
                            </dt>
                            <dd
                                class="font-light text-gray-500 dark:text-gray-400"
                            >
                                Volunteer Requests
                            </dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="mb-2 text-3xl font-extrabold">
                                {{ catCount }}
                            </dt>
                            <dd
                                class="font-light text-gray-500 dark:text-gray-400"
                            >
                                Available Cat(s)
                            </dd>
                        </div>
                    </dl>

                    <div
                    v-if="$page.props.user.role.includes('client')" class="flex justify-center p-4">
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700"
                        >
                            <img
                                class="rounded-t-lg"
                                src="https://www.pngkey.com/png/full/1-19888_cute-cat-png-download-image-light-colored-cat.png"
                                alt=""
                            />
                            <div class="p-5">
                                <h5
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                >
                                    HOME OF RESCUED CATS
                                </h5>
                                <p
                                    class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                                >
                                    PROMOTES ADOPTION AND SPAYING / NEUTERING
                                </p>
                                <p
                                    class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                                >
                                    Available Cat(s): {{ catCount }}
                                </p>
                                <Link
                                    :href="route('adopts.index')"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    Adopt
                                    <svg
                                        aria-hidden="true"
                                        class="w-4 h-4 ml-2 -mr-1"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
