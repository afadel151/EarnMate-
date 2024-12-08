<script setup>
import { computed } from 'vue';

const props = defineProps({
  balance: Object,
  today: Number,
});

const totalBalance = computed(() => {
  const baridi = parseFloat(props.balance?.baridi_balance) || 0; // Ensure props.balance exists
  const binance = parseFloat(props.balance?.binance_balance) || 0; // Ensure props.balance exists
  return baridi + binance;
});

const formattedTotal = computed(() => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
  }).format(totalBalance.value); // Use .value to get the computed value
});
</script>

<template>
    <div class="h-full bg-white  shadow-md rounded-md w-full flex flex-col justify-between p-5 items-start">
        <img src="/imgs/admin/chart-success.png" class="w-14" alt="">
        <p class="text-gray-500 font-semibold">balance</p>
        <p class="text-2xl font-semibold text-gray-500"> {{ formattedTotal }}</p>
        <p :class=" props.today > 0 ? 'text-green-500' : 'text-red-500'"> {{ props.today > 0 ? '+' : '-'}} ${{ props.today }}</p>
    </div>
    
</template>