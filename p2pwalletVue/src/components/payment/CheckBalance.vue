<template>
    <div class="flex justify-between items-center mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Account Balance</h5>
            <span class="text-sm font-medium text-blue-600 dark:text-blue-500">
                <div class="flex flex-row">
                    <div class="basis-1/2 sm:1/1">
                        {{ new Intl.NumberFormat('en-US', {
                                style: 'currency', currency: wallet.currency
                            }).format(wallet.balance)
                        }}
                    </div>
                </div>
            </span>
        </div>
</template>
<script setup>
// in <script setup>
defineProps({
  wallet: Array
})

const wallet = { currency: 'EUR', balance: 500000 }

</script>