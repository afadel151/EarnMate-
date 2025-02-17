<template>
    <AdminLayout>
        <div class="p-10 w-full  flex flex-col justify-center items-center">
            <div class="w-full flex my-10 justify-center items-center">
                <Button icon="pi pi-plus" label="Add Task" @click="visible = true" />
                <Dialog v-model:visible="visible" modal header="Create a new Task" class="md:w-[40rem]">
                    <div class="flex items-center gap-4 mb-4">
                        <label for="name" class="font-semibold w-32">Description</label>
                        <InputText id="name" v-model="form.description" class="flex-auto" autocomplete="off" />
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
            <DataTable v-model:filters="filters" class="w-[100%]" :value="props.tasks" paginator :rows="10" dataKey="id"
                filterDisplay="menu" :globalFilterFields="[
                    'description',
                    'link',
                    'created_at'
                ]">
                <template #header>
                    <div class="flex justify-between">
                        <IconField>
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText v-model="filters.global.value" placeholder="Keyword Search" />
                        </IconField>
                    </div>
                </template>
                <template #empty> No customers found. </template>

                <Column field="description" header="Description" sortable>
                    <template #body="{ data }">
                        {{ data.description }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Type" />
                    </template>
                </Column>
                <Column field="link" header="Link" sortable>
                    <template #body="{ data }">
                        {{ data.link }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>

                <Column field="created_at" header="Created" sortable>
                    <template #body="{ data }">
                        {{ extractDate(data.created_at) }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Date" />
                    </template>

                </Column>

            </DataTable>
        </div>
    </AdminLayout>
</template>
<script setup>
const props = defineProps({
    tasks: Array
});
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import { DataTable, ProgressSpinnerStyle } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref } from "vue";
import { Dialog } from 'primevue';
import { useForm } from "@inertiajs/vue3";
import axiosClient from "@/axios";
const visible = ref(false);
const selectedTasks = ref();
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    description: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }],
    },
    link: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }],
    },
    created_at: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
});


function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}

const form = useForm({
    link: null,
    description: '',
});

const submit = async () => {
    try {
        const response = await axiosClient.post('/admin/primary_tasks/add', { ...form });
        console.log(response.data);
        visible.value = false;
    } catch (error) {
        console.log(error);

    }
};




</script>