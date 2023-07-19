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
        <Password
            :id="name"
            v-model="form[name]"
            class="w-full p-inputtext-sm"
            :required="required"
            toggleMask
            :feedback="feedback"
            :promptLabel="$t('base.password_promptLabel')"
            :weakLabel="$t('base.password_weakLabel')"
            :mediumLabel="$t('base.password_mediumLabel')"
            :strongLabel="$t('base.password_strongLabel')"
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
import Password from 'primevue/password';

const props = defineProps({
    form: Object,
    name: String,
    label: String,
    required: Boolean,
    feedback: Boolean,
})
</script>

<style>
.p-component.p-password-input {
    width: 100%;
}
</style>
