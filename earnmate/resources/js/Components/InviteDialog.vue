<script setup>
import { Button} from 'primevue';
import {Dialog} from "primevue";
import { InputText} from 'primevue'; 
import { ref } from "vue";
const visible = ref(false);
</script>

<template>
    <Button @click="visible = true" variant="outlined" v-tooltip="'Withdraw'" severity="info" class=" !border-2">
        <img src="/svgs/team-svgrepo.svg" width="30" alt="">

    </Button>
    <Dialog v-model:visible="visible" modal header="Withdraw your money" :style="{ width: '25rem' }">
        <div class="flex items-center gap-4 mb-8">
            <label for="email" class="font-semibold w-24">Amount</label>
            <InputText name="username" type="text" placeholder="Username" />
        </div>
        <div class="flex justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
            <Button type="button" label="Request" @click="visible = false" /> 
        </div>
    </Dialog>
</template>