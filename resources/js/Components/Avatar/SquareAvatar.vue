<template>
    <Avatar
        :image="src"
        :size="size"
        v-bind="$attrs"
    />
</template>

<script setup>
import Avatar from 'primevue/avatar';

defineProps({
    src: String,
    size: {
        type: String,
        default: '',
        validator(val) {
            return ['xlarge', 'large', ''].includes(val)
        }
    }
})
</script>
