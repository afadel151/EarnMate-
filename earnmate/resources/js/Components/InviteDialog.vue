<script setup>
import { usePage } from '@inertiajs/vue3';
import { Button} from 'primevue';
import {Dialog} from "primevue";
import { InputText} from 'primevue'; 
import { ref } from "vue";
const visible = ref(false);
const code = usePage().props.auth.user.code;
async function copyURL() {
    try {
      await navigator.clipboard.writeText('127.0.0.1:8000/register?code='+code);
      alert('Copied');
    } catch($e) {
      alert('Cannot copy');
    }
  }
</script>

<template>
    <Button @click="visible = true" variant="text" size="large"  severity="info" icon="pi pi-share-alt"/>
        
    <Dialog v-model:visible="visible" modal header="Withdraw your money" :style="{ width: '25rem' }">
        <div class="flex items-center gap-4 mb-8">
            <label for="email" class="font-semibold ">Invite a Friend via your Link :</label>
        </div>
        <div class="flex justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
            <Button type="button" label="Request" @click="copyURL()" /> 
        </div>
    </Dialog>
</template>