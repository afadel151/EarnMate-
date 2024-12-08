<script setup>
import { Button, Toast, useToast } from "primevue";
import { Dialog, InputNumber } from "primevue";
import { ref, onMounted, watch } from "vue";
const props = defineProps({
    dzd_price: Number
})
const toast = useToast();
const visible = ref(false);
const Amount = ref(0);
const AmountUs = ref(0);
const screenshotBaridi = ref(null);
const screenshotBinance = ref(null);
const screenshotBybit = ref(null);
const codeBaridi = ref("");
const adminrip = ref("");
const adminid = ref(0);
const candepositbaridi = ref(true);
const config = ref(null);
import { usePriceStore } from "@/stores/priceStore";
const priceStore = usePriceStore();
onMounted(async () => {
    try {
        let response = await axios.get("/api/deposits/getrip");
        if (response.data == "full") {
            candepositbaridi.value = false;
            toast.add({ severity: 'error', summary: 'Error', detail: 'Can\'t deposit right now, wait anathor time', life: 3000 });
        } else {
            adminrip.value = response.data.rip;
            adminid.value = response.data.admin_id;
            config.value = response.data.config;
        }
    } catch (error) {
        console.log(error);
    }
});
async function sendBaridi() {
    if (priceStore.price != 0) {
        Processing.value=true;
        let fd = new FormData();
        fd.append("amount", Amount.value);
        fd.append("transaction_code", codeBaridi.value);
        fd.append("screenshot", screenshotBaridi.value);
        fd.append("admin_id", adminid.value);
        fd.append("price", priceStore.price);
        try {
            const response = await axios.post("/api/deposits/baridi", fd);
            if (response.data == 'done') {
                toast.add({ severity: 'success', summary: 'Info', detail: 'Deposited successfully', life: 3000 });
            }
            visible.value = false;
        } catch (error) {
            toast.add({ severity: 'error', summary: 'Info', detail: 'Error depositing', life: 3000 });
        }
    }else{
        console.log('wait');
    }
}
async function sendBinance() {
    if (priceStore.price != 0) {
        Processing.value=true;
        let fd = new FormData();
        fd.append("amount", Amount.value);
        fd.append("screenshot", screenshotBinance.value);
        try {
            const response = await axiosClient.post("/deposits/binance", fd);
            if (response.data == 'done') {
                toast.add({ severity: 'success', summary: 'Info', detail: 'Deposited successfully', life: 3000 });
            }
            visible.value = false;
        } catch (error) {
            toast.add({ severity: 'error', summary: 'Info', detail: 'Error depositing', life: 3000 });
        }
    }else{
        console.log('wait');
    }
}
async function sendBybit() {
    if (priceStore.price != 0) {
        Processing.value=true;
        let fd = new FormData();
        fd.append("amount", Amount.value);
        fd.append("screenshot", screenshotBybit.value);
        try {
            const response = await axiosClient.post("/deposits/bybit", fd);
            if (response.data == 'done') {
                toast.add({ severity: 'success', summary: 'Info', detail: 'Deposited successfully', life: 3000 });
            }
            visible.value = false;
        } catch (error) {
            toast.add({ severity: 'error', summary: 'Info', detail: 'Error depositing', life: 3000 });
        }
    }else{
        console.log('wait');
    }
}
const screenshot = ref(null);
function onChangeBaridi(e) {
    screenshotBaridi.value = e.target.files[0];
}
function onChangeBinance(e) {
    screenshotBinance.value = e.target.files[0];
}
function onChangeBybit(e) {
    screenshotBybit.value = e.target.files[0];
}
watch(Amount, (data) => {
    DZDamount.value = (data ? data : 0) * priceStore.price
})
const DZDamount = ref(null)
import Tabs from "primevue/tabs";
import TabList from "primevue/tablist";
import Tab from "primevue/tab";
import TabPanels from "primevue/tabpanels";
import TabPanel from "primevue/tabpanel";
import axios from "axios";
import axiosClient from "@/axios";
async function copyURL(url) {
    try {
      await navigator.clipboard.writeText(url);
      toast.add({ severity: 'success', summary: 'Info', detail: 'Copied to clipboard', life: 3000 });
    } catch($e) {
      toast.add({ severity: 'danger', summary: 'Info', detail: 'Can\'t copy', life: 3000 });
    }
  }

const Processing = ref(false);
</script>

<template>
    <Button @click="visible = true" label="Deposit" outlined icon="pi pi-arrow-up" />
    <Toast />
    <Dialog v-model:visible="visible" modal header="Deposit" :style="{ width: '35rem' }">
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
                <Tab as="div" value="2">
                    <div class="w-full flex justify-center gap-2 items-center">
                        <img src="/imgs/admin/bybit.png" class="w-12" alt="" />
                        <span class="font-bold whitespace-nowrap">ByBit </span>
                    </div>
                </Tab>
            </TabList>
            <TabPanels>
                <TabPanel value="0" as="p" class="m-0">
                    <div v-if="candepositbaridi">
                        <p class="text-xl text-gray-500 mb-8">
                            This method will charge you of
                            <span class="text-violet-500">{{ config.baridi_tax_percentage }}%</span>
                        </p>
                        <div class="flex items-center gap-4 mb-8">
                            <label class="font-semibold w-24">RIP :</label>
                            <Button label="Copy RIP"  icon="pi pi-clipboard" @click="copyURL(adminrip)" />
                        </div>
                        <div class="flex items-center gap-4 mb-2">
                            <label for="email" class="font-semibold  w-24">Amount</label>
                            <InputNumber v-model="Amount" mode="currency" currency="USD" inputId="withoutgrouping"
                                :useGrouping="false" fluid />

                        </div>
                        <p class="ml-24 mb-8 w-24"> ≈ {{ DZDamount }} DZD</p>
                        <div class="flex items-center gap-4 mb-8">
                            <label for="email" class="font-semibold w-24">code</label>
                            <InputNumber v-model="codeBaridi" fluid />
                        </div>
                        <div class="flex items-center gap-4 mb-8">
                            <label for="email" class="font-semibold w-24">code</label>
                            <input name="file" type="file" class="w-full" @change="onChangeBaridi" />
                        </div>
                        <div class="flex justify-end gap-2">
                            <Button type="button" label="Cancel"  :disabled="Processing"  severity="secondary" @click="visible = false" />
                            <Button type="button" label="Send" :disabled="Processing" @click="sendBaridi" />
                        </div>
                    </div>
                    <div v-else>Can't deposit with this method right now</div>
                </TabPanel>
                <TabPanel value="1"  class="m-0">
                    <p class="text-xl text-gray-500 mb-4">
                        This method will charge you of
                        <span class="text-violet-500">{{ config.binance_tax_percentage }}%</span>
                    </p>

                    <p class="text-lg">
                        Deposit your money using
                        <span class="text-violet-500"> USDT (Tether USDT)</span>
                        with
                        <span class="text-violet-500"> TRON (TRC20)</span>
                        network
                    </p>
                    <div class="flex items-center gap-4">
                        <label for="email" class="font-semibold w-24">Amount</label>
                        <InputNumber v-model="Amount" :min="500" :max="2800" mode="currency" currency="USD" inputId="withoutgrouping"
                            :useGrouping="false" fluid />
                    </div>
                    <div class="flex flex-col justify-center gap-2 mb-4 items-center w-full">
                        <svg height="80" width="80" class="scale-125 my-5" viewBox="0 0 33 33">
                            <path fill="#FFFFFF" d="M0,0 h33v33H0z" shape-rendering="crispEdges"></path>
                            <path fill="#000000"
                                d="M0 0h7v1H0zM9 0h2v1H9zM12 0h1v1H12zM14 0h1v1H14zM23 0h1v1H23zM26,0 h7v1H26zM0 1h1v1H0zM6 1h1v1H6zM10 1h1v1H10zM12 1h2v1H12zM18 1h1v1H18zM23 1h1v1H23zM26 1h1v1H26zM32,1 h1v1H32zM0 2h1v1H0zM2 2h3v1H2zM6 2h1v1H6zM9 2h4v1H9zM16 2h4v1H16zM23 2h1v1H23zM26 2h1v1H26zM28 2h3v1H28zM32,2 h1v1H32zM0 3h1v1H0zM2 3h3v1H2zM6 3h1v1H6zM9 3h2v1H9zM13 3h1v1H13zM17 3h6v1H17zM26 3h1v1H26zM28 3h3v1H28zM32,3 h1v1H32zM0 4h1v1H0zM2 4h3v1H2zM6 4h1v1H6zM8 4h2v1H8zM11 4h1v1H11zM16 4h3v1H16zM23 4h2v1H23zM26 4h1v1H26zM28 4h3v1H28zM32,4 h1v1H32zM0 5h1v1H0zM6 5h1v1H6zM9 5h1v1H9zM11 5h1v1H11zM15 5h1v1H15zM19 5h2v1H19zM26 5h1v1H26zM32,5 h1v1H32zM0 6h7v1H0zM8 6h1v1H8zM10 6h1v1H10zM12 6h1v1H12zM14 6h1v1H14zM16 6h1v1H16zM18 6h1v1H18zM20 6h1v1H20zM22 6h1v1H22zM24 6h1v1H24zM26,6 h7v1H26zM8 7h1v1H8zM10 7h1v1H10zM12 7h1v1H12zM14 7h4v1H14zM20 7h1v1H20zM22 7h1v1H22zM24 7h1v1H24zM2 8h2v1H2zM6 8h4v1H6zM12 8h4v1H12zM19 8h1v1H19zM21 8h1v1H21zM23 8h1v1H23zM25 8h2v1H25zM28 8h1v1H28zM1 9h1v1H1zM3 9h1v1H3zM8 9h1v1H8zM11 9h1v1H11zM14 9h2v1H14zM17 9h2v1H17zM21 9h3v1H21zM25 9h1v1H25zM30,9 h3v1H30zM0 10h1v1H0zM2 10h1v1H2zM5 10h3v1H5zM10 10h1v1H10zM12 10h1v1H12zM14 10h2v1H14zM19 10h1v1H19zM23 10h3v1H23zM27 10h2v1H27zM30 10h1v1H30zM32,10 h1v1H32zM0 11h1v1H0zM2 11h1v1H2zM5 11h1v1H5zM7 11h1v1H7zM9 11h2v1H9zM12 11h4v1H12zM19 11h1v1H19zM27 11h3v1H27zM32,11 h1v1H32zM0 12h3v1H0zM5 12h3v1H5zM12 12h2v1H12zM15 12h6v1H15zM23 12h1v1H23zM25 12h1v1H25zM27 12h3v1H27zM31 12h1v1H31zM0 13h1v1H0zM3 13h1v1H3zM7 13h1v1H7zM9 13h1v1H9zM13 13h1v1H13zM15 13h2v1H15zM18 13h2v1H18zM22 13h1v1H22zM24 13h1v1H24zM27 13h1v1H27zM31,13 h2v1H31zM0 14h2v1H0zM5 14h2v1H5zM11 14h1v1H11zM18 14h1v1H18zM21 14h1v1H21zM25 14h3v1H25zM30 14h1v1H30zM0 15h1v1H0zM11 15h1v1H11zM13 15h1v1H13zM15 15h1v1H15zM17 15h1v1H17zM19 15h1v1H19zM21 15h2v1H21zM24 15h1v1H24zM26 15h3v1H26zM30 15h1v1H30zM32,15 h1v1H32zM6 16h1v1H6zM8 16h1v1H8zM13 16h4v1H13zM18 16h1v1H18zM21 16h2v1H21zM25 16h2v1H25zM30 16h1v1H30zM32,16 h1v1H32zM1 17h4v1H1zM7 17h2v1H7zM11 17h1v1H11zM17 17h2v1H17zM20 17h2v1H20zM23 17h2v1H23zM27 17h3v1H27zM31,17 h2v1H31zM1 18h4v1H1zM6 18h2v1H6zM9 18h1v1H9zM12 18h2v1H12zM19 18h1v1H19zM24 18h1v1H24zM26 18h2v1H26zM30 18h2v1H30zM0 19h1v1H0zM2 19h3v1H2zM7 19h7v1H7zM15 19h1v1H15zM17 19h2v1H17zM23 19h2v1H23zM27 19h1v1H27zM31,19 h2v1H31zM0 20h1v1H0zM2 20h3v1H2zM6 20h2v1H6zM10 20h4v1H10zM17 20h1v1H17zM19 20h1v1H19zM21 20h3v1H21zM31 20h1v1H31zM0 21h1v1H0zM3 21h1v1H3zM7 21h3v1H7zM12 21h1v1H12zM14 21h1v1H14zM16 21h1v1H16zM18 21h1v1H18zM20 21h3v1H20zM26 21h1v1H26zM30 21h1v1H30zM32,21 h1v1H32zM3 22h1v1H3zM6 22h2v1H6zM10 22h3v1H10zM14 22h2v1H14zM18 22h4v1H18zM23 22h4v1H23zM28 22h1v1H28zM31,22 h2v1H31zM1 23h1v1H1zM5 23h1v1H5zM7 23h1v1H7zM9 23h10v1H9zM20 23h1v1H20zM23 23h2v1H23zM26 23h1v1H26zM29 23h1v1H29zM32,23 h1v1H32zM0 24h1v1H0zM2 24h1v1H2zM4 24h3v1H4zM9 24h1v1H9zM12 24h3v1H12zM16 24h2v1H16zM19 24h1v1H19zM21 24h2v1H21zM24 24h5v1H24zM8 25h1v1H8zM10 25h1v1H10zM12 25h2v1H12zM17 25h3v1H17zM24 25h1v1H24zM28 25h1v1H28zM32,25 h1v1H32zM0 26h7v1H0zM8 26h1v1H8zM12 26h1v1H12zM15 26h2v1H15zM18 26h4v1H18zM23 26h2v1H23zM26 26h1v1H26zM28 26h1v1H28zM30 26h1v1H30zM0 27h1v1H0zM6 27h1v1H6zM13 27h2v1H13zM16 27h1v1H16zM19 27h1v1H19zM21 27h1v1H21zM24 27h1v1H24zM28 27h3v1H28zM0 28h1v1H0zM2 28h3v1H2zM6 28h1v1H6zM9 28h1v1H9zM12 28h4v1H12zM17 28h4v1H17zM23 28h6v1H23zM32,28 h1v1H32zM0 29h1v1H0zM2 29h3v1H2zM6 29h1v1H6zM8 29h1v1H8zM10 29h1v1H10zM13 29h4v1H13zM18 29h1v1H18zM22 29h1v1H22zM29 29h1v1H29zM31,29 h2v1H31zM0 30h1v1H0zM2 30h3v1H2zM6 30h1v1H6zM8 30h2v1H8zM12 30h2v1H12zM15 30h3v1H15zM19 30h1v1H19zM21 30h1v1H21zM29 30h1v1H29zM0 31h1v1H0zM6 31h1v1H6zM9 31h1v1H9zM11 31h2v1H11zM14 31h2v1H14zM17 31h2v1H17zM20 31h3v1H20zM24 31h1v1H24zM28 31h1v1H28zM32,31 h1v1H32zM0 32h7v1H0zM9 32h1v1H9zM14 32h1v1H14zM19 32h3v1H19zM25 32h1v1H25zM27 32h1v1H27z"
                                shape-rendering="crispEdges"></path>
                        </svg>
                        <div class="w-full items-center space-x-3 flex">
                            <p class="text-xl font-bold">Adress :</p>
                            <Button label="Copy Adress" @click="copyURL('TNgWLbgpG1jmh8yJ3cvTJX9esAf7KjgNQ6')" icon="pi pi-clipboard" size="small" />

                                <!--  -->
                            


                        </div>
                        <div class="w-full space-x-3 flex mb-4">
                            <p class="text-xl font-bold">Or via Binance ID:</p>
                            <p class="text-xl text-gray-500">
                                718157584
                            </p>
                        </div>
                        <div class="flex items-center gap-4 mb-8">
                            <label for="email" class="font-semibold w-24">code</label>
                            <input name="file" type="file" class="w-full" @change="onChangeBinance" />
                        </div>
                        <div class="flex justify-end w-full gap-2">
                            <Button type="button" label="Cancel"  :disabled="Processing"  severity="secondary" @click="visible = false" />
                            <Button type="button" label="Send"  :disabled="Processing"  @click="sendBinance" />
                        </div>
                    </div>
                </TabPanel>
                <TabPanel value="2">
                    <p class="text-xl text-gray-500 mb-8">
                        This method will charge you of
                        <span class="text-violet-500">{{ config.binance_tax_percentage }}%</span>
                    </p>

                    <p class="text-lg">
                        Deposit your money using
                        <span class="text-violet-500"> USDT (Tether USDT)</span>
                        with
                        <span class="text-violet-500"> TRON (TRC20)</span>
                        network
                    </p>
                    <div class="flex items-center gap-4">
                        <label for="email" class="font-semibold w-24">Amount</label>
                        <InputNumber v-model="Amount" :min="500" :max="2800" mode="currency" currency="USD" inputId="withoutgrouping"
                            :useGrouping="false" fluid />
                    </div>
                    <div class="flex flex-col justify-center gap-2 mb-4 items-center w-full">
                        <img src="/imgs/bybit_barcode.png" class="h-20 scale-125 my-5" alt="">
                        
                        <div class="w-full items-center space-x-3 flex">
                            <p class="text-xl font-bold">Adress :</p>
                            <Button label="Copy Adress" @click="copyURL('TJBSCvJHjmqxFum9f6cmZ74UMBubtKCsHa')" icon="pi pi-clipboard" size="small" />
                        </div>
                        <div class="w-full space-x-3 flex mb-4">
                            <p class="text-xl font-bold">Or via Bybit ID:</p>
                            <p class="text-xl text-gray-500">
                                258857256
                            </p>
                        </div>
                        <div class="flex items-center gap-4 mb-8">
                            <label for="email" class="font-semibold w-24">code</label>
                            <input name="file" type="file" class="w-full" @change="onChangeBybit" />
                        </div>
                        <div class="flex justify-end w-full gap-2">
                            <Button type="button" label="Cancel"  :disabled="Processing"  severity="secondary" @click="visible = false" />
                            <Button type="button" label="Send"  :disabled="Processing"  @click="sendBybit" />
                        </div>
                    </div>
                        
                </TabPanel>
            </TabPanels>
        </Tabs>
    </Dialog>
</template>
