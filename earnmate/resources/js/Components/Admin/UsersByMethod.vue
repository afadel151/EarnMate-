<script setup>
import axios from 'axios';
import { onBeforeMount } from 'vue';
const props = defineProps({
    method: String
})
</script>
<template>
    <div class="w-full flex justify-between items-center py-4  ">
        <img :src="`/imgs/admin/${props.method}.png`" class="w-14" alt="">
        <p class="text-2xl text-gray-500">{{ props.method }}</p>
        <p class="text-xl font-bold text-violet-700">500 <span class=" text-lg text-orange-500">60%</span></p>
    </div>
</template>