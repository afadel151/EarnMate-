<template>
    <MyLayout>
        <div class="  pt-40  flex flex-col justify-center items-center">
            <DataTable v-model:filters="filters" class="w-[100%] border" :value="tasks" paginator :rows="10"
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
                        {{ data.task.name }}
                    </template>

                </Column>
                <Column field="platform" header="Platform" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.task.platform }}
                    </template>

                </Column>
                <Column field="type" header="Type" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ data.task.type }}
                    </template>

                </Column>
                <Column field="link" header="Link" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        <a :href="`${data.task.link}`">
                            <Button label="Proceed" />
                        </a>
                    </template>

                </Column>

                <Column field="created_at" header="Created" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        {{ extractDate(data.created_at) }}
                    </template>

                </Column>
                <Column field="status" header="Link" sortable style="min-width: 14rem">
                    <template #body="{ data }">
                        <Tag :value="data.status" :severity="getSeverity(data.status)" />
                    </template>

                </Column>

            </DataTable>
        </div>
    </MyLayout>
</template>
<script setup>
import MyLayout from "@/Layouts/MyLayout.vue";
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import { DataTable, Tag } from "primevue";
import { IconField } from "primevue";
import { InputIcon } from "primevue";
import { Button } from "primevue";
import { Column } from "primevue";
import { InputText } from "primevue";
const props = defineProps({
    tasks: Array
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