<script setup>
import Chart from "primevue/chart";
import { onMounted, ref } from "vue";
onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    return {
        labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q6', 'Q6', 'Q6'],
        datasets: [
            {
                label: 'earnings',
                data: [325, 702, 620, 900, 230, 230, 230, 230, 10],
                borderWidth: 2,
                tension: 0.4,
                borderColor: 'orange'
                

            }
        ],
        
        
        
    };
};


const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--p-text-color');
    const textColorSecondary = documentStyle.getPropertyValue('--p-text-muted-color');
    const surfaceBorder = documentStyle.getPropertyValue('--p-content-border-color');

    return {
        plugins: {
            legend: {
                display: false,
                labels: {
                    
                    color: textColor
                },
                
            },
           
        },
        scales: {
            x: {
                display: false,
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder,
                }
            },
            y: {
                beginAtZero: true,
                display: false,
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder
                }
            }
        },
        pointStyle: false,
        
        
    };
}
</script>

<template>
    <div class="h-full bg-white rounded-md  shadow-sm  flex justify-between p-5 items-center">
        <!-- <img src="/imgs/admin/wallet-info.png" class="w-14" alt=""> -->

        <div class="h-full w-[30%] flex flex-col justify-between items-start">
            <span class="avatar-initial rounded bg-orange-100 w-14 h-14 flex justify-center items-center">
                <box-icon name="user" color="orange" size="md"></box-icon>
            </span>
            <p class="text-gray-500 font-semibold">total users</p>
            <p class="text-2xl font-semibold text-gray-500">2401</p>
            <p class="text-green-500">+10</p>
        </div>
        <Chart type="line" :data="chartData" :options="chartOptions" class="w-[70%]" />
    </div>

</template>