<script setup>
import { ref, onMounted } from 'vue';
import { Dialog, Button } from 'primevue';
import axiosClient from '@/axios';
import { usePage } from '@inertiajs/vue3';
const infos = ref({});
const props = defineProps({
    level: Number
})
const next = ref({});
const activeFriends = ref(0);
async function getLevelInfo() {
    try {
        const response = await axiosClient.get('/levels/get-level', {
            params: {
                level: props.level
            }
        });
        infos.value = response.data.level
        next.value = response.data.next
        activeFriends.value = response.data.active_friends
    } catch (error) {
        console.log(error);
    }
}
onMounted(() => {
    getLevelInfo();
})
const visible = ref(false)

async function subscribeRegular() {
        try {
            let response = axiosClient.post('/levels/subscribe', {
                data: {
                    level_id: props.level_id,
                    method: 'regular'
                }
            })
        } catch (error) {
            console.log(error);

        }
}
async function subscribeException() {
        try {
            let response = axiosClient.post('/levels/subscribe', {
                data: {
                    level_id: props.level_id,
                    method: 'exception'
                }
            })
        } catch (error) {
            console.log(error);
        }
}
</script>

<template>
    <div class="w-full">


        <button @click="visible = true"
            class=" w-full h-14 border-violet-400 transition-all duration-200 hover:border-transparent hover:bg-yellow-300 hover:text-gray-900 text-gray-500  rounded-md bg-violet-100 border-2">
            <div class="w-full flex justify-around items-center">
                <p class="text-xl  ">level {{ props.level }} </p>
                <p class="text-xl"> $ {{ infos.deposit_required }}</p>
                <div class="flex items-center gap-1 ">
                    <p class="text-xl">{{ infos.friends_required }}</p>
                    <i class="pi pi-user"></i>
                </div>
                <i :class="activeFriends >= infos.friends_required ? 'pi pi-unlock' : 'pi pi-lock'"></i>
            </div>
        </button>
        <Dialog v-model:visible="visible" modal :header="'Level ' + props.level" class="w-[50rem] ">

            <div class="flex px-10  items-center justify-between gap-4 mb-8 w-full">
                <div class="flex items-center">
                    <p class="font-semibold w-24">Method 1 :</p>
                    <p class="text-xl ">Use : ${{ infos.deposit_required }} and invite {{ infos.friends_required }} </p>
                </div>
                <Button label="Subscribe" :disabled="activeFriends < infos.friends_required" />
            </div>
            <div class="flex px-10  items-center justify-between gap-4 mb-8 w-full">
                <div class="flex items-center">
                    <p class="font-semibold w-24">Method 2 :</p>
                    <p class="text-xl ">Use : ${{ next.deposit_required }} </p>
                </div>
                <Button label="Subscribe" severity="info" />
            </div>

            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
            </div>
        </Dialog>
    </div>
</template>