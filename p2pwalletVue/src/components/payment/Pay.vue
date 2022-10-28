<template>
    <div class="flow-root">
        <!-- <alertDanger v-if="pStore.showError"  error-message="Validation Error" /> -->
        <Form @submit="pay" class="w-full px-4 py-3">
            <!-- <b>Select Payment Method:</b> -->
            <div class="mx-auto w-full max-w-md">
                <RadioGroup v-model="selected_payment_type">
                    <RadioGroupLabel class="sr-only">Server size</RadioGroupLabel>
                    <div class="space-y-2">
                        <RadioGroupOption as="template" v-for="gateWay in gateWays" :key="gateWay.payment_type"
                            :value="gateWay" v-slot="{ active, checked }">
                            <div :class="[
                                active
                                    ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                    : '',
                                checked ? 'bg-teal-900 text-white ' : ' ',
                            ]" class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none">
                                <div class="flex w-full items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="text-sm">
                                            <RadioGroupLabel as="p" :class="checked ? 'text-white' : 'text-gray-900'"
                                                class="font-medium">
                                            </RadioGroupLabel>
                                            <RadioGroupDescription as="span"
                                                :class="checked ? 'text-sky-100' : 'text-gray-500'" class="inline">
                                                <span>{{ gateWay.name }}</span>
                                            </RadioGroupDescription>
                                        </div>
                                    </div>
                                    <div v-show="checked" class="shrink-0 text-white">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                            <circle cx="12" cy="12" r="12" fill="#fff" fill-opacity="0.2" />
                                            <path d="M7 13l3 3 7-7" stroke="#fff" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </RadioGroupOption>
                    </div>
                </RadioGroup>
            </div>

            <div>
                {{ to_user }}
                {{ selected_payment_type }}
                {{ amount }}
                <label for="to_user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Pay
                    To</label>
                <Field :rules="isRquired" name="to_user" as="select" v-model="to_user" id="to_user"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value>Select User</option>
                    <option :value="user.id" v-for="user in payableUsers">{{ user.name }}({{ user.email }})</option>
                </Field>
                <div>
                    <ErrorMessage name="to_user" class="error-color" />
                </div>

            </div>
            <label for="website-admin"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Amount</label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    {{ currency }}
                </span>
                <Field :rules="validateAmount" v-model="amount" name="amount" type="number" id="amount"
                    class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Amount" />
            </div>
            <div>
                <ErrorMessage name="amount" class="error-color" />
            </div>
            <br />
            <button
                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Pay
            </button>
        </Form>
    </div>
</template>
<script setup>
import { ref, inject } from "vue";
import { Form, Field, ErrorMessage } from 'vee-validate';
// import alertDanger from '../../components/lib/alert-danger.vue';
import {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupDescription,
    RadioGroupOption,
} from "@headlessui/vue";

const pStore = inject('providedStore')
const props = defineProps({
    payableUsers: Array | Object,
    balance: 0,
    currency: ''
})
const gateWays = [
    {
        payment_type: "P2P",
        name: "P2P Tranfser",
    },
];


const to_user = ref();
const amount = ref(0);
const selected_payment_type = ref(gateWays[0]);

async function pay(values) {
    if (!confirm('Are you sure to proceed?')) {
        return;
    }

    const data = {
        to_user: values.to_user,
        amount: values.amount,
        payment_type: selected_payment_type.value.payment_type
    }
    // console.log(data);
//  return false;
    pStore.startAjaxLoading = true;
    await pStore.ajaxClient
        .post("pay", data, {
            headers: {
                "Content-type": "application/json",
                Authorization: `Bearer ${pStore.token}`,
            }
        })
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
            // console.log(error);
            // return;
            pStore.handleAjaxClientError(error.response)
        });
}
function validateAmount(value) {
    // if the field is empty
    if (!value || Number(value) < 1) {
        //console.log('Valid amount is required')
        return 'Valid amount is required';
    }
    console.log(props);
    console.log(Number(value));
    if (Number(value) > Number(props.balance)) {
        console.log('Yuo don\'t have enough balance')
        return 'Yuo don\'t have enough balance';
    }
    // All is good
    return true;
}
function isRquired(value) {
    if (!value) {
        console.log(value)
        return 'Field is required';
    }
    return true;
}


</script>
<style scoped>
.error-color {
    color: red
}
</style>