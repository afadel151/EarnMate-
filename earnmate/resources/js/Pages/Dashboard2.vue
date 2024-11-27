<script setup>
import MyLayout from "@/Layouts/MyLayout.vue";
import { ref, onMounted, computed } from "vue";
const props = defineProps({
    friends: Number,
    tasks: Array,
    bonus:Number,
    user:Object
})


onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    return {
        labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q6', 'Q6', 'Q6'],
        datasets: [
            {
                label: 'earnings',
                data: [325, 702, 620, 900, 230, 230, 230, 230, 10],
                borderWidth: 1,
                tension: 0.4,

            }
        ]
    };
};
const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--p-text-color');
    const textColorSecondary = documentStyle.getPropertyValue('--p-text-muted-color');
    const surfaceBorder = documentStyle.getPropertyValue('--p-content-border-color');

    return {
        plugins: {
            legend: {
                display: false,
                labels: {
                    color: textColor
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder,
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder
                }
            }
        }
    };
}
const visibleTasks = computed(() => tasks.value.slice(0, 5));
const completeTask = (taskId) => {
    const taskIndex = tasks.value.findIndex((task) => task.id === taskId);
    if (taskIndex !== -1) {
        tasks.value.splice(taskIndex, 1); 
    }
};

const tasks = ref(props.tasks);
import Chart from "primevue/chart";
import Withdraw from "@/Components/Withdraw.vue";
import InvieDialog from "@/Components/InviteDialog.vue"
import { Button } from "primevue";
import ConfirmTask from "@/Components/ConfirmTask.vue";
function getPlatformColor(platform) {
    if (platform == 'youtube') {
        return '#ff0033';
    } else if (platform == 'telegram') {
        return '#3491ed';
    }
    else if (platform == 'facebook') {
        return '#0a68ff';
    }
    else if (platform == 'twitter') {
        return '#46a5e0';
    }
    else if (platform == 'discord') {
        return '#4e61ed';

    }
}
</script>
<template>
    <MyLayout>
        
        <div
            class="grid grid-cols-4 grid-rows-[0.5fr_1fr_1fr_1fr_1fr_1fr]  gap-4 min-h-screen py-10 px-[12rem] h-screen ">
            <div class="col-span-4   ">
                <div
                    class="w-full backdrop-blur-md bg-white/80 shadow-sm flex justify-center items-center rounded-md h-full">
                    <p class="text-3xl">
                        Dear users , we discovered a bad behaviour
                    </p>
                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md relative p-2  backdrop-blur-sm h-full bg-white/80   md:pl-5 space-y-1   shadow-sm flex flex-col justify-center items-start">
                    <div class="h-12 flex justify-start items-center w-full  space-x-2">
                        <span class="avatar-initial rounded bg-[#eafae1] w-14  h-14 flex justify-center items-center">
                            <box-icon name='money-withdraw' color='#72de37' size="md"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500">Balance</p>
                    </div>
                    <p class="text-2xl font-bold text-gray-600">2800 DA</p>
                    <p class="text-green-400 text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i>
                        150
                    </p>

                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md p-2  backdrop-blur-sm h-full bg-white/80  md:pl-5 space-y-1   shadow-sm flex flex-col justify-center items-start ">
                    <div class="h-12 flex justify-start items-center w-full  space-x-2">
                        <span class="avatar-initial rounded bg-[#f5e38829] w-14  h-14 flex justify-center items-center">
                            <box-icon type='solid' name='star' color='#fbed53' size="md"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500">Current Level</p>
                    </div>

                    <p class="text-2xl text-gray-600 font-bold">LEVEL 1</p>
                    <p class=" text-2xl text-gray-600 "> <i
                            class="pi pi-arrow-right mr-5 text-red-400 hover:translate-x-2 duration-200"></i> See other
                        levels</p>
                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md relative p-2  backdrop-blur-sm h-full bg-white/80   md:pl-5 space-y-1   shadow-sm flex flex-col justify-center items-start ">
                    <div class="h-12  flex justify-start items-center w-full  space-x-2">
                        <span class="avatar-initial rounded bg-[#6b6de61b] w-10  h-10 flex justify-center items-center">
                            <box-icon name='user-plus' color='blue' size="sm"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500">Invited friends</p>
                    </div>

                    <p class="text-2xl font-bold text-gray-600">{{ props.friends }} FRIENDS</p>
                    <p class="text-slate-500  text-2xl"> <i
                            class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i> 1
                        Friend</p>
                    <div class=" absolute top-6 right-8">
                        <InvieDialog />
                    </div>
                </div>
            </div>
            <div class="row-start-2">
                <div
                    class="rounded-md p-2  backdrop-blur-sm h-full bg-white/80  space-y-1   shadow-sm flex flex-col justify-center items-start">
                    <div class="h-12  flex justify-start items-center w-full  space-x-2">
                        <span class="avatar-initial rounded bg-[#fcf9eb] w-10  h-10 flex justify-center items-center">
                            <box-icon type='solid' name='gift' color='#faec55' size="sm"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500">Bonus</p>
                    </div>
                    <p class="text-2xl font-bold text-gray-600">800DA</p>
                    <p class="text-green-400 text-2xl"> <i class="pi hover:-translate-y-2 duration-200 pi-arrow-up"></i>
                        30DA</p>
                </div>
            </div>
            <div
                class="col-span-2 p-6 backdrop-blur-sm  bg-white/80 rounded-md py-10 shadow-sm  flex justify-between flex-col  items-center row-span-3 col-start-3 row-start-3">
                <div class="w-full  flex flex-col items-start justify-start  h-full  ">
                    <div class="flex  flex-col h-full  items-stretch space-y-2 justify-between">
                        <div class="h-12  flex justify-start items-center w-full  space-x-2">
                            <span
                                class="avatar-initial rounded bg-[#e8e8ff] w-14  h-14 flex justify-center items-center">
                                <!-- <box-icon type='solid' name='star' ></box-icon> -->
                                <box-icon name='line-chart' color='#a2a1ff' size="md"></box-icon>
                            </span>
                            <p class="text-2xl text-gray-500">Income Analysis</p>
                        </div>
                        <p>
                            Completed tasks over this month
                        </p>
                    </div>
                    <Chart type="bar" :data="chartData" :options="chartOptions" class=" h-fit w-full" />
                </div>
            </div>
            <div
                class="col-span-2  backdrop-blur-sm rounded-md  bg-white/80 shadow-sm  row-span-6  col-start-1 row-start-3">
                <div class="flex  flex-col h-full px-10 p-6 items-stretch space-y-10 justify-start ">
                    <div class="h-12 mt-4  flex justify-start items-center w-full  space-x-2">
                        <span class="avatar-initial rounded bg-[#f5918829] w-14  h-14 flex justify-center items-center">
                            <!-- <box-icon type='solid' name='star' ></box-icon> -->
                            <box-icon name='task' color='red' size="md"></box-icon>
                        </span>
                        <p class="text-2xl text-gray-500">On going Tasks</p>
                    </div>
                    <div v-if="visibleTasks.length == 0" class="h-full w-full flex justify-center items-center">
                        <p class="text-2xl text-gray-500 ">No available tasks for now</p>
                    </div>
                    <div v-else v-for="task in visibleTasks" :key="task.id"
                        class="w-full border-b h-20 flex justify-between     items-center  rounded-md">
                        <span class="avatar-initial rounded bg-[#75727211] w-14  h-14 flex justify-center items-center">
                            <box-icon :name="`${task.platform}`" :color="getPlatformColor(task.platform)"
                                type='logo' size="lg"></box-icon>
                        </span>
                        <div class="w-[50%] flex justify-between ">
                            <p class="text-2xl text-gray-500 w-[50%]">{{ task.type }}</p>
                        </div>
                        <div class="items-center flex space-x-2">
                            <Button label="Go" as="a" :href="task.link" target="_blank" rel="noopener"  icon="pi pi-angle-double-right"  />
                            <ConfirmTask :task_id="task.id" @task_confirmed="completeTask(task.id)" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-span-2 row-span-3 col-start-3 row-start-6">
                <div class="h-full w-full backdrop-blur-sm rounded-md  bg-white/80 shadow-sm">
                    <div class="w-full flex justify-center items-center h-full">
                        <div>
                            <p class="text-3xl text-gray-500">Top performances</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </MyLayout>
</template>
