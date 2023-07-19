<template>
    <div class="card flex flex-wrap">
        <FormSearchInput
            :form="queryParams"
            name="search"
            :loading="loading"
            hide-label
        />
    </div>
    <div class="card flex flex-wrap mb-1">
        <FormSelect
            v-if="Object.keys(props.queryParams).includes('is_active')"
            :placeholder="$t('base.activation')"
            :form="props.queryParams"
            name="is_active"
            :options="[{value: '1', name: $t('base.active')}, {value: '0', name: $t('base.not_active')}]"
            clearable
            filterable
            hide-label
            container-class="filterable"
        />
        <slot name="filters" />
    </div>
    <div class="card">
        <DataTable
            :value="tableData.data"
            paginator
            lazy
            :rows="tableOptions.per_page"
            :rowsPerPageOptions="[10, 20, 50]"
            :totalRecords="tableData.total"
            :loading="loading"
            @page="handleOnPageChange"
            tableStyle="min-width: 50rem"
            size="small"
            v-bind="$attrs"
        >
            <slot />
        </DataTable>
    </div>
</template>

<script setup>
import { ref, reactive, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia'
import DataTable from 'primevue/datatable';
import FormSearchInput from '@/Components/Form/FormSearchInput.vue';
import FormSelect from '@/Components/Form/FormSelect.vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    tableData: Object,
    queryParams: {
        type: Object,
        default: {}
    },
})

const searchParams = new URLSearchParams(location.search)
const loading = ref(false)
const queryParams = reactive({
    search: '',
});
const tableOptions = reactive({
    page: searchParams.get('page') ?? 1,
    per_page: 10,
});

watch(queryParams, debounce(() => {
            tableOptions.page = 1
            loadLazyData()
        },
        500
    )
)

if(Object.entries(props.queryParams).length) {
    watch(props.queryParams, () => {
        tableOptions.page = 1
        loadLazyData()
    })
}

const handleOnPageChange = (event) => {
    tableOptions.page = event.page + 1
    tableOptions.per_page = event.rows

    loadLazyData()
}

const loadLazyData = () => {
    loading.value = true;
    loadData()
};

const loadData = () => {
    Inertia.get(
        location.origin + location.pathname,
        {...tableOptions, ...queryParams, ...props.queryParams},
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            onFinish: () => loading.value = false
        }
    )
}
</script>
