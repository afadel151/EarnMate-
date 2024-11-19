<script setup>
import { onMounted, ref } from 'vue';

const csrf = ref(document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : '');
onMounted(()=>{
    if (!csrf) {
            console.warn('The CSRF token is missing. Ensure that the HTML header includes the following: <meta name="csrf-token" content="{{ csrf_token() }}">');
    }
})
</script>

<template>
     <input type="hidden" name="_token" :value="csrf">
</template>