<template>
    <NotificationAlert />

    <main dir="rtl">
        <!-- lg:py-36 -->
        <section class="grid overflow-hidden relative w-full min-h-screen leading-7 bg-white opacity-100 text-stone-500">
            <div class="flex flex-col lg:flex-row w-full min-h-full text-stone-500">
                <div class="flex overflow-hidden relative flex-col justify-center items-center p-12 bg-gradient-to-tl from-primary-900 to-primary-500  w-full lg:w-1/2" >
                    <div class="w-full max-w-screen-sm text-center box-border">
                        <div
                            class="opacity-100 box-border">
                            <a href=""
                                class="inline-block mx-auto mb-8 cursor-pointer box-border"
                            >
                                <img
                                    :src="asset('logo.png')"
                                    alt="Logo"
                                    class="w-full align-middle m-auto box-border"
                                />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col bg-white z-0 w-full lg:w-1/2">
                    <div :dir="contentDirection" class="flex justify-center items-center px-4 lg:px-12 pt-0 pb-5 h-full">
                        <slot />
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { onMounted } from 'vue';
import NotificationAlert from '@/Components/Others/NotificationAlert.vue';

const contentDirection = document.getElementsByTagName('html')[0]?.dir

onMounted(() => {
    let body = document.getElementsByTagName('body')[0];
    if(body.classList.contains('overflow-hidden')) {
        body.classList.remove('overflow-hidden')
    }
})
</script>
