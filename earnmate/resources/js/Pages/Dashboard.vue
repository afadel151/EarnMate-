<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MyLayout from "@/Layouts/MyLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    return {
        labels: ['Q1', 'Q2', 'Q3', 'Q4','Q5','Q6','Q6','Q6','Q6'],
        datasets: [
            {
                label: 'earnings',
                data: [540, 325, 702, 620,900, 230, 230, 230,230,10],
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
                    color: surfaceBorder
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

<template>

    <Head title="Dashboard" />

    <MyLayout>
        <div class="h-full grid font-['GeneralSans-Medium'] md:grid-cols-4   grid-cols-1     sm:grid-rows-4 ">
            <div class="rounded-2xl relative p-4  bg-white   md:pl-5 space-y-3 shadow-lg flex flex-col justify-center items-start">
                <div class="flex gap-2 md:p-0  justify-center items-center">
                    <img src="/svgs/withdraw-dollar-sign-svgrepo-com.svg" width="30" height="30" alt="" />
                    <p class="md:text-4xl text-xl" >Total earnings</p>
                </div>
                <p class="text-3xl font-bold">2800DA</p>
                <p class="text-green-400 text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i> 150
                </p>
                
            </div>
            <div class="rounded-2xl md:p-0   bg-white  md:pl-5 space-y-3 shadow-lg flex flex-col justify-center items-start ">
                <div class="flex gap-2 justify-center items-center">
                    <img src="/svgs/winner-svgrepo-com.svg" width="30" height="30" alt="" />
                    <p class="md:text-4xl text-xl">Current Level</p>
                </div>

                <p class="text-3xl font-bold">LEVEL 1</p>
                <p class=" text-2xl "> <i
                        class="pi pi-arrow-right mr-5 text-red-400 hover:translate-x-2 duration-200"></i> See other
                    levels</p>
            </div>
            <div class="rounded-2xl relative  md:p-0 bg-white  md:pl-5 space-y-3 shadow-lg flex flex-col justify-center items-start ">
                <div class="flex gap-2 justify-center items-center">
                    <img src="/svgs/add-friend-svgrepo-com.svg" width="30" height="30" alt="" />
                    <p class="md:text-4xl text-xl">Invited Friends</p>
                </div>

                <p class="text-3xl font-bold">13 FRIENDS</p>
                <p class="text-green-400  text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i> 1
                    Friend</p>
                    <div class=" absolute top-6 right-8">
                    <InvieDialog />
                </div>
            </div>
            <div class="rounded-xl bg-white md:pl-5 p-4 space-y-3 shadow-lg flex flex-col justify-center items-start">
                <div class="flex gap-2 justify-center items-center">
                    <img src="/svgs/reward-symbol-in-a-circle-svgrepo-com.svg" width="30" height="30" alt="" />
                    <p class="md:text-4xl text-xl">Total bonus</p>
                </div>
                <p class="text-3xl font-bold">800DA</p>
                <p class="text-green-400 text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i>
                    30DA</p>
            </div>
            <div class="md:col-span-2  md:flex hidden md:row-span-3  space-y-6 flex-col  ">
                <div class="w-full   border-2 rounded-xl h-full">
                    <img src="/imgs/ad.png" class="  rounded-xl" alt="">
                </div>
                <Chart type="line" :data="chartData" :options="chartOptions" class="w-full bg-white border-2 p-6 shadow-lg rounded-xl" />
            </div>
            <div class="h-full bg-white  md:col-span-2 pb-6 pt-2 border shadow-md  rounded-xl md:row-span-3">
                <p class="text-xl mt-1 mb-1 ml-6 font-semibold">Traffic Distribution</p>
                <div class=" h-full grid gap-6 px-6 pb-8  grid-cols-2 grid-rows-3  ">
                    <div class=" rounded-lg border flex flex-col justify-center items-center">
                        <img src="/svgs/games.svg"  class="h-10" alt="">
                        <p class="text-2xl font-bold">2.6K DZD</p>
                        <p class="text-xl font-light">Games</p>

                    </div>
                    <div class="rounded-lg border flex flex-col justify-center items-center">
                        <img src="/svgs/youtube.svg" class="h-10" alt="">
                        <p class="text-2xl font-bold">1.1K DZD</p>
                        <p class="text-xl font-light">youtube</p>
                    </div>
                    <div class="rounded-lg border flex flex-col justify-center items-center">
                        <img src="/svgs/social-telegram.svg" class="w-12" alt="">
                        <p class="text-2xl font-bold">1.1K DZD</p>
                        <p class="text-xl font-light">telegram</p>
                    </div>
                    <div class="rounded-lg border flex flex-col justify-center items-center">
                        <img src="/svgs/apps.svg" class="w-10" alt="">
                        <p class="text-2xl font-bold">1.3K DZD</p>
                        <p class="text-xl font-light">Apps</p>
                    </div>
                    <div class="rounded-lg border flex flex-col justify-center items-center">
                        <img src="/svgs/survey.svg" class="w-14" alt="">
                        <p class="text-2xl font-bold">0.2K DZD</p>
                        <p class="text-xl font-light">Surveys</p>
                    </div>
                    <div class="rounded-lg border flex flex-col justify-center items-center">
                        <img src="/svgs/adsense.svg" class="w-14" alt="">
                        <p class="text-2xl font-bold">0.2K DZD</p>
                        <p class="text-xl font-light">Ads</p>
                    </div>
                </div>
            </div>
        </div>

    </MyLayout>
</template>

<style scoped>
h1 {
    font-family: "Figtree";
    font-weight: 500;
    font-size: x-large;
    color: rgb(89, 88, 88);
}

i {
    font-size: 20px;
}
</style>