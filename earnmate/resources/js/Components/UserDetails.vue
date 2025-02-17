<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import moment from 'moment';
const user = usePage().props.auth.user
const currentLevel = user.current_level
const remainingDays = ref(0);
if (currentLevel != 'No_subscription') {
    if (currentLevel.created_at) {
      

        const createdAt = moment(currentLevel.created_at).toDate();
        console.log('created ad :', createdAt);
        
        const targetDate = new Date(createdAt);
        
        targetDate.setDate(createdAt.getDate() + 5);
        console.log('target date :', targetDate);
        const currentDate = new Date();

        const differenceInMs = targetDate - currentDate;
        console.log('Difference in Ms :', differenceInMs);

        remainingDays.value = Math.max(0, Math.ceil(differenceInMs / (1000 * 60 * 60 * 24)));
        console.log(' Remainings :', remainingDays.value);

    }
}
const createdAt = ref(user.created_at);
const daysAgo = computed(() => {
  const createdAtDate = new Date(createdAt.value);
  const currentDate = new Date();
  const timeDifference = currentDate - createdAtDate;
  const daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

  if (daysDifference === 0) {
    return "today";
  } else if (daysDifference < 0) {
    return "in the future";
  }
  return daysDifference;
});


</script>

<template>
    <div
        class=" md:p-7 p-5 flex flex-col shadow-md space-y-6 items-start dark:bg-slate-700/70  backdrop-blur-md bg-white/90 rounded-lg md:col-span-2 md:row-span-2 ">
        
            <div class="flex items-center w-full space-x-4">
            <span class="  w-16 h-16 flex justify-center items-center bg-blue-50 dark:bg-slate-700/70">
                <box-icon type="solid" name="user-circle" color="#02bee8" size="lg"></box-icon>
            </span>
            <div>
                <p class="text-2xl font-bold text-gray-600 dark:text-gray-300">User</p>
                <p class="text-lg text-gray-500">Joined {{ daysAgo }} days ago</p>
            </div>
        </div>
        <p class="text-4xl font-extrabold text-gray-800 tracking-tight dark:text-gray-300">{{ user.name }}</p>
        <div class="w-full">
            <p class="text-xl font-medium text-gray-700 dark:text-gray-400">Current Level:</p>
            <p v-if="currentLevel == 'No_subscription'" class="text-2xl font-bold text-indigo-600">Not subscribed yet
            </p>
            <p v-else class="text-2xl font-bold text-indigo-400">Level {{ currentLevel.level.level_number }}</p>
        </div>
        <div class="w-full space-y-2">
            <p v-if="currentLevel != 'No_subscription'" class="text-gray-500 font-medium text-sm">
                {{ `Remaining Days: ${remainingDays} more days to get rewarded` }}</p>
            <p v-else></p>
        </div>
    </div>
</template>