<template>
    <Link
        v-if="href"
        :href="href"
        class="anchor-component"
    >
        {{ label ?? $t(`base.${name}`) }}
    </Link>
    <p v-else>
        {{ label ?? $t(`base.${name}`) }}
    </p>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    name: String,
    label: String,
    href: String,
})
</script>
