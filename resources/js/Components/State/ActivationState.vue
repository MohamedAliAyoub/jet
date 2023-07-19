<template>
    <div>
        <Badge
            v-if="isActive"
            :value="$t('base.active')"
            severity="success"
        />
        <Badge
            v-else
            :value="$t('base.not_active')"
            severity="danger"
        />
    </div>
</template>

<script setup>
import Badge from 'primevue/badge';

defineProps({
    isActive: Boolean,
})
</script>
