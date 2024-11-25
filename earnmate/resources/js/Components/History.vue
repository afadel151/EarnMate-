<script setup>
import { ref, onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import { Rating, Tag } from 'primevue';
import { Button } from 'primevue';
import Column from 'primevue/column';
const props = defineProps({
    tasks: {
        type: Array,
        required: true
    }
});



const getSeverity = (product) => {
    switch (product.inventoryStatus) {
        case 'INSTOCK':
            return 'success';

        case 'LOWSTOCK':
            return 'warn';

        case 'OUTOFSTOCK':
            return 'danger';

        default:
            return null;
    }
};

</script>
<template>
    <DataTable   paginator :rows="5"   :rowsPerPageOptions="[5, 10, 20, 50]" :value="props.tasks" >
        <template #header>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <span class="text-xl font-bold">History</span>
                <Button icon="pi pi-refresh" rounded raised />
            </div>
        </template>
        <template #empty>
            <div class="h-full w-full bg-gray-500">
                no data
            </div>
        </template>
        <Column class="w-[20%]" field="name" header="Name">
            <template #body="slotProps">
                {{ slotProps.data.task.name }}
            </template>
        </Column>
        <Column class="w-[20%]" field="platform" header="Platform">
            <template #body="slotProps">
                {{ slotProps.data.task.platform }}
            </template>
        </Column>
        
        <Column class="w-[20%]" field="link" header="Link">
            <template #body="slotProps">
                 {{ slotProps.data.task.link }}
            </template>
        </Column>
        <Column class="w-[20%]" field="status" header="Status">
            <template #body="slotProps">
                <Tag :value="slotProps.data.status" />
            </template>
        </Column>
        <template #footer> In total there are {{ props.tasks ? props.tasks.length : 0 }} products. </template>
    </DataTable>
</template>