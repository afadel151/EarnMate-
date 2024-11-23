<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import axios from "axios";
import { DataTable } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import { ref, onMounted } from "vue";
const withdrawals = ref([]);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    amount: {
        operator: FilterOperator.AND,
        constraints: [
            { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        ],
    },
    user: {
        rip: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            ],
        }
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
onMounted(async () => {
    try {
        const response = await axios.get("/api/admin/withdrawals/");
        withdrawals.value = response.data;
        console.log(response.data);
        
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
        created_at: {
            operator: FilterOperator.OR,
            constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
        },
    };
};

</script>
<template>
    <AdminLayout>
        <div class="p-10 w-full   flex flex-col justify-center items-center">
        <DataTable v-model:filters="filters" v-model:selection="selectedWithdrawals" :value="withdrawals" paginator :rows="10"
                dataKey="id" filterDisplay="menu" :globalFilterFields="[
                    'user.email',
                    'amount',
                    'admin.user.name',
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
                <Column field="user.email" header="Name" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.user.email }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by email" />
                    </template>
                </Column>
                <Column field="user.name" header="Name" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.user.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                    </template>
                </Column>
                <Column field="amount" header="Platform" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.amount }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by amount" />
                    </template>
                </Column>
               
                
                <Column field="admin.user.name" header="Admin" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.admin.user.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column field="created_at" header="Created" sortable style="min-width: 14rem">
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