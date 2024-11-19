<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { usePage } from '@inertiajs/vue3';
import Balance from '@/Components/Admin/Balance.vue';
import RevenueChart from '@/Components/Admin/RevenueChart.vue';
import Sent from '@/Components/Admin/Sent.vue';
import Received from '@/Components/Admin/Received.vue';
import Invitations from '@/Components/Admin/Invitations.vue';
import Users from '@/Components/Admin/Users.vue';
import UsersByLevels from '@/Components/Admin/UsersByLevels.vue';
import OtherAdmins from '@/Components/Admin/OtherAdmins.vue';
import UsersByMethods from '@/Components/Admin/UsersByMethods.vue';

</script>

<template>
    <AdminLayout>



        <div class="grid grid-cols-6 grid-rows-5 gap-4  p-10 px-[13rem]">
            <div class="col-span-4 bg-white rounded-md shadow-sm  flex justify-between  items-end">

                <div class="w-[60%] h-full p-10  ">
                    <p class="text-4xl font-semibold text-violet-500">Hello {{ usePage().props.auth.user.name  }}</p>
                    <p class="text-2xl text-gray-500">Welcome again !</p>
                </div>
                <img src="/imgs/admin/man-with-laptop.png" class="w-56 mr-10" alt="">
            </div>
            <div class="col-start-5 ">
                <Balance />
            </div>
            <div class="col-start-6 ">
                <Received />
            </div>
            <div class="col-start-5 row-start-2 ">
                <Sent />
            </div>
            <div class="col-start-6 row-start-2 ">
                <Invitations />
            </div>
            <div class="col-span-2 col-start-5 row-start-3 ">
                <Users />
                       
             </div>
            <div class="col-span-4 row-span-2 col-start-1 row-start-2 bg-white">
                      
            </div>
            <div class="col-span-2 row-span-2 col-start-5 row-start-4 ">
                <UsersByLevels />
            </div>
            <div class="col-span-2 row-span-2 col-start-1 row-start-4 ">
                <OtherAdmins />
            </div>
            <div class="col-span-2 row-span-2 col-start-3 row-start-4 ">
                <UsersByMethods />
            </div>
        </div>

    </AdminLayout>
</template>