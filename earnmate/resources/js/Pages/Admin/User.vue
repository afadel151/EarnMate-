<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
const props = defineProps({
    user: Object,
    bonus:Number,
    offers:Number
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

        
        <div class="flex flex-col space-y-5  p-10 px-[13rem]">
            <div class="col-span-4 bg-white rounded-md shadow-md flex justify-between items-end">
                <div class="w-[70%] h-full p-10">
                    <p class="text-4xl font-semibold text-violet-500">Profile: {{ props.user.name }}</p>
                    <p class="text-2xl font-semibold text-violet-500">Email: {{ props.user.email }}</p>
                    <p class="text-xl text-gray-500">Member since {{ extractDate(props.user.created_at) }}</p>
                </div>
                <img src="/imgs/admin/man-with-laptop.png" class="md:w-40 w-32 md:mr-10" alt="props.User Profile" />
            </div>

           
                <Balance :balance="props.user.balance" />
            

           
                <Friends :count="props.user.friends" />
            

            <!-- Deposited Amount -->
            
                <DepositsSummary :deposits="props.user.deposits" />
            

            <!-- Withdrawn Amount -->
            
                <WithdrawalsSummary :withdrawals="props.user.withdrawals"  />
            

            <!-- props.User Stats Summary -->
           
                <UserStats :bonuses="props.bonus" :offers="props.offers" :tasks="props.user.tasks_completed"
                    :current-level="props.user.current_level" />

           

        </div>
    </div>


        


    </AdminLayout>
</template>