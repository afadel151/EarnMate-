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
    <div class="w-screen  bg-home-bg bg-no-repeat bg-cover bg-[#0a1f59]">
        <div class="h-screen w-full">
            <div class="w-screen h-16 flex justify-between items-center px-16  ">
                <img src="/svgs/logo.svg" width="100" alt="">
                <div class="flex justify-center items-center gap-2">
                    <Toast />
                    <Button size="small" variant="text" label="Advertise" severity="secondary" />
                    <Button size="small" variant="text" label="Advertise" severity="secondary" />
                    <Button size="small" variant="text" label="Advertise" severity="secondary" />
                    <Button size="small" variant="text" label="Advertise" severity="secondary" />
                    <Button size="small" rounded label="Login" severity="success" />
                    <Button size="small" rounded label="Register" severity="success" outlined />
                </div>
            </div>
            <div class="w-screen bg flex justify-center items-center px-16 h-[500px]  ">
                <div class="landing">
                    <h1 class="text-[60px]  head_title font-normal leading-[120%] bg-gradient-to-r from-white to-[#c886ff] bg-clip-text text-transparent mt-0 mb-4">
                        Play, watch, complete tasks and make money 
                    </h1>
                </div>
                <video  autoplay muted loop class="object-contain overflow-cli h-[80%] w-[50%] p m-0 p-0 rounded-xl">
                    <source src="/vids/D-home-2-Fixed.mp4" type="video/mp4">
                </video>
            </div>
        </div>
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