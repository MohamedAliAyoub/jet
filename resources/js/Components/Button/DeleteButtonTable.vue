<template>
    <div
        :class="{'table-cell px-1': tableCell}"
    >
        <Button
            :size="size"
            :disabled="disabled"
            @click="handleConfirm"
            class="table-p-button delete-button-table p-button-icon-only"
            v-bind="$attrs"
        >
            <span
                class="p-button-icon"
                :class="icon"
            />

            <span class="p-button-label">&nbsp;</span>

            <ConfirmDialog :group="group">
                <template #message="slotProps">
                    <div class="flex">
                        <i :class="slotProps.message.icon" style="font-size: 1.5rem"></i>
                        <p class="p-confirm-dialog-message">
                            {{ slotProps.message.message }}
                            <span class="underline font-bold">{{ slotProps.message.label }}</span>
                            <p class="text-sm">{{ $t('base.confirm_delete_note') }}</p>
                        </p>
                    </div>
                </template>
            </ConfirmDialog>
        </Button>
    </div>
</template>

<script setup>
import ConfirmDialog from 'primevue/confirmdialog';
import { Inertia } from '@inertiajs/inertia';
import { useConfirm } from "primevue/useconfirm";
import Button from 'primevue/button';
import { useI18n } from 'vue-i18n';

const confirm = useConfirm();
const i18n = useI18n();

const props = defineProps({
    id: {
        type: null,
        required: true,
    },
    href: String,
    label: String,
    disabled: Boolean,
    icon: {
        type: String,
        default: 'pi pi-trash',
    },
    size: {
        type: String,
        default: 'large',
        validator(val) {
            return ['small', 'normal', 'large'].includes(val)
        }
    },
    disableMargin: Boolean,
    tableCell: {
        type: Boolean,
        default: true
    },
})

const group = `deleteDialog-${props.id}`

const handleConfirm = () => {
    confirm.require({
        group: group,
        label: props.label,
        message: i18n.t('base.confirm_delete'),
        header: i18n.t('base.delete_item'),
        icon: 'pi pi-info-circle',
        acceptClass: 'p-button-danger',
        acceptLabel: i18n.t('base.accept_label'),
        rejectLabel: i18n.t('base.reject_label'),
        accept: () => {
            Inertia.delete(props.href)
        },
        reject: () => {
            // ...
        }
    })
}
</script>
