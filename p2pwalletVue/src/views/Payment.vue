<template>
    <div>
        <div class="flex flex-row justify-center">
            <div
                class="p-4 w-full max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <alertDanger v-if="pStore.showError"  error-message="Validation Error" />
                <CheckBalance :balance="walletBalance" :currency="walletCurrency" />
                <hr>
                <Pay :payableUsers="userlist" :currency="walletCurrency" :balance="walletBalance" />
            </div>
        </div>

    </div>
</template>
<script setup>
import { ref,inject,onMounted  } from 'vue'
import alertDanger from '../components/lib/alert-danger.vue';
import CheckBalance from '../components/payment/CheckBalance.vue';
import Pay from '../components/payment/Pay.vue';

const pStore = inject('providedStore')
const walletBalance = ref(0)
const walletCurrency = ref('USD')
const userlist = ref([])
onMounted(() => {
    getSelfWallet()
    getPayableUser()
})

async function getSelfWallet() {
    pStore.startAjaxLoading = true;
    await pStore.ajaxClient
        .get("wallet",{headers:{
            "Content-type": "application/json",
            Authorization: `Bearer ${pStore.token}`,
        }})
        .then((response) => {
            pStore.showError = false;
            pStore.startAjaxLoading = false;
            walletCurrency.value = response.data.currency
            walletBalance.value = response.data.amount
        })
        .catch((error) => {
            // will be resolved from single point later
            if (error.code == "ERR_NETWORK") {
                pStore.router.push({ name: "network-issue" });
                pStore.startAjaxLoading = false;
                return false;
            }
            // console.log(error);
            // return;
            pStore.handleAjaxClientError(error.response)
        });
}

async function getPayableUser() {
    pStore.startAjaxLoading = true;
    await pStore.ajaxClient
        .get("payable-user-list",{headers:{
            "Content-type": "application/json",
            Authorization: `Bearer ${pStore.token}`,
        }})
        .then((response) => {
            pStore.showError = false;
            pStore.startAjaxLoading = false;
            // console.log(response.data)
            userlist.value = response.data
            // console.log(userList);
        })
        .catch((error) => {
            // will be resolved from single point later
            if (error.code == "ERR_NETWORK") {
                pStore.router.push({ name: "network-issue" });
                pStore.startAjaxLoading = false;
                return false;
            }
            console.log(error);
            return;
            pStore.handleAjaxClientError(error.response)
        });
}

</script>