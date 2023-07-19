<template>
    <Panel>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-2xl font-bold">{{ $t('base.forgot_password') }}</div>
                        <div class="card-body">
                            <form @submit.prevent="sendPasswordResetLink">
                                <div class="form-group row">
                                    <FormInput :form="form" type="email" :required="1" :name="$t('email')"/>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <SubmitButton type="submit" :name="$t('send_password_reset_link')"
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

const form = useForm({
    email: null
});
function sendPasswordResetLink() {
    form.post(route('user.password.email'), {
        onSuccess: () => {
            // Handle success, e.g., show a success message
        },
        onError: (errors) => {
            // Handle errors, e.g., display validation errors
            form.errors = errors;
        }
    });
}
</script>
