<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
import ProgressBar from 'primevue/progressbar';
import Levels from '@/Components/Levels.vue';
import History from '@/Components/History.vue';
</script>

<template>
    <MyLayout>
        <div class="grid  grid-cols-6 grid-rows-6 gap-4 h-full w-full pr-24 p-6 ">
            <div class="border border-gray-200 bg-white   shadow-md rounded-xl col-span-2 row-span-2 p-4">
                <div class="h-full flex justify-start space-x-10 items-center w-full ">
                    <div class="flex justify-center items-center  w-48 h-48 bg-[#bb69ff] rounded-full">
                        <p class="text-5xl text-gray-50">A</p>
                    </div>
                    <div class="flex flex-col py-10 justify-between h-full items-start w-[50%]">
                        <div>
                            <p class="text-4xl font-bold">Akram</p>
                            <p>joined 20days ago</p>
                        </div>
                        <div class="w-full  ">
                            <div class="w-full flex justify-between">
                                <p>level 1</p>
                                <p>2000DZD to next level</p>
                            </div>
                            <ProgressBar :value="15" severity="secondary"></ProgressBar>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 bg-white  shadow-md col-span-2 rounded-xl row-span-2 p-6 col-start-3">
                <div class="w-full h-full rounded-xl  grid p-2 gap-2 grid-cols-2 grid-rows-2">
                    <div class=" border border-gray-200  shadow-md rounded-lg grid grid-cols-2 p-6 grid-rows-2">
                        <img src="/imgs/withdrawal.png" class="pi pi-wallet h-10 w-10 row-span-2">
                        <p>$0.55</p>
                        <p>Total earning</p>
                    </div>
                    <div class=" border border-gray-200  shadow-md rounded-lg grid grid-cols-2 p-6 grid-rows-2">
                        <img src="/imgs/withdrawal.png" class="pi pi-wallet h-10 w-10 row-span-2">
                        <p>5</p>
                        <p>Offers </p>
                    </div>
                    <div class=" border border-gray-200  shadow-md rounded-lg grid grid-cols-2 p-6 grid-rows-2">
                        <img src="/imgs/withdrawal.png" class="pi pi-wallet h-10 w-10 row-span-2">
                        <p>13</p>
                        <p>Total </p>
                    </div>
                    <div class=" border border-gray-200  shadow-md rounded-lg grid grid-cols-2 p-6 grid-rows-2">
                        <img src="/imgs/withdrawal.png" class="pi pi-wallet h-10 w-10 row-span-2">
                        <p>3000DA</p>
                        <p>in 30 days</p>
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 bg-white   shadow-md col-span-2 rounded-xl row-span-6 p-6 col-start-5">

                <div class="flex flex-col  p-6 justify-start gap-4 items-center h-full w-full rounded-xl  ">
                    <div class="w-full">
                        <p class="text-4xl font-semibold">Levels ladder :</p>
                    </div>
                    <Levels />
                </div>
            </div>
            <div class="border border-gray-200 bg-white   shadow-md col-span-4 row-span-4 rounded-xl p-4 row-start-3">
                <History />
            </div>
        </div>
    </MyLayout>


</template>

<style scoped></style>