<script setup>
import { ref } from "vue";
import { Button } from 'primevue';
import {Dialog} from 'primevue';
import {InputText} from 'primevue';
import {Select} from 'primevue';
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
</script>

<template>
    <div>
        <Button icon="pi pi-plus" label="Add Task" @click="visible = true" />
        <Dialog v-model:visible="visible" modal header="Create a new Task" :style="{ width: '40rem' }">
            <div class="flex items-center gap-4 mb-4">
                <label for="name" class="font-semibold w-32">Task name</label>
                <InputText id="name" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-4">
                <label for="platform" class="font-semibold w-32">Task Platform</label>
                <Select v-model="selectedPlatform" class="flex-auto" :options="platforms" />
            </div>
            <div class="flex items-center gap-4 mb-8">
                <label for="link" class="font-semibold w-32">Task Link</label>
                <InputText id="link" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="button" label="Save" @click="visible = false"></Button>
            </div>
        </Dialog>
    </div>
</template>