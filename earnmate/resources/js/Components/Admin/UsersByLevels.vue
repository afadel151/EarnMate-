<script setup>
import UsersByLevel from './UsersByLevel.vue';
import Chart from 'primevue/chart';
</script>

<template>
    <div class="h-full w-full bg-white shadow-md   flex space-y-5 flex-col justify-between p-5 items-start rounded-md">
        <div class="h-14 flex w-full justify-between items-center ">
            <div class="h-12 flex justify-start items-center  space-x-2">
                <span class="avatar-initial rounded bg-[#f5e38829] w-14  h-14 flex justify-center items-center">
                <box-icon name='user-detail' type='solid' color='#fbed53' size="md" ></box-icon>
                </span>
                <p class="text-2xl text-gray-600">Users by Levels</p>
            </div>
        </div>
        <div class="h-full w-full p-2 flex flex-col justify-between ">
            <UsersByLevel :level="1"  class="border-y "/>

            <UsersByLevel :level="2"  class="border-b" />
            <UsersByLevel :level="3"  class="border-b" />
            <UsersByLevel :level="4"  class="border-b" />
            <UsersByLevel :level="5"  class="border-b" />
            <UsersByLevel :level="6"  class="border-b" /> 
            <UsersByLevel :level="7"  class="border-b" />
             <UsersByLevel :level="8"  class="border-b" />
        </div>
    </div>
    
</template>