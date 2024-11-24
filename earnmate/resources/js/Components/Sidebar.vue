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
            
            <Button
                variant="text"
                label="Tasks"
                icon="pi pi-user"
                severity="secondary"
            />
            <Button
                variant="text"
                label="Bonuses"
                class="mb-4"
                icon="pi pi-cog"
                severity="secondary"
            />
            <Button
                variant="text"
                label="Profile"
                class="mb-4"
                icon="pi pi-cog"
                severity="secondary"
            />
        </div>
        <Link :href="route('profile.edit')">
            <div
                class="h-fit flex justify-between rounded-xl items-center w-full  justify-self-end"
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
</template>
