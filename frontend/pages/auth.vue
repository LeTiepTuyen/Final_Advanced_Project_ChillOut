<template>
  <div id="AuthPage" class="w-full h-[100vh] bg-white">
    <div class="w-full flex items-center justify-center p-5 border-b border-b-gray-300">
      <NuxtLink to="/" class="min-w-[170px]">
        <img width="170" src="/logo.png" alt="Logo" />
      </NuxtLink>
    </div>
    
    <div class="max-w-[400px] mx-auto px-2">
      <button
        @click="login('google')"
        class="flex items-center justify-center gap-3 p-1.5 w-full border hover:bg-gray-100 rounded-full text-lg font-semibold"
      >
        <img class="w-full max-w-[30px]" src="/google-logo.png" alt="Google Logo" />
        <div>Google</div>
      </button>

      <button
        @click="login('github')"
        class="mt-4 flex items-center justify-center gap-3 p-1.5 w-full border hover:bg-gray-100 rounded-full text-lg font-semibold"
      >
        <img class="w-full max-w-[30px]" src="/github-logo.png" alt="GitHub Logo" />
        <div>Github</div>
      </button>

      <div class="text-center my-4">
        <button @click="showLogin = true" :class="{'font-bold': showLogin}">Login</button>
        <span class="mx-2">/</span>
        <button @click="showLogin = false" :class="{'font-bold': !showLogin}">Register</button>
      </div>

      <form v-if="showLogin" @submit.prevent="loginWithEmail">
        <div class="my-4">
          <input v-model="email" type="email" placeholder="Email" class="w-full p-2 border rounded" required />
        </div>
        <div class="my-4">
          <input v-model="password" type="password" placeholder="Password" class="w-full p-2 border rounded" required />
        </div>
        <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded">Login</button>
      </form>

      <form v-else @submit.prevent="registerWithEmail">
        <div class="my-4">
          <input v-model="name" type="text" placeholder="Name" class="w-full p-2 border rounded" required />
        </div>
        <div class="my-4">
          <input v-model="email" type="email" placeholder="Email" class="w-full p-2 border rounded" required />
        </div>
        <div class="my-4">
          <input v-model="password" type="password" placeholder="Password" class="w-full p-2 border rounded" required />
        </div>
        <div class="my-4">
          <input v-model="confirmPassword" type="password" placeholder="Confirm Password" class="w-full p-2 border rounded" required />
        </div>
        <button type="submit" class="w-full p-2 bg-green-500 text-white rounded">Register</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import axios from "../src/axiosClient";
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');
const name = ref('');
const confirmPassword = ref('');
const showLogin = ref(true);
const router = useRouter();

const loginWithEmail = async () => {
  try {
    const response = await axios.post('/login', {
      email: email.value,
      password: password.value,
    });
    console.log('Login successful', response.data);
    localStorage.setItem('authToken', response.data.token); // Store token
    router.push('/'); // Redirect to homepage
  } catch (error) {
    handleError('Login failed', error);
  }
};

const registerWithEmail = async () => {
  if (password.value !== confirmPassword.value) {
    handleError('Passwords do not match');
    return;
  }
  try {
    const response = await axios.post('/register', {
      name: name.value,
      email: email.value,
      password: password.value,
    }); 
    console.log('Register successful', response.data);
    localStorage.setItem('authToken', response.data.token); // Store token
    router.push('/'); // Redirect to homepage
  } catch (error) {
    handleError('Register failed', error);
  }
};
</script>