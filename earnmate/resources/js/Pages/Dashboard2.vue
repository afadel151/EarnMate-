<template>
    <MyLayout>
        <div class="grid grid-cols-4 grid-rows-[0.5fr_1fr_1fr_1fr_1fr_1fr]  gap-4 min-h-screen py-10 px-[12rem] h-screen ">
            <div class="col-span-4   ">
                <div class="w-full backdrop-blur-md bg-white/80 shadow-sm flex justify-center items-center rounded-md h-full">
                    <p class="text-3xl">
                        Dear users , we discovered a bad behaviour
                    </p>
                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md relative p-2  backdrop-blur-sm h-full bg-white/80   md:pl-5 space-y-1   shadow-sm flex flex-col justify-center items-start">
                    <div class="flex gap-2 md:p-0  justify-center items-center">
                        <img src="/svgs/withdraw-dollar-sign-svgrepo-com.svg" width="30" height="30" alt="" />
                        <p class="text-slate-500 text-xl">Total earnings</p>
                    </div>
                    <p class="text-2xl font-bold">2800 DA</p>
                    <p class="text-green-400 text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i>
                        150
                    </p>

                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md p-2  backdrop-blur-sm h-full bg-white/80  md:pl-5 space-y-1   shadow-sm flex flex-col justify-center items-start ">
                    <div class="flex gap-2 justify-center items-center">
                        <img src="/svgs/winner-svgrepo-com.svg" width="30" height="30" alt="" />
                        <p class="text-slate-500 text-xl">Current Level</p>
                    </div>

                    <p class="text-2xl font-bold">LEVEL 1</p>
                    <p class=" text-2xl "> <i
                            class="pi pi-arrow-right mr-5 text-red-400 hover:translate-x-2 duration-200"></i> See other
                        levels</p>
                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md relative p-2  backdrop-blur-sm h-full bg-white/80   md:pl-5 space-y-1   shadow-sm flex flex-col justify-center items-start ">
                    <div class="flex gap-2 justify-center items-center">
                        <img src="/svgs/add-friend-svgrepo-com.svg" width="30" height="30" alt="" />
                        <p class="text-slate-500 text-xl">Invited Friends</p>
                    </div>

                    <p class="text-2xl font-bold">{{props.friends}} FRIENDS</p>
                    <p class="text-slate-500  text-2xl"> <i
                            class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i> 1
                        Friend</p>
                    <div class=" absolute top-6 right-8">
                        <InvieDialog  />
                    </div>
                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md p-2  backdrop-blur-sm h-full bg-white/80  space-y-1   shadow-sm flex flex-col justify-center items-start">
                    <div class="flex gap-2 justify-center items-center">
                        <img src="/svgs/reward-symbol-in-a-circle-svgrepo-com.svg" width="30" height="30" alt="" />
                        <p class="text-slate-500 text-xl">Total bonus</p>
                    </div>
                    <p class="text-2xl font-bold">800DA</p>
                    <p class="text-green-400 text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i>
                        30DA</p>
                </div>
            </div>
            <div
                class="col-span-2 p-6 backdrop-blur-sm  bg-white/80 rounded-md py-10 shadow-sm  flex justify-between flex-col  items-center row-span-3 col-start-3 row-start-3">
                <div class="w-full  flex flex-col items-start justify-start  h-full  ">
                    <p class="  text-4xl  text-gray-600  w-full ">
                        Income Analysis
                    </p>
                    <p>
                        Completed tasks over this month
                    </p>
                </div>
                <Chart type="bar" :data="chartData" :options="chartOptions" class=" h-fit w-full" />
            </div>
            <div class="col-span-2  backdrop-blur-sm rounded-md  bg-white/80 shadow-sm  row-span-6  col-start-1 row-start-3">
                <div class="flex  flex-col h-full p-6 items-stretch space-y-2 justify-between">
                    <div>
                        <p class="text-3xl text-gray-500">On going Tasks</p>
                    </div>

                    <div class="w-full h-28 flex justify-center items-center bg-gray-100 rounded-md">
                        <p class="text-3xl text-gray-500">Journaling</p>
                    </div>
                    <div class="w-full h-28 flex justify-center items-center bg-gray-100 rounded-md">
                        <p class="text-3xl text-gray-500">Journaling</p>
                    </div>
                    <div class="w-full h-28 flex justify-center items-center bg-gray-100 rounded-md">
                        <p class="text-3xl text-gray-500">Journaling</p>
                    </div>
                    <div class="w-full h-28 flex justify-center items-center bg-gray-100 rounded-md">
                        <p class="text-3xl text-gray-500">Journaling</p>
                    </div>
                </div>
            </div>
            <div class="col-span-2 row-span-3 col-start-3 row-start-6">
                <div class="h-full w-full backdrop-blur-sm rounded-md  bg-white/80 shadow-sm">
                    <div class="w-full flex justify-center items-center h-full">
                        <div>
                            <p class="text-3xl text-gray-500">Top performances</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </MyLayout>
</template>
<script setup>
import MyLayout from "@/Layouts/MyLayout.vue";
import { ref, onMounted } from "vue";
const props = defineProps({
    friends: Number
})
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
                data: [ 325, 702, 620, 900, 230, 230, 230, 230, 10],
                borderWidth: 1,
                tension: 0.4,

            }
        ]
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
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder,
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder
                }
            }
        }
    };
}
import Chart from "primevue/chart";
import Withdraw from "@/Components/Withdraw.vue";
import InvieDialog from "@/Components/InviteDialog.vue"
</script>