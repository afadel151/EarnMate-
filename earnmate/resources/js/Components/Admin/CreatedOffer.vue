<script setup>
import { Button } from 'primevue';


</script>
<template>
    <div class="h-16 w-full flex items-center justify-between p-1  ">
        <span class="avatar-initial rounded bg-[#fcf6d770] w-14 h-14 flex justify-center items-center">
            <box-icon name='party' type='solid' color='#fbc153' ></box-icon>
        </span>
        <p class="text-xl text-gray-600 ml-2">
            Deposit $10 and get 10$
        </p>
        <Button icon="pi pi-info" variant="text" severity="warn" class="justify-self-end" />
    </div>
</template>