<template>
    <AdminLayout>
        <div class="p-10 w-full  flex flex-col justify-center items-center">
            <div class="w-full flex my-10 justify-center items-center">
                <AddTask  @addtask="AddNewTask" />
            </div>
            <DataTable v-model:filters="filters" class="w-[100%]"  v-model:selection="selectedTasks" :value="tasks" paginator :rows="10"
                dataKey="id" filterDisplay="menu" :globalFilterFields="[
                    'name',
                    'type',
                    'link',
                    'created_at'
                ]">
                <template #header>
                    <div class="flex justify-between">
                        <Button type="button" icon="pi pi-filter-slash" label="Clear" outlined @click="clearFilter()" />
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
                <Column field="name" header="Name" sortable >
                    <template #body="{ data }">
                        {{ data.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                    </template>
                </Column>
                <Column field="platform" header="Platform" sortable >
                    <template #body="{ data }">
                        {{ data.platform }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by platform" />
                    </template>
                </Column>
                <Column field="type" header="Type" sortable >
                    <template #body="{ data }">
                        {{ data.type }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Type" />
                    </template>
                </Column>
                <Column field="link" header="Link" sortable >
                    <template #body="{ data }">
                        {{ data.link }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column field="admin.user.name" header="Admin" sortable >
                    <template #body="{ data }">
                        {{ data.admin.user.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column field="created_at" header="Created" sortable >
                    <template #body="{ data }">
                        {{ extractDate(data.created_at) }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Date" />
                    </template>
                    <!-- <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            placeholder="Search by Link"
                        />
                    </template> -->
                </Column>

            </DataTable>
            {{ selectedTasksIds }}
        </div>
    </AdminLayout>
</template>
<script setup>
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import { DataTable, ProgressSpinnerStyle } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

import { ref, onMounted, computed } from "vue";
import AddTask from "@/Components/Admin/AddTask.vue";
import axiosClient from "@/axios";
const tasks = ref([]);
const selectedTasks = ref();
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: {
        operator: FilterOperator.AND,
        constraints: [
            { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        ],
    },
    platform: {
        operator: FilterOperator.AND,
        constraints: [
            { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        ],
    },
    type: {
        operator: FilterOperator.AND,
        constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }],
    },
    link: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }],
    },
    admin: {
        user: {
            name: {
                operator: FilterOperator.OR,
                constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }],

            }
        }
    },
    created_at: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
});
function AddNewTask(task){
    tasks.value.push(task);
}
const selectedTasksIds = computed(()=>{
    return selectedTasks.value?.map(task=> task.id)
})
function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}
onMounted(async () => {
    try {
        const response = await axiosClient.get("/admin/tasks/");
        tasks.value = response.data;
    } catch (error) {
        console.log(error);
    }
    initFilters();
});


const clearFilter = async () => {
    try {
        let response = await axiosClient.post('/admin/tasks/delete',{
            tasks: selectedTasksIds.value
        });
        if (response.status == 200) {
            tasks.value = tasks.value.filter(task => !selectedTasksIds.value.includes(task.id));
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
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            ],
        },
        platform: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            ],
        },

        type: {
            operator: FilterOperator.AND,
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
    };
};

</script>