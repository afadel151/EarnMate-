<script setup>
import { Button, Tag } from 'primevue';
import { ref } from 'vue';
import Popover from 'primevue/popover';
import axios from 'axios';

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
    op.value.toggle(event);
}
const statuses = ref(['pending', 'completed', 'declined']);
async function editStatus(s){
    try {
        let response = await axios.post('/api/admin/withdrawals/edit_status',{
            id: props.withdrawal.id,
            status: s
        });
        refwithdrawal.value.status = response.data.status;
        console.log(response.data);
        
    } catch (error) {
        console.log(error);   
    }
}
</script>

<template>
    <Tag :value="refwithdrawal.status" :severity="getSeverity(refwithdrawal.status)" class="hover:cursor-pointer" @click="toggle"></Tag>
    <Popover ref="op">
        <div class="w-[10rem] flex flex-col space-y-2 p-4 justify-center items-center">
            <Button v-for="status in statuses" :key="status" :label="status" @click="editStatus(status)"  :severity="getSeverity(status)" class="hover:cursor-pointer w-full"  />
        </div>
    </Popover>
</template>