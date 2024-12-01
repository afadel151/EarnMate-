<script setup>
import { Button, InputNumber,Dialog, InputText } from 'primevue';
import { ref } from "vue";
import Tabs from "primevue/tabs";
import TabList from "primevue/tablist";
import Tab from "primevue/tab";
import TabPanels from "primevue/tabpanels";
import TabPanel from "primevue/tabpanel";
import { usePriceStore } from '@/stores/priceStore';
import axiosClient from '@/axios';
const visible = ref(false);
const props = defineProps({
    user: Object
});
const AmountDzd = ref(0);
const AmountUs = ref(0);
const screenshotBaridi = ref(null);
const screenshotBinance = ref(null);
const codeBaridi = ref("");
const BinanceAdress = ref('');
const adminid = ref(0);
const Rip = ref('');
async function withdrawBaridi() {
    if (priceStore.price != 0) {
    try {
        let response = await axiosClient.post('/withdrawals/withdraw_baridi',{
            rip : Rip.value,
            amount: AmountDzd.value,
            price : priceStore.price
        });
        console.log(response.data);
        visible.value = false;
    } catch (error) {
        console.log(error);
        
    }}else{
        console.log('wait');
        
    }
}

const priceStore = usePriceStore()

</script>


<template>

    <Button @click="visible = true" :disabled="props.user.balance < 5"  severity="secondary" label="Withdraw"  icon="pi 
pi-arrow-down" />
<Dialog v-model:visible="visible" modal header="Deposit" :style="{ width: '32rem' }">
        <Tabs value="0" class="w-full">
            <TabList class="w-full">
                <Tab value="0" as="div" class="flex items-center gap-2">
                    <img src="/imgs/admin/baridi.png" class="w-10" alt="" />
                    <span class="font-bold whitespace-nowrap">Baridi Mob</span>
                </Tab>
                <Tab value="1" as="div" class="flex items-center gap-2">
                    <img src="/imgs/admin/binance.png" class="w-10" alt="" />
                    <span class="font-bold whitespace-nowrap">Binance</span>
                </Tab>
                <Tab value="2">
                    <div class="w-full flex justify-center gap-2 items-center">
                        <img src="/imgs/admin/bybit.png" class="w-12" alt="" />
                        <span class="font-bold whitespace-nowrap">ByBit </span>
                    </div>
                </Tab>
            </TabList>
            <TabPanels>
                <TabPanel value="0" as="p" class="m-0">
                    <div>
                     
                        <div class="flex items-center gap-4 mb-8">
                            <label  class="font-semibold w-24">RIP :</label>
                            <InputText v-model="Rip"  fluid />
                        </div>
                        <div class="flex items-center gap-4 mb-8">
                            <label for="email" class="font-semibold w-24">Amount</label>
                            <InputNumber v-model="AmountDzd" :min="5" :max="props.user.balance" mode="currency" currency="USD"
                                inputId="withoutgrouping" fluid />
                           
                        </div>
                        <p class="text-xl font-bold mb-8 ml-24"> ≈ {{ Math.floor((priceStore.price - 5) * AmountDzd) }} DZD</p>
                        <div class="flex justify-end w-full gap-2">
                            <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
                            <Button type="button" label="Send" @click="withdrawBaridi" />
                        </div>
                    </div>
                </TabPanel>
                <TabPanel value="1" as="p" class="m-0">
                    <p class="text-xl text-gray-500 mb-8">
                        This method will charge you of
                        <span class="text-violet-500">5%</span>
                    </p>

                    <p class="text-lg mb-8">
                        Withdraw your money using
                        <span class="text-violet-500"> USDT (TetherUS)</span>
                        with
                        <span class="text-violet-500"> TRX (TRC20)</span>
                        network
                    </p>
                    
                    <div class="flex flex-col justify-center gap-2 mb-4 items-center w-full">
                        <div class="flex w-full items-center gap-4">
                        <label for="email" class="font-semibold w-24">Amount</label>
                        <InputNumber :min="500" :max="2800" mode="currency" currency="USD" inputId="withoutgrouping"
                            :useGrouping="false" fluid />
                    </div>
                        <div class="flex w-full items-center gap-4 mb-8">
                            <label for="email" class="font-semibold w-24">Adress ;</label>
                            <InputText v-model="BinanceAdress"  fluid />
                        </div>
                        <div class="flex justify-end w-full gap-2">
                            <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
                            <Button type="button" label="Send" @click="sendBinance" />
                        </div>
                    </div>
                </TabPanel>
                <TabPanel value="2">
                    <p class="m-0">
                        At vero eos et accusamus et iusto odio dignissimos
                        ducimus qui blanditiis praesentium voluptatum deleniti
                        atque corrupti quos dolores et quas molestias excepturi
                        sint occaecati cupiditate non provident, similique sunt
                        in culpa qui officia deserunt mollitia animi, id est
                        laborum et dolorum fuga. Et harum quidem rerum facilis
                        est et expedita distinctio. Nam libero tempore, cum
                        soluta nobis est eligendi optio cumque nihil impedit quo
                        minus.
                    </p>
                </TabPanel>
            </TabPanels>
        </Tabs>
    </Dialog>
</template>