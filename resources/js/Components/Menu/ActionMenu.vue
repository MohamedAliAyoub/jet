<template>
    <div class="card flex justify-content-center mx-1 my-3">
        <Button
            type="button"
            icon="pi pi-ellipsis-v"
            @click="toggle"
            aria-haspopup="true"
            aria-controls="overlay_menu"
            class="ellipsis-button bg-primary-500"
            size="large"
        />
        <Menu
            ref="menu"
            id="overlay_menu"
            :model="items"
            :popup="true"
            class="action-menu"
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Button from "primevue/button";
import Menu from "primevue/menu";
import { useI18n } from "vue-i18n";

const props = defineProps({
    additionalLinks: {
        type: Array,
        default: []
    },
    reports: {
        type: Boolean,
        default: false
    },
    excel: {
        type: Boolean,
        default: true
    },
    trashed: {
        type: Boolean,
        default: false
    },
})

const i18n = useI18n();
const menu = ref();
const items = ref([])

const getExportExcelUrl = () => {
    let url = (location.href).split("?");

    return (typeof url[1] == 'undefined'
    ? url[0] + '?export_excel=true'
    : (location.href) + '&export_excel=true');
}

const getReportUrl = () => {
    let url = (location.href).split("?");

    return (typeof url[1] == 'undefined'
    ? url[0] + '?show_report=true'
    : (location.href) + '&show_report=true');
}

onMounted(() => {

    props.additionalLinks.forEach(item => items.value.push(item))

    if(props.reports) {
        items.value.push({
            to: {
                    href: getReportUrl(),
                    label: i18n.t('base.view_reports'),
                    icon: 'pi pi-chart-line'
                }
        })
    }

    if(props.excel) {
        items.value.push({
            to: {
                    href: getExportExcelUrl(),
                    label: i18n.t('base.export_excel'),
                    icon: 'pi pi-file-export'
                }
        })
    }

    if(props.trashed) {
        items.value.push({
            to: {
                    link: '/test2',
                    label: i18n.t('base.trashed'),
                    icon: 'pi pi-trash'
                }
        })
    }

})

const toggle = (event) => {
    menu.value.toggle(event);
};

</script>
