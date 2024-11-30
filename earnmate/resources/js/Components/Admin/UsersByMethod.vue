<script setup>
import axios from 'axios';
import { onBeforeMount } from 'vue';
const props = defineProps({
    method: String,
    users: Object,
    total: Number
})
</script>
<template>
    <div class="w-full flex justify-between items-center py-4  ">
        <img :src="`/imgs/admin/${props.method}.png`" class="w-14" alt="">
        <p class="text-2xl text-gray-500">{{ props.method }}</p>
        <p class="text-xl flex justify-between w-20 font-bold text-violet-700">{{props.users ? props.users.user_count : '0' }} <span class=" text-lg text-orange-500">{{props.users ? props.users.user_count/props.total*100  : '0'}}%</span></p>
    </div>
</template> 