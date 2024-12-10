<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import axios from "axios";
import { DataTable, Select } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import { ref, onMounted } from "vue";

import Tag from 'primevue/tag';
const props = defineProps({
    deposits: {
        type: Array,
        required: true
    }
});
const statuses = ref(['pending', 'confirmed', 'declined']);
function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    amount: {
        operator: FilterOperator.AND,
        constraints: [
            { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        ],
    },
    method: {
        operator: FilterOperator.AND,
        constraints: [
            { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        ],
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
</script>
<template>
    <MyLayout>
        <div class="md:p-20 p-5 w-full   pt-40   flex flex-col justify-center items-center">
            <DataTable v-model:filters="filters" class="w-[100%]" :value="props.deposits" paginator :rows="10" dataKey="id"
                filterDisplay="menu" :globalFilterFields="[
                    'user.email',
                    'amount',
                    'admin.user.name',
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
                    

                </Column> 
                
                <Column field="amount" header="Amount" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.method == 'baridi' ? data.amount*data.price + ' DZD' : '$ '+data.amount }}
                    </template>
                </Column>
                <Column field="method" header="Method" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        <img :src="`/imgs/admin/${data.method}.png`" class="w-14" alt="">
                    </template>
                </Column>
                <Column field="status" header="Status" sortable style="min-width: 14rem">
                    <template #body="{ data }">

                        <Tag :value="data.status" :severity="getSeverity(data.status)"></Tag>
                    </template>
                   
                    
                </Column>

            </DataTable>
        </div>




    </MyLayout>
</template>