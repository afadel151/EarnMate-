<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
})

</script>

<template>
    <Link :href="route('admin.messages.user',{id:props.user.id})">
        <div :class="route().current('admin.messages.user',{id:props.user.id}) ? 'bg-blue-400 text-gray-100' : 'bg-white'" class="py-3 px-2 w-full bg-white duration-300  shadow-md hover:scale-105 text-gray-500 hover:bg-slate-400 hover:text-white">
            <div class=" flex overflow-hidden   justify-start items-center">
                <p class="text-lg  font-bold">{{ props.user.email }}</p>
            </div>
        </div>
    </Link>
</template>