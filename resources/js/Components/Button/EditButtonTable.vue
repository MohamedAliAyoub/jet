<template>
    <div
        class="table-cell px-1"
    >
        <Button
            :size="size"
            :disabled="disabled"
            :icon="icon"
            @click="handleButtonClick"
            class="table-p-button"
            v-bind="$attrs"
        />
    </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import Button from 'primevue/button';

const props = defineProps({
    href: String,
    disabled: Boolean,
    icon: {
        type: String,
        default: 'pi pi-file-edit',
    },
    size: {
        type: String,
        default: 'large',
        validator(val) {
            return ['small', 'normal', 'large'].includes(val)
        }
    },
})

const handleButtonClick = () => {
    if(props.href) {
        Inertia.visit(props.href)
    }
}
</script>
