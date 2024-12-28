<template>
  <div id="AuthPage" class="w-full h-[100vh] bg-white">
    <div class="max-w-[400px] mx-auto px-2">
      <div class="text-center my-4">
        <button @click="showLogin = true" :class="{ 'font-bold': showLogin }">Login</button>
        <span class="mx-2">/</span>
        <button @click="showLogin = false" :class="{ 'font-bold': !showLogin }">Register</button>
      </div>

      <!-- Hiển thị lỗi -->
      <div v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</div>

      <form v-if="showLogin" @submit.prevent="loginWithEmail">
        <div class="my-4">
          <input v-model="email" type="email" placeholder="Email" class="w-full p-2 border rounded" required />
        </div>
        <div class="my-4">
          <input v-model="password" type="password" placeholder="Password" class="w-full p-2 border rounded" required />
        </div>
        <button :disabled="isLoading" type="submit" class="w-full p-2 bg-blue-500 text-white rounded">
          {{ isLoading ? "Logging in..." : "Login" }}
          
        </button>
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
          <input
            v-model="confirmPassword"
            type="password"
            placeholder="Confirm Password"
            class="w-full p-2 border rounded"
            required
          />
        </div>
        <button :disabled="isLoading" type="submit" class="w-full p-2 bg-green-500 text-white rounded">
          {{ isLoading ? "Registering..." : "Register" }}
        </button>
      </form>
    </div>
    <Loading v-if="isLoading"/>
  </div>
</template>

<script setup>
import axios from "../src/axiosClient";
import { ref } from "vue";
import { useRouter } from "vue-router";

const email = ref("");
const password = ref("");
const name = ref("");
const confirmPassword = ref("");
const showLogin = ref(true);
const errorMessage = ref("");
const isLoading = ref(false);
const router = useRouter();

// Lấy CSRF token và set vào header
const getCsrfToken = async () => {
  try {
    await axios.get("/sanctum/csrf-cookie");
    const xsrfToken = document.cookie
      .split("; ")
      .find((row) => row.startsWith("XSRF-TOKEN"))
      ?.split("=")[1];

    if (xsrfToken) {
      axios.defaults.headers.common["X-XSRF-TOKEN"] = decodeURIComponent(xsrfToken);
    }
  } catch (error) {
    console.error("Failed to set CSRF token:", error);
    throw error;
  }
};

const loginWithEmail = async () => {
  isLoading.value = true;
  errorMessage.value = "";
  try {
    await getCsrfToken(); // Lấy CSRF token trước khi gửi request
    const response = await axios.post("/auth/login", {
      email: email.value,
      password: password.value,
    });
    localStorage.setItem("authToken", response.data.token);
    router.push("/");
  } catch (error) {
    errorMessage.value = error.response?.data?.message || "Login failed";
  } finally {
    isLoading.value = false;
  }
};

const registerWithEmail = async () => {
  if (password.value !== confirmPassword.value) {
    errorMessage.value = "Passwords do not match";
    return;
  }
  isLoading.value = true;
  errorMessage.value = "";
  try {
    await getCsrfToken(); // Lấy CSRF token trước khi gửi request
    const response = await axios.post("/auth/register", {
      name: name.value,
      email: email.value,
      password: password.value,
    });
    console.log("Registration successful:", response.data);
    localStorage.setItem("authToken", response.data.token);
    router.push("/");
  } catch (error) {
    errorMessage.value = error.response?.data?.message || "Register failed";
  } finally {
    isLoading.value = false;
  }
};
</script>
