<script setup>
import Conversations from '@/Components/Admin/Conversations.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

</script>
<template>
    <AdminLayout>
        <div class="h-screen py-10 w-full md:px-[13rem]">
            <div class=" rounded-2xl     flex items-stretch   h-full w-full ">
                <div class="h-full  bg-slate-100 rounded-r-none  border-r border-gray-200  w-[20%]">
                    <Conversations />
                </div>
                <div class="h-full bg-slate-50  w-[80%]">
                    <slot />
                </div>
            </div>
        </div>
        
    </AdminLayout>
</template>