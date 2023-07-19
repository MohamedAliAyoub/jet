<template>
    <Message
        v-if="message"
        severity="error"
        :closable="closable"
    >
        {{ message }}
    </Message>
</template>

<script setup>
import Message from 'primevue/message';

defineProps({
    message: String,
    closable: {
        type: Boolean,
        default: false,
    }
})
</script>
