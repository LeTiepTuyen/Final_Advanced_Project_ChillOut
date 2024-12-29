<template>
  <MainLayout>
    <div id="IndexPage" class="mt-4 max-w-[1200px] mx-auto px-2">
      <section class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 xs:grid-cols-1 gap-4">
        <!-- Hiển thị preload khi đang tải -->
        <article v-if="isLoading" v-for="index in 4" :key="'loading-' + index">
          <PreloadLayout />
        </article>
       
        <!-- Hiển thị sản phẩm sau khi tải -->
        <article v-if="!isLoading" v-for="product in products.data" :key="product.id">
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
import { useRouter } from "vue-router";
import { ref, onBeforeMount, watch } from "vue";

const userStore = useUserStore();
const router = useRouter();
const route = useRoute();

let products = ref(null);
let isLoading = ref(true); 


const fetchProducts = async (query = "") => {
  try {
    const response = await axios.get("/products", { params: { query } });
    products.value = response.data;
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



