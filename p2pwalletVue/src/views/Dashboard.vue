<template>
    <div class="bg-gray-100 pl-6 mt-10 py-6 flex flex-col sm:py-12">
        <div class="flex flex-row">
            <div class="basis-1/4 sm:1/1">
            </div>
            <div class="basis-1/2 sm:1/1">
            
<div class="overflow-x-auto relative">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="bg-slate text-white">
                <th scope="col" class="py-3 px-6">
                    
                </th>
                <th scope="col" class="py-3 px-6">
                    ???
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Mostly Converted by:
                </th>
                <td class="py-4 px-6">
                    {{mostConversionBy}}
                </td>
              
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Total Converted Amount By Me:
                </th>
                <td class="py-4 px-6">
                   {{totalConvertedAmount}}
                </td>
            </tr>
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Third Highest Converted Amount By Me:
                </th>
                <td class="py-4 px-6">
                    {{thirdHighestConvertedAmount}}
                </td>
            </tr>
        </tbody>
    </table>
</div>

            </div>
        </div>
    </div>
</template>
<script setup>
import { ref,inject,onMounted  } from 'vue'
const pStore = inject('providedStore')
onMounted(() => {
    getMostConversionBy()
    getTotalConvertedByMe()
    thirdHighestConvertedByMe()
})
const mostConversionBy = ref(null)
const totalConvertedAmount = ref(null)
const thirdHighestConvertedAmount = ref(null)

async function getMostConversionBy() {
    pStore.startAjaxLoading = true;
    await pStore.ajaxClient
        .get("most-converted-user",{headers:{
            "Content-type": "application/json",
            Authorization: `Bearer ${pStore.token}`,
        }})
        .then((response) => {
            pStore.showError = false;
            pStore.startAjaxLoading = false;
            if(response.data == pStore.getUser.name){
                mostConversionBy.value = 'Me'
            }else{
                mostConversionBy.value = response.data
            }
            
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
async function getTotalConvertedByMe() {
    pStore.startAjaxLoading = true;
    await pStore.ajaxClient
        .get("total-converted-amount",{headers:{
            "Content-type": "application/json",
            Authorization: `Bearer ${pStore.token}`,
        }})
        .then((response) => {
            pStore.showError = false;
            pStore.startAjaxLoading = false;
            totalConvertedAmount.value = response.data
            
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
async function thirdHighestConvertedByMe() {
    pStore.startAjaxLoading = true;
    await pStore.ajaxClient
        .get("third-highest-transacted-amount",{headers:{
            "Content-type": "application/json",
            Authorization: `Bearer ${pStore.token}`,
        }})
        .then((response) => {
            pStore.showError = false;
            pStore.startAjaxLoading = false;
            thirdHighestConvertedAmount.value = response.data.applied_amount
            
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
</script>