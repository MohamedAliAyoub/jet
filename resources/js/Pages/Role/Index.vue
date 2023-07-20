<template>
    <Panel :breadcrumbs="[{label:$t('base.role')}]" >
        <template #actions>
            <PrimaryButton :name="$t('add')" v-ability="Ability.MODULE_ROLE_CREATE" :href="route('user.roles.create')"/>
            <ActionMenu :execl="true"/>
        </template>
        <TablePagination :tableData="data">
            <Column field="name" :header="$t('base.name')"></Column>
            <Column field="title" :header="$t('base.title')"></Column>
            <Column field="created_at" :header="$t('base.created_at')"></Column>
            <Column field="updated_at" :header="$t('base.updated_at')"></Column>
            <Column
                :header="$t('base.operations')"
            >
                <template #body="slot">
                    <EditButtonTable
                        :id="slot.data.id"
                        v-ability="Ability.MODULE_ROLE_UPDATE"
                        :href="route('user.roles.edit', slot.data.id)"
                    />
                    <DeleteButtonTable
                        :id="slot.data.id"
                        :label="slot.data.name"
                        v-ability="Ability.MODULE_ROLE_DELETE"
                        :href="route('user.roles.delete', slot.data.id)"
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
import ActionMenu from "@/Components/Menu/ActionMenu.vue";

const props = defineProps({
    data: {
        type: Array,
        required: true
    }
});

</script>
