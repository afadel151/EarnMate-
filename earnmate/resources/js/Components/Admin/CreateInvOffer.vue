<script setup>
import { Button, DatePicker, Dialog, InputNumber, Select } from "primevue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import axiosClient from "@/axios";
const emit = defineEmits(['addoffer']);
const visible = ref(false);

const form = useForm({
    reward: '',
    invite:''
});



const submit = async () => {
    try {
        const response = await axiosClient.post("/admin/invite_offers/create", {
            ...form,
        });
        emit('addoffer',response.data);
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
            <label for="type" class="font-semibold w-32">Invited</label>
            <InputNumber required v-model="form.invite" class="flex-auto" />
        </div>
        <div class="flex items-center gap-4 mb-4">
            <label for="type" class="font-semibold w-32">Reward</label>
            <InputNumber
                mode="currency"
                currency="USD"
                :useGrouping="false"
                v-model="form.reward"
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

