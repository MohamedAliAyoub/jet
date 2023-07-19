<template>
    <Panel :breadcrumbs="[{label: $t('base.home')}]">
        <div class="container">
            <form @submit.prevent="change_password" method="post">
                <FormInput :form="formPassword" type="password" :required="1" :name="$t('current_password')"/>
                <FormInput :form="formPassword" type="password" :required="1" :name="$t('password')"/>
                <FormInput :form="formPassword" type="password" :required="1" :name="$t('password_confirmation')"/>
                <SubmitButton :name="$t('edit')"/>
            </form>
        </div>
    </Panel>
</template>
<script setup>
import FormInput from "@/Components/Form/FormInput.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import SubmitButton from "@/Components/Button/SubmitButton.vue";
import FormFile from "@/Components/Form/FormFile.vue";
import Panel from "@/Layout/Dashboard/Panel.vue";
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import {ref} from "vue";


const props = defineProps(['data']);
const formPassword = useForm({
    'current_password': null,
    'password': null,
    'password_confirmation': null,
});


function change_password() {
    formPassword.post(route('user.profile.change.password'), {
        preserveScroll: true,
        onSuccess: () => {

        },
        onError: (error) => console.log(error)
    })
}
</script>
