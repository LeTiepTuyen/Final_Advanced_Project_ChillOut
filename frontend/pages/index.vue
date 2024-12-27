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
import axios from "../src/axiosClient";
import { ref, onBeforeMount, watch } from "vue";
import { useRoute } from "vue-router";


const route = useRoute();

let products = ref(null);

const fetchProducts = async (query = "") => {
  try {
    const response = await axios.get("/products", { params: { query } });
    console.log(response.data); // Thêm dòng này để kiểm tra dữ liệu
    products.value = response.data;
  } catch (error) {
    console.error("Failed to fetch products", error);
  }
};

onBeforeMount(() => {
  fetchProducts(route.query.search || "");
});

watch(
  () => route.query.search,
  (newQuery) => {
    fetchProducts(newQuery || "");
  }
);
</script>
