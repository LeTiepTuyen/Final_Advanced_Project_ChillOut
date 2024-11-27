<template>
  <div
    v-if="userStore.isLoading"
    class="fixed bg-white inset-0 w-full z-40 flex items-center justify-center h-[100vh] overflow-hidden"
  >
    <div class="p-3 rounded-md bg-orange-100">
      <svg
        class="animate-spin h-24 w-24 text-orange-500"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
      >
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
      </svg>
      <div class="text-center pt-5 text-xl font-bold text-orange-600">Loading...</div>
    </div>
  </div>

  <div v-else>
    <div class="fixed z-[-1] bg-[#F2F2F2] w-full h-[100vh]"></div>
    <NuxtPage />

    <MenuOverlay
      :class="[
        { 'max-h-[100vh] transition-all duration-200 ease-in visible': userStore.isMenuOverlay },
        { 'max-h-0 transition-all duration-200 ease-out invisible': !userStore.isMenuOverlay },
      ]"
    />
  </div>
</template>

<script setup>
import { useUserStore } from "~/stores/user";
import { onMounted, ref, watch } from "vue";
import { useRoute } from "vue-router";

const userStore = useUserStore();
const route = useRoute();
let windowWidth = ref(process.client ? window.innerWidth : 0);

const isPageLoadedSuccess = () => {
  return new Promise((resolve) => {
    const checkReadyState = () => {
      if (document.readyState === "complete") {
        if (window.jQuery) {
          if (window.jQuery.active === 0) {
            resolve(true);
          } else {
            setTimeout(checkReadyState, 100);
          }
        } else {
          resolve(true);
        }
      } else {
        setTimeout(checkReadyState, 100);
      }
    };
    checkReadyState();
  });
};

const delay = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

onMounted(async () => {
  window.addEventListener("resize", () => {
    windowWidth.value = window.innerWidth;
  });

  userStore.isLoading = true;
  await delay(500); // Ensuring the isLoading state is updated
  await isPageLoadedSuccess();
  userStore.isLoading = false;
});

watch(
  () => windowWidth.value,
  () => {
    if (windowWidth.value >= 767) {
      userStore.isMenuOverlay = false;
    }
  }
);

watch(
  () => route.fullPath,
  async () => {
    userStore.isLoading = true;
    await delay(500); // Ensuring the isLoading state is updated
    await isPageLoadedSuccess();
    userStore.isLoading = false;
  }
);
</script>
