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
   <img :src="props.src == 'no_screenshot' ? '/laravel/public/imgs/admin/no_screenshot.jpg' : `/laravel/public/${props.src}`" @click="props.src == 'no_screenshot' ? visible = false : visible = true" class="w-20" alt="">
    <Dialog v-model:visible="visible" modal header="Screenshot" class="w-[50%] h-[80%]">
        <Image :src="props.src == 'no_screenshot' ? '/laravel/public/imgs/admin/no_screenshot.jpg' : `/laravel/public/${props.src}`" ></Image>
    </Dialog>
</template>