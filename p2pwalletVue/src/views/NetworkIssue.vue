<template>
    <div>
        <h1>Uh-Oh!</h1>
        <h3>It looks like you're experiencing some network issues, please click the back button and try again</h3>
        <router-link :to="{name:'login'}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Go back</router-link>
    </div>
</template>
<script>
export default {
    
}
</script>