
<template>
    <AdminLayout>
        <div class="p-10 px-[13rem]">
            <div class="w-full flex my-10 justify-center items-center">
                <AddTask />
            </div>
            <DataTable
                v-model:filters="filters"
                v-model:selection="selectedTasks"
                :value="tasks"
                paginator
                :rows="10"
                dataKey="id"
                filterDisplay="menu"
                :globalFilterFields="[
                    'name',
                ]"
            >
                <template #header>
                    <div class="flex justify-between">
                        <Button
                            type="button"
                            icon="pi pi-filter-slash"
                            label="Clear"
                            outlined
                            @click="clearFilter()"
                        />
                        <IconField>
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText
                                v-model="filters.global.value"
                                placeholder="Keyword Search"
                            />
                        </IconField>
                    </div>
                </template>
                <template #empty> No customers found. </template>
                <Column
                    selectionMode="multiple"
                    headerStyle="width: 3rem"
                ></Column>
                <Column
                    field="name"
                    header="Name"
                    sortable
                    style="min-width: 14rem"
                >
                    <template #body="{ data }">
                        {{ data.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            placeholder="Search by name"
                        />
                    </template>
                </Column>
                <Column
                    field="platform"
                    header="Platform"
                    sortable
                    style="min-width: 14rem"
                >
                    <template #body="{ data }">
                        {{ data.platform }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            placeholder="Search by platform"
                        />
                    </template>
                </Column>
                <Column
                    field="type"
                    header="Type"
                    sortable
                    style="min-width: 14rem"
                >
                    <template #body="{ data }">
                        {{ data.type }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            placeholder="Search by Type"
                        />
                    </template>
                </Column>
                <Column
                    field="link"
                    header="Link"
                    sortable
                    style="min-width: 14rem"
                >
                    <template #body="{ data }">
                        {{ data.link }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            placeholder="Search by Link"
                        />
                    </template>
                </Column>
                <Column
                    field="created_at"
                    header="Created"
                    sortable
                    style="min-width: 14rem"
                >
                    <template #body="{ data }">
                        {{ data.created_at }}
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
        </div>
    </AdminLayout>
</template>
<script setup>
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import axios from "axios";
import { DataTable } from "primevue";
import {IconField} from "primevue";
import {InputIcon} from "primevue";
import {Button} from "primevue";
import {Column } from "primevue";
import {InputText} from "primevue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

import { ref, onMounted } from "vue";
import AddTask from "@/Components/Admin/AddTask.vue";
const tasks = ref([]);
const selectedTasks = ref([]);
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
    });



onMounted(async () => {
    try {
        const response = await axios.get("/api/admin/tasks");
        tasks.value = response.data;
    } catch (error) {
        console.log(error);
    }
    initFilters();
});


const clearFilter = () => {
    initFilters();
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
    };
};

</script>