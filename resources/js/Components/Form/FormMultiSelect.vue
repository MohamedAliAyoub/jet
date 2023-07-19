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
        <MultiSelect
            v-model="form[name]"
            :options="options"
            :filter="filterable"
            :option-label="optionLabel"
            :option-value="optionValue"
            :empty-filter-message="$t('base.no_results')"
            :empty-message="$t('base.no_options')"
            :selected-items-label="$t('base.items_selected') + ' {0}'"
            :placeholder="placeholder ? `${$t('base.select')} ${placeholder}` : ''"
            :maxSelectedLabels="5"
            class="w-full p-inputtext-sm"
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
import MultiSelect from 'primevue/multiselect';

const props = defineProps({
    form: Object,
    name: String,
    label: String,
    placeholder: String,
    required: Boolean,
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
