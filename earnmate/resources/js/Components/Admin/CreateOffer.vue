<script setup>
import { Button, DatePicker, Dialog, InputNumber, Select } from "primevue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import axiosClient from "@/axios";
const date = ref(null);
const visible = ref(false);
const dateObject = ref(new Date(date));
const form = useForm({
    start_date: "",
    start_time: "",
    days: "",
    real_max_users: "",
    fake_max_users: "",
    required_amount: "",
    percentage: "",
    method: "",
});
const methods = ref(["baridi", "binance", "bybit", "all"]);
watch(date, (newDate) => {
    if (newDate) {
        const dateObj = new Date(newDate);
        form.start_date = dateObj.toISOString().split("T")[0];
        form.start_time = dateObj.toTimeString().split(" ")[0];
    } else {
        form.start_date = "";
        form.start_time = "";
    }
});

const submit = async () => {
    try {
        const response = await axiosClient.post("/admin/offers/add", {
            ...form,
        });
        console.log(response.data);
        visible.value = false;
    } catch (error) {
        console.log(error);
    }
};
</script>

<template>
    <Button icon="pi pi-plus" label="Add Offer" @click="visible = true" />
    <Dialog
        v-model:visible="visible"
        modal
        header="Create a new Task"
        :style="{ width: '40rem' }"
    >
        <div class="flex items-center gap-4 mb-4">
            <label for="name" class="font-semibold w-40">Offer DateTime</label>
            <VueDatePicker
                v-model="date"
                class="z-10 custom-datepicker flex-auto"
                :style="{ zIndex: 1050 }"
                :teleport="true"
            ></VueDatePicker>
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="type" class="font-semibold w-32">Payment method</label>
            <Select
                id="type"
                v-model="form.method"
                class="flex-auto"
                :options="methods"
                required
            />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="type" class="font-semibold w-32">Days</label>
            <InputNumber required v-model="form.days" class="flex-auto" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="type" class="font-semibold w-32">Real users</label>
            <InputNumber required v-model="form.real_max_users" class="flex-auto" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="type" class="font-semibold w-32">Fake users</label>
            <InputNumber required v-model="form.fake_max_users" class="flex-auto" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="type" class="font-semibold w-32">Percentage</label>
            <InputNumber
                v-model="form.percentage"
                :min="0"
                :max="100"
                class="flex-auto"
                required
            />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="type" class="font-semibold w-32">Amount</label>
            <InputNumber
                mode="currency"
                currency="USD"
                :useGrouping="false"
                v-model="form.required_amount"
                class="flex-auto"
                required
            />
        </div>
        <div class="flex justify-end gap-2">
            <Button
                type="button"
                label="Cancel"
                severity="secondary"
                @click="visible = false"
            ></Button>
            <Button
                type="button"
                label="Save"
                @click="submit"
                :disabled="form.processing"
            ></Button>
        </div>
    </Dialog>
</template>
<style scoped>
.custom-datepicker {
    z-index: 1050 !important;
    position: relative;
}
</style>
