<script setup>
import axiosClient from '@/axios';
import Messages from './Messages.vue';
import Message from '@/Components/Message.vue';
import { ref } from 'vue';
import { Button, InputText } from 'primevue';
async function sendMessage() {
    if (textMessage.value != '') {


        try {
            let response = await axiosClient.post('/admin/messages/add', {
                user_id: props.user.id,
                message: textMessage.value
            });
            console.log(response.data);
            refMessages.value.unshift(response.data);
            textMessage.value = '';
        } catch (error) {
            console.log(error);

        }
    }
}
const props = defineProps({
    messages: Array,
    user: Object
})
const textMessage = ref('');
const refMessages = ref(props.messages);

</script>


<template>
    <Messages>
        <div class="h-full">


            <div class="h-[9%] px-10 flex justify-between shadow-sm items-center bg-white w-full">
                <div class="flex justify-center flex-col items-start">
                    <p class="text-2xl text-gray-500 font-bold">{{ props.user.name }}</p>
                    <p class="text-lg text-gray-400">{{ props.user.email }}</p>
                </div>
                <Button icon="pi pi-user" severity="info" rounded />
            </div>
            <div class="h-[91%] w-full flex pb-5 px-5 space-y-2 flex-col-reverse overflow-y-scroll">
                <div class="w-full h-20 bg-white rounded-md space-x-3 px-4 mt-4 flex justify-between items-center">
                    <InputText v-model="textMessage" class="w-full" placeholder="Write a message here..." />
                    <Button label="Send" icon="pi pi-send" @click="sendMessage" severity="info" />
                </div>
                <Message v-for="message in refMessages" :key="message.id" :message="message" />
            </div>
        </div>
    </Messages>
</template>