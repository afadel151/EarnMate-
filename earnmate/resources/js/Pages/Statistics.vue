<script setup>
import MyLayout from "@/Layouts/MyLayout.vue";

import Levels from "@/Components/Levels.vue";
import History from "@/Components/History.vue";
import { usePage } from "@inertiajs/vue3";
import Withdraw from "@/Components/Withdraw.vue";
import Deposit from "@/Components/Deposit.vue";
import { onMounted, ref } from "vue";
import { usePriceStore } from '@/stores/priceStore';
const priceStore = usePriceStore();
const user = usePage().props.auth.user;
const props = defineProps({
    tasks: Array
})
const today = new Date();
const year = today.getFullYear();
const month = String(today.getMonth() + 1).padStart(2, '0');
const day = String(today.getDate()).padStart(2, '0');
const formattedDate = `${year}-${month}-${day}`;
import Chart from "primevue/chart";
import UserDetails from "@/Components/UserDetails.vue";
onMounted(() => {
    priceStore.fetchPrice();
});


</script>

<template>
    <MyLayout>
        <div
            class="grid grid-cols-1 p-10 px-[12rem] font-['GeneralSans-Medium'] md:grid-cols-6 md:grid-rows-5 gap-5 h-full w-full">
           
            <UserDetails :user="user" /> 
            <div
                class="backdrop-blur-md bg-white/70 shadow-sm md:col-span-2 rounded-md md:row-span-1 p-5 md:col-start-3">
                <div class="w-full h-full rounded-md p-2 ">
                    <div class="col-span-2  rounded-lg flex flex-col  justify-around h-full w-full items-start ">
                        <!-- <p class="text-3xl text-gray-500">Balance :</p> -->
                        <div class="h-12 flex justify-start items-center w-full  space-x-2">
                            <span
                                class="avatar-initial rounded bg-[#eafae1] w-14  h-14 flex justify-center items-center">
                                <box-icon name='wallet' type='solid' color='#72de37' size="md"></box-icon>
                            </span>
                            <p class="text-2xl text-gray-500">Balance</p>
                        </div>
                        <p class="text-3xl text-violet-600 font-bold">
                            $ {{ user.balance }}
                        </p>
                    </div>
                </div>
            </div>
            <div
                class="col-start-3 p-5 flex flex-col justify-around items-center row-start-2 col-span-2  backdrop-blur-md bg-white/70 shadow-sm rounded-md">
                <div class="h-12 flex justify-start items-center w-full  space-x-2">
                    <span class="avatar-initial rounded bg-orange-100 w-14  h-14 flex justify-center items-center">
                        <box-icon name='dollar' type='solid' color='#ffa600' size="md"></box-icon>
                    </span>
                    <p class="text-2xl text-gray-500">Operations</p>
                </div>
                <div class="flex justify-start space-x-4 w-full     items-center">

                    <Deposit />

                    <Withdraw :user="user" />
                </div>
            </div>
            <div class="bg-white z-10  shadow-sm md:col-span-4 row-span-3 rounded-md p-4 md:row-start-3">
                <div class="h-12 mt-4 p-4 flex justify-start items-center w-full  space-x-2">
                    <span class="avatar-initial rounded bg-[#f5918829] w-14  h-14 flex justify-center items-center">
                        <!-- <box-icon type='solid' name='star' ></box-icon> -->
                        <box-icon name='task' color='red' size="md"></box-icon>
                    </span>
                    <p class="text-2xl text-gray-500">Task History</p>
                </div>
                <History :tasks="props.tasks" />
            </div>
            <div
                class="backdrop-blur-md bg-white/3  bg-white/70 shadow-sm md:col-span-2 rounded-md md:row-span-4 md:row-start-2 p-8 md:col-start-5">
                <div class="flex flex-col h-full  justify-start gap-4 items-center w-full rounded-md">
                    <div class="h-12 flex justify-start items-center w-full  space-x-2">
                        <span class="avatar-initial rounded bg-[#f5e38829] w-14  h-14 flex justify-center items-center">
                            <box-icon type='solid' name='star' color='#fbed53' size="md"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500">Levels Ladder</p>
                    </div>
                    <Levels />
                </div>
            </div>
            <div
                class="backdrop-blur-md bg-white/3   bg-white/70 shadow-sm md:col-span-2 rounded-md md:row-span-1 md:row-start-1 p-6 md:col-start-5">

                <p class="text-xl text-gray-500 mb-8">{{ formattedDate }}</p>
                <div class="w-full flex justify-between items-center">
                    <img src="/imgs/admin/usdt-logo.png" class="w-10" alt="">
                    <p class="text-xl text-gray-500">1 USDT</p>
                    <Chart type="line" :data="chartData" :options="chartOptions" class=" w-[30%]" />
                    <p class=" text-gray-500"> <span class="font-black text-violet-600"> {{ Math.floor(priceStore.price)
                            }} DZDM</span></p>

                </div>
            </div>
        </div>
    </MyLayout>
</template>
