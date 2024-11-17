<script setup>
import AdminSidebar from '@/Components/Admin/AdminSidebar.vue';
</script>

<template>
    <div class=" bg-[#f5f5fa] md:mb-0 mb-20 min-w-screen flex relative  ">
        <div class="h-72 absolute bottom-10 right-10 w-72 bg-violet-200 blur-[200px] rounded-full"></div>
        <div class="h-72 absolute bottom-10 left-10 w-72 bg-orange-200 blur-[200px] rounded-full"></div>
        <div class="w-80 h-screen sticky top-0">

            <AdminSidebar class="w-full " />
        </div>

        <div class="  w-full   ">
            <slot />
        </div>
    </div>
</template>

