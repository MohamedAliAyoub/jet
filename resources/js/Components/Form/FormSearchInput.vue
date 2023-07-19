<template>
    <div class="my-2">
        <div v-if="! hideLabel">
            <label
                :for="name"
                :class="{'required': required}"
                class="text-sm font-bold"
            >
                {{ label ?? $t(`base.${name}`) }}
            </label>
        </div>
        <div class="p-input-icon-left">
            <i :class="{'pi pi-search': ! loading, 'pi pi-spin pi-spinner': loading}" />
            <InputText
                :id="name"
                type="text"
                v-model="form[name]"
                class="w-full p-inputtext-sm"
                :placeholder="label ?? $t(`base.${name}`)"
                :required="required"
                v-bind="$attrs"
            />
        </div>
        <p
            v-if="form?.errors"
            class="text-sm text-red-600"
        >
            {{ form['errors'][name] }}
        </p>
    </div>
</template>

<script setup>
import InputText from 'primevue/inputtext';

const props = defineProps({
    form: Object,
    name: String,
    label: String,
    required: Boolean,
    loading: Boolean,
    hideLabel: Boolean,
})
</script>
