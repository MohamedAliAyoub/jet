<template>
    <TabMenu
        :model="tabItems"
    />
</template>

<script setup>
import TabMenu from 'primevue/tabmenu';
import { useI18n } from 'vue-i18n';

const i18n = useI18n()

const props = defineProps({
    tabs: Array,
})

const icons = {
    'profile': 'pi pi-info-circle',
    'edit': 'pi pi-file-edit',
    'users': 'pi pi-users',
}

const labels = {
    'profile': i18n.t('base.profile_info'),
    'edit': i18n.t('base.edit_info'),
    'users': i18n.t('base.users_info'),
}

const tabItems = props.tabs.map(tab => ({
        to: {
            ...tab,
            ...{
                label: labels[tab.type],
                icon: icons[tab.type],
                active: tab.link === location.href,
            }
        }
    })
)
</script>
