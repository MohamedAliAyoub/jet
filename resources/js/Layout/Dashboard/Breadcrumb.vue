<template>
    <nav class="p-breadcrumb p-component dashboard-breadcrumb">
        <ol class="p-breadcrumb-list flex items-center">
            <li
                v-for="(item, index) in breadcrumbs"
                class="p-menuitem flex items-center text-sm"
                :class="{'font-bold': index !== lastBreadcrumbIndex}"
            >
                <Link
                    v-if="item?.href"
                    :href="item.href"
                >
                    {{ item.label }}
                </Link>
                <p v-else>
                    {{ item.label }}
                </p>
                <li
                    v-if="index !== lastBreadcrumbIndex"
                    class="p-menuitem-separator"
                >
                    <span
                        :class="{
                            'pi pi-angle-left': $page.props.locale === 'ar',
                            'pi pi pi-angle-right': $page.props.locale !== 'ar'
                        }"
                    ></span>
                </li>
            </li>
        </ol>
    </nav>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/inertia-vue3";

const props = defineProps({
    breadcrumbs: Array,
})

const lastBreadcrumbIndex = computed(() => props.breadcrumbs.length - 1);
</script>
