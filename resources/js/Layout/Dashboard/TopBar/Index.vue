<template>
    <Toolbar class="dashboard-toolbar">
        <template #start>
            <Button
                icon="pi pi-align-justify"
                class="toggle-button"
                size="large"
                @click="handleToggleMenu"
            />
        </template>

        <template #end>
            <div class="card flex items-center justify-content-center">
                <div class="mx-5 cursor-pointer">
                    <img
                        v-if="englishLocale"
                        :src="asset('flags/sa.png')"
                        alt="Flag"
                        @click="setLocale('ar')"
                        class="w-8"
                    />
                    <img
                        v-else
                        :src="asset('flags/us.png')"
                        alt="Flag"
                        @click="setLocale('en')"
                        class="w-8"
                    />
                </div>
                <ToggleMenu />
            </div>
        </template>
    </Toolbar>
</template>

<script setup>
import Toolbar from 'primevue/toolbar';
import Button from 'primevue/button';
import ToggleMenu from './ToggleMenu.vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import route from 'ziggy-js';

const englishLocale = computed(() => usePage().props.value.locale === 'en')

const form = useForm({
    language: ''
})

const setLocale = (language) => {
    form.language = language
    form.post(route('user.locale.update'), {
        onFinish: () => location.reload()
    })
}

document.onclick = (event) => {
    if(event.target.classList.contains('dashboard-overlay')) {
        document.body.classList.toggle('mobile-active')
    }
}

const handleToggleMenu = () => {
    document.body.classList.toggle('mobile-active')
}
</script>
