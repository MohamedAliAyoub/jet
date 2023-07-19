<template>
    <Dialog :header="header"
            v-model:visible="visible.status"
            :breakpoints="{'960px': '75vw', '640px': '90vw'}"
            :style="{width: '70vw'}"
            :maximizable="true"
            :modal="true">
        <slot/>
        <template #footer v-if="showFooter">
            <PrimaryButton :name="$t('save')" @click="$emit('submit')" />
            <SecondaryButton :name="$t('cancel')" @click="closeDialog" class="p-button-text"/>
        </template>
    </Dialog>
</template>

<script setup>
import  Dialog  from "primevue/dialog";
import PrimaryButton from "@/Components/Button/PrimaryButton.vue";
import SecondaryButton from "@/Components/Button/SecondaryButton.vue";



const props = defineProps({
    header: {
        type: String
    },
    showFooter: {
        type: Boolean,
        default: true
    },
    visible: {
        type: Object,
    },
});
function openDialog() {
    visible.value.status = true;
}
function closeDialog() {
    visible.value.status = false;
}
defineExpose({openDialog});

</script>
