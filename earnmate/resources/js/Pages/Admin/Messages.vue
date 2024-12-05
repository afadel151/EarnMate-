<script setup>
import Conversations from '@/Components/Admin/Conversations.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Button } from 'primevue';
import Popover from 'primevue/popover';
import { ref } from "vue";

const op = ref();
const toggle = (event) => {
    op.value.toggle(event);
}

</script>
<template>
    <AdminLayout>
        <div class="md:h-screen h-[calc(100vh-112px)]  md:py-10  w-full md:px-[13rem]">
            <div class="md:hidden pl-5 mb-4">
                <Button type="button" severity="info"  icon="pi pi-list"  @click="toggle" />
                <Popover ref="op">
                    <Conversations />
                </Popover>
            </div>
            <div class=" rounded-2xl     flex items-stretch md:h-full h-[80%]   w-full ">
                <div class="h-full md:block hidden  bg-slate-100 rounded-r-none  border-r border-gray-200  w-[20%]">
                    <Conversations />
                </div>
                <div class="h-full bg-slate-50 w-full  md:w-[80%]">
                    <slot />
                </div>
            </div>
        </div>
        
    </AdminLayout>
</template>