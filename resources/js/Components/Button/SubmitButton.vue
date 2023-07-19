<template>
    <div
        :class="{'my-3': ! disableMargin}"
        class="submit-button"
    >
        <Button
            :label="label ?? $t(`base.${name}`)"
            :size="size"
            :loading="loading"
            type="submit"
            v-bind="$attrs"
        />
    </div>
</template>

<script setup>
import Button from 'primevue/button';

defineProps({
    loading: Boolean,
    name: String,
    label: String,
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
