<template>
    <div class="my-2 grid grid-cols-1 md:grid-cols-2 gap-2">
        <div>
            <div class="flex justify-between items-center">
                <label
                    :for="`${name}-ar`"
                    :class="{'required': required}"
                    class="text-sm font-bold"
                >
                    {{ label ?? $t(`base.${name}`) }}
                    ( <span class="text-sm">{{ $t('base.ar') }}</span> )
                </label>
            </div>
            <Textarea
                v-if="textarea"
                rows="5"
                cols="30"
                v-model="form[name]['ar']"
                class="w-full p-inputtext-sm"
                :required="required"
                v-bind="$attrs"
            />

            <InputText
                v-else
                :id="`${name}-ar`"
                type="text"
                v-model="form[name]['ar']"
                class="w-full p-inputtext-sm"
                :required="required"
                v-bind="$attrs"
            />
            <p
                class="text-sm text-red-600"
            >
                {{ form['errors'][`${name}.ar`] }}
            </p>
        </div>
        <div>
            <div class="flex justify-between items-center">
                <label
                    :for="`${name}-en`"
                    :class="{'required': required}"
                    class="text-sm font-bold"
                >
                    {{ label ?? $t(`base.${name}`) }}
                    ( <span class="text-sm">{{ $t('base.en') }}</span> )
                </label>
            </div>
            <Textarea
                v-if="textarea"
                rows="5"
                cols="30"
                v-model="form[name]['en']"
                class="w-full p-inputtext-sm"
                :required="required"
                v-bind="$attrs"
            />

            <InputText
                v-else
                :id="`${name}-en`"
                type="text"
                v-model="form[name]['en']"
                class="w-full p-inputtext-sm"
                :required="required"
                v-bind="$attrs"
            />
            <p
                class="text-sm text-red-600"
            >
                {{ form['errors'][`${name}.en`] }}
            </p>
        </div>
    </div>
</template>

<script setup>
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';

const props = defineProps({
    form: Object,
    name: String,
    label: String,
    required: Boolean,
    textarea: Boolean,
})
</script>
