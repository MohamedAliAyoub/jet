<template>
    <div class="my-2">
        <div>
            <label
                :for="name"
                :class="{'required': required}"
                class="text-sm font-bold"
            >
                {{ label ?? $t(`base.${name}`) }}
            </label>
        </div>
        <div class="flex flex-wrap my-2">
            <div
                v-for="file in media"
                class="delete-media relative h-12 w-12 mx-1"
            >
                <SquareAvatar
                    :src="file.original_url"
                    size="large"
                    class="front absolute h-full w-full z-10"
                />
                <div class="back h-full w-full hidden">
                    <DeleteButtonTable
                        :id="`media-${file.id}`"
                        :href="route('user.media.delete', file.id)"
                        :label="file.name"
                        size="large"
                        class="h-full"
                        style="width: 100% !important;"
                        :table-cell="false"
                    />
                </div>
            </div>
        </div>
        <FileUpload
            :multiple="true"
            :accept="accept"
            :maxFileSize="maxFileSize"
            :required="required"
            :showUploadButton="false"
            :chooseLabel="$t('base.choose')"
            :cancelLabel="$t('base.delete_all')"
            @select="handleSelectFile"
            @clear="handleRemoveFiles"
            @remove="handleRemoveFile"
            v-bind="$attrs"
        >
            <template #empty>
                <p>{{ $t('base.drag_drop') }}</p>
            </template>
        </FileUpload>
        <p
            class="text-sm text-red-600"
        >
            {{ form['errors'][name] }}
        </p>
    </div>
</template>

<script setup>
import FileUpload from 'primevue/fileupload';
import SquareAvatar from '../Avatar/SquareAvatar.vue';
import DeleteButtonTable from '../Button/DeleteButtonTable.vue';
import route from 'ziggy-js';

const props = defineProps({
    form: Object,
    name: String,
    label: String,
    required: Boolean,
    media: {
        type: Array,
        default: []
    },
    accept: {
        type: String,
        default: 'image/*'
    },
    maxFileSize: {
        type: Number,
        default: 1000 * 1000
    }
})

const handleSelectFile = (evt) => {
    props.form[props.name] = evt.files
}

const handleRemoveFile = (evt) => {
    props.form[props.name] = evt.files.filter(file => file.objectURL !== evt.file.objectURL)
}

const handleRemoveFiles = () => {
    props.form[props.name] = []
}
</script>

<style>
.p-fileupload-file-details span:nth-child(3) {
    display: none !important;
}
.p-fileupload-file-remove {
    padding: unset !important;
    color: white !important;
}
.delete-media {
    transition: var(--transition-delay-default);
}
.delete-media:hover .front {
    display: none;
}

.delete-media:hover .back {
    display: flex;
}
</style>
