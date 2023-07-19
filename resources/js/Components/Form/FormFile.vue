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
        <SquareAvatar
            v-if="src"
            :src="src"
            size="xlarge"
        />
        <input
            :id="name"
            type="file"
            class="w-full"
            :required="required"
            @change="handleUpdateFile"
            v-bind="$attrs"

        >
        <p
            class="text-sm text-red-600"
        >
            {{ form['errors'][name] }}
        </p>
    </div>
</template>

<script setup>
import SquareAvatar from '../Avatar/SquareAvatar.vue';

const props = defineProps({
    form: Object,
    name: String,
    label: String,
    required: Boolean,
    src: String,
})

const handleUpdateFile = (event) => {
    props.form[props.name] = event.target.files[0]
}
</script>
