<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { Button } from 'primevue';
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

const submit =async  () => {
    try {
        let response = await axios.post('/login', {...form})
        console.log(response.data);
        store.state.user.token = response.data;
        router.visit(route('dashboard'));
    } catch (error) {
        console.log(error);
    }
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />      
        <div class="w-full h-[75%] flex md:flex-row flex-col justify-center items-center md:space-x-36 md:px-[400px] ">
            <div class="flex flex-col w-[70%] text-[#6a38ff] justify-center  h-full">
                <p class="font-bold text-lg text-black">Log in</p>
                <p class="md:text-7xl text-6xl">Acess your account</p>
                <p class="md:text-8xl text-7xl font-black">and explore our service</p>
                <p></p>
            </div>
            <form @submit.prevent="submit" class="md:w-[50%] w-[80%] shadow-custom-purple border-2 rounded-2xl flex space-y-5 md:mt-0 mt-10 flex-col justify-around md:py-5 py-10 items-center md:pb-10 pb-5  h-full">
                <a href="/auth/google/redirect" class="w-full px-10"><Button class="w-full mt-5 " icon="pi pi-google" label="continue with Google"  severity="help" /></a>
                <a href="/auth/google/redirect" class="w-full px-10"><Button class="w-full  " icon="pi pi-facebook" label="continue with Facebook"  severity="info" /></a>

                <div class="w-full px-10">
                    <InputLabel for="email" class="text-xl" value="Your e-mail" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class=" w-full px-10">
                    <InputLabel for="password" class="text-xl" value="password" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="current-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class=" block w-full px-10">
                    <label class="flex items-center">
                        <Checkbox name="remember" :checked="form.remember" />
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="mt-4 flex items-center w-full px-10 justify-end">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Forgot your password?
                    </Link>

                    <Button class="ms-4" size="large" :class="{ 'opacity-25': form.processing }" @click="submit" label="Log in"  severity="help" :disabled="form.processing"/>
                       
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
