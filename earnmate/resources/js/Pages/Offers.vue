<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
const props = defineProps({
    subscriptions: Array
})
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import { DataTable, Tag } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import { ref } from "vue";

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
function getSeverity(status) {
    if (status == 'pending') {
        return 'info'
    } else if (status == 'confirmed') {
        return 'success'
    } else {
        return 'danger'
    }
}
</script>

<template>
    <MyLayout>
        <div class="md:p-20 p-5 mt-20 w-full  flex flex-col justify-center items-center">

            <DataTable v-model:filters="filters" class="w-[100%]" :value="props.subscriptions" paginator :rows="10"
                dataKey="id" filterDisplay="menu" :globalFilterFields="[
                    'method',
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
                        <img v-if="data.method != 'all'" :src="`/imgs/admin/${data.method}.png`" class="w-14" alt="">
                    </template>
                    
                </Column>
                <Column field="amount" header="Amount" sortable >
                    <template #body="{ data }">
                        {{ data.method == 'baridi' ? data.amount + 'DZD' : '$'+data.amount }}
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
                    
                </Column>
                <Column field="start_time" header="Start time" sortable >
                    <template #body="{ data }">
                        {{ data.offer.start_time }}
                    </template>
                    
                </Column>
                <Column field="created_at" header="Created" sortable >
                    <template #body="{ data }">
                        {{ extractDate(data.created_at) }}
                    </template>
                    
                    
                </Column>
                <Column field="status" header="Status" sortable >
                    <template #body="{ data }">
                        <Tag :value="data.status" :severity="getSeverity(data.status)"></Tag>
                                        </template>
                    
                </Column>
                <Column field="done" header="Done" sortable >
                    <template #body="{ data }">
                        <Tag :icon="data.done ? 'pi pi-check' : 'pi pi-hourglass'" :value="data.done ? 'done' : 'waiting'" :severity="data.done ? 'primary' : 'secondary'"></Tag>
                    </template>
                    
                </Column>
            </DataTable>
        </div>

    </MyLayout>
</template>