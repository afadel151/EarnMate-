<script setup>
import Sidebar from '@/Components/Sidebar.vue';
import Withdrawal from '@/Components/Withdrawal.vue';
let i=0;
</script>

<template>
    <div class="w-screen overflow-x-hidden flex ">

        <Sidebar class="float-left" />
        <div class=" w-full h-screen items-stretch justify-stretch flex flex-col ">
            <div class="w-full pl-4 flex  justify-start space-x-2 items-center h-[9%] border-b-2">
                <div class="h-12 pl-1 flex relative items-center justify-around w-12 rounded-md border-2">
                    <img src="/svgs/global.svg" class="h-full p-1" alt="">
                    <div class="absolute bottom-1 right-1 h-3 w-3 rounded-full bg-green-400">

                    </div>
                </div>
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
                <Withdrawal />
            </div>
            <div class="h-full  w-full ">
                <slot />
            </div>
        </div>
       
    </div>
</template>