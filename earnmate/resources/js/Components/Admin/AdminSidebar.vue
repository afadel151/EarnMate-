<script setup>
import { Button } from "primevue";
import { Link } from "@inertiajs/vue3";
import $ from "jquery";
import SidebarButton from "../SidebarButton.vue";
import { usePage } from "@inertiajs/vue3";
</script>

<template>
    <span>

        <div
            class="md:hidden pr-8 pl-4  shadow-md flex  justify-between  items-center space-x-1 bg-white  h-28  mb-5  w-screen">
            <img src="/svgs/logo2.svg" class="my-10" alt="" />
            <div class="flex items-center space-x-5">
                <Button icon="pi pi-list" size="" @click="$('#menu').slideToggle()" />
            </div>
        </div>
        <div id="menu" class="w-full hidden mb-5 px-20 md:hidden flex flex-col justify-start h-fit">
            <SidebarButton :href="'admin.dashboard'" :label="'Dashboard'" :icon="'home'" />
            <SidebarButton :href="'admin.tasks'" :label="'Tasks'" :icon="'credit-card'" />
            <SidebarButton :href="'admin.deposits'" :label="'Deposits'" :icon="'crown'" />
            <SidebarButton :href="'admin.withdrawals'" :label="'Withdrawals'" :icon="'cog'" />
            <SidebarButton :href="'admin.done_tasks'" :label="'Done tasks'" :icon="'cog'" />
            <SidebarButton :href="'admin.admins'" :label="'Admins'" :icon="'cog'" />
            <SidebarButton :href="'admin.users'" :label="'Users'" :icon="'users'" />
            <SidebarButton :href="'admin.offers'" :label="'Offers'" :icon="'gift'" />
            <SidebarButton :href="'admin.offer_subscribers'" :label="'Offer Subs'" :icon="'gift'" />
            <SidebarButton :href="'admin.messages'" :label="'Messages'" :icon="'envelope'" />
            <SidebarButton :href="'admin.config'" :label="'Config'" :icon="'cog'" />
            <SidebarButton :href="'admin.profile'" :label="'Profile'" :icon="'user'" />

        </div>
        <div class="hidden p-10 bg-gray-50 h-screen md:flex flex-col items-center px-4 py-4 space-y-4">
            <img src="/svgs/logo2.svg" class="my-10" alt="" />
            <div class="flex-grow flex w-[80%]  flex-col items-stretch space-y-4">
                <SidebarButton :href="'admin.dashboard'" :label="'Dashboard'" :icon="'home'" />
                <SidebarButton :href="'admin.tasks'" :label="'Tasks'" :icon="'credit-card'" />
                <SidebarButton :href="'admin.deposits'" :label="'Deposits'" :icon="'crown'" />
                <SidebarButton :href="'admin.withdrawals'" :label="'Withdrawals'" :icon="'cog'" />
                <SidebarButton :href="'admin.done_tasks'" :label="'Done tasks'" :icon="'cog'" />
                <SidebarButton :href="'admin.admins'" :label="'Admins'" :icon="'cog'" />
                <SidebarButton :href="'admin.users'" :label="'Users'" :icon="'users'" />
                <SidebarButton :href="'admin.offers'" :label="'Offers'" :icon="'gift'" />
                <SidebarButton :href="'admin.offer_subscribers'" :label="'Offer Subs'" :icon="'gift'" />
                <SidebarButton :href="'admin.messages'" :label="'Messages'" :icon="'envelope'" />
                <SidebarButton :href="'admin.config'" :label="'Config'" :icon="'cog'" />
                <SidebarButton :href="'admin.profile'" :label="'Profile'" :icon="'user'" />
            </div>
            

        </div>
    </span>
</template>
