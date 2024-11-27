<template>
  <MainLayout>
    <div
      id="SuccessPage"
      class="mt-4 max-w-[1200px] mx-auto px-2 flex items-center justify-center min-h-[50vh]"
    >
      <div
        class="bg-white w-full max-w-lg p-6 rounded-lg shadow-md text-center"
      >
        <div class="flex items-center justify-center">
          <Icon
            name="clarity:success-standard-line"
            color="#5FCB04"
            size="35"
          />
          <h2 class="text-xl font-semibold ml-2">Order Successful</h2>
        </div>
        <p class="text-sm mt-2">Thank you! We've received your order.</p>

        <!-- Button to navigate back to homepage -->
        <router-link
          to="/"
          class="mt-4 inline-block bg-red-500 text-white text-lg font-semibold px-4 py-2 rounded-full transition transform hover:shadow-lg hover:scale-105 ease-in-out duration-300"
        >
          Back to Homepage
        </router-link>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from "~/layouts/MainLayout.vue";
import { useUserStore } from "~/stores/user";

const userStore = useUserStore();

onMounted(() => {
  setTimeout(() => {
    userStore.isLoading = false;
  }, 300);
});
</script>

<style scoped>
/* Optional: Add scoped styles if needed */
#SuccessPage {
  background-color: #f3f4f6;
}

.bg-white {
  background-color: #ffffff;
}

.text-xl {
  font-size: 1.25rem;
}

.text-sm {
  font-size: 0.875rem;
}

.max-w-lg {
  max-width: 32rem;
}

.rounded-lg {
  border-radius: 0.5rem;
}

.shadow-md {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
}

.text-center {
  text-align: center;
}

/* Styles for the back to homepage button */
.router-link {
  text-decoration: none;
}
.router-link:hover {
  text-decoration: none;
}
</style>
