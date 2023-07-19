<template>
    <div class="my-2" :class="containerClass">
        <div v-if="! hideLabel">
            <label
                :for="name"
                :class="{'required': required}"
                class="text-sm font-bold"
            >
                {{ label ?? $t(`base.${name}`) }}
            </label>
        </div>
        <Dropdown
            v-model="form[name]"
            :options="options"
            :option-label="optionLabel"
            :option-value="optionValue"
            :showClear="clearable"
            :filter="filterable"
            :empty-filter-message="$t('base.no_results')"
            :empty-message="$t('base.no_options')"
            class="w-full p-inputtext-sm"
            :placeholder="placeholder ? `${$t('base.select')} ${placeholder}` : ''"
            v-bind="$attrs"
        />
        <p
            v-if="form['errors']"
            class="text-sm text-red-600"
        >
            {{ form['errors'][name] }}
        </p>
    </div>
</template>

<script setup>
import Dropdown from 'primevue/dropdown';

const props = defineProps({
    form: Object,
    name: String,
    label: String,
    placeholder: String,
    required: Boolean,
    clearable: Boolean,
    filterable: Boolean,
    options: Array,
    optionLabel: {
        type: String,
        default: 'name',
    },
    optionValue: {
        type: String,
        default: 'value',
    },
    hideLabel: Boolean,
    containerClass: String,
})
</script>
