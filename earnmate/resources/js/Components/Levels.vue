<script setup>
import Level from './Level.vue';
</script>
<template>
    <div class="flex   rounded-xl flex-col md:space-y-0 space-y-5  h-full  justify-around w-full items-center">
       <Level :level="8"  />
       <Level :level="7" />
       <Level :level="6" />
       <Level :level="5" />
       <Level :level="4" />
       <Level :level="3" />
       <Level :level="2" />
       <Level :level="1" />
    </div>
</template>
