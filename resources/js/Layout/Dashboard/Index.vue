<template>
    <div class="flex">

        <SideBar />

        <section class="w-full dashboard-container">

            <div class="dashboard-overlay"></div>

            <TopBar />

            <NotificationAlert />

            <slot />

        </section>

    </div>
</template>

<script setup>
import SideBar from './SideBar/Index.vue';
import TopBar from './TopBar/Index.vue';
import NotificationAlert from '@/Components/Others/NotificationAlert.vue';
import { onMounted } from 'vue';

onMounted(() => document.getElementsByTagName('body')[0].classList.add('overflow-hidden'))
</script>
