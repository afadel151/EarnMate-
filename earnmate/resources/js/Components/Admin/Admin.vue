<script setup>
import { Button } from 'primevue';
const props = defineProps({
    admin: Object
})

</script>

<template>
    <div class=" w-full flex items-center justify-between">
        <img src="/imgs/admin/rb_855.png" class="h-10" alt="">
        <p class="text-xl text-gray-500">{{props.admin.user.email}}</p>
        <Button severity="info" label="Show" size="small" />
    </div>
</template>