<script setup>
import ViewScreenshot from '@/Components/Admin/ViewScreenshot.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import axios from "axios";
import { DataTable, Select, Tag } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import { computed, ref } from "vue";
import DoneTaskStatusEdit from '@/Components/Admin/DoneTaskStatusEdit.vue';
import axiosClient from '@/axios';
const statuses = ref(['pending', 'confirmed', 'declined']);
const props = defineProps({
    tasks: Array
})
function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    user: {
        email: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.CONTAINS },
            ],
        }
    },
    task: {
        name: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.CONTAINS },
            ],
        },
        platform: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.CONTAINS },
            ],
        },
        link: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.CONTAINS },
            ],
        },
    },
    created_at: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    status: { value: null, matchMode: FilterMatchMode.EQUALS },
});
function getSeverity(status) {
    if (status == 'pending') {
        return 'info'
    } else if (status == 'confirmed') {
        return 'success'
    } else {
        return 'danger'
    }
}
const selectedTasks = ref([])
const selectedTasksIds = computed(()=>{
    return selectedTasks.value?.map(task=> task.id)
})
const clearFilter = async () => {
    try {
        let response = await axiosClient.post('/admin/done_tasks/delete',{
            tasks: selectedTasksIds.value
        });
        if (response.status == 200) {
            selectedTasks.value = [];
        }else if(response.status == 201){
            console.log('NO tasks to delete');
        }else{
         console.log('Error :'+response.data);
         
        }
        
    } catch (error) {
        console.log(error);

    }
    
};
const tasks = ref(props.tasks);
const confirmFilter = async () => {
    try {
        let response = await axiosClient.post('/admin/done_tasks/confirm');
        if (response.status == 200) {
            tasks.value.map(task => task.status = 'confirmed')
        }else if(response.status == 201){
            console.log('Error confirming tasks');
        }else{
         console.log('Error :'+response.data);
         
        }
        
    } catch (error) {
        console.log(error);

    }
    
};

</script>

<template>
    <AdminLayout>
        <div class="p-10 pt-32 w-full flex flex-col justify-center items-center">
            <DataTable v-model:filters="filters" v-model:selection="selectedTasks" class="w-[100%]" :value="tasks" paginator :rows="10" dataKey="id"
                filterDisplay="menu" :globalFilterFields="[
                    'user.email',
                    'task.name',
                    'task.platform',
                    'task.link',
                    'created_at'
                ]">
                <template #header>
                    <div class="flex justify-between">
                        <div class="flex justify-start space-x-3">
                            <Button type="button" icon="pi pi-filter-slash" label="Clear" outlined @click="clearFilter()" />
                            <Button type="button" icon="pi pi-filter-slash" label="Confirm" severity="info" outlined @click="confirmFilter()" />
                        </div>
                        <IconField>
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText v-model="filters.global.value" placeholder="Keyword Search" />
                        </IconField>
                    </div>
                </template>
                <template #empty> No customers found. </template>
                <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                <Column field="created_at" header="Date" sortable >
                    <template #body="{ data }">
                        {{ extractDate(data.created_at) }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Date" />
                    </template>

                </Column>

                <Column field="user.email" header="User" sortable >
                    <template #body="{ data }">
                        {{ data.user.email }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Enail" />
                    </template>
                </Column>


                <Column field="task.name" header="Name" sortable >
                    <template #body="{ data }">

                        {{ data.task.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Task" />
                    </template>
                </Column>
                <Column field="task.platform" header="Platform" sortable >
                    <template #body="{ data }">

                        {{ data.task.platform }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Platform" />
                    </template>
                </Column>
                <Column field="task.link" header="Link" sortable >
                    <template #body="{ data }">

                        <a :href="`${data.task.link}`">
                            <Button label="Proceed" />
                        </a>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column header="Screenshot" sortable >
                    <template #body="{ data }">

                        <ViewScreenshot :src="data.image" />
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>


                <Column field="status" header="Status" sortable >
                    <template #body="{ data }">

                        <DoneTaskStatusEdit :task="data" />
                    </template>
                    
                    <template #filter="{ filterModel, filterCallback }">
                        <Select v-model="filterModel.value" :options="statuses" @change="filterCallback()"
                            placeholder="Select One" style="min-width: 12rem" :showClear="true">
                            <template #option="slotProps">
                                <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)" />
                            </template>
                        </Select>
                    </template>
                </Column>

            </DataTable>
        </div>

    </AdminLayout>
</template>