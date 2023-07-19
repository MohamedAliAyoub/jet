<template>
    <Panel :breadcrumbs="[{label: $t('base.clients'), href: route('user.clients.index')},{label:$t('base.show')}]">
        <div class="show">
            <ProfileInfo
                :name="$t('name')"
                :label="data?.name_text"/>
            <ProfileInfo
                :name="$t('email')"
                :label="data?.email"/>
            <ProfileInfo
                :name="$t('mobile')"
                :label="data?.mobile"/>
            <ProfileInfo
                :name="$t('area')"
                :label="data?.area?.name"/>
            <ProfileInfo
                :name="$t('city')"
                :label="data?.city?.name"/>
            <ProfileInfo
                :name="$t('blood_type')"
                :label="data?.blood_type?.name"/>
        </div>
    </Panel>
</template>


<script setup>
import {useForm, useInertia} from '@inertiajs/inertia-vue3';
import Panel from "@/Layout/Dashboard/Panel.vue";
import ProfileInfo from "@/Components/Others/ProfileInfo.vue";


const props = defineProps({
    data: {
        type: Array,
        required: true
    }
});


</script>

<style scoped>
.show {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.item {
    display: flex;
    align-items: center;
}

.label {
    font-weight: bold;
    width: 120px;
}

.value {
    flex: 1;
}
</style>
