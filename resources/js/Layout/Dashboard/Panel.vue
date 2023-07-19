<template>
    <div class="dashboard-panel">

        <div class="flex items-center justify-between pl-5 pr-5">
            <Breadcrumb
                :breadcrumbs="breadcrumbs"
            />

            <div class="flex flex-wrap items-center">
                <slot name="actions" />
            </div>
        </div>

        <div
            v-if="$slots.tabs"
            class="dashboard-tabs"
        >
            <slot name="tabs" />
        </div>

        <div class="dashboard-body">
            <slot />
        </div>

    </div>
</template>

<script setup>
import Breadcrumb from './Breadcrumb.vue';

defineProps({
    breadcrumbs: Array, // Array.Object<label, href>
})
</script>

