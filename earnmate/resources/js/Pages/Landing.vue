<script setup>
import { Button } from 'primevue';
import Acheivments from '@/Components/Acheivments.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
import $ from "jquery";
import Services from '@/Components/Services.vue';
import Partners from '@/Components/Partners.vue';
import Footer from '@/Components/Footer.vue';

</script>

<template>
    <div id="app" class="w-screen   bg-home-bg bg-no-repeat bg-cover bg-[#0a1f59]">
        <div class="h-fit mb-10   w-full">
            <div
                class="w-screen md:border-b-0 border-b-2 border-indigo-500    h-28 flex justify-between items-center md:px-16  px-10 ">
                <img src="/svgs/logo.svg" width="200" alt="">
                <div class="md:hidden block">

                    <Button @click="$('#menu').slideToggle()" severity="secondary" icon="pi  pi-align-justify"
                        size="l/arge" variant="text" />
                </div>
                <div class="md:flex justify-center  hidden items-center gap-3">
                    <Button variant="text" size="large" label="Advertise" severity="secondary" />
                    <Button variant="text" size="large" label="Advertise" severity="secondary" />
                    <Button variant="text" size="large" label="Advertise" severity="secondary" />
                    <Button variant="text" size="large" label="Advertise" severity="secondary" />

                </div>

            </div>
            <div id="menu" class="hidden mt-5 ">
                <div class="md:hidden  justify-center flex  items-center flex-col w-full  gap-3">
                    <Button variant="text" size="large" label="Why us" severity="secondary" />
                    <Button variant="text" size="large" label="Achievments" severity="secondary" />
                    <Button variant="text" size="large" label="Testimonals" severity="secondary" />
                    <Button variant="text" size="large" label="Advertise" severity="secondary" />
                </div>
            </div>
            <div
                class="w-screen md:mt-0 mt-20 px-10 md:flex-row flex-col space-y-3 flex justify-center items-center md:px-72 md:h-[800px]  ">
                <div class="landing md:w-[50%]">
                    <h1
                        class="md:text-[80px] text-[60px]  head_title font-normal leading-[120%] bg-gradient-to-r from-white to-[#c886ff] bg-clip-text text-transparent mt-0 mb-4">
                        Play, watch, complete tasks and make money
                    </h1>
                    <p
                        class="text-[#f1e1ff] md:mt-0 mt-5 font-roboto-slab text-[24px] font-normal leading-[1.5] tracking-[1.44px] mb-10">
                        At Toro, we believe in connecting people from around the world. We work with apps, games, and
                        websites to enhance brands, provide monetization opportunities and expose users to great
                        content.</p>
                    <div v-if="canLogin" class="w-full md:mt-0 mt-20 flex justify-start gap-3 items-center">
                        <Link v-if="usePage().props.auth.user" :href="route('dashboard')">
                        <button
                            class="bg-[#b7f763] transition-all duration-200 hover:text-white hover:bg-violet-600 text-black font-['GeneralSans-Medium']  text-xl p-4 rounded-full">
                            Dashboard </button>
                        </Link>
                        <template v-else>
                            <Link :href="route('login')">
                            <button
                                class="bg-[#b7f763] transition-all duration-200 hover:text-white hover:bg-violet-600 text-black font-['GeneralSans-Medium']  text-xl p-4 rounded-full">
                                Get Started </button>
                            </Link>
                            <Link v-if="canRegister" :href="route('register')">

                            <button
                                class="border-[#b7f763] border-2 transition-all duration-200 hover:border-transparent  text-[#b7f763] hover:text-white hover:bg-violet-600 font-['GeneralSans-Medium']  text-xl p-4 rounded-full">
                                Register </button>
                            </Link>
                        </template>

                    </div>
                    <div v-else class="w-full md:mt-0 mt-20 flex justify-start gap-3 items-center">

                    </div>

                </div>
                <video autoplay muted loop
                    class="object-contain overflow-cli brightness-110 md:h-[80%] md:w-[50%] p m-0 p-0 rounded-xl">
                    <source src="/vids/32s4zc_1.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="md:h-[600px] h-[1400px] px-10 w-full">
            <p class="text-center text-gray-50 text-4xl">Why Us</p>
            <div class="w-full h-[400px] gap-10 mt-10 grid md:grid-cols-3  md:px-72">
                <div class="w-full p-10 flex flex-col justify-around items-stretch h-full rounded-3xl bg-[#0a1f59]">
                    <div class="top flex gap-[24px] box-border justify-center items-center">
                        <img class="item__icon" src="/svgs/traffic-1.svg" alt="Global and Direct Traffic">
                        <h3 class="text-2xl text-wrap font-old text-white">
                            Global and Direct Traffic </h3>
                    </div>
                    <p class="text-xl font-semibold text-[#f1e1ff]">At Toro, our primary focus is to deliver direct,
                        high-quality traffic to websites, apps, games,youtube and telegram channels, and
                        many social media platforms on a global scale. By accessing a diverse and international
                        audience, our
                        clients gain the
                        advantage of tapping into new markets and expanding their global reach.</p>
                </div>
                <div class="w-full h-full p-10 rounded-3xl flex flex-col justify-around items-stretch bg-[#0a1f59]">
                    <div class="top flex gap-[24px] box-border justify-center items-center">
                        <img class="item__icon" src="/svgs/talk-1.svg" alt="Transparency and Responsivity">
                        <h3 class="text-2xl text-wrap font-old text-white">
                            Transparency and Responsivity </h3>
                    </div>
                    <p class="text-xl font-semibold text-[#f1e1ff]">We believe that transparency and responsiveness are
                        the
                        cornerstone of building successful and fruitful partnerships. Our company places great emphasis
                        on
                        fostering open communication and a clear understanding of expectations between ourselves and our
                        clients, partners and users..</p>
                </div>
                <div class="w-full h-full p-10 rounded-3xl flex flex-col justify-around items-stretch bg-[#0a1f59]">
                    <div class="top flex gap-[24px] box-border justify-center items-center">
                        <img class="item__icon" src="/svgs/technology-1-1.svg" alt="In-house Technological Solutions">
                        <h3 class="text-2xl text-wrap font-old text-white">
                            In-house Technological Solutions </h3>
                    </div>
                    <p class="text-xl font-semibold text-[#f1e1ff]">With our in-house technological solutions, we have
                        gained a
                        competitive edge that allows us to deliver comprehensive services without compromising on
                        quality. By
                        having our own specialized tools and resources, we can streamline our processes, optimize
                        efficiency,
                        and maintain control over the service delivery chain..</p>
                </div>
            </div>
        </div>
        <div class="bg-white">
            <Acheivments />
            <Services />
            <Partners />
        </div>
        <Footer />
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