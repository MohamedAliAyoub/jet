<template>
    <form @submit.prevent="submit" method="post">
        <FormTranslatable :form="form" :required="1" name="name"/>
        <SubmitButton :name="$t('save')"/>
    </form>
</template>


<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import route from "ziggy-js";
import FormTranslatable from "@/Components/Form/FormTranslatable.vue";
import SubmitButton from "@/Components/Button/SubmitButton.vue";
import {defineEmits} from "vue";


const props = defineProps({
    data: {
        type: Object
    },

    visible: {
        type: Object,
    },
});

const form = useForm({
    'id': props.data?.id ?? null,
    'name': {
        ar: props.data?.name?.ar,
        en: props.data?.name?.en
    },
});
const createable = !props.data
let add = createable ? 'add' : 'edit';

let success_emit = defineEmits(['success']);
function submit() {
    let url = createable
        ? route('user.blood_types.store')
        : route('user.blood_types.update', props.data.id)
    form.post(url, {
        preserveScroll: true,
        onSuccess: () => {
            success_emit('success');
        },
        onError: (error) => console.log(error)
    })

};
</script>
