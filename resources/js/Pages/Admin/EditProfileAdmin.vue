<template>
    <Panel :breadcrumbs="[{label: $t('base.home')}]">
        <div class="container">
            <form @submit.prevent="update" method="post">
                <FormInput :form="formUpdate" :required="1" :name="$t('name')"/>
                <FormInput :form="formUpdate" type="email" :required="1" :name="$t('email')"/>
                <FormFile :form="formUpdate" type="file" :src="data.avatar_url" :name="$t('avatar')"/>
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
const formUpdate = useForm({
    'id': props.data?.id,
    'name': props.data?.name,
    'email': props.data?.email,
    'avatar': props.data?.avatar ?? [],
});
const formPassword = useForm({
    'current_password': null,
    'password': null,
    'password_confirmation': null,
});
const activeTabIndex = ref(0);

function changeTab(index) {
    activeTabIndex.value = index;
}


function update() {
    formUpdate.post(route('user.profile.update.profile'), {
        preserveScroll: true,
        onSuccess: () => {

        },
        onError: (error) => console.log(error)
    })
};

function change_password() {
    console.log(formUpdate);
    formPassword.post(route('user.profile.change.password'), {
        preserveScroll: true,
        onSuccess: () => {

        },
        onError: (error) => console.log(error)
    })
};
</script>
