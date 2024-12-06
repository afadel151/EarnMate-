<script setup>
import CreateOffer from '@/Components/Admin/CreateOffer.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import { DataTable } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import { ref } from "vue";
const props = defineProps({
    offers: Array
})
function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}
const offers = ref(props.offers)
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    
    method: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    real_max_users: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    fake_max_users: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    required_amount: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    days:{
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    start_date:{
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    start_time:{
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    created_at: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
});

</script>
<template>
    <AdminLayout>
        <div class="p-10 w-full  flex flex-col justify-center items-center">
            <div class="w-full flex my-10 justify-center items-center">
            <CreateOffer />
            
            </div>
            <DataTable v-model:filters="filters" class="w-[100%]" :value="props.offers" paginator :rows="10"
                dataKey="id" filterDisplay="menu" :globalFilterFields="[
                    'method',
                    'real_max_users',
                    'fake_max_users',
                    'required_amount',
                    'days',
                    'start_date',
                    'start_time',
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
                <Column field="method" header="Method" sortable >
                    <template #body="{ data }">
                        {{ data.method }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                    </template>
                </Column>
                <Column field="real_max_users" header="Real users" sortable >
                    <template #body="{ data }">
                        {{ data.real_max_users }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by platform" />
                    </template>
                </Column>
                <Column field="fake_max_users" header="Fake users" sortable >
                    <template #body="{ data }">
                        {{ data.fake_max_users }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Type" />
                    </template>
                </Column>
                <Column field="required_amount" header="Amount" sortable >
                    <template #body="{ data }">
                        {{ data.required_amount }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column field="days" header="Days" sortable >
                    <template #body="{ data }">
                        {{ data.days }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column field="start_date" header="Start date" sortable >
                    <template #body="{ data }">
                        {{ data.start_date }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column field="start_time" header="Start time" sortable >
                    <template #body="{ data }">
                        {{ data.start_time }}
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
                    
                </Column>

            </DataTable>
        </div>
    </AdminLayout>
</template>