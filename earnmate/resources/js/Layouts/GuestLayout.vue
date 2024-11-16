<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { Button } from 'primevue';
import Footer from '@/Components/Footer.vue';
</script>

<template>
    <div class="h-screen w-screen">
        <div class="w-screen h-[15%] flex bg-gray-100 justify-between items-center px-16  ">
            <img src="/svgs/Group.svg" width="200" alt="">
            <div class="flex justify-center items-center gap-3">
                <Button variant="text" size="large" label="Advertise" severity="contrast" />
                <Button variant="text" size="large" label="Advertise" severity="contrast" />
                <Button variant="text" size="large" label="Advertise" severity="contrast" />
                <Button variant="text" size="large" label="Advertise" severity="contrast" />
                <Button rounded label="Log in" size="large" severity="help" />
                <Button rounded label="Register" size="large" severity="contrast" outlined />
            </div>
        </div>
        <div class="flex w-screen  h-[85%]  gap-36 justify-center items-center bg-gray-100  ">
            
                <slot />
            
        </div>
        <div class="w-screen h-[35%] ">
            <Footer />
        </div>
    </div>
</template>
<style>
::-webkit-scrollbar {
    display: none;
}
</style>