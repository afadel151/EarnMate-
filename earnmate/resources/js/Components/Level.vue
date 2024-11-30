<script setup>
import { ref, onMounted } from "vue";
import { Dialog, Button, Toast } from "primevue";
import axiosClient from "@/axios";
import { usePage } from "@inertiajs/vue3";
import { useToast } from 'primevue/usetoast';

const toast = useToast();
const infos = ref({});
const props = defineProps({
    level: Number,
});
const next = ref({});
const activeFriends = ref(0);
async function getLevelInfo() {
    try {
        const response = await axiosClient.get("/levels/get-level", {
            params: {
                level: props.level,
            },
        });
        infos.value = response.data.level;
        next.value = response.data.next;
        activeFriends.value = response.data.active_friends;
    } catch (error) {
        console.log(error);
    }
}
onMounted(() => {
    getLevelInfo();
});
const visible = ref(false);

async function subscribe(method) {
    try {
        let response = await axiosClient.post("/levels/subscribe", {
            level_id: infos.value.id,
            method: method,
        });
        console.log(response.data);
        if (response.data == 'already_subscribed') {
            toast.add({ severity: 'info', summary: 'Info', detail: 'Already subscribed', life: 3000 });
        }else if(response.data == 'insufficient_balance')
        {
            toast.add({ severity: 'danger', summary: 'Info', detail: 'Insufficient balance', life: 3000 });
        }
        else if(response.data == 'less_friends')
        {
            toast.add({ severity: 'info', summary: 'Info', detail: 'Need more Active friends', life: 3000 });
        }else if(response.data == 'subscribed')
        {
            toast.add({ severity: 'success', summary: 'Info', detail: 'Subscribed', life: 3000 });
        }
    } catch (error) {
        console.log(error);
    }
}

</script>

<template>
    <div class="w-full">
        <Toast />
        <button @click="visible = true"
            class="w-full h-14 border-2 border-violet-400 bg-gradient-to-r from-purple-100 via-purple-200 to-violet-100 text-gray-600 hover:bg-yellow-300 hover:border-yellow-300 hover:text-gray-900 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
            <div class="flex justify-between items-center w-full px-4">
                <p class="text-lg font-semibold flex items-center gap-1">
                    <i class="pi pi-star text-yellow-400"></i> Level {{ props.level }}
                </p>

                <p class="text-lg font-semibold">
                    💵 ${{ infos.deposit_required }}
                </p>

                <div class="flex items-center gap-1">
                    <p class="text-lg font-semibold">{{ infos.friends_required }}</p>
                    <i class="pi pi-user text-purple-500"></i>
                </div>

                <i :class="activeFriends >= infos.friends_required
                    ? 'pi pi-unlock text-green-500'
                    : 'pi pi-lock text-red-500'" class="text-2xl"></i>
            </div>
        </button>

        <Dialog v-model:visible="visible" modal :header="'Level ' + props.level"
            class="w-[50rem] rounded-lg shadow-lg bg-gradient-to-br from-gray-50 to-gray-100">
            <!-- Header Section -->
            <div class="p-6 text-center">
                <h2 class="text-3xl font-bold text-gray-700">
                    🚀 Level {{ props.level }}
                </h2>
                <p class="text-xl text-gray-500 mt-2">Get $20 profit in 5 days!</p>
            </div>

            <!-- Method 1 -->
            <div class="flex items-center justify-between gap-4 p-6 bg-white rounded-lg shadow-md mb-4">
                <div class="flex items-center gap-2">
                    <p class="font-semibold text-lg text-gray-600 w-32">Method 1:</p>
                    <p class="text-lg text-gray-700">
                        Use:
                        <span class="font-bold text-indigo-500">${{ infos.deposit_required }}</span>
                        and invite
                        <span class="font-bold text-indigo-500">{{
                            infos.friends_required
                            }}</span>
                    </p>
                </div>
                <Button label="Subscribe" :disabled="activeFriends < infos.friends_required"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-6 rounded-md disabled:bg-gray-300 disabled:text-gray-800 disabled:border-transparent disabled:cursor-not-allowed"
                    @click="subscribe('regular')" />
            </div>

            <!-- Method 2 -->
            <div class="flex items-center justify-between gap-4 p-6 bg-white rounded-lg shadow-md mb-4">
                <div class="flex items-center gap-2">
                    <p class="font-semibold text-lg text-gray-600 w-32">Method 2:</p>
                    <p class="text-lg text-gray-700">
                        Use:
                        <span class="font-bold text-indigo-500">${{ next.deposit_required }}</span>
                    </p>
                </div>
                <Button label="Subscribe" severity="info" @click="subscribe('exception')" />
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-4 mt-10">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
            </div>
        </Dialog>
    </div>
</template>