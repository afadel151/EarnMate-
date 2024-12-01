<script setup>
import ViewScreenshot from '@/Components/Admin/ViewScreenshot.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import OfferSubStatusEdit from '@/Components/Admin/OfferSubStatusEdit.vue';

import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import { DataTable, Tag } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import { ref } from "vue";
const props = defineProps({
    subscriptions: Array
})
function getSeverity(status) {
    if (status == 'pending') {
        return 'info'
    } else if (status == 'confirmed') {
        return 'success'
    } else {
        return 'danger'
    }
}
function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}
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
        <div class="p-10 pt-40 w-full  flex flex-col justify-center items-center">
            <DataTable v-model:filters="filters" class="w-[100%]" :value="props.subscriptions" paginator :rows="10"
                dataKey="id" filterDisplay="menu" :globalFilterFields="[
                    'method',
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
                <template #empty> No subscriptions found. </template>
                <Column field="email" header="Email" sortable >
                    <template #body="{ data }">
                        {{ data.user.email }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                    </template>
                </Column>
                <Column field="method" header="Method" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        <img v-if="data.method != 'all'" :src="`/imgs/admin/${data.method}.png`" class="w-14" alt="">
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column field="required_amount" header="Amount" sortable >
                    <template #body="{ data }">
                        {{ data.amount }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column field="screenshot" header="Screenshot" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        <ViewScreenshot :src="data.screenshot" />
                    </template>
                </Column>
                <Column field="days" header="Days" sortable >
                    <template #body="{ data }">
                        {{ data.offer.days }}
                    </template>
                </Column>
                <Column field="start_date" header="Start date" sortable >
                    <template #body="{ data }">
                        {{ data.offer.start_date }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column field="start_time" header="Start time" sortable >
                    <template #body="{ data }">
                        {{ data.offer.start_time }}
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
                <Column field="status" header="Start time" sortable >
                    <template #body="{ data }">
                        <OfferSubStatusEdit :subscription="data" />
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
            </DataTable>
        </div>
    </AdminLayout>
</template>