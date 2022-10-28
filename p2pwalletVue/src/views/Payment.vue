<template>
    <div>
        <div class="flex flex-row justify-center">
            <div
                class="p-4 w-full max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <CheckBalance />
                <hr>
                <Pay />
            </div>
        </div>

    </div>
</template>
<script setup>
import CheckBalance from '../components/payment/CheckBalance.vue';
import Pay from '../components/payment/Pay.vue';
</script>