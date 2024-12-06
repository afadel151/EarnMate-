<script setup>
import { onMounted, ref } from 'vue';
import UserConversation from './UserConversation.vue';
import axiosClient from '@/axios';
const Users = ref([]);
async function getConvs()
{
    try {
        let response = await axiosClient.get('/admin/messages/convs')
        Users.value = response.data;
    } catch (error) {
        console.log(error);
    }
}
onMounted(()=>{
   getConvs();
})
</script>

<template>
    <div class="w-full h-full overflow-y-scroll flex px-2 pt-2 flex-col space-y-2 justify-start items-stretch">
        <UserConversation v-for="user in Users" :key="user.id" :user="user" />
    </div>
</template>