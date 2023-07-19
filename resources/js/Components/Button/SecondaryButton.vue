<template>
    <div
        :class="{'my-3': ! disableMargin}"
        class="submit-button"
    >
        <Link
            v-if="href"
            :href="href"
            class="secondary-anchor self-start bg-transparent text-secondary-800 dark:text-secondary-200
                border border-secondary-500 dark:border-secondary-300 disabled:opacity-80
                cursor-pointer inline-block py-2 px-8 mx-1
                rounded transition-all duration-300 text-base font-bold
                hover:bg-secondary-500
                hover:text-white dark:hover:text-white"
        >
            <i :class="icon"></i>
            {{ label ?? $t(`base.${name}`) }}
        </Link>

        <Button
            v-else
            :label="label ?? $t(`base.${name}`)"
            :size="size"
            :loading="loading"
            severity="secondary"
            :disabled="disabled"
            :icon="icon"
            v-bind="$attrs"
        />
    </div>
</template>

<script setup>
import Button from 'primevue/button';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    loading: Boolean,
    name: String,
    label: String,
    href: String,
    disabled: Boolean,
    icon: String,
    size: {
        type: String,
        default: 'normal',
        validator(val) {
            return ['small', 'normal', 'large'].includes(val)
        }
    },
    disableMargin: Boolean,
})
</script>
