<template>
    <Panel :breadcrumbs="[{label: $t('base.admins'), href: route('user.admins.index')},{label:$t('base.add')}]">
        <div class="mt-4 px-3">
            <form @submit.prevent="store" method="post">
                <div class="grid pt-2 grid-cols-2 gap-4">
                    <FormInput :form="formCreate" :required="1" :name="$t('name')"/>
                    <FormInput :form="formCreate" type="email"  :name="$t('email')"/>
                    <FormInput :form="formCreate" type="password" :required="1" :name="$t('password')"/>
                    <FormInput :form="formCreate" type="password" :required="1" :name="$t('password_confirmation')"/>
                    <FormInput :form="formCreate"  :name="$t('mobile')"/>
                    <FormSelect :form="formCreate" :name="'role_id'" :label="$t('role')"
                                :options="roles"
                                option-label="name"
                                option-value="id"/>
                    <FormSelect :form="formCreate" name="parent_id" :label="$t('base.parent')"
                                :options="parents"
                                option-label="name"
                                option-value="id"/>

                </div>
                <SubmitButton :name="$t('add')"/>
            </form>
        </div>
    </Panel>
</template>


<script setup>
import FormInput from "@/Components/Form/FormInput.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import SubmitButton from "@/Components/Button/SubmitButton.vue";
import Panel from "@/Layout/Dashboard/Panel.vue";
import FormFile from "@/Components/Form/FormFile.vue";
import FormSelect from "@/Components/Form/FormSelect.vue";


const props = defineProps(['roles' , 'parents']);
const formCreate = useForm({
    'name': null,
    'email': null,
    'password': null,
    'password_confirmation':null,
    'avatar': null,
    'role_id': null,
    'parent_id': null

});

function store() {
    formCreate.post(route('user.admins.store'), {
        preserveScroll: true,
        onSuccess: () => {
            formCreate.reset();
        },
        onError: (error) => console.log(error)
    })
};

</script>
