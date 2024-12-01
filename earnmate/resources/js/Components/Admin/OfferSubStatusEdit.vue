<script setup>
import { Button, Dialog, Tag } from 'primevue';
import { ref } from 'vue';
import Popover from 'primevue/popover';
import axiosClient from '@/axios';


const op = ref();
const props = defineProps({
    subscription: Object
});
const visible = ref(false);
const refSub = ref(props.subscription)
function getSeverity(status) {
    if (status == "pending") {
        return "info";
    } else if (status == "confirmed") {
        return "success";
    } else {
        return "danger";
    }
}
const toggle = (event) => {
    if (props.subscription.status == 'pending') {
        op.value.toggle(event);
    }
}
const statuses = ref(['pending', 'confirmed', 'declined']);
const selectedStatus = ref('');
function selectStatus(status) {
    selectedStatus.value = status;
    visible.value = true;
}
async function editStatus() {
    try {
        let response = await axiosClient.post('/admin/offers/edit_status', {
            id: props.subscription.id,
            status: selectedStatus.value
        });
        refSub.value.status = response.data.status;
        visible.value = false
    } catch (error) {
        console.log(error);
    }
}
</script>

<template>
    <Tag :value="refSub.status" :severity="getSeverity(refSub.status)" class="hover:cursor-pointer"
        @click="toggle"></Tag>
    <Popover ref="op">
        <div class="w-[10rem] flex flex-col space-y-2 p-4 justify-center items-center">
            <Button v-for="status in statuses" :key="status" :label="status" @click="selectStatus(status)"
                :severity="getSeverity(status)" class="hover:cursor-pointer w-full" />
        </div>
    </Popover>
    <Dialog v-model:visible="visible" modal header="Screenshot" class="w-[10rem] h-[10rem]">
        <div class="flex justify-end gap-2">
            <p class="text-2xl text-gray-600 font-bold">Are you sure you want to change the status to {{ selectedStatus
                }}</p>
        </div>
        <div class="flex justify-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
            <Button type="button" label="Change status" @click="editStatus"></Button>
        </div>
    </Dialog>
</template>