<template>
    <div class="h-[12rem] bg-white rounded-md shadow-md w-full flex flex-col justify-between p-5 items-start">
        <span class="avatar-initial rounded bg-[#d7f6fc] w-14 h-14 flex justify-center items-center">
            <box-icon name="group" color="#02c2ed" size="md" type="solid"></box-icon>
        </span>
        <p class="text-gray-500 font-semibold">Friends</p>
        <p class="text-2xl font-semibold text-gray-500"> {{ count }} </p>
    </div>
</template>

<script setup>
const props =  defineProps({
        friends: {
            type: Number,
            required: true,
        },
    })
const count = props.friends.length;
</script>
