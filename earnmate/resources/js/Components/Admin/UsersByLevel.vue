<script setup>
import axios from 'axios';
import { onBeforeMount } from 'vue';
const props = defineProps({
    level :{
        type:Object
    },
    users_count: Number
})
</script>
<template>
    <div class="w-full flex justify-between items-center  h-10">
        <p class="text-xl text-gray-500 ">Level {{props.level.level_number}}:</p>
        <p class="text-xl font-bold flex justify-between w-20 text-violet-700">{{props.level.users_count}} <span class=" text-lg text-orange-500">{{props.users_count > 0 ? Math.floor(props.level.users_count/props.users_count*100) : '0' }}%</span></p>
    </div>
</template>