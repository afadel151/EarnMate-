<script setup>
import CreatedOffer from './CreatedOffer.vue';
import { Button } from 'primevue';
</script>

<template>
    <div class="h-full bg-white rounded-md  shadow-sm w-full flex space-y-5 flex-col justify-between p-5 items-start">
        <div class="h-14 flex w-full justify-between items-center ">
            <div class="h-12 flex justify-start items-center  space-x-2">
                <span class="avatar-initial rounded bg-[#f3dd702d] w-14  h-14 flex justify-center items-center">
                <box-icon name='offer' type='solid' color='#fbed53' size="md" ></box-icon>
                </span>
                <p class="text-2xl text-gray-600">Created Offers</p>
            </div>
            <Button label="more" variant="text"  severity="secondary"/>
        </div>
        <div class="h-full w-full p-2 flex flex-col justify-between space-y-5 ">
            <CreatedOffer/>
            <CreatedOffer/>
            <CreatedOffer/>
            <CreatedOffer/>

        </div>
    </div>
</template>