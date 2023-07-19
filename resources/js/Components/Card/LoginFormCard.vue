<template>
    <div class="flex flex-col justify-center mx-1 md:mx-2 xl:mx-2 lg:mx-1 px-1 md:px-10 xl:px-10 lg:px-2">
        <div class="relative">
            <div class="absolute top-0 bottom-0 left-0 right-0 bg-green-200  z-0 rounded-xl -rotate-3"></div>
            <div class="px-4 py-8 border border-green-50 shadow-lg relative bg-white rounded-xl">
                <div class="flex flex-wrap flex-col justify-between items-center p-4 lg:px-12 pt-12 pb-0">
                    <h2 class="mx-0 flex-1 text-center mt-0 mb-4 text-2xl lg:text-4xl font-bold text-slate-800"
                        style="line-height: 1.2;">
                        {{ $t('base.welcome') }}
                    </h2>
                    <p class="text-center text-xl text-slate-500"
                       style="line-height: 1.5">
                        {{ $t('base.welcome_intro') }}
                    </p>
                </div>
                <slot/>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>

</style>
