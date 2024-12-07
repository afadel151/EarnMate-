<script setup>
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import axios from "axios";
import { DataTable, Tag } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, onMounted } from "vue";
import ViewScreenshot from "@/Components/Admin/ViewScreenshot.vue";
import DeposiStatusEdit from "@/Components/Admin/DeposiStatusEdit.vue";

const props = defineProps({
    deposits: {
        type: Array,
    },
});
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
    if (status == "pending") {
        return "info";
    } else if (status == "confirmed") {
        return "success";
    } else {
        return "danger";
    }
}
const clearFilter = () => {
    initFilters();
};
const initFilters = () => {
    filters.value = {
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
    };
};
const statuses = ref(["pending", "confirmed", "declined"]);
function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split("T")[0];
}
</script>
<template>
    <AdminLayout>
        <div class="p-10 w-full pt-40 flex flex-col justify-center items-center">
            <DataTable v-model:filters="filters" class="w-[100%]" :value="props.deposits" paginator :rows="10" dataKey="id"
                filterDisplay="menu" :globalFilterFields="[
                    'created_at',
                    'amount',
                    'code',
                    'method',
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
               
                <Column field="amount" header="Amount" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.method == 'baridi' ? data.amount * data.price : data.amount }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by amount" />
                    </template>
                </Column>
                <Column field="method" header="Method" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        <img :src="`/laravel/public/imgs/admin/${data.method}.png`" class="w-14" alt="">
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

                <Column field="status" header="Status" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        <DeposiStatusEdit :deposit="data" />
                    </template>
                    <template #filter="{ filterModel, filterCallback }">
                        <Select v-model="filterModel.value" :options="statuses" @change="filterCallback()"
                            placeholder="Select One" style="min-width: 12rem" :showClear="true">
                            <template #option="slotProps">
                                <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)" />
                            </template>
                        </Select>
                    </template>
                </Column>
            </DataTable>
        </div>
    </AdminLayout>
</template>
