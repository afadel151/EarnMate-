<script setup>
const props = defineProps({
    balance: Number
})
</script>

<template>
    <div class="h-full bg-white  shadow-md rounded-md w-full flex flex-col justify-between p-5 items-start">
        <img src="/imgs/admin/chart-success.png" class="w-14" alt="">
        <p class="text-gray-500 font-semibold">balance</p>
        <p class="text-2xl font-semibold text-gray-500">${{ props.balance }}</p>
        <p class="text-green-500">+70%</p>
    </div>
    
</template>