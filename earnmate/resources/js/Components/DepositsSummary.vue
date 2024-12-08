<template>
    <div class="h-[12rem] bg-white rounded-md shadow-md w-full flex flex-col justify-between p-5 items-start">
        <span class="avatar-initial rounded bg-[#d7f6fc] w-14 h-14 flex justify-center items-center">
            <box-icon name="wallet" color="#02c2ed" size="md" type="solid"></box-icon>
        </span>
        <p class="text-gray-500 font-semibold">Total Deposited</p>
        <p class="text-2xl font-semibold text-gray-500">$ {{ totalD }} </p>
    </div>
</template>

<script setup>  

const props =  defineProps({
    deposits: {
        type: Array,
        required: true,
    },
});
let totalD = 0;
props.deposits.forEach(w => {
    totalD += w.amount;
});
</script>
