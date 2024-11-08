<script setup>
import { Button, Menubar, SplitButton, Toast } from 'primevue';
import { useToast } from "primevue/usetoast";
const toast = useToast();
const items = [
    {
        label: 'Update',
        command: () => {
            this.$toast.add({ severity: 'success', summary: 'Updated', detail: 'Data Updated', life: 3000 });
        }
    },
    {
        label: 'Delete',
        command: () => {
            this.$toast.add({ severity: 'warn', summary: 'Delete', detail: 'Data Deleted', life: 3000 });
        }
    },
    {
        separator: true
    },
    {
        label: 'Quit',
        command: () => {
            window.location.href = 'https://vuejs.org/';
        }
    }
];

const save = () => {
    toast.add({ severity: 'success', summary: 'Success', detail: 'Data Saved', life: 3000 });
};
</script>

<template>
    <div id="app" class="w-screen   bg-home-bg bg-no-repeat bg-cover bg-[#0a1f59]">
        <div class="h-screen  w-full">
            <div class="w-screen h-28 flex justify-between items-center px-16  ">
                <img src="/svgs/logo.svg" width="200" alt="">
                <div class="flex justify-center items-center gap-3">
                    <Toast />
                    <Button variant="text" label="Advertise" severity="secondary" />
                    <Button variant="text" label="Advertise" severity="secondary" />
                    <Button variant="text" label="Advertise" severity="secondary" />
                    <Button variant="text" label="Advertise" severity="secondary" />
                    <Button rounded label="Log in" severity="success" />
                    <Button rounded label="Register" severity="success" outlined />
                </div>
            </div>
            <div class="w-screen  flex justify-center items-center px-72 h-[800px]  ">
                <div class="landing w-[50%]">
                    <h1
                        class="text-[80px]  head_title font-normal leading-[120%] bg-gradient-to-r from-white to-[#c886ff] bg-clip-text text-transparent mt-0 mb-4">
                        Play, watch, complete tasks and make money
                    </h1>
                    <p
                        class="text-[#f1e1ff] font-roboto-slab text-[24px] font-normal leading-[1.5] tracking-[1.44px] mb-10">
                        At Torox, we believe in connecting people from around the world. We work with apps, games, and
                        websites to enhance brands, provide monetization opportunities and expose users to great
                        content.</p>
                    <div class="w-full flex justify-start gap-3 items-center">
                        <Button size="large" rounded label="Get started" severity="success" />
                        <Button size="large" rounded label="Register" severity="secondary" outlined />
                    </div>
                </div>
                <video autoplay muted loop
                    class="object-contain overflow-cli brightness-110 h-[80%] w-[50%] p m-0 p-0 rounded-xl">
                    <source src="/vids/32s4zc_1.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="h-[600px] w-full">
            <p class="text-center text-gray-50 text-4xl">Why Us</p>
            <div class="w-full h-[400px] gap-10 mt-10 grid grid-cols-3  px-72">
                <div class="w-full p-10 flex flex-col justify-around items-stretch h-full rounded-3xl bg-[#0a1f59]">
                    <div class="top flex gap-[24px] box-border justify-center items-center">
                        <img class="item__icon" src="/svgs/traffic-1.svg" alt="Global and Direct Traffic">
                        <h3 class="text-2xl text-wrap font-old text-white">
                            Global and Direct Traffic </h3>
                    </div>
                    <p class="text-xl font-semibold text-[#f1e1ff]">At Torox, our primary focus is to deliver direct,
                        high-quality traffic to websites, apps, and
                        games on a global scale. By accessing a diverse and international audience, our clients gain the
                        advantage of tapping into new markets and expanding their global reach.</p>
                </div>
                <div class="w-full h-full p-10 rounded-3xl flex flex-col justify-around items-stretch bg-[#0a1f59]">
                    <div class="top flex gap-[24px] box-border justify-center items-center">
                        <img class="item__icon" src="/svgs/talk-1.svg" alt="Transparency and Responsivity">
                        <h3 class="text-2xl text-wrap font-old text-white">
                            Transparency and Responsivity </h3>
                    </div>
                    <p class="text-xl font-semibold text-[#f1e1ff]">At Torox, our primary focus is to deliver direct,
                        high-quality traffic to websites, apps, and
                        games on a global scale. By accessing a diverse and international audience, our clients gain the
                        advantage of tapping into new markets and expanding their global reach.</p>
                </div>
                <div class="w-full h-full p-10 rounded-3xl flex flex-col justify-around items-stretch bg-[#0a1f59]">
                    <div class="top flex gap-[24px] box-border justify-center items-center">
                        <img class="item__icon" src="/svgs/technology-1-1.svg" alt="In-house Technological Solutions">
                        <h3 class="text-2xl text-wrap font-old text-white">
                            In-house Technological Solutions </h3>
                    </div>
                    <p class="text-xl font-semibold text-[#f1e1ff]">At Torox, our primary focus is to deliver direct,
                        high-quality traffic to websites, apps, and
                        games on a global scale. By accessing a diverse and international audience, our clients gain the
                        advantage of tapping into new markets and expanding their global reach.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="w-screen pt-24    bg-home2-bg bg-no-repeat bg-cover bg-[#dddeff] ">
        <p class="text-5xl font-light text-center ">Achievments</p>
    </div>
</template>

<style scoped>
.head_title {
    font-family: "Figtree", sans-serif;
    font-optical-sizing: auto;
    font-weight: 800;
    font-style: normal;
}
</style>

<style>
::-webkit-scrollbar {
    display: none;
}
</style>