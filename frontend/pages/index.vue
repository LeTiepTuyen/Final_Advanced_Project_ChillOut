<template>
  <MainLayout>
    <div id="IndexPage" class="mt-4 max-w-[1200px] mx-auto px-2">
      <div v-if="route.query.search" class="text-xl font-bold mb-4">
        Search Results for "{{ route.query.search }}" ({{ products?.length || 0 }} products found)
      </div>
      <div class="mb-4 flex space-x-2">
        <button @click="setSortOrder('default')" :class="{'bg-[#FD374F] text-white': sortOrder === 'default', 'bg-gray-200': sortOrder !== 'default'}" class="px-4 py-2 rounded">
          All
        </button>
        <button @click="setSortOrder('low-to-high')" :class="{'bg-[#FD374F] text-white': sortOrder === 'low-to-high', 'bg-gray-200': sortOrder !== 'low-to-high'}" class="px-4 py-2 rounded">
          Price: Low to High
        </button>
        <button @click="setSortOrder('high-to-low')" :class="{'bg-[#FD374F] text-white': sortOrder === 'high-to-low', 'bg-gray-200': sortOrder !== 'high-to-low'}" class="px-4 py-2 rounded">
          Price: High to Low
        </button>
      </div>
      <section class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 xs:grid-cols-1 gap-4">
        <!-- Hiển thị preload khi đang tải -->
        <article v-if="isLoading" v-for="index in 4" :key="'loading-' + index">
          <PreloadLayout />
        </article>
       
        <!-- Hiển thị sản phẩm sau khi tải -->
        <article v-if="!isLoading && products?.length > 0" v-for="product in sortedProducts" :key="product.id">
          <ProductComponent3 :product="product" />
        </article>
      </section>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from "~/layouts/MainLayout.vue";
import PreloadLayout from "~/components/PreloadLayout.vue";
import { useUserStore } from "~/stores/user";
import axios from "../src/axiosClient";
import { useRouter, useRoute } from "vue-router";
import { ref, onBeforeMount, watch, computed } from "vue";

const userStore = useUserStore();
const router = useRouter();
const route = useRoute();

let products = ref(null);
let isLoading = ref(true);
let sortOrder = ref("default");

const fetchProducts = async (query = "") => {
  try {
    const response = await axios.get("/products", { params: { query } });
    products.value = response.data.data;
    userStore.isLoading = false;
    isLoading.value = false;
  } catch (error) {
    console.error("Failed to fetch products", error);
    if (error.response && error.response.status === 404) {
      router.push("/404");
    }
    isLoading.value = false;
  }
};

const setSortOrder = (order) => {
  sortOrder.value = order;
};

const sortedProducts = computed(() => {
  if (sortOrder.value === "low-to-high") {
    return [...products.value].sort((a, b) => a.price - b.price);
  } else if (sortOrder.value === "high-to-low") {
    return [...products.value].sort((a, b) => b.price - a.price);
  }
  return products.value;
});

onBeforeMount(() => {
  fetchProducts(route.query.search || "");
});

watch(
  () => route.query.search,
  (newQuery) => {
    fetchProducts(newQuery || "");
    userStore.showNoResults = false;
    userStore.searchSuggestions = [];
  }
);
</script>