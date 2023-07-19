<template>
    <Panel :breadcrumbs="[{label: $t('base.blood_type')}]">
        <template #actions>
            <PrimaryButton :name="$t('add')" v-ability="Ability.MODULE_ADMINS_CREATE"
                           @click.prevent="openDialog"/>
            <ActionMenu :execl="true"/>
        </template>

        <TablePagination :tableData="data">
            <Column field="name_text" :header="$t('base.name')"></Column>
            <Column  :header="$t('base.is_active')">
                <template #body="row">
                    <ToggleButtonTable
                        :form="row.data"
                        name="is_active"
                        :href="route('user.blood_types.change_active' , row.data.id)"
                        :ability="Ability.MODULE_BLOOD_TYPE_ACTIVE"
                    />
                </template>
            </Column>

            <Column
                :header="$t('base.operations')"
            >
                <template #body="slot">
                    <EditButtonTable
                        :id="slot.data.id"
                        v-ability="Ability.MODULE_CLIENT_UPDATE"
                        @click="editData(slot.data)"
                    />

                    <DeleteButtonTable
                        :id="slot.data.id"
                        :label="slot.data.name_text"
                        v-ability="Ability.MODULE_CLIENT_DELETE"
                        :href="route('user.blood_types.delete', slot.data.id)"
                    />
                </template>
            </Column>

        </TablePagination>

        <Dialog :header="modalData == null ? $t('base.add') : $t('base.edit')" :showFooter="false" :visible="visible">
            <BloodTypeModal :data="modalData" @success="visible.status=false"/>
        </Dialog>

    </Panel>
</template>


<script setup>
import EditButtonTable from '@/Components/Button/EditButtonTable.vue';
import DeleteButtonTable from '@/Components/Button/DeleteButtonTable.vue';
import {Ability} from '../../ability';
import TablePagination from "@/Components/Table/TablePagination.vue";
import PrimaryButton from "@/Components/Button/PrimaryButton.vue";
import Panel from "@/Layout/Dashboard/Panel.vue";
import BloodTypeModal from "@/Pages/BloodType/BloodTypeModal.vue";
import {ref} from "vue";
import Dialog from '@/Components/Dialog.vue';
import ActionMenu from "@/Components/Menu/ActionMenu.vue";
import ToggleButtonTable from "@/Components/Button/ToggleButtonTable.vue";


const modalData = ref(null);
const visible = ref({status: false});

function openDialog() {
    modalData.value = null;
    visible.value.status = true
}

const props = defineProps({
    data: {
        type: Array,
        required: true
    }
});


function editData(data = null) {
    modalData.value = data;
    visible.value.status = true
}
</script>
