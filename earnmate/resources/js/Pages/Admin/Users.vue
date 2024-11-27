<script setup>
import Level from '@/Components/Level.vue';
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
            <DataTable v-model:filters="filters" class="w-[100%]" :value="users" paginator :rows="10" dataKey="id"
                filterDisplay="menu" :globalFilterFields="[
                    'email',
                    'name',
                    'balance',
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
                <Column field="created_at" header="Date" sortable >
                    <template #body="{ data }">
                        {{ extractDate(data.created_at) }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Date" />
                    </template>

                </Column>
                <Column field="name" header="Name" sortable >
                    <template #body="{ data }">

                        {{ data.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Task" />
                    </template>
                </Column>

                <Column field="email" header="Email" sortable >
                    <template #body="{ data }">
                        {{ data.email }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Enail" />
                    </template>
                </Column>
                <Column field="balance" header="Balance" sortable >
                    <template #body="{ data }">
                        {{ data.balance }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Enail" />
                    </template>
                </Column>
                <Column  header="Friends" sortable >
                    <template #body="{ data }">
                        {{ data.friends.length }}
                    </template>
                </Column>
                <Column  header="Level" sortable >
                    <template #body="{ data }">
                        {{ data.current_level  ? data.current_level.level.level_number : 'Not subscibed' }}
                    </template>
                </Column>
                <Column  header="Bonus" sortable >
                    <template #body="{ data }">
                        {{ Math.floor(data.bonuses.reduce((sum, item) => sum + (item.amount || 0), 0)) }}
                    </template>
                </Column>
            </DataTable>
        
            </div>

    </AdminLayout>
</template>