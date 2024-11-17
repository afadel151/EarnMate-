<script setup>
import { ref, onMounted } from 'vue';
import {Dialog, Button} from 'primevue';
import axios from 'axios';
const props = defineProps({
    level:Number
})
async function getLevelInfo(){
    try {
        const response = await axios.get('/api/levels/get-level',{
        params:{
            level : props.level
        }
        });
        infos.value = response.data
    } catch (error) {
        console.log(error);
    }
}
const width = ref(0)
onMounted(()=>{
    getLevelInfo();
})
const infos = ref(null);
const visible = ref(false)
</script>

<template>
    <button @click="visible = true"  class=" w-full h-14 border-violet-400 transition-all duration-200 hover:border-transparent hover:bg-yellow-300 hover:text-gray-900 text-gray-500  rounded-3xl bg-violet-100 border-2">
        <p class="text-2xl  ">Level {{props.level}}</p>
    </button>
    <Dialog v-model:visible="visible" modal :header="'Level '+ props.level " class="w-[50rem] ">
        <div class="flex items-center  gap-4 mb-8 w-full">
            <label for="email" class="font-semibold w-24">Method 1 :</label>
            <p class="text-xl ">Deposit {{ infos.deposit_required }} DA </p>
            <Button type="button" class="justify-self-end  " label="Request" /> 

        </div>
        <div class="flex items-center gap-4 mb-8 w-full">
            <label for="email" class="font-semibold w-24">Method 2 :</label>
            <p class="text-xl ">Deposit {{ infos.deposit_required }} DA and invite {{ infos.friends_required }} friends</p>
            <Button type="button" label="Request" class="justify-self-end mx-auto"  /> 

        </div>
        <div class="flex justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
        </div>
    </Dialog>
</template>