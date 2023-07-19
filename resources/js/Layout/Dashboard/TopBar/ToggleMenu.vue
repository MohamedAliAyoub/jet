<template>
    <div>
        <Button
            type="button"
            @click="toggle"
            aria-haspopup="true"
            aria-controls="overlay_menu"
            class="dashboard-topbar-button"
        >
            <CircleAvatar
                :src="$page.props.auth.avatar"
            />
        </Button>
        <Menu
            ref="menu"
            id="overlay_menu"
            :model="items"
            :popup="true"
        >
            <template #start>
                <div
                    class="w-full flex items-center p-2 text-color hover:surface-200 border-noround"
                >

                    <div class="flex align-middle toggle-menu-start w-full">
                        <CircleAvatar
                            :src="$page.props.auth.avatar"
                        />

                        <div class="mx-1">
                            <p class="text-sm font-bold">
                                {{ $page.props.auth.name }}
                            </p>
                            <p class="text-sm">
                                {{ $page.props.auth.role }}
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full flex items-center p-2 text-color hover:surface-200 border-noround"
                >
                    <div class="flex flex-col align-middle toggle-menu-start">
                        <Link
                            :href="route('user.profile.edit.profile')"
                            class="w-full flex  p-2"
                        >
                            <span class="text-sm font-bold center">{{ $t('base.edit_profile') }}</span>
                        </Link>
                    </div>
                </div>
                <div
                    class="w-full flex items-center p-2 text-color hover:surface-200 border-noround"
                >
                    <div class="flex flex-col align-middle toggle-menu-start">
                        <Link
                            :href="route('user.profile.change.password.view')"
                            class="w-full flex  p-2"
                        >
                            <span class="text-sm font-bold center">{{ $t('base.change_password') }}</span>
                        </Link>
                    </div>
                </div>
            </template>
            <template #end>
                <Link
                    @click="logout"
                    class="w-full flex  p-2"
                >
                    <i class="p-menuitem-icon pi pi-power-off"/>
                    <span class="">{{ $t('base.logout') }}</span>
                </Link>
            </template>

        </Menu>
    </div>
</template>

<script setup>
import {Link, useForm} from '@inertiajs/inertia-vue3';
import Button from 'primevue/button';
import Menu from 'primevue/menu';
import CircleAvatar from '@/Components/Avatar/CircleAvatar.vue';
import {ref, computed} from 'vue';
import route from 'ziggy-js';
import {useI18n} from 'vue-i18n';


const i18n = useI18n()
const menu = ref()
const items = ref([
    {separator: true},
    // { to: {link: route('user.profile.index'), label: i18n.t('base.profile'), icon: 'pi pi-fw pi-user'} },
    // { to: {link: route('user.password.index'), label: i18n.t('base.change_password'), icon: 'pi pi-cog'} },
    {separator: true}
])

const toggle = (event) => {
    menu.value.toggle(event);
}
const logoutForm = useForm({
    'logout': true,
});

function logout() {
    logoutForm.post(route('user.logout'), {
        preserveScroll: true,
        onSuccess: () => {

        },
        onError: (error) => console.log(error)
    })
};

</script>

