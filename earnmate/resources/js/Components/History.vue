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
function getPlatformColor(platform) {
    if (platform == "youtube") {
        return "#ff0033";
    } else if (platform == "telegram") {
        return "#3491ed";
    } else if (platform == "facebook") {
        return "#0a68ff";
    } else if (platform == "twitter") {
        return "#46a5e0";
    } else if (platform == "discord") {
        return "#4e61ed";
    }
}
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
    <DataTable class="mt-5"   paginator :rows="5"   :rowsPerPageOptions="[5, 10, 20, 50]" :value="props.tasks" >
        <template #header>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <span class="text-xl font-bold">History</span>
                <Button icon="pi pi-refresh" rounded raised />
            </div>
        </template>
        <template #empty>
            <div class="h-60 justify-center flex items-center w-full">
                <p class="text-2xl">No data</p>
            </div>
        </template>
        <Column class="w-[20%]" field="name" header="Name">
            <template #body="slotProps">
                {{ slotProps.data.task.name }}
            </template>
        </Column>
        <Column class="w-[20%]" field="platform" header="Platform">
            <template #body="slotProps">
                <span class="avatar-initial rounded bg-[#75727211] w-14 h-14 flex justify-center items-center">
                            <box-icon :name="`${ slotProps.data.task.platform}`" :color="getPlatformColor(slotProps.data.task.platform)" type="logo"
                                size="lg"></box-icon>
                        </span>
            </template>
        </Column>
        
        <Column class="w-[20%]" field="link" header="Link">
            <template #body="slotProps">
                 <a :href="`${slotProps.data.task.link}`">
                    <Button label="Proceed" />
                 </a>
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