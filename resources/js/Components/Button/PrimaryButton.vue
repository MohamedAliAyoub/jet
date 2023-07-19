<template>
    <div
        :class="{'my-3': ! disableMargin}"
        class="submit-button"
    >
        <Link
            v-if="href"
            :href="href"
            class="primary-anchor self-start bg-primary-500 border border-primary-500 disabled:opacity-80
                    cursor-pointer text-white py-2 px-8 inline-block mx-1
                    rounded transition-all duration-300 text-base font-bold"
        >
            <i :class="icon"></i>
            {{ label ?? $t(`base.${name}`) }}
        </Link>

        <Button
            v-else
            :label="label ?? $t(`base.${name}`)"
            :size="size"
            :loading="loading"
            :disabled="disabled"
            :icon="icon"
            @click="handleClick"
            v-bind="$attrs"
        />
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Button from 'primevue/button';

const emit = defineEmits(['clicked'])

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

const handleClick = () => emit('clicked')
</script>
