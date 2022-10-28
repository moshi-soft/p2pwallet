<template>
  <Navbar/>
  <div class="pl-2 pt-2">
    <RouterView/>
  </div>
  <overly v-if="store.startAjaxLoading" />
</template>

<script setup>
import { ref,provide } from 'vue'
import {useAuthenticationStore} from '../src/store/authentication';
import Navbar from './components/layout/Navbar.vue';
import overly from '../src/components/lib/overly.vue';
// import { Form, Field, ErrorMessage } from 'vee-validate';
// import overly from './components/lib/overly.vue';
// import alertDanger from './components/lib/alert-danger.vue';

var js = document.createElement("script");
js.type = "text/javascript";
js.src = "/node_modules/flowbite/dist/flowbite.js";
document.body.appendChild(js);

const store = useAuthenticationStore();
provide('providedStore', store)

const email = ref(null)
const password = ref(null)

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