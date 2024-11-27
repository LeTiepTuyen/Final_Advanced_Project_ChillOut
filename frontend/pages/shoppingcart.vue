<!-- <template>
  <MainLayout>
    <div id="ShoppingCartPage" class="mt-4 max-w-[1200px] mx-auto px-2">
      <div
        v-if="!userStore.cart.length"
        class="h-[500px] flex items-center justify-center"
      >
        <div class="pt-20 text-center">
          <img
            class="mx-auto"
            width="250"
            src="/cart-empty.png"
            alt="Empty Cart"
          />
          <div class="text-xl mt-4">No items yet?</div>
          <div v-if="!user" class="flex justify-center mt-4">
            <NuxtLink
              to="/auth"
              class="bg-red-500 w-full text-white text-xl font-semibold py-2 rounded-full hover:bg-red-600 transition duration-300"
            >
              Sign in
            </NuxtLink>
          </div>
        </div>
      </div>
      <div v-else class="md:flex gap-4 justify-between mx-auto w-full">
        <div class="md:w-[65%]">
          <div class="bg-white rounded-lg p-4 shadow-sm">
            <div class="text-2xl font-bold mb-2">
              Shopping Cart ({{ userStore.cart.length }})
            </div>
          </div>
          <div class="bg-pink-100 rounded-lg p-4 mt-4">
            <div class="text-red-500 font-bold">
              Welcome Deal applicable on 1 item only
            </div>
          </div>
          <div id="Items" class="bg-white rounded-lg p-4 mt-4 shadow-sm">
            <div
              v-for="product in userStore.cart"
              :key="product.id"
              class="mb-4 relative"
            >
              <CartItem
                :product="product"
                :selectedArray="selectedArray"
                @selectedRadio="selectedRadioFunc"
              />
              <div
                class="quantity-controls absolute bottom-4 right-4 flex items-center bg-gray-100 p-2 rounded-full shadow-md"
              >
                <button
                  @click="decreaseQuantity(product)"
                  class="quantity-button"
                >
                  -
                </button>
                <span class="mx-4">{{ product.quantity }}</span>
                <button
                  @click="increaseQuantity(product)"
                  class="quantity-button"
                >
                  +
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="md:hidden block my-4"></div>
        <div class="md:w-[35%]">
          <div id="Summary" class="bg-white rounded-lg p-4 shadow-sm">
            <div class="text-2xl font-extrabold mb-2">Summary</div>
            <div class="flex items-center justify-between my-4">
              <div class="font-semibold">Total</div>
              <div class="text-2xl font-semibold">
                $ <span class="font-extrabold">{{ totalPriceComputed }}</span>
              </div>
            </div>
            <button
              @click="goToCheckout"
              class="checkout-button w-full bg-red-500 text-white text-lg font-semibold px-4 py-2 rounded-full mt-4 transition transform hover:shadow-2xl hover:scale-105 ease-in-out duration-300"
            >
              Checkout
            </button>
          </div>
          <div
            id="PaymentProtection"
            class="bg-white rounded-lg p-4 mt-4 shadow-sm"
          >
            <div class="text-lg font-semibold mb-2">Payment methods</div>
            <div class="flex items-center justify-start gap-8 my-4">
              <div v-for="card in cards" :key="card">
                <img class="h-6" :src="card" alt="Payment Method" />
              </div>
            </div>
            <div class="border-b"></div>
            <div class="text-lg font-semibold mb-2 mt-2">Buyer Protection</div>
            <p class="my-2">
              Get full refund if the item is not as described or if is not
              delivered
            </p>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import CartItem from "~/components/CartItem.vue";
import MainLayout from "~/layouts/MainLayout.vue";
import { useUserStore } from "~/stores/user";
const userStore = useUserStore();
const user = useSupabaseUser();

let selectedArray = ref([]);

onMounted(() => {
  setTimeout(() => (userStore.isLoading = false), 200);
});

const cards = ref(["visa.png", "mastercard.png", "paypal.png", "applepay.png"]);

const totalPriceComputed = computed(() => {
  let price = 0;
  userStore.cart.forEach((prod) => {
    price += prod.price;
  });
  return price / 100;
});

const selectedRadioFunc = (e) => {
  const index = selectedArray.value.findIndex((item) => item.id === e.id);
  if (index !== -1) {
    selectedArray.value.splice(index, 1);
  } else {
    selectedArray.value.push(e);
  }
};

const goToCheckout = () => {
  userStore.checkout = userStore.cart.filter((item) =>
    selectedArray.value.some((selected) => selected.id === item.id)
  );
  navigateTo("/checkout");
};

const increaseQuantity = (product) => {
  product.quantity += 1;
};

const decreaseQuantity = (product) => {
  if (product.quantity > 1) {
    product.quantity -= 1;
  }
};
</script>

<style scoped>
.checkout-button:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.quantity-controls {
  background-color: #f8f9fa;
  border: 1px solid #e0e0e0;
  border-radius: 9999px;
  display: flex;
  align-items: center;
  padding: 0.5rem 1rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.quantity-button {
  background-color: #f0f0f0;
  border: none;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.2s, transform 0.2s;
}

.quantity-button:hover {
  background-color: #e0e0e0;
  transform: scale(1.1);
}
</style> -->

<template>
  <MainLayout>
    <div id="ShoppingCartPage" class="mt-4 max-w-[1200px] mx-auto px-2">
      <div
        v-if="!userStore.cart.length"
        class="h-[500px] flex items-center justify-center"
      >
        <div class="pt-20 text-center">
          <img
            class="mx-auto"
            width="250"
            src="/cart-empty.png"
            alt="Empty Cart"
          />
          <div class="text-xl mt-4">No items yet?</div>
          <div v-if="!user" class="flex justify-center mt-4">
            <NuxtLink
              to="/auth"
              class="bg-red-500 w-full text-white text-xl font-semibold py-2 rounded-full hover:bg-red-600 transition duration-300"
            >
              Sign in
            </NuxtLink>
          </div>
        </div>
      </div>
      <div v-else class="md:flex gap-4 justify-between mx-auto w-full">
        <div class="md:w-[65%]">
          <div class="bg-white rounded-lg p-4 shadow-sm">
            <div class="text-2xl font-bold mb-2">
              Shopping Cart ({{ userStore.cart.length }})
            </div>
          </div>
          <div class="bg-pink-100 rounded-lg p-4 mt-4">
            <div class="text-red-500 font-bold">
              Welcome Deal applicable on 1 item only
            </div>
          </div>
          <div id="Items" class="bg-white rounded-lg p-4 mt-4 shadow-sm">
            <div
              v-for="product in userStore.cart"
              :key="product.id"
              class="mb-4 relative"
            >
              <CartItem
                :product="product"
                :selectedArray="selectedArray"
                @selectedRadio="selectedRadioFunc"
              />
              <div
                class="quantity-controls absolute bottom-4 right-4 flex items-center bg-gray-100 p-2 rounded-full shadow-md"
              >
                <button
                  @click="decreaseQuantity(product)"
                  class="quantity-button"
                >
                  -
                </button>
                <span class="mx-4">{{ product.quantity }}</span>
                <button
                  @click="increaseQuantity(product)"
                  class="quantity-button"
                >
                  +
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="md:hidden block my-4"></div>
        <div class="md:w-[35%]">
          <div id="Summary" class="bg-white rounded-lg p-4 shadow-sm">
            <div class="text-2xl font-extrabold mb-2">Summary</div>
            <div class="flex items-center justify-between my-4">
              <div class="font-semibold">Total</div>
              <div class="text-2xl font-semibold">
                $ <span class="font-extrabold">{{ totalPrice }}</span>
              </div>
            </div>
            <button
              @click="goToCheckout"
              class="checkout-button w-full bg-red-500 text-white text-lg font-semibold px-4 py-2 rounded-full mt-4 transition transform hover:shadow-2xl hover:scale-105 ease-in-out duration-300"
            >
              Checkout
            </button>
          </div>
          <div
            id="PaymentProtection"
            class="bg-white rounded-lg p-4 mt-4 shadow-sm"
          >
            <div class="text-lg font-semibold mb-2">Payment methods</div>
            <div class="flex items-center justify-start gap-8 my-4">
              <div v-for="card in cards" :key="card">
                <img class="h-6" :src="card" alt="Payment Method" />
              </div>
            </div>
            <div class="border-b"></div>
            <div class="text-lg font-semibold mb-2 mt-2">Buyer Protection</div>
            <p class="my-2">
              Get full refund if the item is not as described or if is not
              delivered
            </p>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import CartItem from "~/components/CartItem.vue";
import MainLayout from "~/layouts/MainLayout.vue";
import { useUserStore } from "~/stores/user";
const userStore = useUserStore();
const user = useSupabaseUser();

let selectedArray = ref([]);

onMounted(() => {
  setTimeout(() => (userStore.isLoading = false), 200);
});

const cards = ref(["visa.png", "mastercard.png", "paypal.png", "applepay.png"]);

const totalPrice = ref(0);

const calculateTotalPrice = () => {
  let price = 0;
  userStore.cart.forEach((prod) => {
    price += prod.price * prod.quantity;
  });
  totalPrice.value = (price / 100).toFixed(2); // Sử dụng toFixed để định dạng số thập phân
};

watch(() => userStore.cart, calculateTotalPrice, { deep: true });

const selectedRadioFunc = (e) => {
  const index = selectedArray.value.findIndex((item) => item.id === e.id);
  if (index !== -1) {
    selectedArray.value.splice(index, 1);
  } else {
    selectedArray.value.push(e);
  }
};

const goToCheckout = () => {
  userStore.checkout = userStore.cart.filter((item) =>
    selectedArray.value.some((selected) => selected.id === item.id)
  );
  navigateTo("/checkout");
};

const increaseQuantity = (product) => {
  product.quantity += 1;
  calculateTotalPrice();
};

const decreaseQuantity = (product) => {
  if (product.quantity > 1) {
    product.quantity -= 1;
    calculateTotalPrice();
  }
};


userStore.cart.forEach((product) => {
  if (!product.quantity) {
    product.quantity = 1;
  }
});

onMounted(() => {
  calculateTotalPrice();
});
</script>

<style scoped>
.checkout-button:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.quantity-controls {
  background-color: #f8f9fa;
  border: 1px solid #e0e0e0;
  border-radius: 9999px;
  display: flex;
  align-items: center;
  padding: 0.5rem 1rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.quantity-button {
  background-color: #f0f0f0;
  border: none;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.2s, transform 0.2s;
}

.quantity-button:hover {
  background-color: #e0e0e0;
  transform: scale(1.1);
}
</style>
