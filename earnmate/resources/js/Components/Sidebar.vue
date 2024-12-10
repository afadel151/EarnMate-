<script setup>
    import $ from "jquery";
import { Button } from "primevue";
import SidebarButton from "./SidebarButton.vue";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
</script>

<template>
    <div class="md:hidden pr-8 pl-4  shadow-md flex  justify-between  items-center space-x-1 bg-white  h-28  mb-5  w-screen">
        <img src="/svgs/logo2.svg" class="my-10 w-48" alt="" />
        <div class="flex items-center space-x-5">
            <p class="text-xl bg-violet-500   p-2 text-white  rounded-md">${{ user.balance }}</p>
        <Button icon="pi pi-list" size="" @click="$('#menu').slideToggle()" />
        </div>
    </div>
    <div id="menu" class="w-full hidden mb-5 px-20 md:hidden flex flex-col justify-start h-fit">
        <SidebarButton :href="'dashboard'" :label="'Dashboard'" :icon="'home'" />
        <SidebarButton :href="'statistics'" :label="'Statistics'" :icon="'home'" />
        <SidebarButton :href="'deposits'" :label="'Deposits'" :icon="'credit-card'" />
        <SidebarButton :href="'withdrawals'" :label="'Withdrawals'" :icon="'dollar'" />
        <SidebarButton :href="'leaderboard'" :label="'Leaderboard'" :icon="'crown'" />
        <SidebarButton :href="'tasks'" :label="'Tasks'" :icon="'list-check'" />
        <SidebarButton :href="'bonuses'" :label="'Bonuses'" :icon="'gift'" />
        <SidebarButton :href="'offers'" :label="'Offers'" :icon="'gift'" />
        <SidebarButton :href="'messages'" :label="'Messages'" :icon="'envelope'" />
        <SidebarButton :href="'help'" :label="'Help'" :icon="'info-circle'" />
        <SidebarButton :href="'profile.edit'" :label="'Profile'" :icon="'cog'" />
    </div>
    <div class="hidden backdrop-blur-sm  bg-white/70 p-10 h-screen border-r md:flex flex-col items-center px-4 py-4 space-y-4">
        <img src="/svgs/logo2.svg" class="my-10" alt="" />
        <div class="flex-grow flex flex-col  items-stretch  space-y-4">
            <SidebarButton :href="'dashboard'" :label="'Dashboard'" :icon="'home'" />
            <SidebarButton :href="'statistics'" :label="'Statistics'" :icon="'home'" />
            <SidebarButton :href="'deposits'" :label="'Deposits'" :icon="'credit-card'" />
            <SidebarButton :href="'withdrawals'" :label="'Withdrawals'" :icon="'dollar'" />
            <SidebarButton :href="'leaderboard'" :label="'Leaderboard'" :icon="'crown'" />
            <SidebarButton :href="'tasks'" :label="'Tasks'" :icon="'list-check'" />
            <SidebarButton :href="'bonuses'" :label="'Bonuses'" :icon="'gift'" />
            <SidebarButton :href="'offers'" :label="'Offers'" :icon="'gift'" />
            <SidebarButton :href="'messages'" :label="'Messages'" :icon="'envelope'" />
            <SidebarButton :href="'help'" :label="'Help'" :icon="'info-circle'" />
            <SidebarButton :href="'profile.edit'" :label="'Profile'" :icon="'cog'" />
        </div>


    </div>
</template>
<style>
::-webkit-scrollbar {
    display: none;
}
</style>