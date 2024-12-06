<script setup>
import { ref } from "vue";
import { Button } from 'primevue';
import {Dialog} from 'primevue';
import {InputText} from 'primevue';
import {Select} from 'primevue';
import { useForm, usePage } from "@inertiajs/vue3";
import axiosClient from "@/axios";

const emit = defineEmits(['addadmin']);
const visible = ref(false);

const form = useForm({
    email: '',
    RIP: '',
    _token : usePage().props.auth.csrf
});

const submit = async () => {
    try {
        const response  = await axiosClient.post('/admin/admins/add', { ...form});
        console.log(response.data);
        emit('addadmin',response.data);
        visible.value = false;
    } catch (error) {
        console.log(error);   
    }
};
</script>

<template>
    <div>
        <Button icon="pi pi-plus" label="Add Admin" @click="visible = true" />
        <Dialog v-model:visible="visible" modal header="Create a new Admin" :style="{ width: '40rem' }">
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