<template>
    <div class="h-full w-full">
        <!-- <line-chart :data="data" /> -->
    </div>
</template>

<script setup>
const props =  defineProps({
        data: {
            type: Array,
            required: true,
        },
    

});
</script>