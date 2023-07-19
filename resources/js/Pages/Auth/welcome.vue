<template>
    <Panel>
       <h2> {{$t('base.comming_soon')}} </h2>
        <a :href="route('user.login')">{{$t('base.login')}}</a>
    </Panel>
</template>

<script setup>

import LoginLayout from '@/Layout/LoginLayout.vue';
import route from 'ziggy-js';

defineOptions({layout: LoginLayout})


</script>
<style>

</style>

