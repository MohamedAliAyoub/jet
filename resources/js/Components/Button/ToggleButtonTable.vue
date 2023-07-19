<template>
    <div
        class="table-cell px-1"
    >
        <div v-ability="ability">
            <InputSwitch
                v-model="form[name]"
                :disabled="disabled"
                class="table-p-button"
                @change="handleSwitchChange"
                v-bind="$attrs"
            />
        </div>
        <div v-else-ability="ability">
            <ActivationState
                :is-active="form[name]"
            />
        </div>
    </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import InputSwitch from 'primevue/inputswitch';
import ActivationState from '../../Components/State/ActivationState.vue';

const props = defineProps({
    form: Object,
    name: String,
    href: String,
    disabled: Boolean,
    ability: String,
})

const handleSwitchChange = () => {
    if(props.href) {
        Inertia.put(props.href, {}, {
            preserveState: true,
            preserveScroll: true
        })
    }
}
</script>
