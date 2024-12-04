<script setup>
import axiosClient from '@/axios';
import Chart from 'primevue/chart';
import { onMounted, ref } from 'vue';
const chartData = ref(null);
const chartOptions = ref(null);
import { format } from 'date-fns';

const fetchData = async () => {
    try {
        const { data } = await axiosClient.get('/admin/money_chart_data');
        const currentMonth = format(new Date(), 'MMMM yyyy');
        
        chartData.value = {
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

        chartOptions.value = {
            lineTension: 0.4,
            // responsive: true,
            plugins: {
                legend: {
                    dispaly: false,
                },
                tooltip: {
                    enable: false,
                },
                title: {
                    display: true,
                    text: `Transactions for ${currentMonth}`, // Set chart title
                    font: {
                        size: 18,
                        
                    },
                },
            },
            scales: {
                x: {
                    title: {
                        display: false,
                        text: 'Date',
                    },
                    ticks: {
                        callback: function (value, index, values) {
                            // Extract the day part from the date (assuming YYYY-MM-DD format)
                            const date = this.getLabelForValue(value);
                            return new Date(date).getDate();
                        },
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
    } catch (error) {
        console.error('Error fetching chart data:', error);
    }
};
onMounted(() => {
    fetchData();
});
</script>


<template>
    <div class="h-full md:p-5  w-full bg-white shadow-md">
        <Chart type="line" :data="chartData" :options="chartOptions" v-if="chartData" />
        <p v-else>Loading chart...</p>
    </div>
</template>

