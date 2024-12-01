<script setup>
import Sidebar from '@/Components/Sidebar.vue';
</script>

<template>
    <div class=" md:bg-[#f2f5f7] md:mb-0 mb-20  md:min-w-screen flex md:flex-row flex-col justify-start  relative  ">
        <div class="h-72 absolute bottom-10 right-10 w-72 bg-violet-200 blur-[200px] rounded-full"></div>
        <div class="h-72 absolute bottom-10 left-10 w-72 bg-orange-200 blur-[200px] rounded-full"></div>
        <div class="md:w-80 md:h-screen  md:sticky md:top-0">
            <Sidebar  />
        </div>

        <div class="  md:w-full   ">
            <slot />
        </div>
    </div>
</template>

