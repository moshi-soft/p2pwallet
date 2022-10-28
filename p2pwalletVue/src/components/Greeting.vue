<template>
    <div>
        <h4 class="mb-2 text-sm font-semibold text-gray-900 dark:text-white">Your Name: <span class="text-metal">{{pStore.getUser.name}}</span>, Email: <span class="text-metal">{{pStore.getUser.email}}</span></h4>
    </div>
</template>
<script setup>
import { inject } from 'vue'

const pStore = inject('providedStore')
</script>