<template>
    <Panel>
        <!-- component -->
        <div class="flex flex-col md:flex-row justify-center">
            <div class="md:w-11/12">
                <div class="flex md:flex-row space-x-10">
                    <div class="shadow-md p-3">
                        <div class="">
                            <div class="flex flex-col">
                                <div class="flex space-x-8 w-56">
                                    <div class="">
                                        <div class="uppercase text-sm text-gray-400">
                                            {{ $t('base.users_count') }}
                                        </div>
                                        <div class="mt-1">
                                            <div class="flex space-x-2 items-center">
                                                <div class="text-2xl">
                                                    {{ props.users_count }}
                                                </div>
                                                <div class="text-xs text-green-800 bg-green-200 rounded-md p-1">
                                                    +4.5%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <svg class="h-16 w-20 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shadow-md p-3">
                        <div class="">
                            <div class="flex flex-col">
                                <div class="flex space-x-8 w-56">
                                    <div class="">
                                        <div class="uppercase text-sm text-gray-400">
                                            {{ $t('base.travelers_count') }}
                                        </div>
                                        <div class="mt-1">
                                            <div class="flex space-x-2 items-center">
                                                <div class="text-2xl">
                                                    {{ travelers_count }}
                                                </div>
                                                <div class="text-xs text-green-800 bg-green-200 rounded-md p-1">
                                                    +4.5%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <svg class="h-16 w-20 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shadow-md p-3">
                        <div class="">
                            <div class="flex flex-col">
                                <div class="flex space-x-8 w-56">
                                    <div class="">
                                        <div class="uppercase text-sm text-gray-400">
                                            {{ $t('base.trips_count') }}

                                        </div>
                                        <div class="mt-1">
                                            <div class="flex space-x-2 items-center">
                                                <div class="text-2xl">
                                                    {{ trips }}
                                                </div>
                                                <div class="text-xs text-green-800 bg-green-200 rounded-md p-1">
                                                    +100%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <svg class="h-16 w-20 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shadow-md p-3">
                        <div class="">
                            <div class="flex flex-col">
                                <div class="flex space-x-8 w-56">
                                    <div class="">
                                        <div class="uppercase text-sm text-gray-400">
                                            {{ $t('base.upcoming_trips_count') }}

                                        </div>
                                        <div class="mt-1">
                                            <div class="flex space-x-2 items-center">
                                                <div class="text-2xl">
                                                    {{ upcoming_trips }}
                                                </div>
                                                <div class="text-xs text-green-800 bg-green-200 rounded-md p-1">
                                                    +4.5%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <i class="pi pi-sun text-gray-300" style="font-size: 2rem"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </Panel>
</template>

<script setup>
import Panel from "@/Layout/Dashboard/Panel.vue";
import {defineProps} from "vue";

const props = defineProps({
    users_count: {
        type: Object,
        required: true
    },
    travelers_count: {
        type: Object,
        required: true
    },
    trips: {
        type: Object,
        required: true
    },
    upcoming_trips: {
        type: Object,
        required: true
    }
});


</script>
