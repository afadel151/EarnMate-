<script setup>
import { Dialog } from 'primevue';
import { onMounted, ref } from 'vue';
import Image from 'primevue/image';
import axiosClient from '@/axios';
const props = defineProps({
    src: String
})
const visible = ref(false);
const fd = new FormData;
fd.append('path',props.src);
async function getImage() {
    try {
        
        const response = await axiosClient.post('/get_image', fd, {
                    responseType: 'blob', // Important for handling binary data
                });
        const blob = new Blob([response.data], { type: response.headers['content-type'] });
        imageUrl.value = URL.createObjectURL(blob); // Create a URL for the image
    } catch (error) {
        console.log(error);
        
    }
}
async function showImage() {
            await getImage();
            visible.value = true;
        }
const imageUrl = ref(null);
onMounted(()=>{
    getImage();
});
</script>

<template>
<button @click="showImage">Show Image</button>
    <Dialog v-model:visible="visible" modal header="Screenshot" class="md:w-[50%] w-[90%] h-[80%]">
        <img v-if="imageUrl" :src="imageUrl" alt="Loaded Image" />
    </Dialog>
</template>