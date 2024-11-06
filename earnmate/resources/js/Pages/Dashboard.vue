<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MyLayout from "@/Layouts/MyLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>

    <Head title="Dashboard" />

    <MyLayout>
        <div class="w-full h-full grid grid-cols-4 gap-6 pt-6 pb-6  pl-6 pr-24 grid-rows-4 ">
            <div class="rounded-xl pl-5 space-y-3 shadow-md flex flex-col justify-center items-start">
                <div class="flex gap-2 justify-center items-center">
                    <img src="/svgs/withdraw-dollar-sign-svgrepo-com.svg" width="30" height="30" alt="" />
                    <h1>Total earnings</h1>
                </div>

                <p class="text-3xl font-bold">2800DA</p>
                <p class="text-green-400 text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i> 150
                </p>
            </div>
            <div class="rounded-xl pl-5 space-y-3 shadow-md flex flex-col justify-center items-start ">
                <div class="flex gap-2 justify-center items-center">
                    <img src="/svgs/winner-svgrepo-com.svg" width="30" height="30" alt="" />
                    <h1>Current level</h1>
                </div>

                <p class="text-3xl font-bold">LEVEL 1</p>
                <p class=" text-2xl "> <i
                        class="pi pi-arrow-right mr-5 text-red-400 hover:translate-x-2 duration-200"></i> See other
                    levels</p>
            </div>
            <div class="rounded-xl pl-5 space-y-3 shadow-md flex flex-col justify-center items-start ">
                <div class="flex gap-2 justify-center items-center">
                    <img src="/svgs/add-friend-svgrepo-com.svg" width="30" height="30" alt="" />
                    <h1>Invited Friends</h1>
                </div>

                <p class="text-3xl font-bold">13 FRIENDS</p>
                <p class="text-green-400  text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i> 1
                    Friend</p>
            </div>
            <div class="rounded-xl pl-5 space-y-3 shadow-md flex flex-col justify-center items-start">
                <div class="flex gap-2 justify-center items-center">
                    <img src="/svgs/reward-symbol-in-a-circle-svgrepo-com.svg" width="30" height="30" alt="" />
                    <h1>Total bonus</h1>
                </div>
                <p class="text-3xl font-bold">800DA</p>
                <p class="text-green-400 text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i>
                    30DA</p>
            </div>
            <div class="col-span-2 row-span-3 ">

            </div>
            <div class="h-full col-span-2 pb-6 pt-2 border-2 rounded-xl row-span-3">
                <p class="text-xl mt-2 ml-6 font-semibold">Traffic Distribution</p>
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