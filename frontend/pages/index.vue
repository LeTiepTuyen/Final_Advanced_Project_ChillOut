<template>
  <MainLayout>
    <div id="IndexPage" class="mt-4 max-w-[1200px] mx-auto px-2">
      <section class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 xs:grid-cols-1 gap-4">
        <article v-if="products" v-for="product in products.data" :key="product.id">
          <ProductComponent3 :product="product" />
        </article>
      </section>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from "~/layouts/MainLayout.vue";
import { useUserStore } from "~/stores/user";
const userStore = useUserStore();

let products = ref(null);

onBeforeMount(async () => {
  try {
    products.value = await useFetch("/api/prisma/get-all-products");
    userStore.isLoading = false;
  } catch (error) {
    console.error("Failed to fetch products:", error);
  }
});
</script>
