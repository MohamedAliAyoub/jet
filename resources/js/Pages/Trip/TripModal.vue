<template>
    <form @submit.prevent="submit" method="post">
        <div class="grid grid-cols-3 gap-3">
            <FormInput :form="form" name="departure_country" required/>
            <FormInput :form="form" name="departure_city" required/>
            <FormInput :form="form" name="departure_airport_name" required/>

            <FormInput :form="form" name="arrival_country" required/>
            <FormInput :form="form" name="arrival_city" required/>
            <FormInput :form="form" name="arrival_airport_name" required/>

        </div>
        <div class="grid grid-cols-2 gap-2">

            <FormDateInput :form="form" name="date" required/>

            <FormSelect
                :form="form"
                name="flight_status"
                :label="$t('base.flight_status')"
                :options="statuses"
                option-label="name"
                option-value="id"

                required
            />

            <FormDateTimeInput :form="form" name="take_off_time" required/>

            <FormDateTimeInput :form="form" name="landing_time" required/>

            <div class="grid grid-cols-2 gap-2">

                <FormInput :form="form"  name="hours" required/>
                <FormInput :form="form"  name="minutes" />
            </div>
            <FormSelect
                :form="form"
                name="user_id"
                :label="$t('base.user_id')"
                :options="users"
                option-label="name"
                option-value="id"
                required
            />
        </div>
        <SubmitButton :name="$t('save')"/>
    </form>
</template>


<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import route from "ziggy-js";
import SubmitButton from "@/Components/Button/SubmitButton.vue";
import {defineEmits} from "vue";
import FormInput from "@/Components/Form/FormInput.vue";
import FormSelect from "@/Components/Form/FormSelect.vue";
import FormDateInput from "@/Components/FormDateInput.vue";
import FormNumber from "@/Components/Form/FormNumber.vue";
import FormDateTimeInput from "@/Components/Form/FormDateTimeInput.vue";


const props = defineProps({
    data: {
        type: Object
    },

    statuses: {
        type: Object
    },

    users: {
        type: Object
    },

    visible: {
        type: Object,
    },
});

const form = useForm({
    'id': props.data?.id,
    'departure_country': props.data?.departure_country,
    'departure_city': props.data?.departure_city,
    'departure_airport_name': props.data?.departure_airport_name,
    'arrival_country': props.data?.arrival_country,
    'arrival_city': props.data?.arrival_city,
    'arrival_airport_name': props.data?.arrival_airport_name,
    'date': props.data?.date,
    'take_off_time': props.data?.take_off_time ?? null,
    'landing_time': props.data?.landing_time ?? null,
    'flight_status': props.data?.flight_status,
    'user_id': props.data?.user_id,
    'hours': props.data?.hours,
    'minutes': props.data?.minutes ?? 0,


});
const createable = !props.data
let add = createable ? 'add' : 'edit';

let success_emit = defineEmits(['success']);

function submit() {
    let url = createable
        ? route('user.trips.store')
        : route('user.trips.update', props.data.id)
    form.post(url, {
        preserveScroll: true,
        onSuccess: () => {
            success_emit('success');
        },
        onError: (error) => console.log(error)
    })

};
</script>
