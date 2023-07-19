<template>
    <div class="flex flex-wrap">
        <PrimaryButton
            :label="$t('base.import_excel')"
            @clicked="handleSelectFile"
        />
        <SecondaryButton
            :label="$t('base.download_draft')"
            class="px-2"
            @click="downloadDraft"
        />
        <input
            type="file"
            ref="file"
            class="hidden"
            @change="handleImportFile"
        >
    </div>
</template>

<script setup>
import PrimaryButton from './PrimaryButton.vue';
import SecondaryButton from './SecondaryButton.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';

const props = defineProps({
    href: String,
    draftUrl: String,
})

const file = ref(null)

const handleSelectFile = () => {
    file.value.click()
}

const handleImportFile = (evt) => {
    Inertia.post(props.href, {
            file: evt.target.files[0]
        },
        {
            preserveScroll: true,
            preserveState: true,
            onFinish: () => file.value.value = ''
        }
    )
}

const downloadDraft = () => {
    location.href = props.draftUrl
}
</script>
