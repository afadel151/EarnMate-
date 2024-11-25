<script setup>
import axios from 'axios';
import { Button, Dialog } from 'primevue';
import { ref } from 'vue';
const props = defineProps({
    task_id : Number
})
</script>

<template>
 <div>
        <Button icon="pi pi-plus" label="Add Admin" @click="visible = true" />
        <Dialog v-model:visible="visible" modal header="Confirm task" :style="{ width: '40rem' }">
            <div class="flex items-center gap-4 mb-4">
                <label for="name" class="font-semibold w-32">Email :</label>
                <InputText id="name"  v-model="form.email" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="link" class="font-semibold w-32">RIP :</label>
                <InputText id="link" v-model="form.RIP" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="button" label="Save" @click="submit" :disabled="form.processing"></Button>
            </div>
        </Dialog>
    </div>
</template>