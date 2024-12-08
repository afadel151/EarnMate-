<template>
    <div class="h-[12rem] bg-white rounded-md shadow-md w-full flex flex-col justify-between p-5 items-start">
        <span class="avatar-initial rounded bg-[#fce7e9] w-14 h-14 flex justify-center items-center">
            <box-icon name="wallet" color="#f04361" size="md" type="solid"></box-icon>
        </span>
        <p class="text-gray-500 font-semibold">Total Withdrawn</p>
        <p class="text-2xl font-semibold text-gray-500">$ {{ total}} </p>
    </div>
</template>

<script setup>
const props = defineProps({
    withdrawals: Array
})
let total = 0;
props.withdrawals.forEach(w => {
    total = total + w.amount;
});
</script>
