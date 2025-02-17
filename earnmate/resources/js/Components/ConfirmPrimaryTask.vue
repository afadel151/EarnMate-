<script setup>
import axiosClient from '@/axios';
import { Button, Dialog, InputText } from 'primevue';
import { ref } from 'vue';
const visible = ref(false)
const Screenshot = ref(null);

const props = defineProps({
    task_id: Number,
})
async function confirmTask() {
    console.log('confirm');
    
    let fd = new FormData();
    fd.append("screenshot", Screenshot.value);
    fd.append("task_id", props.task_id);
    
    try {
        let response = await axiosClient.post('/primary_tasks/confirm', fd);
        console.log(response.data);
        emit('primary_task_confirmed',props.task_id)
        visible.value = false;
    } catch (error) {
        console.log(error);
    }

}
const emit = defineEmits(['primary_task_confirmed']);
function onChange(e) {
    Screenshot.value = e.target.files[0];
}
</script>

<template>
    <div>
        <Button icon="pi pi-check-square" severity="info" @click="visible = true" />
        <Dialog v-model:visible="visible" modal header="Confirm task" :style="{ width: '40rem' }">
            <div class="flex items-center gap-4 mb-8">
                <label for="email" class="font-semibold w-24">Screenshot: </label>
                <input name="file" type="file" class="w-full" @change="onChange" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="button" label="Send" @click="confirmTask"></Button>
            </div>
        </Dialog>
    </div>
</template>