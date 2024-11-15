<script setup>
import { ref } from 'vue';
import {Dialog} from 'primevue';
const props = defineProps({
    level:Number
})
const visible = ref(false)
</script>

<template>
    <button @click="visible = true" class="w-full h-16 border-violet-400 transition-all duration-200 hover:border-transparent hover:bg-yellow-300 hover:text-gray-900 text-gray-500  rounded-3xl bg-violet-100 border-2">
        <p class="text-2xl  ">Level {{props.level}}</p>
    </button>
    <Dialog v-model:visible="visible" modal :header="'Level '+ props.level " :style="{ width: '25rem' }">
        <div class="flex items-center gap-4 mb-8">
            <label for="email" class="font-semibold w-24">Method 1 :</label>

        </div>
        <div class="flex justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
            <Button type="button" label="Request" @click="visible = false" /> 
        </div>
    </Dialog>
</template>