<script setup>
import { onMounted } from 'vue';
onMounted(() => {
    setInterval(() => {
        document.getElementById('path0').setAttribute('fill', '#fd777d');
    }, 800);
    setTimeout(() => {
        setInterval(() => {
            document.getElementById('path0').setAttribute('fill', '#2C2C44');
        }, 800);
    }, 400);

})
</script>
<template>
    <div class="flex bg-slate-100 rounded-xl flex-col space-y-1 justify-center w-full h-full items-center">

        <img src="/svgs/level10.svg" alt="">
        <img src="/svgs/level9.svg" alt="">
        <img src="/svgs/level8.svg" alt="">
        <img src="/svgs/level7.svg" alt="">
        <img src="/svgs/level6.svg" alt="">
        <img src="/svgs/level5.svg" alt="">
        <img src="/svgs/level4.svg" alt="">
        <img src="/svgs/level3.svg" alt="">

        <div class="hover:scale-110  h-fit relative flex items-center justify-center  w-fit">
            <svg class="ladder" preserveAspectRatio="none" width="190" height="40" viewBox="0 0 153 40" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.10021 7.87953C4.53627 5.37826 6.43821 2.99976 9.00226 2.99976H143.998C146.562 2.99976 148.464 5.37826 147.9 7.87953L142.94 29.8795C142.528 31.7039 140.908 32.9998 139.038 32.9998H13.9624C12.0923 32.9998 10.4717 31.7039 10.0604 29.8795L5.10021 7.87953Z"
                    fill="#2C2C44"></path>
                <path
                    d="M5.10021 7.87953C4.53627 5.37826 6.43821 2.99976 9.00226 2.99976H143.998C146.562 2.99976 148.464 5.37826 147.9 7.87953L142.94 29.8795C142.528 31.7039 140.908 32.9998 139.038 32.9998H13.9624C12.0923 32.9998 10.4717 31.7039 10.0604 29.8795L5.10021 7.87953Z"
                    fill="url(#paint0_linear_1262_217)" fill-opacity="0.15"></path>
                <path
                    d="M5.58797 7.76956C5.09451 5.58094 6.75871 3.49976 9.00226 3.49976H143.998C146.241 3.49976 147.905 5.58094 147.412 7.76956L142.452 29.7696C142.092 31.3659 140.674 32.4998 139.038 32.4998H13.9624C12.326 32.4998 10.9081 31.3659 10.5482 29.7696L5.58797 7.76956Z"
                    stroke="#9C9CC2" stroke-opacity="0.3"></path>
            </svg>
            <div class="absolute bottom-0 left-0 flex justify-center space-x-1  items-center h-full w-full">
                <svg width="12" height="10" viewBox="0 0 12 10" fill="#9C9CC2" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 6L6 -2.62268e-07L-1.21594e-06 6L1.4866 7.48659L6 2.97319L10.5134 7.4866L12 6Z"
                        fill="param(fill)" fill-opacity="0.7"></path>
                    <circle cx="5.99996" cy="7.91522" r="1.40179" fill="param(fill)" fill-opacity="0.7"></circle>
                </svg>
                <span class=" text-[#b3b3cb] left-[40%]">2000DA</span>
            </div>
        </div>
        <div class=" h-fit hover:scale-110  relative flex items-center justify-center  w-fit">
            <svg class="ladder" preserveAspectRatio="none" width="170" height="40" viewBox="0 0 153 40" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.10021 7.87953C4.53627 5.37826 6.43821 2.99976 9.00226 2.99976H143.998C146.562 2.99976 148.464 5.37826 147.9 7.87953L142.94 29.8795C142.528 31.7039 140.908 32.9998 139.038 32.9998H13.9624C12.0923 32.9998 10.4717 31.7039 10.0604 29.8795L5.10021 7.87953Z"
                    fill="#2C2C44"></path>
                <path
                    d="M5.10021 7.87953C4.53627 5.37826 6.43821 2.99976 9.00226 2.99976H143.998C146.562 2.99976 148.464 5.37826 147.9 7.87953L142.94 29.8795C142.528 31.7039 140.908 32.9998 139.038 32.9998H13.9624C12.0923 32.9998 10.4717 31.7039 10.0604 29.8795L5.10021 7.87953Z"
                    fill="url(#paint0_linear_1262_217)" fill-opacity="0.15"></path>
                <path
                    d="M5.58797 7.76956C5.09451 5.58094 6.75871 3.49976 9.00226 3.49976H143.998C146.241 3.49976 147.905 5.58094 147.412 7.76956L142.452 29.7696C142.092 31.3659 140.674 32.4998 139.038 32.4998H13.9624C12.326 32.4998 10.9081 31.3659 10.5482 29.7696L5.58797 7.76956Z"
                    stroke="#9C9CC2" stroke-opacity="0.3"></path>
            </svg>
            <div class="absolute bottom-0 left-0 flex justify-center space-x-1  items-center h-full w-full">
                <svg width="12" height="8" viewBox="0 0 12 8" fill="#b3b3cb" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 6L6 -2.62268e-07L-1.21594e-06 6L1.4866 7.48659L6 2.97319L10.5134 7.4866L12 6Z"
                        fill="param(fill)" fill-opacity="0.7"></path>
                </svg>
                <span class=" text-[#b3b3cb] left-[40%]">2000DA</span>
            </div>
        </div>
        <div class=" h-fit hover:scale-110  relative flex items-center justify-center   w-fit">
            <svg preserveAspectRatio="none" width="150" height="40" viewBox="0 0 150 40" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path id="path0"
                    d="M5.10021 7.87953C4.53627 5.37826 6.43821 2.99976 9.00226 2.99976H143.998C146.562 2.99976 148.464 5.37826 147.9 7.87953L142.94 29.8795C142.528 31.7039 140.908 32.9998 139.038 32.9998H13.9624C12.0923 32.9998 10.4717 31.7039 10.0604 29.8795L5.10021 7.87953Z"
                    fill="#2C2C44"></path>
                <path
                    d="M5.10021 7.87953C4.53627 5.37826 6.43821 2.99976 9.00226 2.99976H143.998C146.562 2.99976 148.464 5.37826 147.9 7.87953L142.94 29.8795C142.528 31.7039 140.908 32.9998 139.038 32.9998H13.9624C12.0923 32.9998 10.4717 31.7039 10.0604 29.8795L5.10021 7.87953Z"
                    fill="url(#paint0_linear_1262_217)" fill-opacity="0.15"></path>
                <path
                    d="M5.58797 7.76956C5.09451 5.58094 6.75871 3.49976 9.00226 3.49976H143.998C146.241 3.49976 147.905 5.58094 147.412 7.76956L142.452 29.7696C142.092 31.3659 140.674 32.4998 139.038 32.4998H13.9624C12.326 32.4998 10.9081 31.3659 10.5482 29.7696L5.58797 7.76956Z"
                    stroke="#9C9CC2" stroke-opacity="0.3"></path>
            </svg>
            <div class="absolute bottom-0 left-0 flex justify-center items-center h-full w-full">
                <span class=" text-[#b3b3cb] left-[40%]">1000DA</span>
            </div>
        </div>
    </div>
</template>
