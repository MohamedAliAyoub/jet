<template>
    <Panel :breadcrumbs="[{label: $t('base.admins'), href: route('user.admins.index')},{label:$t('base.edit')}]">
        <div class="container">
            <form @submit.prevent="update" method="post">
                <div class="grid pt-2 grid-cols-2 gap-4">
                    <FormInput :form="formUpdate" :required="1" :name="$t('name')"/>
                    <FormInput :form="formUpdate" type="email"  :name="$t('email')"/>
                    <FormPassword :form="formUpdate" :name="$t('password')"/>
                    <FormPassword :form="formUpdate" :name="$t('password_confirmation')"/>
                    <FormInput :form="formUpdate"  :name="$t('mobile')"/>

                    <FormSelect :form="formUpdate"
                                name="role_id"
                                :label="$t('base.role')"
                                :options="roles"
                                option-label="name"
                                option-value="id"/>
                    <FormSelect :form="formUpdate" name="parent_id" :label="$t('base.parent')"
                                :options="parents"
                                option-label="name"
                                option-value="id"/>
                    <FormInput :form="formUpdate"  :name="$t('hours_balance')"/>

<!--                    <FormFile :form="formUpdate" type="file" :src="data.avatar_url" :name="$t('avatar')"/>-->

                </div>
                <SubmitButton :name="$t('edit')"/>
            </form>
        </div>
    </Panel>
</template>


<script setup>
import FormInput from "@/Components/Form/FormInput.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import SubmitButton from "@/Components/Button/SubmitButton.vue";
import FormFiles from "@/Components/Form/FormFiles.vue";
import Panel from "@/Layout/Dashboard/Panel.vue";
import FormFile from "@/Components/Form/FormFile.vue";
import FormPassword from "@/Components/Form/FormPassword.vue";
import FormSelect from "@/Components/Form/FormSelect.vue";


const props = defineProps(['data', 'roles' ,  'parents']);
const formUpdate = useForm({
    'id': props.data?.id,
    'name': props.data?.name,
    'mobile': props.data?.mobile,
    'email': props.data?.email,
    'avatar': props.data?.avatar ?? [],
    'role_id': props.data?.role_id,
    'parent_id': props.data?.parent_id,
    'hours': props.data?.hours_number,
    'hours_balance': props.data?.hours_balance,
    'password': '',
    'password_confirmation':'',
});

function update() {
    formUpdate.post(route('user.admins.update', props.data.id), {
        preserveScroll: true,
        onSuccess: () => {

        },
        onError: (error) => console.log(error)
    })
};

</script>
