<script setup>
import { usePage } from "@inertiajs/vue3";
import ProgressBar from "primevue/progressbar";
import { ref } from "vue";
const user = usePage().props.auth.user
const currentLevel = usePage().props.auth.current_level
if (currentLevel != 'No_subscription') {
    let createdAt = null;
    if (currentLevel.created_at) {
        createdAt = new Date(currentLevel.created_at);
    }
    const targetDate = new Date(createdAt);
    targetDate.setDate(createdAt.getDate() + 5);
    const currentDate = new Date();

    const differenceInMs = targetDate - currentDate;
    const remainingDays = ref(Math.ceil(differenceInMs / (1000 * 60 * 60 * 24)));
}
</script>

<template>
    <div
        class=" p-7 flex flex-col space-y-6 items-start  backdrop-blur-md bg-white/70 rounded-lg md:col-span-2 md:row-span-2 ">
        <div class="flex items-center w-full space-x-4">
            <span class="  w-16 h-16 flex justify-center items-center bg-blue-50">
                <box-icon type="solid" name="user-circle" color="#02bee8" size="lg"></box-icon>
            </span>
            <div>
                <p class="text-2xl font-bold text-gray-600">User</p>
                <p class="text-lg text-gray-500">Joined 20 days ago</p>
            </div>
        </div>
        <p class="text-4xl font-extrabold text-gray-800 tracking-tight">{{ user.name }}</p>
        <div class="w-full">
            <p class="text-xl font-medium text-gray-700">Current Level:</p>
            <p v-if="currentLevel == 'No_subscription'" class="text-2xl font-bold text-indigo-600">Not subscribed yet
            </p>
            <p v-else class="text-2xl font-bold text-indigo-600">Level {{ currentLevel.level.level_number }}</p>
        </div>
        <div class="w-full space-y-2">
            <ProgressBar :value="15" class="h-4 rounded-md overflow-hidden" severity="info"></ProgressBar>
            <p v-if="currentLevel != 'No_subscription'" class="text-gray-500 font-medium text-sm">{{ `Remaining Days:
                ${remainingDays > 0 ? remainingDays : 0}` }}
                more days to get rewarded</p>
            <p v-else></p>
        </div>
    </div>
</template>