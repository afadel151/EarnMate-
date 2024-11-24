<script setup>
import { Button } from "primevue";
import { Link } from "@inertiajs/vue3";
import SidebarButton from "./SidebarButton.vue";

</script>

<template>
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
        class="hidden backdrop-blur-sm  bg-white/70 p-10 h-screen md:flex flex-col items-center px-4 py-4 space-y-4"
    >
        <img src="/svgs/logo2.svg" class="my-10" alt="" />
        <div class="flex-grow flex flex-col  items-stretch  space-y-4">
            <SidebarButton :href="'dashboard'" :label="'Dashboard'" :icon="'home'"  />
            <SidebarButton :href="'statistics'" :label="'Statistics'" :icon="'home'"  />
            <SidebarButton :href="'deposits'" :label="'Deposits'" :icon="'credit-card'"  />
            <SidebarButton :href="'withdrawals'" :label="'Withdrawals'" :icon="'dollar'"  />
            <SidebarButton :href="'leaderboard'" :label="'Leaderboard'" :icon="'crown'"  />
            <SidebarButton :href="'tasks'" :label="'Tasks'" :icon="'list-check'"  />
            <SidebarButton :href="'bonuses'" :label="'Bonuses'" :icon="'gift'"  />
            <SidebarButton :href="'profile.edit'" :label="'Profile'" :icon="'cog'"  />
        </div>
       
        
    </div>
</template>
