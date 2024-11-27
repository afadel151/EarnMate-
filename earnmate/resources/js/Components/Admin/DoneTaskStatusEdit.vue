<script setup>
import { Button, Tag } from 'primevue';
import { ref } from 'vue';
import Popover from 'primevue/popover';
import axiosClient from '@/axios';

const op = ref();
const props = defineProps({
    task:Object
});
const refTask = ref(props.task)
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
        let response = await axiosClient.post('/admin/tasks/edit_status',{
            id: props.task.id,
            status: status
        });
        refTask.value.status = response.data.status;
    } catch (error) {
        console.log(error);   
    }
}
</script>

<template>
    <Tag :value="refTask.status" :severity="getSeverity(refTask.status)" class="hover:cursor-pointer" @click="toggle"></Tag>
    <Popover ref="op">
        <div class="w-[10rem] flex flex-col space-y-2 p-4 justify-center items-center">
            <Button v-for="status in statuses" :key="status" :label="status" @click="editStatus(status)"  :severity="getSeverity(status)" class="hover:cursor-pointer w-full"  />
        </div>
    </Popover>
</template>