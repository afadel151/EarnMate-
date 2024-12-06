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
const country = ref(null);
const city = ref(null);
const dzFlag = ref(false);
onMounted(() => {
    $.get("https://ipinfo.io", function (response) {
        country.value = response.country;
        if (response.country == 'DZ') {
            dzFlag.value = true;
        }
        city.value = response.city
    }, "jsonp");
});
import $ from 'jquery';
import { onMounted, ref } from 'vue';
const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';

</script>

<template>
    <GuestLayout>
        <div class="w-full h-[75%] flex md:flex-row flex-col justify-center items-center md:space-x-36 md:px-[400px] ">
            <div class="flex flex-col w-[70%] text-[#6a38ff] justify-center  h-full">
                <p class="font-bold text-lg text-black">Register</p>
                <p class="md:text-7xl text-6xl">Register and enjoy</p>
                <p class="md:text-8xl text-7xl font-black">all the benefits our platform has to offer.</p>
                <p></p>
            </div>
            <form @submit.prevent="submit"
                class="md:w-[50%] w-[80%] shadow-custom-purple border-2 py-5 rounded-2xl flex flex-col justify-around md:mt-0 mt-10   items-center  h-full">
                <a href="/auth/google/redirect" class="w-full px-10"><Button class="w-full mt-5 " icon="pi pi-google"
                        label="continue with Google" severity="help" /></a>
                <a href="/auth/facebook/redirect" class="w-full px-10"><Button class="w-full mt-5 " icon="pi pi-facebook"
                        label="continue with Facebook" severity="info" /></a>
               
                <div class="w-full mt-5 px-10">
                    <InputLabel for="name" value="Name" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-3 w-full px-10">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-3 w-full px-10">
                    <InputLabel for="password" value="Password" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-3 w-full px-10">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" required autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>
                
                <div class="mt-3 w-full px-10">
                    <InputLabel for="password_confirmation" value="Location" />
                <InputGroup class="mt-1 block w-full">
                    
                    <InputGroupAddon>
                        <i class="pi pi-map-marker"></i>
                    </InputGroupAddon>
                    <div class="flex pl-5 items-center w-full border-2 bg-[#ffffff]">
                        <img :src="`https://flagsapi.com/${country}/flat/32.png`">
                    <!-- <img src="" v-else alt=""> -->
                    <div>{{ city }}</div>
                </div>
                </InputGroup>
            </div>
                <div class="mt-4 w-full px-10 flex items-center justify-end">
                    <Link :href="route('login')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Already registered?
                    </Link>

                    <Button type="submit" class="ms-4" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing" label="Register" severity="help" size="large" />

                </div>

            </form>
        </div>
    </GuestLayout>
</template>
