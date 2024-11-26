<script setup>
import axios from 'axios';
import { Button, Dialog, InputText } from 'primevue';
import { ref } from 'vue';
const visible = ref(false)
const props = defineProps({
    task_id : Number,
})
async function confirmTask()
{

}
const emit = defineEmits(['task_confirmed']);
</script>

<template>
 <div>
        <Button icon="pi pi-check-square" label="confirm" @click="visible = true" />
        <Dialog v-model:visible="visible" modal header="Confirm task" :style="{ width: '40rem' }">
            <div class="flex items-center gap-4 mb-4">
                <label for="name" class="font-semibold w-32">Email :</label>
                <InputText id="name"   class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="link" class="font-semibold w-32">RIP :</label>
                <InputText id="link"  class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="button" label="Save" ></Button>
            </div>
        </Dialog>
    </div>
</template>