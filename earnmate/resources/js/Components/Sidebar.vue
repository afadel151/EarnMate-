<script setup>
import { Button } from 'primevue';
</script>

<template>
    <!--  -->
    <div class="h-screen  flex flex-col items-center px-4 py-4 space-y-4 border-r-2">
        <img src="/svgs/logo-small.svg" alt="">
        <div class="flex-grow flex flex-col items-center space-y-4">
            <Button  v-tooltip="'Dashboard'" icon="pi pi-home" severity="secondary" />
            
            <Button icon="pi pi-dollar"  v-tooltip="'Statistics'" severity="secondary" />
            <Button icon="pi pi-credit-card" severity="secondary" />
            <Button icon="pi pi-crown" severity="secondary" />
            <Button icon="pi pi-gift" severity="secondary" />
            <Button icon="pi pi-user" severity="secondary" />
        </div>
        <Button class="mb-4" icon="pi pi-cog" severity="secondary" />
    </div>
</template>