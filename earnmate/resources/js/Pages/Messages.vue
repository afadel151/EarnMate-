<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';

const props = defineProps({
    messages: Array
});

</script>

<template>
    <MyLayout>
      <div class="h-[calc(100vh-112px)] md:h-screen md:py-10 pb-5  w-full md:px-[13rem]">
            <div class=" rounded-2xl bg-slate-50    flex items-stretch   h-full w-full ">
              <slot />
            </div>
        </div>
    </MyLayout>
  </template>