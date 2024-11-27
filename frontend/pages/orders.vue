<template>
  <MainLayout>
    <div id="OrdersPage" class="mt-4 max-w-5xl mx-auto px-4 min-h-screen">
      <div class="bg-white shadow-md rounded-lg p-6 min-h-[150px]">
        <div class="flex items-center text-2xl font-semibold mb-6">
          <Icon name="carbon:delivery" color="#5FCB04" size="35" />
          <span class="pl-4">Orders</span>
        </div>

        <div v-if="orders && orders.length > 0" class="space-y-6">
          <div
            v-for="order in orders"
            :key="order.id"
            class="border rounded-lg p-4 bg-gray-50 shadow-sm"
          >
            <p class="text-lg font-medium">
              Order ID: <span class="text-gray-700">{{ order.id }}</span>
            </p>

            <div class="mt-4 space-y-3">
              <div
                v-for="item in order.orderItem"
                :key="item.id"
                class="flex items-center gap-4 p-2 bg-white rounded-lg shadow-sm"
              >
                <img
                  width="60"
                  class="rounded-lg"
                  :src="item.product.url"
                  alt="Product Image"
                />
                <NuxtLink
                  class="hover:underline hover:text-blue-600"
                  :to="`/item/${item.productId}`"
                >
                  <p class="text-lg text-gray-800">{{ item.product.title }}</p>
                </NuxtLink>
              </div>
            </div>

            <div class="mt-4 text-sm text-gray-600">
              <p class="font-semibold">Delivery Address:</p>
              <p>
                {{ order.name }}, {{ order.address }}, {{ order.zipcode }},
                {{ order.city }}, {{ order.country }}
              </p>
            </div>
          </div>
        </div>

        <div v-else class="flex items-center justify-center h-40">
          <p class="text-lg text-gray-500">You have no order history</p>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from "~/layouts/MainLayout.vue";
import { useUserStore } from "~/stores/user";
const userStore = useUserStore();
const user = useSupabaseUser();

let orders = ref([]);

onBeforeMount(async () => {
  if (!user.value) {
    return navigateTo("/auth");
  }

  const { data } = await useFetch(
    `/api/prisma/get-all-orders-by-user/${user.value.id}`
  );
  if (data.value) {
    orders.value = data.value;
  }

  setTimeout(() => (userStore.isLoading = false), 200);
});
</script>

<style scoped>
#OrdersPage {
  background-color: #f9fafb;
}
</style>
