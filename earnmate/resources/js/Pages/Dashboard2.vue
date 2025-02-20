<script setup>
import MyLayout from "@/Layouts/MyLayout.vue";
import { ref, onMounted, computed } from "vue";
const props = defineProps({
    friends: Number,
    tasks: Array,
    bonus: Number,
    user: Object,
    offer: Object,
    level: Object,
    invite_offer: Object,
    invited: Number,
    primary_tasks: Array
});

onMounted(() => {
    fetchWithdrawals();
    calculateRemainingTime();
    setInterval(calculateRemainingTime, 1000);
});

const setChartData = () => {
    return {
        labels: ["Q1", "Q2", "Q3", "Q4", "Q5", "Q6", "Q6", "Q6", "Q6"],
        datasets: [
            {
                label: "earnings",
                data: [325, 702, 620, 900, 230, 230, 230, 230, 10],
                borderWidth: 1,
                tension: 0.4,
            },
        ],
    };
};
const chartOptions = ref({
    responsive: true,
    plugins: {
        legend: {
            display: true,
            position: 'top',
        },
    },
    scales: {
        x: {
            title: {
                display: true,
                text: 'Weeks',
            },
        },
        y: {
            title: {
                display: true,
                text: 'Amount Withdrawn',
            },
        },
    },
});
const fetchWithdrawals = async () => {
    try {
        const response = await axiosClient.get('/user/withdrawals'); // Adjust API endpoint
        const data = response.data;

        chartData.value = {
            labels: data.map(item => item.week),
            datasets: [
                {
                    label: 'Withdrawals',
                    data: data.map(item => item.total),
                    borderColor: '#42A5F5',
                    tension: 0.4,
                },
            ],
        };
    } catch (error) {
        console.error('Error fetching withdrawals:', error);
    }
};
const primaryTasks = ref(props.primary_tasks);
const visibleTasks = computed(() => tasks.value.slice(0, 5));
const completeTask = (taskId) => {
    const taskIndex = tasks.value.findIndex((task) => task.id === taskId);
    if (taskIndex !== -1) {
        tasks.value.splice(taskIndex, 1);
    }
};
const completePrimaryTask = (taskId) =>
{
    const taskIndex = primaryTasks.value.findIndex((task) => task.id === taskId);
    if (taskIndex !== -1) {
        primaryTasks.value.splice(taskIndex, 1);
    }
}


const tasks = ref(props.tasks);
import Chart from "primevue/chart";
import InvieDialog from "@/Components/InviteDialog.vue";
import { Button } from "primevue";
import ConfirmTask from "@/Components/ConfirmTask.vue";
import OfferSubscribe from "@/Components/OfferSubscribe.vue";
function getPlatformColor(platform) {
    if (platform == "youtube") {
        return "#ff0033";
    } else if (platform == "telegram") {
        return "#3491ed";
    } else if (platform == "facebook") {
        return "#0a68ff";
    } else if (platform == "twitter") {
        return "#46a5e0";
    } else if (platform == "discord") {
        return "#4e61ed";
    } else if (platform == "snapchat") {
        return "#edd900";
    } else if (platform == "instagram") {
        return "#d62d76";
    }
}

const chartData = ref([]);
const offer = props.offer; // Assuming the single offer is passed as `offer`
const remainingTime = ref(null);

const calculateRemainingTime = () => {
    if (props.offer) {
        const startDateTime = new Date(`${offer.start_date}T${offer.start_time}`);
        const now = new Date();
        const difference = startDateTime - now;

        if (difference > 0) {
            const days = Math.floor(difference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((difference / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((difference / (1000 * 60)) % 60);
            const seconds = Math.floor((difference / 1000) % 60);
            remainingTime.value = { days, hours, minutes, seconds };
        } else {
            remainingTime.value = null;
        }
    }
};
import { usePriceStore } from "@/stores/priceStore";
import axiosClient from "@/axios";
import { Link } from "@inertiajs/vue3";
import ConfirmPrimaryTask from "@/Components/ConfirmPrimaryTask.vue";
const priceStore = usePriceStore();

</script>
<template>
    <MyLayout>
        <div
            class="md:grid grid-cols-4 grid-rows-[1.5fr_1.2fr_1fr_1fr_1fr_1fr] md:gap-4  px-5 flex flex-col space-y-5  md:py-10 md:px-[12rem] ">
            <div class="col-span-4 flex flex-col space-y-6 md:block " :class="props.offer ? 'h-72' : ''">
                <div v-if="!props.offer && !props.invite_offer"
                    class="w-full backdrop-blur-md bg-white/80 shadow-md flex justify-center items-center rounded-md h-full">
                    <p class="text-xl text-gray-500">
                        No offer for today
                    </p>
                </div>
                <div v-else-if="props.offer"
                    class="w-full backdrop-blur-md  justify-between bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white shadow-lg md:p-8 px-1 flex  items-center rounded-lg md:space-x-8 h-full">
                    <!-- Left Image Section -->

                    <div class="space-y-4">
                        <p class="md:text-5xl text-2xl font-bold">
                            🎉 {{ props.offer.percentage }}% profit in {{ props.offer.days }} days!
                        </p>
                        <p class="md:text-3xl text-2xl">
                            🚀 User Limit: <span class="font-semibold">{{ props.offer.fake_max_users }}</span>
                        </p>
                        <p class="md:text-2xl text-xl">
                            💵 Amount : <span class="font-semibold"> ${{ props.offer.required_amount }}</span>
                        </p>
                        <p class="md:text-2xl text-xl">
                            💳 Payment Method:
                            <span class="font-semibold">
                                {{ props.offer.method == 'all' ? 'All Methods' : 'Only ' + props.offer.method }}
                            </span>
                        </p>
                    </div>
                    <div class="md:flex hidden flex-col justify-center items-center space-y-6">
                        <div v-if="remainingTime" class="text-center">
                            <p class="text-4xl font-bold">⏳ Starts In:</p>
                            <p class="text-3xl font-mono">
                                {{ remainingTime.days }}d {{ remainingTime.hours }}h
                                {{ remainingTime.minutes }}m {{ remainingTime.seconds }}s
                            </p>
                        </div>
                        <OfferSubscribe :offer="props.offer" />
                    </div>

                </div>
                <div v v-if="props.invite_offer"
                    class="w-full backdrop-blur-md  justify-between bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white shadow-lg md:p-8 px-1 md:py-0 py-4 flex  items-center rounded-lg md:space-x-8 h-full">
                    <div class="space-y-4">
                        <p class="md:text-5xl text-2xl font-bold">
                            🎉 Invitation Offer
                        </p>
                        <p class="md:text-3xl text-2xl">
                            Invite <span class="font-semibold">{{ props.invite_offer.invite }}</span> active Persons ,
                            You are currently inviting {{ props.invited }}
                        </p>
                        <p class="md:text-2xl text-xl">
                            Get : <span class="font-semibold"> ${{ props.invite_offer.invite }}</span> 💵
                        </p>
                    </div>
                </div>
                <div class="flex md:hidden flex-col justify-center items-center space-y-6">
                    <div v-if="remainingTime" class="text-center">
                        <p class="text-4xl font-bold">⏳ Starts In:</p>
                        <p class="text-3xl font-mono">
                            {{ remainingTime.days }}d {{ remainingTime.hours }}h
                            {{ remainingTime.minutes }}m {{ remainingTime.seconds }}s
                        </p>
                    </div>
                    <OfferSubscribe v-if="props.offer" :offer="props.offer" />
                </div>
            </div>

            <div class="row-start-2">
                <div
                    class="rounded-md relative md:py-5  md:pr-0 p-5 md:pl-5 backdrop-blur-sm h-full bg-white/80 dark:bg-slate-800/80 md:space-y-2  space-y-3 shadow-md flex flex-col justify-between items-start">
                    <div class="h-12 flex justify-start items-center w-full space-x-2">
                        <span class="avatar-initial rounded bg-[#eafae1] dark:bg-[#242f1e] w-14 h-14 flex justify-center items-center">
                            <box-icon name="money-withdraw" color="#72de37" size="md"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500 dark:text-gray-300">Balance</p>
                    </div>
                    <p class="text-2xl font-bold text-gray-600 dark:text-gray-200">${{ props.user.balance }}</p>
                    <p class="font-bold text-gray-500 dark:text-gray-300"> ≈ {{ props.user.balance * priceStore.price }} DZD</p>

                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md md:py-5  md:pr-0 p-5 md:pl-  justify-between backdrop-blur-sm h-full bg-white/80 dark:bg-slate-800/80  md:space-y-2  space-y-3 shadow-md flex flex-col  items-start">
                    <div class="h-12 flex justify-start items-center w-full space-x-2">
                        <span class="avatar-initial rounded bg-[#f5e38829] w-14 h-14 flex justify-center items-center">
                            <box-icon type="solid" name="star" color="#fbed53" size="md"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500 dark:text-gray-300">Current Level</p>
                    </div>

                    <p class="text-2xl text-gray-600 font-bold dark:text-gray-300">{{ props.level != 'No_subscription' ? 'Level ' +
                        props.level.level.level_number : 'Unsubscribed' }}</p>
                    <Link :href="route('statistics')">

                    <p class="text-2xl text-gray-600 dark:text-gray-400">
                        <i class="pi pi-arrow-right mr-5 text-red-400 hover:translate-x-2 duration-200"></i>
                        See other levels
                    </p>
                    </Link>
                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md relative md:py-5  md:pr-0 p-5 md:pl-  justify-between backdrop-blur-sm h-full bg-white/80 dark:bg-slate-800/80  md:space-y-2  space-y-3 shadow-md flex flex-col  items-start">
                    <div class="h-12 flex justify-start items-center w-full space-x-2">
                        <span class="avatar-initial rounded bg-[#6b6de61b] w-10 h-10 flex justify-center items-center">
                            <box-icon name="user-plus" color="blue" size="sm"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500 dark:text-gray-300">Invited friends</p>
                    </div>

                    <p class="text-2xl font-bold text-gray-600 dark:text-gray-400">
                        {{ props.friends }} FRIENDS
                    </p>

                    <div class="absolute top-6 right-8">
                        <InvieDialog />
                    </div>
                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md  md:py-5  md:pr-0 p-5 md:pl- justify-between backdrop-blur-sm dark:bg-slate-800/80 h-full bg-white/80 md:space-y-2  space-y-3 shadow-md flex flex-col  items-start">
                    <div class="h-12 flex justify-start items-center w-full space-x-2">
                        <span class="avatar-initial rounded bg-[#fcf9eb] w-10 h-10 flex justify-center items-center">
                            <box-icon type="solid" name="gift" color="#faec55" size="sm"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500 dark:text-gray-300">Bonus</p>
                    </div>
                    <p class="text-2xl font-bold text-gray-600 dark:text-gray-400">{{ props.bonus }}</p>

                </div>
            </div>
            <div
                class="col-span-2 p-6 backdrop-blur-sm bg-white/80 dark:bg-slate-800/80 rounded-md py-10 shadow-md flex justify-between flex-col items-center row-span-6 col-start-3 row-start-3">
                <div class="w-full flex flex-col md:space-y-2  space-y-3 items-start justify-start h-full">
                    <div class="flex flex-col h-full w-full items-stretch md:space-y-2  space-y-3 justify-start">
                        <div class="h-12 flex justify-start items-center w-full space-x-2">
                            <span
                                class="avatar-initial rounded bg-[#e8e8ff] w-14 h-14 flex justify-center items-center">
                                <!-- <box-icon type='solid' name='star' ></box-icon> -->
                                <box-icon type='solid' color="#a2a1ff" size="md" name='calendar-star'></box-icon>
                            </span>
                            <p class="text-2xl text-gray-500 dark:text-gray-300">
                                Primary Tasks
                            </p>
                        </div>
                        <div v-for="task in primaryTasks" :key="task.id"
                            class="w-full  border-b h-20 flex justify-between items-center rounded-md">

                          
                                <p class="text-2xl text-gray-500 ">
                                    {{ task.description }}
                                </p>
                            <div class="items-center   flex space-x-2">
                                <Button label="Go" as="a" v-if="task.link != null" :href="task.link" target="_blank" rel="noopener"
                                    icon="pi pi-angle-double-right" />
                                <ConfirmPrimaryTask :task_id="task.id" @primary_task_confirmed="completePrimaryTask(task.id)" />
                            </div>
                        </div>
                    </div>  

                </div>
            </div>
            <div
                class="col-span-2 backdrop-blur-sm rounded-md bg-white/80 dark:bg-slate-800/80 shadow-md row-span-6 col-start-1 row-start-3">
                <div class="flex flex-col h-full px-10 p-6 items-stretch space-y-10 justify-start">
                    <div class="h-12 mt-4 flex justify-start items-center w-full space-x-2">
                        <span class="avatar-initial rounded bg-[#f5918829] w-14 h-14 flex justify-center items-center">
                            <!-- <box-icon type='solid' name='star' ></box-icon> -->
                            <box-icon name="task" color="red" size="md"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500 dark:text-gray-300">On going Tasks</p>
                    </div>
                    <div v-if="visibleTasks.length == 0 || props.user.current_level == 'No_subscription'"
                        class="h-full w-full flex justify-center items-center">
                        <p class="text-2xl text-gray-500 text-center">
                            No available tasks for now, Subscribe to a level to get something to do
                        </p>
                    </div>
                    <div v-else v-for="task in visibleTasks" :key="task.id"
                        class="w-full border-b h-20 flex justify-between items-center rounded-md">
                        <span class="avatar-initial rounded  w-14 h-14 flex justify-center items-center">
                            <box-icon :name="`${task.platform}`" :color="getPlatformColor(task.platform)" type="logo"
                                size="lg"></box-icon>
                        </span>
                        <div class="w-[50%] flex justify-between">
                            <p class="text-2xl text-gray-500 w-[50%]">
                                {{ task.type }}
                            </p>
                        </div>
                        <div class="items-center flex space-x-2">
                            <Button label="Go" as="a" :href="task.link" target="_blank" rel="noopener"
                                icon="pi pi-angle-double-right" />
                            <ConfirmTask :task_id="task.id" @task_confirmed="completeTask(task.id)" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </MyLayout>
</template>
