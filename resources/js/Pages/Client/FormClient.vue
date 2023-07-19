<template>
    <Panel :breadcrumbs="[{label: $t('base.clients'), href: route('user.clients.index')},{label:$t('base.'+add)}]">
        <div class="container">
            <form @submit.prevent="submit" method="post">
                <div class="grid grid-cols-1 gap-4">
                    <FormTranslatable :form="form" :required="1" name="name" />
                    <div class="grid pt-2 grid-cols-2 gap-4">
                        <FormInput :form="form" type="email" :required="1" :name="$t('email')"/>
                        <FormPassword :form="form" :name="$t('password')"/>

                        <FormInput :form="form" :name="$t('mobile')"/>
                        <FormSelect :form="form" name="type" :required="true" :label="$t('base.type')"
                                    :options="types"
                                    :option-label="name"
                                    option-value="id"/>
                    </div>
                    <SubmitButton :name="$t('save')"/>

                </div>
            </form>
        </div>
    </Panel>
</template>


<script setup>
import FormInput from "@/Components/Form/FormInput.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import SubmitButton from "@/Components/Button/SubmitButton.vue";
import Panel from "@/Layout/Dashboard/Panel.vue";
import FormPassword from "@/Components/Form/FormPassword.vue";
import route from "ziggy-js";
import FormSelect from "@/Components/Form/FormSelect.vue";
import FormTranslatable from "@/Components/Form/FormTranslatable.vue";


const props = defineProps(['data', 'types']);
const form = useForm({
    'id': props.data?.id ?? null,
    'name': {
        ar: props.data?.name?.ar,
        en: props.data?.name?.en
    },
    'email': props.data?.email ?? null,
    'mobile': props.data?.mobile ?? null,
    'password': '',
    'type': props.data?.type ?? null,
});
const createable = !props.data
let add = createable ? 'add' : 'edit';

function submit() {
    let url = createable
        ? route('user.clients.store')
        : route('user.clients.update', props.data.id)
    form.post(url, {
        preserveScroll: true,
        onSuccess: () => {

        },
        onError: (error) => console.log(error)
    })

};

</script>
