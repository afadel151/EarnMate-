<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
import ProgressBar from 'primevue/progressbar';
import { onMounted } from 'vue';

onMounted(() => {
    setInterval(() => {
        document.getElementById('path0').setAttribute('fill', '#fd777d');
    }, 800);
    setTimeout(() => {
        setInterval(() => {
            document.getElementById('path0').setAttribute('fill', '#2C2C44');
        }, 800);
    }, 400);

})
</script>

<template>
    <MyLayout>
        <div class="grid  grid-cols-6 grid-rows-6 gap-4 h-full w-full pr-24 p-6 ">
            <div class="border-2 rounded-xl col-span-2 row-span-2 p-4">
                <div class="h-full flex justify-start space-x-10 items-center w-full ">
                    <div class="flex justify-center items-center  w-48 h-48 bg-gray-300 rounded-full">
                        <p class="text-5xl">A</p>
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
            <div class="border-2 col-span-2 rounded-xl row-span-2 p-6 col-start-3">
                <div class="w-full h-full rounded-xl  grid p-2 gap-2 grid-cols-2 grid-rows-2">
                    <div class=" border-2 rounded-lg grid grid-cols-2 p-6 grid-rows-2">
                        <img src="/imgs/withdrawal.png" class="pi pi-wallet h-10 w-10 row-span-2">
                        <p>$0.55</p>
                        <p>Total earning</p>
                    </div>
                    <div class=" border-2 rounded-lg grid grid-cols-2 p-6 grid-rows-2">
                        <img src="/imgs/withdrawal.png" class="pi pi-wallet h-10 w-10 row-span-2">
                        <p>$0.55</p>
                        <p>Total earning</p>
                    </div>
                    <div class=" border-2 rounded-lg grid grid-cols-2 p-6 grid-rows-2">
                        <img src="/imgs/withdrawal.png" class="pi pi-wallet h-10 w-10 row-span-2">
                        <p>$0.55</p>
                        <p>Total earning</p>
                    </div>
                    <div class=" border-2 rounded-lg grid grid-cols-2 p-6 grid-rows-2">
                        <img src="/imgs/withdrawal.png" class="pi pi-wallet h-10 w-10 row-span-2">
                        <p>$0.55</p>
                        <p>Total earning</p>
                    </div>
                </div>
            </div>
            <div class="border-2 col-span-2 row-span-6 p-6 col-start-5">

                <div class="flex flex-col p-6 justify-start gap-4 items-center h-full w-full rounded-xl  ">
                    <div class="w-full">
                        <p class="text-5xl font-bold">Levels ladder :</p>
                    </div>
                    <div class="flex flex-col space-y-1 justify-center w-full h-full items-center">
                        <img src="/svgs/level10.svg" alt="">
                        <img src="/svgs/level9.svg" alt="">
                        <img src="/svgs/level8.svg" alt="">
                        <img src="/svgs/level7.svg" alt="">
                        <img src="/svgs/level6.svg" alt="">
                        <img src="/svgs/level5.svg" alt="">
                        <img src="/svgs/level4.svg" alt="">
                        <img src="/svgs/level3.svg" alt="">
                        <img src="/svgs/level2.svg" alt="">
                        <img src="/svgs/level1.svg" alt="">
                        <svg class="ladder" preserveAspectRatio="none" width="150" height="40" viewBox="0 0 153 40"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path id="path0"
                                d="M5.10021 7.87953C4.53627 5.37826 6.43821 2.99976 9.00226 2.99976H143.998C146.562 2.99976 148.464 5.37826 147.9 7.87953L142.94 29.8795C142.528 31.7039 140.908 32.9998 139.038 32.9998H13.9624C12.0923 32.9998 10.4717 31.7039 10.0604 29.8795L5.10021 7.87953Z"
                                fill="#2C2C44"></path>
                            <path
                                d="M5.10021 7.87953C4.53627 5.37826 6.43821 2.99976 9.00226 2.99976H143.998C146.562 2.99976 148.464 5.37826 147.9 7.87953L142.94 29.8795C142.528 31.7039 140.908 32.9998 139.038 32.9998H13.9624C12.0923 32.9998 10.4717 31.7039 10.0604 29.8795L5.10021 7.87953Z"
                                fill="url(#paint0_linear_1262_217)" fill-opacity="0.15"></path>
                            <path
                                d="M5.58797 7.76956C5.09451 5.58094 6.75871 3.49976 9.00226 3.49976H143.998C146.241 3.49976 147.905 5.58094 147.412 7.76956L142.452 29.7696C142.092 31.3659 140.674 32.4998 139.038 32.4998H13.9624C12.326 32.4998 10.9081 31.3659 10.5482 29.7696L5.58797 7.76956Z"
                                stroke="#9C9CC2" stroke-opacity="0.3"></path>
                        </svg>
               
                    </div>
                </div>
            </div>
            <div class="border-2 col-span-4 row-span-4 row-start-3">4</div>
        </div>
    </MyLayout>


</template>

<style scoped></style>