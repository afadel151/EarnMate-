<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';

const props = defineProps({
    messages: Array
});

</script>

<template>
    <MyLayout>
      <div class="relative  flex flex-col-reverse h-[calc(100vh-15rem)] overflow-y-auto bg-gray-100 p-4">
        <div v-for="(message, index) in props.messages" :key="index" >
          <div class="bg-white p-3 shadow-md rounded-md">
            {{ message }}
          </div>
        </div>
      </div>
    </MyLayout>
  </template>