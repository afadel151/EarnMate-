<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
const props = defineProps({
    bonuses: Array
})

</script>


<template>
<MyLayout>
    {{ props.bonuses }}

    
</MyLayout>
</template>