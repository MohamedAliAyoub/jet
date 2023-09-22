<template>
    <Panel :breadcrumbs="[{label: $t('base.trips')}]">
        <template #actions>
            <PrimaryButton :name="$t('add')" v-ability="Ability.MODULE_TRIP_CREATE"
                           @click.prevent="openDialog"/>
            <ActionMenu :execl="true"/>
        </template>

        <TablePagination :tableData="data">

            <Column field="id" :header="$t('base.id')"></Column>
            <Column field="departure_country" :header="$t('base.departure_country')"></Column>
            <Column field="departure_city" :header="$t('base.departure_city')"></Column>
            <Column field="departure_airport_name" :header="$t('base.departure_airport_name')"></Column>


            <Column field="arrival_country" :header="$t('base.arrival_country')"></Column>
            <Column field="arrival_city" :header="$t('base.arrival_city')"></Column>
            <Column field="arrival_airport_name" :header="$t('base.arrival_airport_name')"></Column>


            <Column field="date" :header="$t('base.date')"></Column>
            <Column field="take_off_time" :header="$t('base.take_off_time')"></Column>
            <Column field="landing_time" :header="$t('base.landing_time')"></Column>
            <Column field="flight_status_text" :header="$t('base.flight_status')"></Column>
            <Column field="hours" :header="$t('base.hours')">
                <template #body="row">
                    <div>{{ row.data.hours_with_minutes }}</div>
                </template>
            </Column>
            <Column field="user.name" :header="$t('base.user_id')"></Column>

            <Column field="is_active" :header="$t('base.is_active')">
                <template #body="row">
                    <div
                        class="cursor-pointer"
                        @click="changeActive(row.data.id)"
                    >
                        <SvgCheck class="text-green-500" v-if="row.data.is_active"/>
                        <SvgCircleDashed class="text-orange-400" v-if="!row.data.is_active"/>
                    </div>
                </template>
            </Column>


            <Column
                :header="$t('base.operations')"
            >
                <template #body="slot">
                    <EditButtonTable
                        :id="slot.data.id"
                        v-ability="Ability.MODULE_TRIP_UPDATE"
                        @click="editData(slot.data)"
                    />

                    <DeleteButtonTable
                        :id="slot.data.id"
                        :label="$t('base.heading_to') +' ' +  slot.data.arrival_city"
                        v-ability="Ability.MODULE_TRIP_DELETE"
                        :href="route('user.trips.delete', slot.data.id)"
                    />
                </template>
            </Column>

        </TablePagination>


    </Panel>
    <Dialog :header="modalData == null ? $t('base.add') : $t('base.edit')" :showFooter="false" :visible="visible">
        <TripModal :data="modalData" :statuses="statuses" :users="users" :visible="visible"
                   @success="visible.status=false"/>
    </Dialog>
</template>


<script setup>
import EditButtonTable from '@/Components/Button/EditButtonTable.vue';
import DeleteButtonTable from '@/Components/Button/DeleteButtonTable.vue';
import {Ability} from '../../ability';
import TablePagination from "@/Components/Table/TablePagination.vue";
import PrimaryButton from "@/Components/Button/PrimaryButton.vue";
import Panel from "@/Layout/Dashboard/Panel.vue";
import {ref} from "vue";
import Dialog from '@/Components/Dialog.vue';
import ActionMenu from "@/Components/Menu/ActionMenu.vue";
import ToggleButtonTable from "@/Components/Button/ToggleButtonTable.vue";
import TripModal from "@/Pages/Trip/TripModal.vue";
import SvgCheck from "@/Components/Svg/SvgCheck.vue";
import SvgCircleDashed from "@/Components/Svg/SvgCircleDashed.vue";
import {Inertia} from "@inertiajs/inertia";

const modalData = ref(null);
const visible = ref({status: false});


const props = defineProps({
    data: {
        type: Object,
        required: true
    },
    statuses: {
        type: Object,
        required: true
    },
    users: {
        type: Object,
        required: true
    }


});

const changeActive = (id) => {
    const url = route('user.trips.change_active', id);
    Inertia.put(url, null, {
        preserveState: true,
        preserveScroll: true
    });
}

function openDialog() {
    modalData.value = null;
    visible.value.status = true
}

function editData(data = null) {
    modalData.value = data;
    visible.value.status = true
}
</script>
