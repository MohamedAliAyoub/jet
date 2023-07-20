<template>
    <Panel :breadcrumbs="[{label: $t('base.admins')}]">
        <template #actions>
            <PrimaryButton :name="$t('add')" v-ability="Ability.MODULE_ADMINS_CREATE" :href="route('user.admins.create')"/>
            <ActionMenu :execl="true"/>
        </template>

        <TablePagination :tableData="data">
            <Column >
                <template #header>#</template>
                <template #body="row">
                    <Avatar :image="row.data.avatar_url"
                            class="shadow  shadow-5xl ml-3" size="large"   shape="circle"/>
                </template>
            </Column>
            <Column field="name" :header="$t('base.name')"></Column>
            <Column field="email" :header="$t('base.email')"></Column>
            <Column field="roles" :header="$t('base.role')">
                <template #body="row">
                    <p v-for="item in row.data.roles" v-text="item.name"/>
                </template>
            </Column>
            <Column :header="$t('base.is_active')">
                <template #body="row">
                    <ToggleButtonTable
                        :form="row.data"
                        name="is_active"
                        :href="route('user.admins.change_active' , row.data.id)"
                        :ability="Ability.MODULE_ADMINS_ACTIVE"
                    />
                </template>
            </Column>

            <Column
                :header="$t('base.operations')"
            >
                <template #body="slot">
                    <EditButtonTable
                        :id="slot.data.id"
                        v-ability="Ability.MODULE_ADMINS_UPDATE"
                        :href="route('user.admins.edit', slot.data.id)"
                    />
                    <DeleteButtonTable
                        :id="slot.data.id"
                        :label="slot.data.name"
                        v-ability="Ability.MODULE_ADMINS_DELETE"
                        :href="route('user.admins.delete', slot.data.id)"
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
import Avatar from 'primevue/avatar';
import Panel from "@/Layout/Dashboard/Panel.vue";
import ToggleButtonTable from "@/Components/Button/ToggleButtonTable.vue";
import ActionMenu from "@/Components/Menu/ActionMenu.vue";


const props = defineProps({
    data: {
        type: Array,
        required: true
    },
    breadcrumbs : [
        label => "index"
    ]
});


</script>
