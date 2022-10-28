<template>
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div
                class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
            </div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div>
                        <h1 class="text-2xl font-semibold text-center">P2P Wallet</h1>
                        <h2 class="text-2x font-semibold">Login Form</h2>
                    </div>
                    <alertDanger v-if="store.showError"  error-message="Validation Error" />
                    <div class="divide-y divide-gray-200">
                        <Form @submit="login">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="relative">
                                    <Field :rules="validateEmail" id="email" v-model="email" name="email" type="email"
                                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600"
                                        placeholder="Email address" />
                                    <ErrorMessage name="email" class="error-color" />
                                    <label for="email"
                                        class="absolute left-1 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-1 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">
                                        Email
                                        Address</label>
                                </div>
                                <div class="relative">
                                    <Field :rules="isRquired" v-model="password" required id="password" name="password"
                                        type="password"
                                        class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600"
                                        placeholder="Password" />
                                    <ErrorMessage name="password" class="error-color" />
                                    <label for="password"
                                        class="absolute left-1 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                                </div>
                                <div class="relative">
                                    <button class="bg-blue-500 text-white rounded-md px-2 py-1 hover:bg-blue-600">Submit
                                    </button>
                                </div>
                            </div>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { ref } from 'vue'
import { Form, Field, ErrorMessage } from 'vee-validate';
import {useAuthenticationStore} from '../store/authentication';

import alertDanger from '../components/lib/alert-danger.vue';

var js = document.createElement("script");
js.type = "text/javascript";
js.src = "/node_modules/flowbite/dist/flowbite.js";
document.body.appendChild(js);
// const showError = ref(true)
const email = ref(null)
const password = ref(null)
// const isLoading = ref(false);
const store = useAuthenticationStore();
async function login(values) {
    await store.tryLogin(values.email,values.password)
    // setTimeout(function () {
    //     isLoading.value = false
    // }, 2000)
    // isLoading.value = true
    //console.log(values);
    //console.log('Submitted');
}
function validateEmail(value) {
    // if the field is empty
    if (!value) {
        return 'Email is required';
    }
    // if the field is not a valid email
    const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if (!regex.test(value)) {
        return 'Invalid email address';
    }
    // All is good
    return true;
}
function isRquired(value) {
    //console.log('password rule');
    // if the field is empty
    if (!value) {
        return 'Value is required';
    }
    return true;
}
</script>
  
<style scoped>
.error-color {
    color: red
}
</style>