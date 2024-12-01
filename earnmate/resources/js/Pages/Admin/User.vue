<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
const props = defineProps({
    user: Object
})
import Balance from "@/Components/Balance.vue";
import Friends from "@/Components/Friends.vue";
import DepositsSummary from "@/Components/DepositsSummary.vue";
import WithdrawalsSummary from "@/Components/WithdrawalsSummary.vue";
import UserStats from "@/Components/UserStats.vue";
import Graph from "@/Components/Graph.vue";
import UserInfo from "@/Components/UserInfo.vue";

function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}
</script>

<template>
    <AdminLayout>

        <div class="h-full w-full flex justify-center items-center">

        
        <div class="grid grid-cols-6  grid-rows-[1fr_1fr_1fr_1fr] gap-4 p-10 px-[13rem]">
            <div class="col-span-4 bg-white rounded-md shadow-sm flex justify-between items-end">
                <div class="w-[70%] h-full p-10">
                    <p class="text-4xl font-semibold text-violet-500">Profile: {{ props.user.name }}</p>
                    <p class="text-2xl font-semibold text-violet-500">Email: {{ props.user.email }}</p>
                    <p class="text-xl text-gray-500">Member since {{ extractDate(props.user.created_at) }}</p>
                </div>
                <img src="/imgs/admin/man-with-laptop.png" class="w-40 mr-10" alt="props.User Profile" />
            </div>

            <div class="col-start-5">
                <Balance :balance="props.user.balance" />
            </div>

            <div class="col-start-6">
                <Friends :count="props.user.friends" />
            </div>

            <!-- Deposited Amount -->
            <div class="col-start-5 row-start-2">
                <DepositsSummary :amount="props.user.total_deposited" />
            </div>

            <!-- Withdrawn Amount -->
            <div class="col-start-6 row-start-2">
                <WithdrawalsSummary :amount="props.user.total_withdrawn" />
            </div>

            <!-- props.User Stats Summary -->
            <div class="col-span-2 col-start-5 row-start-3">
                <props.UserStats :bonuses="props.user.total_bonuses" :offers="props.user.total_offers" :tasks="props.user.tasks_completed"
                    :current-level="props.user.current_level" />
            </div>

            <!-- Deposits & Withdrawals Graph -->
            <div class="col-span-4 row-span-2 col-start-1 row-start-2 bg-white rounded-md shadow-md p-5">
                <Graph :data="props.user.weekly_transactions" />
            </div>

            <!-- Email & Join Date -->
            
        </div>
    </div>


        


    </AdminLayout>
</template>