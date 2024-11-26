<script setup>
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

const statuses = ref(['pending', 'confirmed', 'declined']);
const props = defineProps({
    tasks: Array
})
function extractDate(datetime) {
    const date = new Date(datetime);
    return date.toISOString().split('T')[0];
}
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    user: {
        email: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.CONTAINS },
            ],
        }
    },
    task: {
        name: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.CONTAINS },
            ],
        },
        platform: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.CONTAINS },
            ],
        },
        link: {
            operator: FilterOperator.AND,
            constraints: [
                { value: null, matchMode: FilterMatchMode.CONTAINS },
            ],
        },
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
    <AdminLayout>
        <div class="p-20 w-full  pt-40  flex flex-col justify-center items-center">
            <DataTable v-model:filters="filters" class="w-[100%]" :value="props.tasks" paginator :rows="10" dataKey="id"
                filterDisplay="menu" :globalFilterFields="[
                    'user.email',
                    'task.name',
                    'task.platform',
                    'task.link',
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

                <Column field="user.email" header="User" sortable >
                    <template #body="{ data }">
                        {{ data.user.email }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Enail" />
                    </template>
                </Column>


                <Column field="task.name" header="Name" sortable >
                    <template #body="{ data }">

                        {{ data.task.name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Task" />
                    </template>
                </Column>
                <Column field="task.platform" header="Platform" sortable >
                    <template #body="{ data }">

                        {{ data.task.platform }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Platform" />
                    </template>
                </Column>
                <Column field="task.link" header="Link" sortable >
                    <template #body="{ data }">

                        {{ data.task.link }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>
                <Column header="Screenshot" sortable >
                    <template #body="{ data }">

                        {{ data.image }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Link" />
                    </template>
                </Column>


                <Column field="status" header="Status" sortable >
                    <template #body="{ data }">

                        <Tag :value="data.status" :severity="getSeverity(data.status)"></Tag>
                    </template>
                    <!-- <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by Status" />
                    </template> -->
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