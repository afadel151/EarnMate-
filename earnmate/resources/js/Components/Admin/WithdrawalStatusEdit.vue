<script setup>
import { Button, Dialog, Tag } from 'primevue';
import { ref } from 'vue';
import Popover from 'primevue/popover';
import axiosClient from '@/axios';
const selectedStatus = ref('');
const op = ref();
const props = defineProps({
    withdrawal:Object
});
const refwithdrawal = ref(props.withdrawal);
function getSeverity(status) {
    if (status == "pending") {
        return "info";
    } else if (status == "completed") {
        return "success";
    } else {
        return "danger";
    }
}
const toggle = (event) => {
    if (refwithdrawal.value.status == 'pending') {
        op.value.toggle(event);
    }
}
const visible = ref(false);
const statuses = ref(['pending', 'completed', 'declined']);
async function editStatus(s){
    try {
        let response = await axiosClient.post('/admin/withdrawals/edit_status',{
            id: props.withdrawal.id,
            status: s
        });
        refwithdrawal.value.status = response.data.status;
        console.log(response.data);
        
    } catch (error) {
        console.log(error);   
    }
}
function selectStatus(s){
    selectedStatus.value = s;
    visible.value = true;
}
</script>

<template>
    <Tag :value="refwithdrawal.status" :severity="getSeverity(refwithdrawal.status)" class="hover:cursor-pointer" @click="toggle"></Tag>
    <Popover ref="op">
        <div class="w-[10rem] flex flex-col space-y-2 p-4 justify-center items-center">
            <Button v-for="status in statuses" :key="status" :label="status" @click="selectStatus(status)"  :severity="getSeverity(status)" class="hover:cursor-pointer w-full"  />
        </div>
    </Popover>
    <Dialog v-model:visible="visible" modal header="Screenshot" class="w-[25rem]">
        <div class="flex justify-between items-start  w-full flex-col  space-y-5">
            <p class="text-2xl text-gray-600 ">Are you sure you want to change the status to <span class="font-black"> {{ selectedStatus
                }}</span></p>

            <div class="flex w-full justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="button" label="Change status" @click="editStatus(selectedStatus)"></Button>
            </div>
        </div>
    </Dialog>
</template>