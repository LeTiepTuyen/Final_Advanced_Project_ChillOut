<template>
  <div class="fixed z-[-1] bg-[#F2F2F2] w-full h-[100vh]"></div>
  <NuxtPage />


  <MenuOverlay
    :class="[
      { 'max-h-[100vh] transition-all duration-200 ease-in visible': userStore.isMenuOverlay },
      { 'max-h-0 transition-all duration-200 ease-out invisible': !userStore.isMenuOverlay },
    ]"
  />
</template>


<script setup>
import { useUserStore } from "~/stores/user";
import { onMounted, ref, watch } from "vue";
import { useRoute } from "vue-router";


const userStore = useUserStore();
const route = useRoute();
let windowWidth = ref(process.client ? window.innerWidth : 0);


onMounted(async () => {
  const authToken = localStorage.getItem("authToken");
  if (!authToken) {
    userStore.isLoading = false; // Không hiển thị loading nếu không có token
    return;
  }


  try {
    userStore.isLoading = true;
    const response = await axios.get("/profile");
    userStore.user = response.data.data; // Lưu thông tin user nếu hợp lệ
  } catch (error) {
    console.warn("Invalid token. Clearing user session...");
    localStorage.removeItem("authToken");
  } finally {
    userStore.isLoading = false;
  }
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
    userStore.isLoading = false;
  }
);
</script>

