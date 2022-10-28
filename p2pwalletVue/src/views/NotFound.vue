<template>
    <div>
        <div class="bg-gray-100 mt-6 py-6 flex flex-col sm:py-12">
            <h1>Oops!</h1>
            <h3>The {{ resource }} you're looking for is not here.</h3>
            <router-link :to="{ name: 'login' }">Back to the login page</router-link>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        resource: {
            type: String,
            required: true,
            default: 'page'
        }
    }
}
</script>