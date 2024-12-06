<template>
    <div class="h-full w-full">
        <line-chart :data="props.data" />
    </div>
</template>

<script setup>
const props =  defineProps({
        data: {
            type: Array,
            required: true,
        },
});
const chartData = {
            labels: data.dates,
            datasets: [
                
                {
                    label: 'Deposits',
                    data: data.deposits,
                    borderColor: '#42A5F5',
                    fill: false,
                },
                {
                    label: 'Withdrawals',
                    data: data.withdrawals,
                    borderColor: '#FFA726',
                    fill: false,
                },
            ],
        };
const chartOptions = {
            lineTension: 0.4,
            plugins: {
                legend: {
                    dispaly: false,
                },
                tooltip: {
                    enable: false,
                },
            },
            scales: {
                x: {
                    title: {
                        display: false,
                        text: 'Date',
                    },
                },
                y: {
                    title: {
                        display: false,
                        text: 'Amount',
                    },
                    min: 0,
                },
            },
        };
</script>