<script setup>
import axios from 'axios';
import { onBeforeMount } from 'vue';
const props = defineProps({
    level :{
        type:Number
    }
})
</script>
<template>
    <div class="w-full flex justify-between items-center  h-10">
        <p class="text-xl text-gray-500 ">Level {{props.level}} :</p>
        <p class="text-xl font-bold text-violet-700">500 <span class=" text-lg text-orange-500">10%</span></p>
    </div>
</template>