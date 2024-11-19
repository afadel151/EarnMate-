<script setup>
import { Button } from 'primevue';
import Admin from './Admin.vue';


</script>

<template>

    <div class="h-full w-full bg-white shadow-md   flex space-y-5 flex-col justify-between p-5 items-start rounded-md">
        <div class="h-14 flex w-full justify-between items-center ">
            <div class="h-12 flex justify-start items-center  space-x-2">
                <span class="avatar-initial rounded bg-[#88b9f535] w-14  h-14 flex justify-center items-center">
                    <box-icon name='user-circle' type='solid' color='#005DFF' size="md"></box-icon>
                </span>
                <p class="text-2xl text-gray-600">Admins</p>
            </div>
            <Button label="more" variant="text"  severity="secondary"/>
        </div>
        <div class="h-full w-full p-2 flex space-y-1 flex-col justify-between ">
            <Admin />
            <Admin />
            <Admin />
            <Admin />
            <Admin />
            <Admin />
        </div>
    </div>

</template>