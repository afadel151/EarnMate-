<script setup>
import { Button, Dialog, Tag } from 'primevue';
import { ref } from 'vue';
import Popover from 'primevue/popover';
import axios from 'axios';

const op = ref();
const props = defineProps({
    deposit:Object
});
const visible = ref(false);
const refdeposit = ref(props.deposit)
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
    if (props.deposit.status == 'pending') {
        op.value.toggle(event);
    }
}
const statuses = ref(['pending', 'confirmed', 'declined']);
const selectedStatus = ref('');
function selectStatus(status){
    selectedStatus.value = status;
    visible.value = true;
}
async function editStatus(){
    try {
        let response = await axios.post('/api/admin/deposits/edit_status',{
            id: props.deposit.id,
            status: selectedStatus.value
        });
        refdeposit.value.status = response.data.status;
        visible.value = false
    } catch (error) {
        console.log(error);   
    }
}
</script>

<template>
    <Tag :value="props.deposit.status" :severity="getSeverity(refdeposit.status)" class="hover:cursor-pointer" @click="toggle"></Tag>
    <Popover ref="op">
        <div class="w-[10rem] flex flex-col space-y-2 p-4 justify-center items-center">
            <Button v-for="status in statuses" :key="status" :label="status" @click="selectStatus(status)"  :severity="getSeverity(status)" class="hover:cursor-pointer w-full"  />
        </div>
    </Popover>
    <Dialog v-model:visible="visible" modal header="Screenshot" class="w-[50%] h-[80%]">
        <div class="flex justify-end gap-2">
            <p class="text-2xl text-gray-600 font-bold">Are you sure you want to change the status to {{ selectedStatus }}</p>
        </div>
        <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="button" label="Change status" @click="editStatus" ></Button>
            </div>
    </Dialog>
</template>