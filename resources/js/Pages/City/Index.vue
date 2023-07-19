<template>
    <Panel :breadcrumbs="[{label: $t(title) ,   href: route('user.cities.index') }]">
        <template #actions>
            <PrimaryButton :name="$t('add')" v-ability="Ability.MODULE_CITY_CREATE"
                           @click.prevent="openDialog"/>
            <ActionMenu :execl="true"/>
        </template>

        <TablePagination :tableData="data">
            <Column field="name_text" :header="$t('base.name')">
                <template v-if="title=='base.area'" #body="row">
                    <Anchor :label="row.data.name_text" :href="route('user.cities.city.index' , row.data.id)"/>
                </template>
            </Column>
            <Column :header="$t('base.is_active')">
                <template #body="row">
                    <ToggleButtonTable
                        :form="row.data"
                        name="is_active"
                        :href="route('user.cities.change_active' , row.data.id)"
                        :ability="Ability.MODULE_CITY_ACTIVE"
                    />
                </template>
            </Column>

            <Column
                :header="$t('base.operations')"
            >
                <template #body="slot">
                    <EditButtonTable
                        :id="slot.data.id"
                        v-ability="Ability.MODULE_CITY_UPDATE"
                        @click="editData(slot.data)"
                    />
                    <DeleteButtonTable
                        :id="slot.data.id"
                        :label="slot.data.name_text"
                        v-ability="Ability.MODULE_CITY_DELETE"
                        :href="route('user.cities.delete', slot.data.id)"
                    />
                </template>
            </Column>
            <Dialog :header="modalData == null ? $t('base.add') : $t('base.edit')" :showFooter="false"
                    :visible="visible">
                <CityModal :data="modalData" @success="visible.status=false" :id="id"/>
            </Dialog>
        </TablePagination>
    </Panel>
</template>


<script setup>
import EditButtonTable from '@/Components/Button/EditButtonTable.vue'; // this button must redirect to edit tab page through `href` prop.
import DeleteButtonTable from '@/Components/Button/DeleteButtonTable.vue';
import {Ability} from '../../ability';
import TablePagination from "@/Components/Table/TablePagination.vue";
import PrimaryButton from "@/Components/Button/PrimaryButton.vue";
import Panel from "@/Layout/Dashboard/Panel.vue";
import Anchor from "@/Components/Others/Anchor.vue";
import Dialog from '@/Components/Dialog.vue';
import {ref} from "vue";
import CityModal from "@/Pages/City/CityModal.vue";
import ActionMenu from "@/Components/Menu/ActionMenu.vue";
import ToggleButtonTable from "@/Components/Button/ToggleButtonTable.vue";


const props = defineProps({
    data: {
        type: Array,
        required: true
    },
    id: {
        type: Number,
        required: false
    }
});

const modalData = ref(null);
const visible = ref({status: false});

function openDialog() {
    visible.value.status = true
    modalData.value = null;

}


function editData(data = null) {
    modalData.value = data;
    visible.value.status = true
}

let title = props.id != null ? 'base.city' : 'base.area';


</script>
