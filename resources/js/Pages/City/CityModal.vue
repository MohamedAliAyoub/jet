<template>
    <form @submit.prevent="submit" method="post">
        <FormTranslatable :form="form" :required="1" name="name"/>
        <SubmitButton :name="$t('save')"/>
    </form>
</template>


<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import SubmitButton from "@/Components/Button/SubmitButton.vue";
import route from "ziggy-js";
import FormTranslatable from "@/Components/Form/FormTranslatable.vue";
import {defineEmits} from "vue";


const props = defineProps({
    data: {
        type: Object
    },
    visible: {
        type: Object,
    },
    id: {
        type: Number,
        required: false,
    },
});
let type = props.parent_id ? 'city' : 'area'

const form = useForm({
    'id': props.data?.id,
    'name': {
        ar: props.data?.name?.ar,
        en: props.data?.name?.en
    },
    'parent_id': props.id,
    'type': type
});
const createable = !props.data
let add = createable ? 'add' : 'edit';


let success_emit = defineEmits(['success']);

function submit() {
    let url = createable
        ? route('user.cities.store')
        : route('user.cities.update', props.data.id)
    form.post(url, {
        preserveScroll: true,
        onSuccess: () => {
            success_emit('success');
        },
        onError: (error) => console.log(error)
    })

};


</script>
