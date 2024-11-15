<script setup>
const props = defineProps({
    code: String
})
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { Button } from 'primevue';
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    code: props.code
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

</script>

<template>
    <GuestLayout>
        <div class="w-full h-[70%] flex justify-center items-center space-x-36 px-[400px] ">
            <div class="flex flex-col w-[60%] text-[#6a38ff] justify-center  h-full">
                <p class="font-bold text-lg text-black">Register</p>
                <p class="text-6xl">Register and enjoy</p>
                <p class="text-7xl font-black">all the benefits our platform has to offer.</p>
                <p></p>
            </div>

            <form @submit.prevent="submit"
                class="w-[50%] shadow-custom-purple border-2 rounded-2xl flex flex-col justify-around py-20 items-center  h-full">
                <div class="flex justify-between w-full px-10">
                    <p class="text-4xl font-bold">Register</p>
                    <p class="text-xl font-semibold "> Already registered ? <br><span
                            class="underline text-end text-indigo-500">Log in</span></p>
                </div>
                <div class="w-full px-10">
                    <InputLabel for="name" value="Name" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4 w-full px-10">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4 w-full px-10">
                    <InputLabel for="password" value="Password" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4 w-full px-10">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" required autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="mt-4 w-full px-10 flex items-center justify-end">
                    <Link :href="route('login')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Already registered?
                    </Link>

                    <Button type="submit" class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        label="Register" severity="help" size="large" />

                </div>
            </form>
        </div>
    </GuestLayout>
</template>
