<template>
    <div class="h-full bg-white rounded-md shadow-sm w-full flex flex-col justify-between p-5 items-start">
        <div class="flex flex-col">
            <p class="text-gray-500 font-semibold">Email</p>
            <p class="text-lg font-semibold text-gray-800"> email </p>
        </div>
        <div class="mt-4">
            <p class="text-gray-500 font-semibold">Joined On</p>
            <p class="text-lg font-semibold text-gray-800"> joined </p>
        </div>
    </div>
</template>

<script setup>
const props =  defineProps({
        name: {
            type: String,
            required: true,
        },
        email: {
            type: String,
            required: true,
        },
        created_at: {
            type: String,
            required: true,
        },
});
</script>
