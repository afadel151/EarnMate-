<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {  usePage } from '@inertiajs/vue3';
import Balance from '@/Components/Admin/Balance.vue';
import RevenueChart from '@/Components/Admin/RevenueChart.vue';
import Sent from '@/Components/Admin/Sent.vue';
import Received from '@/Components/Admin/Received.vue';
import Invitations from '@/Components/Admin/Invitations.vue';
import Users from '@/Components/Admin/Users.vue';
import UsersByLevels from '@/Components/Admin/UsersByLevels.vue';
import OtherAdmins from '@/Components/Admin/OtherAdmins.vue';
import UsersByMethods from '@/Components/Admin/UsersByMethods.vue';
import MoneyChart from '@/Components/Admin/MoneyChart.vue';
import axiosClient from '@/axios';
import { Button, Toast, useToast } from 'primevue';

const props = defineProps({
    admin:Object,
    admins: Array,
    levels:Array,
    users_count: Number,
    users_today:Number,
    invitations_count: Number,
    invitations_today:Number,
    deposits_sum: Number,
    today_deposits_sum: Number,
    withdrawals_sum:Number,
    today_withdrawals_sum:Number,
    users_by_method: Array
});
const toast = useToast();
async function SchduleSubs()
{
    try {
        let response = await axiosClient.get('/admin/schedule/subscriptions')
        if (response.status == 200) {
            toast.add({ severity: 'success', summary: 'Error', detail: `${response.data} Level subscribtions handled successfully`, life: 3000 });
        }
    } catch (error) {
        toast.add({ severity: 'error', summary: 'Error', detail: error , life: 3000 });
    }
}
async function SchduleOffs()
{
    try {
        let response = await axiosClient.get('/admin/schedule/offer')
        if (response.status == 200) {
            toast.add({ severity: 'success', summary: 'Error', detail: `${response.data} Offer subscriptions handled successfully`, life: 3000 });
        }
    } catch (error) {
        toast.add({ severity: 'error', summary: 'Error', detail: error , life: 3000 });
    }
}

</script>

<template>
    <AdminLayout>
        <Toast />
        <div class="md:grid space-y-5 md:space-y-0 grid-cols-6 grid-rows-5 gap-4  p-10 md:px-[10rem]">
            <div class="col-span-4 bg-white rounded-md shadow-md  flex justify-between  items-end">

                <div class="w-[60%] h-full flex flex-col justify-between items-start p-10  ">
                    <p class="text-4xl font-semibold text-violet-500">Hello {{ usePage().props.auth.user.name  }}</p>
                    <p class="text-2xl text-gray-500">Welcome again !</p>
                    <div class="flex items-center flex-col space-y-2 mt-2">
                    <Button label="Subscriptions" icon="pi pi-stopwatch"  @click="SchduleSubs"/>
                    <Button label="Subscriptions" outlined icon="pi pi-gift" @click="SchduleOffs" />
                </div>
                </div>
                <img src="/imgs/admin/man-with-laptop.png" class="w-40 " alt="">
            </div>
            <div class="col-start-5 ">
                <Balance :today="props.today_deposits_sum - props.today_withdrawals_sum" :balance="props.admin"  />
            </div>
            <div class="col-start-6 ">
                <Received :amount="props.deposits_sum" :today="props.today_deposits_sum" />
            </div>
            <div class="col-start-5 row-start-2 ">
                <Sent :amount="props.withdrawals_sum" :today="props.today_withdrawals_sum" />
            </div>
            <div class="col-start-6 row-start-2 ">
                <Invitations :count="props.invitations_count" :today="props.invitations_today" />
            </div>
            <div class="col-span-2 col-start-5 row-start-3 ">
                <Users :count="props.users_count" :today="props.users_today" /> 
             </div>
            <div class="col-span-4 row-span-2 col-start-1 row-start-2 bg-white">
                      <MoneyChart />
            </div>
            <div class="col-span-2 row-span-2 col-start-5 row-start-4 ">
                <UsersByLevels :levels="props.levels" />
            </div>
            <div class="col-span-2 row-span-2 col-start-1 row-start-4 ">
                <OtherAdmins :admins="props.admins.filter((admin)=> admin.id != props.admin.id)" />
            </div>
            <div class="col-span-2 row-span-2 col-start-3 row-start-4 ">
                <UsersByMethods :users="props.users_by_method" />
            </div>
        </div>

    </AdminLayout>
</template>