<template>
    <div class=" bg-white rounded-md shadow-md w-full flex flex-col justify-between p-5 items-start">
        <div >
            <p class="text-gray-500 font-semibold">Current Level</p>
            <p class="text-2xl font-semibold text-violet-500"> {{props.currentLevel.level ? props.currentLevel.level.level_number : 'No subscription'}} </p>
        </div>
        <div >
            <p class="text-gray-500 font-semibold">Bonuses Earned</p>
        <p class="text-xl font-semibold text-green-500">$ {{props.bonuses}} </p>
        </div>
        <div >
            <p class="text-gray-500 font-semibold">Offers Earned</p>
            <p class="text-xl font-semibold text-blue-500">${{props.offers}} </p>
        </div>
        <div>
            <p class="text-gray-500 font-semibold">Tasks Completed</p>
            <p class="text-xl font-semibold text-gray-800"> {{props.tasks}} </p>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    currentLevel: {
        type: Object,
        required: true,
    },
    bonuses: {
        type: Number,
        required: true,
    },
    offers: {
        type: Number,
        required: true,
    },
    tasks: {
        type: Number,
        required: true,
    }
});
</script>
