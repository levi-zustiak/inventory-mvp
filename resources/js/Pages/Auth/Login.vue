<script setup>
import { reactive } from "vue";
import {router} from "@inertiajs/vue3";

const form = reactive({
    email: '',
    password: '',
})

function submit() {
    router.post('/login', form)
}
</script>

<template>
  <div class="container">
    <form @submit.prevent="submit">
        <label for="email">Email</label>
        <input id="email" v-model="form.email"/>
        <label for="password">Password</label>
        <input id="password" v-model="form.password"/>
        <button type="submit">Login</button>
    </form>
  </div>
</template>

<style scoped>
    .container {
        height: 100vh;
        width: 100vw;
        border: 2px solid orange;
    }
</style>
