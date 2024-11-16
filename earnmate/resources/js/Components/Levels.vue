<script setup>
import Level from './Level.vue';
import { onMounted } from 'vue';
onMounted(() => {
    setInterval(() => {
        document.getElementById('path0').setAttribute('fill', '#fd777d');
    }, 800);
    setTimeout(() => {
        setInterval(() => {
            document.getElementById('path0').setAttribute('fill', '#2C2C44');
        }, 800);
    }, 400);

})
</script>
<template>
    <div class="flex   rounded-xl flex-col space-y-3 justify-around w-full h-full items-center">
       <Level :level="8" />
       <Level :level="7" />
       <Level :level="6" />
       <Level :level="5" />
       <Level :level="4" />
       <Level :level="3" />
       <Level :level="2" />
       <Level :level="1" />
    </div>
</template>
