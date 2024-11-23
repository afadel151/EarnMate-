<script setup>
import { Button } from "primevue";
import { Link } from "@inertiajs/vue3";
import SidebarButton from "../SidebarButton.vue";
</script>

<template>
    <span>

    
    <div
        class="md:hidden z-10 flex px-4 justify-around items-center space-x-1 bg-slate-50 fixed h-20 bottom-0 w-screen"
    >
        <button
            class="h-full rounded-xl hover:bg-indigo-300 w-full bg-slate-100"
        >
            <i class="pi pi-user"></i>
        </button>
        <button class="h-full rounded-xl hover:bg-indigo-300 bg-slate-100">
            <i class="pi pi-user"></i>
        </button>
        <button
            class="h-full rounded-xl hover:bg-indigo-300 w-full bg-slate-100"
        >
            <i class="pi pi-user"></i>
        </button>
        <button
            class="h-full rounded-xl hover:bg-indigo-300 w-full bg-slate-100"
        >
            <i class="pi pi-user"></i>
        </button>
    </div>
    <div
        class="hidden p-10 bg-gray-50 h-screen md:flex flex-col items-center px-4 py-4 space-y-4"
    >
        <img src="/svgs/logo2.svg" class="my-10" alt="" />
        <div class="flex-grow flex w-[80%]  flex-col items-stretch space-y-4">
            <SidebarButton :href="'admin.dashboard'" :label="'Dashboard'" :icon="'home'" />
            <SidebarButton :href="'admin.tasks'" :label="'Tasks'" :icon="'credit-card'" />
            <SidebarButton :href="'admin.deposits'" :label="'Deposits'" :icon="'crown'" />
            <SidebarButton :href="'admin.withdrawals'" :label="'Withdrawals'" :icon="'cog'" />
            <SidebarButton :href="'admin.leaderboard'" :label="'Leaderboard'" :icon="'cog'" />
            <SidebarButton :href="'admin.admins'" :label="'Admins'" :icon="'cog'" />
            <SidebarButton :href="'admin.users'" :label="'Users'" :icon="'cog'" />
            <SidebarButton :href="'admin.messages'" :label="'Messages'" :icon="'envelope'" />
          
        </div>
        <Link :href="route('admin.profile')">
            <div
                class="h-fit flex justify-between bg-white/30 rounded-xl items-center w-full backdrop-blur-sm justify-self-end"
            >
                <img src="/imgs/user-1.jpg" class="w-14 rounded-full" alt="" />
                <div
                    class="h-full text-gray-600 overflow-x-hidden flex flex-col justify-center items-start py-4 ml-1"
                >
                    <p class="text-lg">Fadel Akram</p>
                    <p>af8356207@gmail.com</p>
                </div>
            </div>
        </Link>
        
    </div>
</span>
</template>
