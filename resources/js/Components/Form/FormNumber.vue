<template>
    <div class="my-2">
        <div>
            <label
                :for="name"
                :class="{'required': required}"
                class="text-sm font-bold"
            >
                {{ label ?? $t(`base.${name}`) }}
            </label>
        </div>
        <InputNumber
            :inputId="name"
            v-model="form[name]"
            :suffix="suffix"
            class="w-full p-inputtext-sm"
            :required="required"
            v-bind="$attrs"
        />
        <p
            class="text-sm text-red-600"
        >
            {{ form['errors'][name] }}
        </p>
    </div>
</template>

<script setup>
import InputNumber from 'primevue/inputnumber';

const props = defineProps({
    form: Object,
    name: String,
    label: String,
    required: Boolean,
    suffix: String,
})
</script>
