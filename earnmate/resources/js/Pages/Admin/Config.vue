<script setup>
import axiosClient from '@/axios';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { Button, InputText, InputNumber, useToast, Toast } from 'primevue';
const props = defineProps({
    config: Object
})
const form = useForm({
    max_balance:props.config.max_balance,
    level_days:props.config.level_days,
    baridi_tax_percentage:props.config.baridi_tax_percentage,
    binance_tax_percentage:props.config.binance_tax_percentage,
    dzd_price:props.config.dzd_price
});
const toast = useToast();
async function submit(){
    try {
        let response = await axiosClient.post('/admin/config',form);
        if (response.data == 'done') {
            toast.add({ severity: 'success', summary: 'Info', detail: 'Config Changed successfylly', life: 3000 });
        }else{
            toast.add({ severity: 'danger', summary: 'Info', detail: 'Error while changing config', life: 3000 });
        }
    } catch (error) {
        console.log(error);
    }
}
</script>

<template>
    <AdminLayout>
        <Toast/>
        <div class="h-full md:px-0 md:pt-0 pt-20 p px-5 w-full flex justify-center items-center">
            <div class="md:w-[50rem] w-full bg-white p-10 rounded-2xl shadow-custom-purple">
                <p class="text-4xl font-bold text-gray-600 mb-8">Config </p>
                <div class="flex items-center gap-4 mb-4">
                    <label for="name" class="font-semibold w-52">Max balance :</label>
                    <InputNumber currency="USD"  mode="currency" :withoutGrouping="false"  id="name" v-model="form.max_balance" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="link" class="font-semibold w-52">Level days :</label>
                    <InputText id="link" v-model="form.level_days" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="link" class="font-semibold w-52">BaridiMob tax percentage :</label>
                    <InputText id="link" v-model="form.baridi_tax_percentage" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="link" class="font-semibold w-52">Binance tax percentage :</label>
                    <InputText id="link" v-model="form.binance_tax_percentage" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex items-center gap-4 mb-8">
                    <label for="link" class="font-semibold w-52">Dzd Price :</label>
                    <InputText id="link" v-model="form.dzd_price" class="flex-auto" autocomplete="off" />
                </div>
                <div class="flex justify-end gap-2">
       
                    <Button type="button" label="Save" @click="submit" :disabled="form.processing"></Button>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>