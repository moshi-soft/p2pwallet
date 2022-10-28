<template>

    <div class="flow-root">
        <div class="w-full px-4 py-3">
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
                <label for="users" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Pay
                    To</label>
                <select id="users"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Select User</option>
                    <option :value="user.id" v-for="user in users">{{ user.name }}</option>
                </select>
            </div>
            <label for="website-admin"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Amount</label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    {{ wallet.currency }}
                </span>
                <input type="number" id="amount"
                    class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Amount">
            </div>
            <br>
            <button type="button"
                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Pay</button>
        </div>
    </div>

</template>
<script setup>
import { ref } from 'vue'
import {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupDescription,
    RadioGroupOption,
} from '@headlessui/vue'

const gateWays = [
    {
        payment_type: 'P2P',
        name: 'P2P Tranfser'
    }
]
const users = [
    { id: 1, name: 'A' },
    { id: 2, name: 'B' }
]
const wallet = { currency: 'EUR', balance: 500000 }
// const wallet={currency:'EUR','balance':500000}

const to_user = ref()
const amount = ref(0)
const selected_payment_type = ref(gateWays[0])
console.log(selected_payment_type);

</script>