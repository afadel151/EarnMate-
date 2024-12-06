<script setup>
import UsersByMethod from './UsersByMethod.vue';
const props = defineProps({
    users : Array
})
let total = 0;
props.users.forEach((method)=>{
    total = total + method.user_count
});

</script>

<template>
    
    <div class="h-full w-full bg-white shadow-md   flex space-y-5 flex-col justify-between p-5 items-start rounded-md">
        <div class="h-14 flex w-full justify-between items-center ">
            <div class="h-12 flex justify-start items-center  space-x-2">
                <span class="avatar-initial rounded bg-[#f5e38829] w-14  h-14 flex justify-center items-center">
                    <box-icon name='user-detail' type='solid' color='#fbed53' size="md" ></box-icon>
                </span>
                <p class="text-2xl text-gray-600">Users by Methods</p>
            </div>
        </div>
        <div class="h-full w-full p-2 flex flex-col   justify-start ">
            <UsersByMethod :method="'binance'" :total="total" :users="props.users.filter((element) => element.method == 'binance')[0]" />
            <UsersByMethod :method="'bybit'" :total="total" :users="props.users.filter((element) => element.method == 'bybit')[0]"  />
            <UsersByMethod :method="'baridi'" :total="total" :users="props.users.filter((element) => element.method == 'baridi')[0]"   />
           
        </div>
    </div>
    
</template>