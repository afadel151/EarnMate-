<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { Button } from 'primevue';
import Footer from '@/Components/Footer.vue';
import $ from "jquery";


</script>

<template>
    <div class="md:h-screen  md:w-screen bg-gray-100 ">
        <div class="flex md:h-[15%] md:flex-row flex-col w-screen md:px-10  justify-between items-center">
            <div
                class=" flex flex-row  w-full md:w-fit px-10 md:px-0  h-32  bg-gray-100 justify-between items-center md:px-16  ">
                <img src="/svgs/Group.svg" width="200" alt="">
                <div class="md:hidden">
                    <Button icon="pi pi-list" @click="$('#menu').slideToggle()" />
                </div>
            </div>
            <div id="menu" class="md:block hidden">
                <div  class="flex     justify-center md:flex-row flex-col items-center gap-3">
                    <Link :href="route('login')">
                    <Button rounded label="Sign  in" size="large" severity="help" />
                    </Link>
                    <Link :href="route('register')">
                    <Button rounded label="Sign up" size="large" severity="contrast" />
                    </Link>
                </div>
            </div>
        </div>
        <div class="md:flex overflow-x-hidden scroll-hide   md:h-[90%] pb-10    md:gap-36 justify-center items-center bg-gray-100  ">

            <slot />

        </div>
        <div class="w-screen  h-[35%] ">
            <Footer />
        </div>
    </div>
</template>
<style scoped>
.scroll-hide {
  overflow: scroll; /* Enable scrolling */
  -ms-overflow-style: none; /* Hide scrollbar in Internet Explorer */
  scrollbar-width: none; /* Hide scrollbar in Firefox */
}

.scroll-hide::-webkit-scrollbar {
  display: none; /* Hide scrollbar in WebKit browsers */
}

</style>