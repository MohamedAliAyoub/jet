<template>
    <Panel :breadcrumbs="[{label: $t('base.role'), href: route('user.roles.index')},{label:$t('base.'+add)}]" >
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <FormInput
                    :form="form"
                    name="name"
                    required
                />
                <FormInput
                    :form="form"
                    name="title"
                    :label="$t('base.title')"
                />
            </div>

            <div>
                <h1 class="text-lg mb-2">{{ $t('base.abilities') }}</h1>
                <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <AbilityCard v-for="(items, index) of abilities">
                        <template #card-header-start>
                            <div class="flex justify-between items-center">
                                <p>{{ $t('enums.ModuleName.' + index) }}</p>
                                <div>
                                    <template
                                        v-if="(items.map((x)=>x.key)).every(elem => ((form.abilities)).includes(elem))">
                                        <button
                                            type="button"
                                            @click="toggleSelect(items,0);"
                                            class="text-sm mr-1 p-button-primary p-1"
                                        >
                                            {{ $t('base.remove_all') }}
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button
                                            type="button"
                                            @click="toggleSelect(items,1);"
                                            class="text-sm mr-1 p-button-primary p-1"
                                        >
                                            {{ $t('base.select_all') }}
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </template>
                        <aside class="grid md:grid-cols-2 gap-2">
                            <template v-for="ability of items" :key="items">
                                <div class="field-checkbox text-lg">
                                    <FormCheckbox
                                        :id="ability.key"
                                        :form="form"
                                        name="abilities"
                                        :value="ability.key"
                                        :label="$t(`abilities.${ability.key}`)"
                                    />
                                </div>
                            </template>
                        </aside>
                    </AbilityCard>
                </section>
            </div>


            <div class="mt-6">
                <SubmitButton
                    :loading="form.processing"
                    name="save"
                />
            </div>
        </form>
    </Panel>
</template>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3';
import route from 'ziggy-js';
import FormInput from '@/Components/Form/FormInput.vue';
import AbilityCard from '@/Components/Card/AbilityCard.vue';
import FormCheckbox from "@/Components/Form/FormCheckbox.vue"
import SubmitButton from '@/Components/Button/SubmitButton.vue';
import Panel from "@/Layout/Dashboard/Panel.vue";


const props = defineProps({
    model: Object,
    selected: Object,
    abilities: Object,
})

const createable = !props.model
let add = createable ? 'add' : 'edit';

const form = useForm({
    name: props.model?.name,
    title: props.model?.title,
    abilities: props.model?.role_abilities ?? [],
})

const submit = () => {
    let url = createable
        ? route('user.roles.store')
        : route('user.roles.update', props.model.id)
    form.post(url)
}

const toggleSelect = (items, states) => {
    for (let i = 0; i < items.length; i++) {
        if (states)
            form.abilities.push(items[i].key);
        else {
            let index = form.abilities.indexOf(items[i].key);
            if (index > -1) { // only splice array when item is found
                form.abilities.splice(index, 1); // 2nd parameter means remove one item only
            }
        }
    }
}
</script>
