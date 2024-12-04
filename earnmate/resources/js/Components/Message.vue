<script setup>
const props = defineProps({
    message:Object
})
</script>

<template>
    <div class="w-full px-5 flex items-center" :class="props.message.sender == 'admin' ? 'justify-end' : 'justify-start'">
        <div :class="props.message.sender == 'admin' ? 'bg-[#0ea3e8] text-white' : 'bg-white text-gray-700'"  class=" h-fit w-fit p-2 rounded-md shadow-md">
        <p class="text-lg ">{{ props.message.message }}</p>
    </div>
    </div>
</template>