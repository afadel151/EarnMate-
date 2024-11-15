<script setup>
import MyLayout from "@/Layouts/MyLayout.vue";
import ProgressBar from "primevue/progressbar";
import Levels from "@/Components/Levels.vue";
import History from "@/Components/History.vue";
import { usePage } from "@inertiajs/vue3";
import Withdraw from "@/Components/Withdraw.vue";
import Deposit from "@/Components/Deposit.vue";
const user = usePage().props.auth.user;
</script>

<template>
    <MyLayout>
        <div
            class="grid grid-cols-1 p-10 font-['GeneralSans-Medium'] md:grid-cols-6 md:grid-rows-5 gap-5 h-full w-full">
            <div
                class="backdrop-blur-md flex py-1 flex-col justify-around items-center bg-white/30 shadow-md rounded-xl md:col-span-2 md:row-span-2">
                <div class="flex justify-center  items-center w-36 h-36 bg-[#bb69ff] rounded-full">
                    <p class="text-5xl text-gray-50">A</p>
                </div>

                <p class="text-4xl font-bold">{{ user.name }}</p>
                <p>joined 20days ago</p>

                <p class="text-2xl">level 1</p>
                <div class="w-[80%]">

                    <ProgressBar :value="15" severity="secondary"></ProgressBar>
                </div>
                <p>2000DZD to next level</p>



            </div>
            <div
                class="backdrop-blur-md bg-white/30 shadow-md md:col-span-2 rounded-xl md:row-span-2 p-4 md:p-6 md:col-start-3">
                <div class="w-full h-full rounded-xl grid p-2 gap-4 md:gap-4 grid-cols-2 grid-rows-2">
                    <div
                        class="col-span-2 shadow-md rounded-lg flex flex-col space-y-2 justify-around items-stretch px-6">
                        <p class="text-3xl text-gray-500">Current Balance :</p>

                        <div class="flex justify-between w-full items-center">
                            <p class="text-3xl font-bold">
                                {{ user.balance }} DZD
                            </p>
                            <div></div>
                        </div>
                    </div>

                    <div class="flex justify-center items-center">
                        <Deposit />
                    </div>
                    <div class="flex justify-center items-center">
                        <Withdraw :user="user" />
                    </div>
                </div>
            </div>
            <div class="bg-white z-10 shadow-md md:col-span-4 row-span-4 rounded-xl p-4 md:row-start-3">
                <History />
            </div>
            <div
                class="backdrop-blur-md bg-white/3 md:h-full bg-white/30 shadow-md md:col-span-2 rounded-xl md:row-span-6 p-6 md:col-start-5">
                <div class="flex flex-col h-full p-6 justify-start gap-4 items-center w-full rounded-xl">
                    <div class="w-full">
                        <p class="text-4xl text-center underline">
                            Levels ladder
                        </p>
                    </div>
                    <Levels />
                </div>
            </div>
        </div>
    </MyLayout>
</template>
