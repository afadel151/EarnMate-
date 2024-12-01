<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';
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
    bonuses: Array
})
function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    friend: {
        name: {
            operator: FilterOperator.OR,
            constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS }],
        },

        email: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.CONTAINS },
            ],
        },
    },
    amount: {
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
    <MyLayout>
        <div class="md:p-20 w-full p-5 pt-40  flex flex-col justify-center items-center">
            <div class="w-full mb-8 flex justify-center items-center">
                <AddAdmin @addadmin="add_admin" />
            </div>
            <DataTable v-model:filters="filters" class="w-[100%]" :value="props.bonuses" paginator :rows="10" dataKey="id"
                filterDisplay="menu" :globalFilterFields="[
                    'friend.name',
                    'friend.email',
                    'amount',
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
                <Column field="friend.name" header="Name" sortable style="min-width: 14rem">
                    <template #body="{ data }">

                        {{ data.friend.name }}
                    </template>
                    
                </Column>

                <Column field="friend.email" header="Email" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.friend.email }}
                    </template>
                    
                </Column>
                <Column field="amount" header="Amount" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.amount }}
                    </template>
                    
                </Column>
                
            </DataTable>

        </div>

    </MyLayout>
</template>