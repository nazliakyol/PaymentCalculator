<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">E-mail</label>
                <input id="email" type="text" class="input" v-model="form.email"/>
                <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input id="password" type="password" class="input" v-model="form.password"  />
                <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn-primary w-full">Login</button>

            </div>
        </div>
    </form>
</template>

<script setup>

import {useForm, Link} from "@inertiajs/vue3";

const form = useForm(
    {
        email: null,
        password: null,
    }
)
const login = () => {
    form.post(route('login.store'));
}
</script>
