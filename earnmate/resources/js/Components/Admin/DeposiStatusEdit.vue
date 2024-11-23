<script setup>
import { Button, Tag } from 'primevue';
import { ref } from 'vue';
import Popover from 'primevue/popover';
import axios from 'axios';

const op = ref();
const props = defineProps({
    deposit:Object
});
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
    op.value.toggle(event);
}
const statuses = ref(['pending', 'confirmed', 'declined']);
async function editStatus(status){
    try {
        let response = await axios.post('/api/admin/deposits/edit_status',{
            id: props.deposit.id,
            status: status
        });
        refdeposit.value.status = response.data.status;
    } catch (error) {
        console.log(error);   
    }
}
</script>

<template>
    <Tag :value="props.deposit.status" :severity="getSeverity(refdeposit.status)" class="hover:cursor-pointer" @click="toggle"></Tag>
    <Popover ref="op">
        <div class="w-[10rem] flex flex-col space-y-2 p-4 justify-center items-center">
            <Button v-for="status in statuses" :key="status" :label="status" @click="editStatus(status)"  :severity="getSeverity(status)" class="hover:cursor-pointer w-full"  />
        </div>
    </Popover>
</template>