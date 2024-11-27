<script setup>
const props  = defineProps({
    count:Number,
    today:Number
})
</script>

<template>
     <div class="h-full bg-white rounded-md w-full  shadow-sm flex flex-col justify-between p-5 items-start">
        <img src="/imgs/admin/cube-secondary.png" class="w-14" alt="">
        <p class="text-gray-500 font-semibold">invitations</p>
        <p class="text-2xl font-semibold text-gray-500">{{ props.count }}</p>
        <p class="text-green-500">+{{ props.today }} today</p>
    </div>
    
</template>