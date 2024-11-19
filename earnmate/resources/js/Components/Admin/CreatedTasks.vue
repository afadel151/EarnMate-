<script setup>
import { Button } from 'primevue';
import CreatedTask from './CreatedTask.vue';


</script>

<template>
    <div class="h-full bg-white rounded-md  shadow-sm w-full flex space-y-5 flex-col justify-between p-5 items-start">
        <div class="h-14 flex justify-between w-full items-center ">
            <div class="h-12 flex justify-between items-center  space-x-2">
                <span class="avatar-initial rounded bg-[#f6cabb3e] w-14  h-14 flex justify-center items-center">
                <!-- <box-icon name='wallet' color="orange" '></box-icon> -->
                <box-icon name='task' color='#ea595b' size="md" type='solid' ></box-icon>
            </span>
            <p class="text-2xl text-gray-600">Created Tasks</p>
            </div>
            <Button label="more" variant="text"  severity="secondary"/>
        </div>
        <div class="h-full w-full flex p-2 flex-col justify-between space-y-5 ">
            <CreatedTask />
            <CreatedTask />
            <CreatedTask />
            <CreatedTask />
        </div>
    </div>
</template>