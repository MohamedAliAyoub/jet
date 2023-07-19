<template>
    <Panel>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-2xl font-bold">{{ $t('base.reset_password') }}</div>
                        <div class="card-body">
                            <form @submit.prevent="resetPassword">
                                <div class="form-group row">
                                    <FormInput :form="form" type="email" :required="1" :name="$t('email')"/>
                                </div>

                                <div class="form-group row">
                                    <FormInput :form="form" type="password" :required="1" :name="$t('password')"/>
                                </div>

                                <div class="form-group row">
                                    <FormInput :form="form" type="password" :required="1" :name="$t('password_confirmation')"/>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <SubmitButton type="submit" :name="$t('edit')"
                                                      class="btn btn-primary"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Panel>
</template>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3';
import Panel from "@/Layout/Dashboard/Panel.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import SubmitButton from "@/Components/Button/SubmitButton.vue";

const props = defineProps({
    token: {
        type: Object,
    },
});

const form = useForm({
    email: null,
    password: null,
    password_confirmation: null,
    token: props.token,
});

function resetPassword() {
    form.post(route('user.password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            // Handle success, e.g., redirect to a success page
        },
        onError: (errors) => {
            // Handle errors, e.g., display validation errors
            form.errors = errors;
        }
    });
}
</script>
