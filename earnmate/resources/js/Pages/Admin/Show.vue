<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Balance from '@/Components/Admin/Balance.vue';
import Sent from '@/Components/Admin/Sent.vue';
import Received from '@/Components/Admin/Received.vue';
import CreatedTasks from '@/Components/Admin/CreatedTasks.vue';
import CreatedOffers from '@/Components/Admin/CreatedOffers.vue';
const props = defineProps({
    admin: {
        type: Object,
        required: true
    }
})
</script>

<template>

    <AdminLayout>
        <div class="grid grid-cols-6 grid-rows-4 gap-4 h-full w-full    p-10 px-[13rem]">
            <div class="col-span-4 row-span-1  rounded-md shadow-sm  flex justify-start  items-stretch  bg-white">
                <img src="/imgs/admin/rb_855.png" class="w-56" alt="">
                <div class=" h-full p-10  ">
                    <p class="text-4xl font-semibold text-violet-500"> {{ props.admin.name }}</p>
                    <p class="text-2xl text-gray-500">Welcome again !</p>
                    <p class="text-3xl text-gray-500">Email : {{ admin.email }}</p>
                    <p class="text-3xl text-gray-500">RIP : {{ admin.admin.RIP }}</p>
                </div>

            </div>
            <div class="col-span-2 row-span-3 col-start-5 bg-green-300">2</div>
            <div class="col-span-2 row-span-2 col-start-1 row-start-3 bg-red-100">
                <CreatedTasks />
            </div>
            <div class="col-start-1 row-start-2 ">
                <Balance />
            </div>
            <div class="col-start-2 row-start-2 ">
               <Received />
            </div>
            <div class="col-start-3 row-start-2 ">
                <Sent />
            </div>
            <div class="col-start-4 row-start-2 bg-indigo-400">7</div>
            <div class="col-span-2 row-span-2 col-start-3  row-start-3">
                <CreatedOffers />
            </div>
            <div class="col-span-2 col-start-5 row-start-4 bg-orange-300">9</div>
        </div>
    </AdminLayout>

</template>