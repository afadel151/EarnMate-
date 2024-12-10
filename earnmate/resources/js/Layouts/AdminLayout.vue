<script setup>
import AdminSidebar from '@/Components/Admin/AdminSidebar.vue';

</script>

<template>
    <div class="md:h-fit   bg-[radial-gradient(circle,rgba(0,0,0,0.075)_1.5px,transparent_1px)] bg-[length:10px_10px] md:mb-0 mb-20  md:min-w-screen flex md:flex-row flex-col justify-start  relative  ">
        
        <div class="md:w-80 md:h-screen  md:sticky md:top-0">
            <AdminSidebar class="w-full " />
        </div>

        <div class="md:w-full">
            <slot />
        </div>
    </div>
</template>

<style>
::-webkit-scrollbar {
    display: none;
}
</style>