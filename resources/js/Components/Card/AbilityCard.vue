<template>
    <div class="px-2" style="overflow: unset;">
        <section class="overflow-hidden pb-2" style="border-bottom: 1px solid var(--el-card-border-color)" v-if="$slots['card-header-start'] ||$slots['card-header-end']">
            <aside v-if="$slots['card-header-start']" class="float-right font-bold w-full">
                <slot name="card-header-start"></slot>
                <hr class="mt-0">
            </aside>
            <aside v-if="$slots['card-header-end']" class="float-left">
                <slot  name="card-header-end"></slot>
            </aside>
        </section>
        <section>
            <slot name="card-content"/>
            <slot/>
        </section>
    </div>
</template>

<script setup>

</script>
<style scoped>

</style>
