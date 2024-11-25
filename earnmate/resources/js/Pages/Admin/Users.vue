<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import axios from "axios";
import { DataTable, Select, Tag } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import { ref, onMounted } from "vue";

const props = defineProps({
    users: Array
})
const users = ref(props.users);
function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    balance: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    email: {
        operator: FilterOperator.AND,
        constraints: [
            { value: null, matchMode: FilterMatchMode.CONTAINS },
        ],
    },
    created_at: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
});
</script>
<template>
    <AdminLayout>
        <div class="p-20 w-full  pt-40  flex flex-col justify-center items-center">
            <div class="w-full mb-8 flex justify-center items-center">
                <AddAdmin @addadmin="add_admin" />
            </div>
            <DataTable v-model:filters="filters" class="w-[100%]" :value="admins" paginator :rows="10" dataKey="id"
                filterDisplay="menu" :globalFilterFields="[
                    'user.email',
                    'user.name',
                    'balance',
                    'RIP',
                    'created_at'
                ]">
                <template #header>
                    <div class="flex justify-end">
                        <IconField>
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText v-model="filters.global.value" placeholder="Keyword Search" />
                        </IconField>
                    </div>
                </template>
                <template #empty> No customers found. </template>
                <Column field="created_at" header="Date" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ extractDate(data.created_at) }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Date" />
                    </template>

                </Column>
                <Column field="user.name" header="Name" sortable style="min-width: 14rem">
                    <template #body="{ data }">

                        {{ data.user.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Task" />
                    </template>
                </Column>

                <Column field="user.email" header="Email" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.user.email }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Enail" />
                    </template>
                </Column>
                <Column field="balance" header="Balance" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.balance }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Enail" />
                    </template>
                </Column>
                <Column field="RIP" header="RIP" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.RIP }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Enail" />
                    </template>
                </Column>

                
                

            </DataTable>
        
            </div>

    </AdminLayout>
</template>