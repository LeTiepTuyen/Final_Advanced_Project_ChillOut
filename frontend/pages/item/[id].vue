<template>
  <MainLayout>
    <div id="ItemPage" class="mt-4 max-w-[1200px] mx-auto px-2">
      <div class="md:flex gap-6 justify-between mx-auto w-full">
        <div class="md:w-[40%]">
          <img v-if="currentImage" class="rounded-lg object-cover" :src="currentImage" width="500" height="400" />

          <div
            v-if="images.length > 0"
            class="flex items-center justify-center mt-4 space-x-1 justify-between md:flex-nowrap"
          >
            <div v-for="image in images" :key="image">
              <img
                @mouseover="currentImage = image.url"
                @click="currentImage = image.url"
                width="85"
                class="rounded-md object-cover border-[3px] cursor-pointer"
                :class="currentImage === image.url ? 'border-[#FF5353]' : 'border-transparent'"
                :src="image.url"
                loading="lazy"
              />
            </div>
          </div>
        </div>
        <div class="md:w-[55%] bg-white p-6 rounded-lg shadow-md flex flex-col justify-between">
          <div>
            <div v-if="product && product.data">
              <p class="text-2xl font-semibold text-gray-800 mb-2">{{ product.data.title }}</p>
              <p class="text-md text-gray-600 mb-4 leading-relaxed">{{ product.data.description }}</p>
            </div>

            <div class="flex items-center py-2">
              <span class="flex items-center justify-center w-5 h-5 rounded-full bg-yellow-400 mr-2">
                <Icon name="material-symbols:star-rounded" class="text-white" size="12" />
              </span>
              <p class="text-red-500 font-semibold text-sm">Extra 5% off</p>
            </div>

            <div class="flex items-center my-4">
              <Icon name="ic:baseline-star" color="#FF5353" size="20" />
              <Icon name="ic:baseline-star" color="#FF5353" size="20" />
              <Icon name="ic:baseline-star" color="#FF5353" size="20" />
              <Icon name="ic:baseline-star" color="#FF5353" size="20" />
              <Icon name="ic:baseline-star" color="#FF5353" size="20" />
              <span class="text-sm text-gray-600 font-light ml-2">5,213 Reviews · 1,000+ orders</span>
            </div>

            <div class="flex items-center my-4">
              <div class="text-xl font-bold text-gray-800">$ {{ priceComputed }}</div>
              <span class="bg-gray-100 border border-gray-300 text-orange-500 text-sm font-semibold px-2 py-1 rounded-sm ml-3"
                >70% off</span
              >
            </div>


            <p class="text-green-600 text-sm font-semibold my-2">Free 11-day delivery over ￡8.28</p>
            <p class="text-green-600 text-sm font-semibold my-2">Free Shipping</p>


            <p style="color: rgb(255, 255, 255)">This text is white too.</p>
          </div>
          
          <button
            @click="addToCart()"
            :disabled="isInCart"

            class="mt-6 w-full px-6 py-3 rounded-lg text-white text-lg font-semibold bg-red-500 transition-transform transform hover:scale-105 disabled:opacity-50"

          >
            <div>{{ isInCart ? 'Is Added' : 'Add to Cart' }}</div>
          </button>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from "~/layouts/MainLayout.vue";
import { useUserStore } from "~/stores/user";
const userStore = useUserStore();

const route = useRoute();

let product = ref(null);
let currentImage = ref(null);
const images = ref([]);

onBeforeMount(async () => {
  product.value = await useFetch(`/api/prisma/get-product-by-id/${route.params.id}`);
});

watchEffect(() => {
  if (product.value && product.value.data) {
    currentImage.value = product.value.data.url;
    images.value = product.value.data.images || [product.value.data.url]; // Use the images field from the product data
    userStore.isLoading = false;
  }
});

const isInCart = computed(() => {
  let res = false;
  userStore.cart.forEach((prod) => {
    if (route.params.id == prod.id) {
      res = true;
    }
  });
  return res;
});

const priceComputed = computed(() => {
  if (product.value && product.value.data) {
    return product.value.data.price / 100;
  }
  return "0.00";
});



const addToCart = () => {
  userStore.cart.push(product.value.data);
};
</script>
