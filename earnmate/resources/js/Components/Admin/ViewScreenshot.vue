<script setup>
import { Dialog } from 'primevue';
import { ref } from 'vue';
import Image from 'primevue/image';
const props = defineProps({
    src: String
})
const visible = ref(false);
</script>

<template>
   <img :src="`/${props.src}`" @click="visible = true" class="w-20" alt="">
    <Dialog v-model:visible="visible" modal header="Screenshot" class="w-[50%] h-[80%]">
        <Image :src="`/${props.src}`" ></Image>
    </Dialog>
</template>