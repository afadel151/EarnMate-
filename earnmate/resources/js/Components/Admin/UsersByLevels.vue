<script setup>
import UsersByLevel from './UsersByLevel.vue';
import Chart from 'primevue/chart';
const props = defineProps({
    levels: Array
})
const filterLevel = (number) =>
{
    return props.levels.filter((level)=> level.level_number == number)[0];
}
let users = 0;
props.levels.forEach((level)=>{
    users = users + level.users_count
});
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
            <UsersByLevel :users_count="users" :level="filterLevel(1)"   class="border-y "/>
            <UsersByLevel :users_count="users" :level="filterLevel(2)"   class="border-b" />
            <UsersByLevel :users_count="users" :level="filterLevel(3)"  class="border-b" />
            <UsersByLevel :users_count="users" :level="filterLevel(4)"  class="border-b" />
            <UsersByLevel :users_count="users" :level="filterLevel(5)"  class="border-b" />
            <UsersByLevel :users_count="users" :level="filterLevel(6)"  class="border-b" /> 
            <UsersByLevel :users_count="users" :level="filterLevel(7)"  class="border-b" />
             <UsersByLevel :users_count="users" :level="filterLevel(8)"  class="border-b" />
        </div>
    </div>
    
</template>