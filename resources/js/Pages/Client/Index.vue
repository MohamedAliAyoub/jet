<template>
    <Panel :breadcrumbs="[{label: $t('base.clients')}]">
        <template #actions>
            <PrimaryButton
                :name="$t('add')"
                v-ability="Ability.MODULE_ADMINS_CREATE"
                :href="route('user.clients.create')"
            />
            <SecondaryButton
                :name="$t('export_excel')"
                icon="pi pi-upload"
                @click="exportExcel()"
            />
        </template>

        <TablePagination
            :tableData="data"
            :query-params="queryParams"
        >
            <template #filters>
                <form @submit.prevent="fetchClientsByType" method="get">
                    <FormSelect
                        :form="queryParams"
                        :label="$t('base.type')"
                        name="type"
                        :options="types"
                        option-label="name"
                        option-value="id"
                    />
                </form>
            </template>
            <Column :header="$t('base.name')">
                <template #body="row">
                    <Anchor :label="row.data.name_text" :href="route('user.clients.show' , row.data.id)"/>
                </template>
            </Column>
            <Column field="email" :header="$t('base.email')"></Column>
            <Column field="mobile" :header="$t('base.mobile')"></Column>
            <Column :header="$t('base.is_active')">
                <template #body="row">
                    <ToggleButtonTable
                        :form="row.data"
                        name="is_active"
                        :href="route('user.clients.change_active' , row.data.id)"
                        :ability="Ability.MODULE_CLIENT_ACTIVE"
                    />
                </template>
            </Column>

            <Column field="created_at" :header="$t('base.created_at')"></Column>
            <Column field="updated_at" :header="$t('base.updated_at')"></Column>
            <Column
                :header="$t('base.operations')"
            >
                <template #body="slot">
                    <EditButtonTable
                        :id="slot.data.id"
                        v-ability="Ability.MODULE_CLIENT_UPDATE"
                        :href="route('user.clients.edit', slot.data.id)"
                    />
                    <DeleteButtonTable
                        :id="slot.data.id"
                        :label="slot.data.name_text"
                        v-ability="Ability.MODULE_CLIENT_DELETE"
                        :href="route('user.clients.delete', slot.data.id)"
                    />
                </template>
            </Column>

        </TablePagination>
    </Panel>
</template>


<script setup>
import EditButtonTable from '@/Components/Button/EditButtonTable.vue'; // this button must redirect to edit tab page through `href` prop.
import DeleteButtonTable from '@/Components/Button/DeleteButtonTable.vue';
import {Ability} from '../../ability';
import TablePagination from "@/Components/Table/TablePagination.vue";
import PrimaryButton from "@/Components/Button/PrimaryButton.vue";
import SecondaryButton from "@/Components/Button/SecondaryButton.vue";
import {exportExcel} from "@/Helpers/Functions";
import Panel from "@/Layout/Dashboard/Panel.vue";
import Anchor from "@/Components/Others/Anchor.vue";
import ToggleButtonTable from "@/Components/Button/ToggleButtonTable.vue";
import FormSelect from "@/Components/Form/FormSelect.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import { reactive } from 'vue';


const props = defineProps({
    data: {
        type: Array,
        required: true
    },
    types: {
        type: Object,
        required: true
    }
});

const queryParams = reactive({
    type: '',
})


function fetchClientsByType(selectedValue) {
    Inertia.get(route('user.clients.index' , {'type':selectedValue.value}), {
        onSuccess: () => {
            console.log(form.data())
        },
        onError: (error) => console.log(error)
    })
}

</script>
