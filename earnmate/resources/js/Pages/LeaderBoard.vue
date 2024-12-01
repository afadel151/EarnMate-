<script setup>
import MyLayout from '@/Layouts/MyLayout.vue';


</script>


<template>
    <MyLayout>
        <div class="relative w-full z-0 p-10 pt-36 md:px-[25rem]">
            <div class="absolute -z-10  h-52 w-52 top-10 right-[45%] bg-violet-500 rounded-full blur-[200px] ">
            </div>
            <div class="z-30 w-full h-full">
                <div class="h-72  flex justify-center px-10 space-x-1 items-end w-full">
                    <div class="h-40  w-52 rounded-t-xl border-t border-x border-slate-200 bg-violet-100">

                    </div>
                    <div class="h-72 w-52 rounded-t-xl border-t border-x border-slate-400 bg-violet-300">

                    </div>
                    <div class="h-52 w-52 rounded-t-xl border-t border-x border-slate-300 bg-violet-200">

                    </div>

                </div>
                <div class="h-[1000px] w-full bg-indigo-200 mb-8 rounded-xl">

                </div>
            </div>
        </div>

    </MyLayout>
</template>