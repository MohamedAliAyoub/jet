<template>
    <aside class="layout-sidebar active hidden lg:block " id="dashboard-menu">
        <div>
            <img :src="asset('logo.png')" alt="Logo">
        </div>
        <nav>
            <ul class="layout-menu">
                <template v-for="(item, i) in $page.props.menu" :key="item">
                    <AppMenuItem
                        v-if="!item.separator"
                        :item="item"
                        :index="i"
                        @click="handleToggleMenu"
                    />
                    <li v-if="item.separator" class="menu-separator"></li>
                </template>
            </ul>
        </nav>
    </aside>
</template>

<script setup>
import AppMenuItem from './AppMenuItem.vue';

const handleToggleMenu = () => {
    if(document.body.classList.contains('mobile-active')) {
        document.body.classList.remove('mobile-active')
    }
}
// import { ref, watch } from 'vue';

// const props = defineProps({
    // menu: Array,
// })

// const menu = ref([
//     {
//         items: props.menu
//     }
// ])

// watch(props.menu, () => {
//     console.log('zzz');
//     menu.value = [
//         {
//             items: props.menu
//         }
//     ]
// })

// const menu = ref([
//     {
//         items: [
//             { label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/' },
//             {
//                 label: 'Users',
//                 icon: 'pi pi-fw pi-users',
//                 to: '/',
//                 items: [
//                     {
//                         label: 'Form Layout',
//                         icon: 'pi pi-fw pi-id-card',
//                         to: '/uikit/formlayout'
//                     },
//                     { label: 'Input', icon: 'pi pi-fw pi-check-square', to: '/uikit/input' },
//                     {
//                         label: 'Float Label',
//                         icon: 'pi pi-fw pi-bookmark',
//                         to: '/uikit/floatlabel'
//                     },
//                 ]
//             }
//         ]
//     }
// ])
</script>
