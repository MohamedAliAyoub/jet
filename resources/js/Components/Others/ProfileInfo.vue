<template>
    <div class="my-4">
        <SquareAvatar
            v-if="avatar"
            :src="avatar_url"
            size="xlarge"
        />
        <div
            v-else
            class="flex items-center"
        >
            <i :class="icon"></i>
            <p class="mx-2">{{ $t(`base.${name}`) }}  :</p>
            <p v-if="label">{{ label ?? $t('base.not_found') }}</p>
            <slot />
        </div>
    </div>
</template>

<script setup>
import SquareAvatar from '../Avatar/SquareAvatar.vue';

defineProps({
    name: String,
    icon: {
        type: String,
        default: 'pi pi-bookmark-fill'
    },
    label: String,
    avatar: String,
})
</script>
