<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    href:String,
    icon:String,
    label:String
})
</script>

<template>
    <Link :href="route(`${props.href}`)" >
        <button class="w-full h-11 px-4  flex justify-start space-x-2 items-center  rounded-md"
         :class="route().current(`${props.href}`) ? 'bg-[#6366f2] hover:bg-[#484bf3] text-white' : 'text-gray-500 hover:bg-gray-100'">
            <i :class="`pi pi-${props.icon} `" >
            </i>
            <p class="text-lg dark:text-gray-200">{{ props.label }}</p>
        </button>
        
    </Link>
</template>
