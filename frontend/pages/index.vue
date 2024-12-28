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
import PreloadLayout from "~/components/PreloadLayout.vue"; // Import component preload layout
import { useUserStore } from "~/stores/user";
import axios from "../src/axiosClient";
import { useRouter } from "vue-router";


const userStore = useUserStore();
const router = useRouter();


let products = ref(null);
let isLoading = ref(true); // Thêm biến isLoading để kiểm tra trạng thái tải


onBeforeMount(async () => {
  try {
    const response = await axios.get("/products");
    products.value = response.data;
    userStore.isLoading = false;
    isLoading.value = false; // Đặt isLoading thành false khi API đã tải xong
  } catch (error) {
    console.error("Failed to fetch products", error);
    if (error.response && error.response.status === 404) {
      router.push("/404");
    }
    isLoading.value = false; // Dù có lỗi hay không, cũng đặt isLoading thành false
  }
});
</script>



