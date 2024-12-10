<script setup>
import { Button, InputNumber, Dialog, InputText, Toast, useToast } from 'primevue';
import { computed, ref } from "vue";
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
const toast = useToast();
async function withdrawBaridi() {
    if (priceStore.price != 0) {
        try {
            let response = await axiosClient.post('/withdrawals/withdraw_baridi', {
                rip: Rip.value,
                amount: AmountDzd.value,
                price: priceStore.price
            });
            console.log(response.data);
            visible.value = false;
            if (response.data == 'failed') {
                toast.add({ severity: 'danger', summary: 'Info', detail: 'Failed to withdraw, please try tomorrow', life: 3000 });
            } else {
                toast.add({ severity: 'success', summary: 'Info', detail: 'Withdrawal requested successfully,your money is on the way', life: 3000 });
            }
        } catch (error) {
            console.log(error);

        }
    } else {
        console.log('wait');

    }
}
async function withdrawBinance()
{
    try {
        let response = await axiosClient.post('/withdrawals/withdraw_binance', {
                adress: BinanceAdress.value,
                amount: AmountUs.value,
            });
            console.log(response.data);
            visible.value = false;
            if (response.data == 'failed') {
                toast.add({ severity: 'error', summary: 'Info', detail: 'Failed to withdraw, please try tomorrow', life: 3000 });
            } else {
                toast.add({ severity: 'success', summary: 'Info', detail: 'Withdrawal requested successfully,your money is on the way', life: 3000 });
            }
    } catch (error) {
        toast.add({ severity: 'error', summary: 'Info', detail: 'Error while withdrawing', life: 3000 });
    }
}
const ByBitAdress = ref('');
async function withdrawByBit()
{
    try {
        let response = await axiosClient.post('/withdrawals/withdraw_bybit', {
                adress: ByBitAdress.value,
                amount: AmountUs.value,
            });
            console.log(response.data);
            visible.value = false;
            if (response.data == 'failed') {
                toast.add({ severity: 'error', summary: 'Info', detail: 'Failed to withdraw, please try tomorrow', life: 3000 });
            } else {
                toast.add({ severity: 'success', summary: 'Info', detail: 'Withdrawal requested successfully,your money is on the way', life: 3000 });
            }
    } catch (error) {
        toast.add({ severity: 'error', summary: 'Info', detail: 'Error while withdrawing', life: 3000 });
    }
}
const isValidRip = computed(() => /^\d{20}$/.test(Rip.value));

    const validateRip = () => {
      if (!/^\d*$/.test(Rip.value)) {
        Rip.value = Rip.value.replace(/\D/g, "");
      }
    };
const priceStore = usePriceStore();

</script>


<template>
    <Toast />
    <Button @click="visible = true" :disabled="props.user.balance < 5" severity="secondary" label="Withdraw" icon="pi 
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

                        <div class="flex items-center gap-4 ">
                            <label class="font-semibold w-24">RIP :</label>
                            <InputText v-model="Rip" fluid @input="validateRip" :class="{ 'p-invalid': !isValidRip }" />
                        </div>
                        <small v-if="!isValidRip" class="p-error mb-8">
                                RIP must contain exactly 20 numeric characters.
                            </small>
                        <div class="flex items-center gap-4 mt-8 mb-8">
                            <label for="email" class="font-semibold w-24">Amount</label>
                            <InputNumber v-model="AmountDzd" :min="5" :max="props.user.balance" mode="currency"
                                currency="USD" inputId="withoutgrouping" fluid />

                        </div>
                        <p class="text-xl font-bold mb-8 ml-24"> ≈ {{ Math.floor((priceStore.price - 5) * AmountDzd) }}
                            DZD</p>
                        <div class="flex justify-end w-full gap-2">
                            <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
                            <Button type="button" label="Send" @click="withdrawBaridi" />
                        </div>
                    </div>
                </TabPanel>
                <TabPanel value="1" as="p" class="m-0">
                    <p class="text-lg mb-8">
                        Withdraw your money using
                        <span class="text-violet-500"> USDT (TetherUS)</span>
                        with
                        <span class="text-violet-500"> TRX (TRC20)</span>
                        network
                    </p>

                    <div class="flex flex-col justify-center gap-2 mb-4 items-center w-full">
                        <div class="flex w-full items-center gap-4">
                            <label for="email" class="font-semibold w-36">Amount</label>
                            <InputNumber :min="5" v-model="AmountUs" :max="props.user.balance" mode="currency" currency="USD" inputId="withoutgrouping"
                                :useGrouping="false" fluid />
                        </div>
                        <div class="flex w-full items-center gap-4 mb-8">
                            <label for="email" class="font-semibold w-36">Adress or Binance ID:</label>
                            <InputText v-model="BinanceAdress" fluid />
                        </div>
                        <div class="flex justify-end w-full gap-2">
                            <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
                            <Button type="button" label="Send" @click="withdrawBinance" />
                        </div>
                    </div>
                </TabPanel>
                <TabPanel value="2">
                    <p class="text-lg mb-8">
                        Withdraw your money using
                        <span class="text-violet-500"> USDT (TetherUS)</span>
                        with
                        <span class="text-violet-500"> TRX (TRC20)</span>
                        network
                    </p>

                    <div class="flex flex-col justify-center gap-2 mb-4 items-center w-full">
                        <div class="flex w-full items-center gap-4">
                            <label for="email" class="font-semibold w-36">Amount</label>
                            <InputNumber :min="5" v-model="AmountUs" :max="props.user.balance" mode="currency" currency="USD" inputId="withoutgrouping"
                                :useGrouping="false" fluid />
                        </div>
                        <div class="flex w-full items-center gap-4 mb-8">
                            <label for="email" class="font-semibold w-36">Adress or Bybit ID:</label>
                            <InputText v-model="ByBitAdress" fluid />
                        </div>
                        <div class="flex justify-end w-full gap-2">
                            <Button type="button" label="Cancel" severity="secondary" @click="visible = false" />
                            <Button type="button" label="Send" @click="withdrawByBit" />
                        </div>
                    </div>
                </TabPanel>
            </TabPanels>
        </Tabs>
    </Dialog>
</template>