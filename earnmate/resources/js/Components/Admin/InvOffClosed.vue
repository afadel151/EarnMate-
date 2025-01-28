<script setup>
import { Button, Tag } from 'primevue';
import { ref } from 'vue';
import Popover from 'primevue/popover';
import axiosClient from '@/axios';

const op = ref();
const props = defineProps({
    offer:Object
});
const offer = ref(props.offer)
function getSeverity(status) {
    if (status == false) {
        return "success";
    } else {
        return "danger";
    }
}
const toggle = (event) => {
    if(offer.value.closed == false){
        op.value.toggle(event);
    }
}

async function close(){
    try {
        let response = await axiosClient.post('/admin/invite_offers/close',{
            offer_id: props.offer.id,
        });
        offer.value.closed = response.data.closed;
    } catch (error) {
        console.log(error);   
    }
}
</script>

<template>
    <Tag :value="offer.closed == true ? 'Closed' : 'Open'" :severity="getSeverity(offer.closed)" class="hover:cursor-pointer" @click="toggle"></Tag>
    <Popover ref="op">
        <div class="w-[10rem] flex flex-col space-y-2 p-4 justify-center items-center">
            <Button @click="close()"  severity="danger" label="Close" class="hover:cursor-pointer w-full"  />
        </div>
    </Popover>
</template>