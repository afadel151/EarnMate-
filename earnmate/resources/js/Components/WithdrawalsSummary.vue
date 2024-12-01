<template>
    <div class="h-full bg-white rounded-md shadow-sm w-full flex flex-col justify-between p-5 items-start">
        <span class="avatar-initial rounded bg-[#fce7e9] w-14 h-14 flex justify-center items-center">
            <box-icon name="wallet" color="#f04361" size="md" type="solid"></box-icon>
        </span>
        <p class="text-gray-500 font-semibold">Total Withdrawn</p>
        <p class="text-2xl font-semibold text-gray-500">$amount </p>
    </div>
</template>

<script setup>
defineProps({
    amount: Number
})
</script>
