<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { Button, Toast, useToast } from 'primevue';
import store from '@/stores/tokenStore';
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
    _token: usePage().props.auth.crsf
});
const toast = useToast();
 
const submit = async  () => {
    try {
        let response = await axios.post('/login', {...form})
        store.state.user.token = response.data;
        router.visit(route('dashboard'));
    } catch (error) {
        form.reset();
        toast.add({ severity: 'error', summary: 'Error', detail: 'Incorrect cridentials', life: 3000 });
    }
};
</script>

<template>
    <GuestLayout>
        <Toast />
        <Head title="Log in" />      
        <div class="flex md:flex-row flex-col justify-center items-center md:space-x-36 md:px-[15%] w-full h-fit">
            <div class="flex flex-col justify-center w-[60%] h-full text-[#6a38ff]">
                <p class="font-bold text-black text-lg">Log in</p>
                <p class="text-6xl md:text-7xl">Acess your account</p>
                <p class="font-black text-7xl md:text-8xl">and explore our service</p>
                <p></p>
            </div>

            <form @submit.prevent="submit" class="flex flex-col justify-between items-center space-y-5 border-2 shadow-custom-purple mt-10 md:mt-0 py-10 md:py-5 pb-5 md:pb-10 rounded-2xl w-[80%] md:w-[40%] h-full">
                <a href="/auth/google/redirect" class="px-10 w-full"><Button class="mt-5 w-full" icon="pi pi-google" label="Google"  severity="help" /></a>
               


                <div class="px-10 w-full">
                    <InputLabel for="email" class="text-xl" value="Your e-mail" />

                    <TextInput id="email" type="email" class="block mt-1 w-full" v-model="form.email" required autofocus
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="px-10 w-full">
                    <InputLabel for="password" class="text-xl" value="password" />

                    <TextInput id="password" type="password" class="block mt-1 w-full" v-model="form.password" required
                        autocomplete="current-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block px-10 w-full">
                    <label class="flex items-center">
                        <Checkbox name="remember" :checked="form.remember" />
                        <span class="text-gray-600 text-sm ms-2">Remember me</span>
                    </label>
                </div>

                <div class="flex justify-end items-center mt-4 px-10 w-full">
                    <Button class="ms-4" size="large" :class="{ 'opacity-25': form.processing }" @click="submit" label="Submit"  severity="help" :disabled="form.processing"/>
                       
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
