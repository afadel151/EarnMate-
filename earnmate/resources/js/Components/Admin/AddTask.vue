<script setup>
import { ref } from "vue";
import { Button } from 'primevue';
import {Dialog} from 'primevue';
import {InputText} from 'primevue';
import {Select} from 'primevue';
import { useForm } from "@inertiajs/vue3";
import axiosClient from "@/axios";
const emit = defineEmits(['addtask']);
const visible = ref(false);
const selectedPlatform = ref(null);
const platforms = ref([
    'youtube',
    'telegram',
    'snapchat',
    'facebook',
    'instagram',
    'twitter',
    'vk',
    'LinkedIn',
    'Threads',
    'Discord',
    'Pinterest'
])
const types = ref([
    'like',
    'subscription',
    'watch',
    'comment'
]);
const form = useForm({
    name: '',
    type: '',
    link: '',
    platform: '',
});

const submit = async () => {
    try {
        const response  = await axiosClient.post('/admin/tasks/add', { ...form});
        console.log(response.data);
        emit('addtask',response.data);
        visible.value = false;
    } catch (error) {
        console.log(error);
        
    }
};
</script>

<template>
    <div>
        <Button icon="pi pi-plus" label="Add Task" @click="visible = true" />
        <Dialog v-model:visible="visible" modal header="Create a new Task" class="md:w-[40rem]">
            <div class="flex items-center gap-4 mb-4">
                <label for="name" class="font-semibold w-32">Task name</label>
                <InputText id="name"  v-model="form.name" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-4">
                <label for="platform" class="font-semibold w-32">Task Platform</label>
                <Select  id="platform" v-model="form.platform" class="flex-auto" :options="platforms" />
            </div>
            <div class="flex items-center gap-4 mb-4">
                <label for="type" class="font-semibold w-32">Task Type</label>
                <Select id="type" v-model="form.type" class="flex-auto" :options="types" />
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="link" class="font-semibold w-32">Task Link</label>
                <InputText id="link" v-model="form.link" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="button" label="Save" @click="submit" :disabled="form.processing"></Button>
            </div>
        </Dialog>
    </div>
</template>