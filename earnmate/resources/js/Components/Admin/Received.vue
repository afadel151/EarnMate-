<script setup>
const props = defineProps({
    amount:Number,
    today:Number
})
</script>

<template>
    <div class="h-full bg-white rounded-md  shadow-sm w-full flex flex-col justify-between p-5 items-start">
        <span class="avatar-initial rounded bg-[#d7f6fc] w-14 h-14 flex justify-center items-center">
            <box-icon name='wallet' color="#02c2ed" size="md" type='solid' >

        </box-icon></span>

        <p class="text-gray-500 font-semibold">received</p>
        <p class="text-2xl font-semibold text-gray-500">${{ props.amount }}</p>
        <p class="text-green-500">{{ props.today }} today</p>
    </div>
    
</template>