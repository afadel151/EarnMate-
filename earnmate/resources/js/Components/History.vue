<script setup>
import { ref, onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import { Rating, Tag } from 'primevue';
import { Button } from 'primevue';
import Column from 'primevue/column';
const p = [
    {
        'name' : 'Phone',
        'price' : 300,
        'inventoryStatus' : 'INSTOCK',
        'rating' : 4,
        'category' : 'electronics',

    },
    {
        'name' : 'Phone',
        'price' : 300,
        'inventoryStatus' : 'INSTOCK',
        'rating' : 4,
        'category' : 'electronics',

    },
    {
        'name' : 'Phone',
        'price' : 300,
        'inventoryStatus' : 'INSTOCK',
        'rating' : 4,
        'category' : 'electronics',

    },
    {
        'name' : 'Phone',
        'price' : 300,
        'inventoryStatus' : 'INSTOCK',
        'rating' : 4,
        'category' : 'electronics',

    },
    {
        'name' : 'Phone',
        'price' : 300,
        'inventoryStatus' : 'INSTOCK',
        'rating' : 4,
        'category' : 'electronics',

    },
    {
        'name' : 'Phone',
        'price' : 300,
        'inventoryStatus' : 'INSTOCK',
        'rating' : 4,
        'category' : 'electronics',

    },
    {
        'name' : 'Phone',
        'price' : 300,
        'inventoryStatus' : 'INSTOCK',
        'rating' : 4,
        'category' : 'electronics',

    },
    {
        'name' : 'Phone',
        'price' : 300,
        'inventoryStatus' : 'INSTOCK',
        'rating' : 4,
        'category' : 'electronics',

    },
]
const products = ref(p);

const formatCurrency = (value) => {
    return value.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
};
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
    <DataTable  paginator :rows="5"  :rowsPerPageOptions="[5, 10, 20, 50]" :value="products" >
        <template #header>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <span class="text-xl font-bold">History</span>
                <Button icon="pi pi-refresh" rounded raised />
            </div>
        </template>
        <Column field="name" header="Name"></Column>
        <Column field="price" header="Price">
            <template #body="slotProps">
                {{ formatCurrency(slotProps.data.price) }}
            </template>
        </Column>
        <Column field="category" header="Category"></Column>
        <Column field="rating" header="Reviews">
            <template #body="slotProps">
                <Rating :modelValue="slotProps.data.rating" readonly />
            </template>
        </Column>
        <Column header="Status">
            <template #body="slotProps">
                <Tag :value="slotProps.data.inventoryStatus" :severity="getSeverity(slotProps.data)" />
            </template>
        </Column>
        <template #footer> In total there are {{ products ? products.length : 0 }} products. </template>
    </DataTable>
</template>