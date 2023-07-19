<template>
    <div class="flex align-items-center">
        <Checkbox
            v-model="form[name]"
            :name="name"
            :value="value"
            :inputId="id"
        />
        <label
            :for="id"
            class="checkbox-label text-sm cursor-pointer"
        >
            {{ label }}
        </label>
    </div>
</template>

<script setup>
import Checkbox from 'primevue/checkbox';
import { computed } from 'vue';

const props = defineProps({
    form: Object,
    name: String,
    label: String,
    value: String,
    id: String,
})

const id = computed(() => props.id ?? props.name)
</script>
