<script setup>
import CreateInvOffer from '@/Components/Admin/CreateInvOffer.vue';
import InvOffClosed from '@/Components/Admin/InvOffClosed.vue';
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
    invited:{
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
    reward:{
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }],
    },
    closed:{
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }],
    },
    created_at: {
        operator: FilterOperator.OR,
        constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
    },
});
function AddNewOffer(offer){
    offers.value.push(offer);
}

</script>
<template>
    <AdminLayout>
        <div class="p-10 w-full  flex flex-col justify-center items-center">
            <div class="w-full flex my-10 justify-center items-center">
            <CreateInvOffer @addoffer="AddNewOffer"  />
            
            </div>
            <DataTable v-model:filters="filters" class="w-[100%]" :value="offers" paginator :rows="10"
                dataKey="id" filterDisplay="menu" :globalFilterFields="[
                    'reward',
                    'invited',
                    'closed'
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
                <Column field="created_at" header="Created" sortable >
                    <template #body="{ data }">
                        {{ extractDate(data.created_at) }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Date" />
                    </template>
                    
                </Column>
                <Column field="invited" header="Invite" sortable >
                    <template #body="{ data }">
                        {{ data.invite }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Number" />
                    </template>
                    
                </Column>
                <Column field="reward" header="Reward" sortable >
                    <template #body="{ data }">
                        {{ data.reward }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Number" />
                    </template>
                </Column>
                <Column field="closed" header="Closed" sortable >
                    <template #body="{ data }">
                        <InvOffClosed :offer="data" />
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Number" />
                    </template>
                </Column>
                
               

            </DataTable>
        </div>
    </AdminLayout>
</template>