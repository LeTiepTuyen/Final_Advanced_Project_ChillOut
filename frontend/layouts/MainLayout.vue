<template>
  <div>
    <header id="MainLayout" class="w-full fixed z-50">
      <!-- Top Menu -->
      <div id="TopMenu" class="w-full bg-[#FAFAFA] border-b md:block hidden">
        <ul
          class="flex items-center justify-end text-xs text-[#333333] font-light px-2 h-10 bg-[#FAFAFA] max-w-[1200px]"
        >
          <li class="border-r border-r-gray-400 px-3 hover:text-[#FF4646] cursor-pointer">Sell on ShoppingWeb</li>
          <li class="border-r border-r-gray-400 px-3 hover:text-[#FF4646] cursor-pointer">Cookie Preferences</li>
          <li class="border-r border-r-gray-400 px-3 hover:text-[#FF4646] cursor-pointer">Help</li>
          <li class="border-r border-r-gray-400 px-3 hover:text-[#FF4646] cursor-pointer">Buyer Protection</li>
          <li class="px-3 hover:text-[#FF4646] cursor-pointer">
            <Icon name="ic:sharp-install-mobile" size="17" />
            App
          </li>

          <li
            @mouseenter="isAccountMenu = true"
            @mouseleave="isAccountMenu = false"
            class="relative flex items-center px-2.5 hover:text-[#FF4646] h-full cursor-pointer"
            :class="
              isAccountMenu
                ? 'bg-white border z-40 shadow-[0_15px_100px_40px_rgba(0,0,0,0.3)]'
                : 'border border-[#FAFAFA]'
            "
          >
            <Icon name="ph:user-thin" size="17" />
            Account
            <Icon name="mdi:chevron-down" size="15" class="ml-5" />

            <div
              id="AccountMenu"
              v-if="isAccountMenu"
              class="absolute bg-white w-[220px] text-[#333333] z-40 top-[38px] -left-[100px] border-x border-b"
            >
              <div v-if="!user">
                <div class="text-semibold text-[15px] my-4 px-3">Welcome to ShoppingWebsite!</div>
                <div class="flex items-center gap-1 px-3 mb-3">
                  <NuxtLink
                    to="/auth"
                    class="bg-[#FF4646] text-center w-full text-[16px] rounded-sm text-white font-semibold p-2"
                  >
                    Login / Register
                  </NuxtLink>
                </div>
              </div>
              <div class="border-b" />
              <ul class="bg-white">
                <li @click="navigateTo('/orders')" class="text-[13px] py-2 px-4 w-full hover:bg-gray-200">My Orders</li>
                <li v-if="user" @click="logout" class="text-[13px] py-2 px-4 w-full hover:bg-gray-200"><Loading v-if="isLoading"/> Sign out</li>
                
              </ul>
            </div>
          </li>
        </ul>
      </div>

      <!-- Main Header -->
      <div id="MainHeader" class="flex items-center w-full bg-white">
        <div class="flex lg:justify-start justify-between gap-10 max-w-[1150px] w-full px-3 py-5 mx-auto">
          <NuxtLink to="/" class="min-w-[170px]">
            <img width="130" src="/logo.png" alt="ShoppingWeb Logo" />
          </NuxtLink>
          <div id="search-bar" class="max-w-[700px] w-full md:block hidden my-auto">
            <div class="relative">
              <div class="flex items-center border-2 border-[#FF4646] rounded-md w-full">
                <input
                  v-model="searchQuery"
                  @keyup.enter="handleSearch"
                  type="text"
                  placeholder="Search for products..."
                  class="w-full placeholder-gray-400 text-sm pl-3 focus:outline-none"
                  aria-label="Search"
                />
                <Icon v-if="isSearching" name="eos-icons:loading" size="25" class="mr-2" />
                <button class="flex items-center h-[100%] p-1.5 px-2 bg-[#FF4646]" aria-label="Search">
                  <Icon name="ph:magnifying-glass" size="20" color="#ffffff" />
                </button>
              </div>
              <div v-if="searchQuery.trim() && searchSuggestions.length" class="absolute bg-white max-w-[700px] h-auto w-full border border-gray-200 rounded-md shadow-lg mt-1">
                <ul>
                  <li v-for="suggestion in searchSuggestions" :key="suggestion.id" class="flex items-center justify-between p-2 cursor-pointer hover:bg-gray-100" @click="navigateToProduct(suggestion.id)">
                    <div class="flex items-center">
                      <img class="rounded-md" width="40" :src="suggestion.image" alt="Product Image" />
                      <div class="truncate ml-2">
                        <div class="font-semibold">{{ suggestion.title }}</div>
                        <div class="text-sm text-gray-600">{{ suggestion.short_description }}</div>
                      </div>
                    </div>
                    <div class="truncate">${{ (suggestion.price / 100).toFixed(2) }}</div>
                  </li>
                </ul>
              </div>
              <div v-else-if="showNoResults && searchQuery.trim()" class="absolute bg-white max-w-[700px] h-auto w-full border border-gray-200 rounded-md shadow-lg mt-1">
                <div class="p-2 text-sm font-italic text-black-500 text-center font-bold">No product found</div>
              </div>
            </div>
          </div>
          <NuxtLink to="/shoppingcart" class="flex items-center">
            <button class="relative md:block hidden" @mouseenter="isCartHover = true" @mouseleave="isCartHover = false">
              <span
                class="absolute flex items-center justify-center -right-[3px] top-0 bg-[#FF4646] h-[17px] min-w-[17px] text-xs text-white px-0.5 rounded-full"
              >
                {{ userStore.cart.length }}
              </span>
              <div class="min-w-[40px]">
                <Icon name="ph:shopping-cart-simple-light" size="33" :color="isCartHover ? '#FF4646' : ''" />
              </div>
            </button>
          </NuxtLink>

          <button
            @click="userStore.isMenuOverlay = true"
            class="md:hidden block rounded-full p-1.5 -mt-[4px] hover:bg-gray-200"
          >
            <Icon name="radix-icons:hamburger-menu" size="33" />
          </button>
        </div>
      </div>
    </header>

    
    <main class="lg:pt-[150px] md:pt-[130px] pt-[80px]">
      <slot />
    </main>
    <Footer v-if="!userStore.isLoading" />
  </div>
</template>

<script setup>
import { useUserStore } from "~/stores/user";
import axios from "../src/axiosClient";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { debounce } from "lodash";
import { watch } from "vue";

const userStore = useUserStore();
const user = ref(null);
const router = useRouter();

let isLoading = ref(false);

onMounted(async () => {
  const authToken = localStorage.getItem("authToken");
  if (!authToken) {
    return; // Không gửi request nếu không có token
  }

  try {
    const response = await axios.get("/profile");
    user.value = response.data.data;
  } catch (error) {
    console.error("Failed to fetch user profile. Logging out...");
    localStorage.removeItem("authToken");
    router.push("/auth");
  }
});

const logout = async () => {
  isLoading.value = true;
  try {
    await axios.post("/logout");
    user.value = null;
    localStorage.removeItem("authToken"); // Remove token
    router.push("/auth");
  } catch (error) {
    console.error("Logout failed", error);
  }
};

let isAccountMenu = ref(false);
let isCartHover = ref(false);
let isSearching = ref(false);

const searchQuery = ref("");
let searchSuggestions = ref([]);
let noResultsTimeout = null;
let showNoResults = ref(false);

const handleSearch = () => {
  if (searchQuery.value.trim()) {
    router.push({ path: "/", query: { search: searchQuery.value } });
    searchSuggestions.value = []; // Xóa ngay lập tức
    showNoResults.value = false;
  }
};


const fetchSuggestions = debounce(async (newQuery) => {
  if (newQuery.trim()) {
    isSearching.value = true;
    try {
      const response = await axios.get("/products", { params: { query: newQuery } });
      searchSuggestions.value = response.data.data.map(product => ({
        id: product.id,
        image: product.images[0]?.url || '/default-image.png',
        title: product.title,
        short_description: product.short_description,
        price: product.price
      }));
      showNoResults.value = response.data.data.length === 0;
    } finally {
      isSearching.value = false;
    }
  } else {
    searchSuggestions.value = [];
    showNoResults.value = false;
  }
}, 300); 

watch(
  () => searchQuery.value,
  (newQuery) => {
    fetchSuggestions(newQuery);
    showNoResults.value = false;
    clearTimeout(noResultsTimeout);
  }
);

watch(
  () => searchSuggestions.value,
  (newSuggestions) => {
    if (!searchQuery.value.trim()) {
      showNoResults.value = false;
      return;
    }
    showNoResults.value = newSuggestions.length === 0;
  }
);


const navigateToProduct = (id) => {
  router.push(`/item/${id}`);
};

const navigateToOrders = () => {
  router.push("/orders");
};
</script>