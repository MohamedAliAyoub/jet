<template>
    <LoginFormCard class="w-full box-border">
        <ErrorMessage :message="form.errors.message"/>
        <form @submit.prevent="login">
            <FormInput
                :form="form"
                name="email"
                required
                v-focustrap
                autofocus
            />
            <FormPassword
                :form="form"
                name="password"
                required
            />
            <div class="flex flex-wrap justify-center">
                <SubmitButton
                    name="login"
                    :loading="form.processing"
                />

            </div>
            <div class="text-center">
                 <Anchor
                     :href="route('user.password.request')"
                    name="forgot_password"
                />

            </div>
        </form>
    </LoginFormCard>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import LoginFormCard from '@/Components/Card/LoginFormCard.vue';
import FormInput from '@/Components/Form/FormInput.vue';
import FormPassword from '@/Components/Form/FormPassword.vue';
import SubmitButton from '@/Components/Button/SubmitButton.vue';
import ErrorMessage from '../../Components/Message/ErrorMessage.vue';
import LoginLayout from '@/Layout/LoginLayout.vue';
import Anchor from '@/Components/Others/Anchor.vue';
import route from 'ziggy-js';

defineOptions({layout: LoginLayout})

const form = useForm({
    email: '',
    password: '',
})

function login() {
    form.post(route('user.login'), {
        onError: () => form.reset('password')
    });
}
</script>

