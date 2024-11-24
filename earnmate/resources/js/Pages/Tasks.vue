<template>
    <MyLayout>
        <div class="p-20 w-full pt-40 flex flex-col justify-center items-center">
            <DataTable v-model:filters="filters" class="max-w-[100%]"  :value="tasks" paginator :rows="10"
                dataKey="id" filterDisplay="menu" :globalFilterFields="[
                    'name',
                    'type',
                    'link',
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
                <Column field="name" header="Name" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                    </template>
                </Column>
                <Column field="platform" header="Platform" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.platform }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by platform" />
                    </template>
                </Column>
                <Column field="type" header="Type" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.type }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Type" />
                    </template>
                </Column>
                <Column field="link" header="Link" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.link }}
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
    </MyLayout>
</template>
<script setup>
import MyLayout from "@/Layouts/MyLayout.vue";
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import { DataTable } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
const props= defineProps({
    tasks  : Array
})
import { ref } from "vue";
const tasks = ref(props.tasks);
const filters = ref({
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
    admin: {
        user: {
            name: {
                operator: FilterOperator.OR,
                constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }],

            }
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