<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
</script>

<template>
    <AdminLayout>



        <div class="grid grid-cols-6 grid-rows-5 gap-4  p-10 px-[16rem]">
            <div class="col-span-4 bg-slate-300">

                1
            </div>
            <div class="col-start-5 bg-red-400 h-[200px]">2</div>
            <div class="col-start-6 bg-green-400">3</div>
            <div class="col-start-5 row-start-2 bg-blue-300">4</div>
            <div class="col-start-6 row-start-2 bg-rose-400">5</div>
            <div class="col-span-2 col-start-5 row-start-3 bg-indigo-500">6</div>
            <div class="col-span-4 row-span-2 col-start-1 row-start-2 bg-yellow-100">7</div>
            <div class="col-span-2 row-span-2 col-start-5 row-start-4 bg-violet-500">8</div>
            <div class="col-span-2 row-span-2 col-start-1 row-start-4 bg-orange-400">9</div>
            <div class="col-span-2 row-span-2 col-start-3 row-start-4 bg-cyan-300">10</div>
        </div>

    </AdminLayout>
</template>