<template>
  <MainLayout>
    <div id="CheckoutPage" class="mt-6 max-w-5xl mx-auto px-6">
      <div class="md:flex gap-8 justify-between w-full">
        <!-- Left Section -->
        <div class="md:w-2/3 flex flex-col">
          <div class="bg-white rounded-lg shadow p-6 mb-6 flex-grow">
            <div class="text-2xl font-semibold mb-4">Shipping Address</div>
            <div v-if="currentAddress && currentAddress.data">
              <NuxtLink to="/address" class="flex items-center pb-4 text-blue-500 hover:text-red-400">
                <Icon name="+" size="18" class="mr-2" />
                Update Address
              </NuxtLink>

              <div class="pt-2 border-t">
                <div class="underline pb-1">Delivery Address</div>
                <ul class="text-xs">
                  <li class="flex items-center gap-2">
                    <div>Contact name:</div>
                    <div class="font-bold">{{ currentAddress.data.name }}</div>
                  </li>
                  <li class="flex items-center gap-2">
                    <div>Address:</div>
                    <div class="font-bold">
                      {{ currentAddress.data.address }}
                    </div>
                  </li>
                  <li class="flex items-center gap-2">
                    <div>Zip Code:</div>
                    <div class="font-bold">
                      {{ currentAddress.data.zipcode }}
                    </div>
                  </li>
                  <li class="flex items-center gap-2">
                    <div>City:</div>
                    <div class="font-bold">{{ currentAddress.data.city }}</div>
                  </li>
                  <li class="flex items-center gap-2">
                    <div>Country:</div>
                    <div class="font-bold">
                      {{ currentAddress.data.country }}
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <NuxtLink v-else to="/address" class="flex items-center text-blue-500 hover:text-red-400">
              <Icon name="mdi:plus" size="18" class="mr-2" />
              Add New Address
            </NuxtLink>
          </div>

          <div id="Items" class="bg-white rounded-lg shadow p-6 flex-grow">
            <div v-for="product in userStore.checkout" :key="product.id" class="mb-6 flex items-center">
              <img :src="product.url" alt="product image" class="w-20 h-20 rounded mr-4" />
              <div class="items-start">
                <div class="text-lg font-semibold">{{ product.title }}</div>
                <div class="text-sm text-gray-500">
                  {{ product.description }}
                </div>
                <div class="text-lg font-bold mt-1">
                  ${{ (product.price / 100).toFixed(2) }}
                  <span class="text-sm text-gray-500">x {{ product.quantity }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Section -->
        <div class="md:w-1/3 flex flex-col">
          <div id="PlaceOrder" class="bg-white rounded-lg shadow p-6 mb-6 flex-grow">
            <div class="text-2xl font-extrabold mb-4">Summary</div>
            <div class="space-y-2">
              <div class="flex items-center justify-between">
                <div>Subtotal</div>
                <div class="font-medium">$ {{ (subtotal / 100).toFixed(2) }}</div>
              </div>
              <div class="flex items-center justify-between">
                <div>Taxes</div>
                <div class="font-medium">$ {{ (taxes / 100).toFixed(2) }}</div>
              </div>
              <div class="flex items-center justify-between">
                <div>Shipping</div>
                <div class="font-medium">$ {{ (shipping / 100).toFixed(2) }}</div>
              </div>
            </div>
            <div class="border-t my-4"></div>
            <div class="flex items-center justify-between">
              <div class="font-semibold">Total</div>
              <div class="text-2xl font-semibold">
                $
                <span class="font-extrabold">{{ (total / 100).toFixed(2) }}</span>
              </div>
            </div>
            <button
              @click="placeOrder"
              class="bg-gradient-to-r from-[#FE630C] to-[#FF3200] text-white py-2 px-4 rounded-lg mt-4 w-full"
            >
              Place Order
            </button>
          </div>

          <div class="bg-white rounded-lg shadow p-6 flex-grow">
            <div class="text-lg font-semibold mb-4">ChillOutExpress</div>
            <p class="text-sm">ChillOutExpress keeps your information and payment safe</p>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from "~/layouts/MainLayout.vue";
import { useUserStore } from "~/stores/user";
import Swal from "sweetalert2";
import { useRouter } from "vue-router";

const user = useSupabaseUser();
const userStore = useUserStore();
const route = useRoute();

let subtotal = ref(0);
let taxes = ref(199); // example value
let shipping = ref(0); // example value
let total = computed(() => subtotal.value + taxes.value + shipping.value);

let currentAddress = ref(null);
let isProcessing = ref(false);

onBeforeMount(async () => {
  if (userStore.checkout.length < 1) {
    return navigateTo("/shoppingcart");
  }

  total.value = 0.0;
  if (user.value) {
    currentAddress.value = await useFetch(`/api/prisma/get-address-by-user/${user.value.id}`);
    setTimeout(() => (userStore.isLoading = false), 200);
  }
});

watchEffect(() => {
  if (route.fullPath == "/checkout" && !user.value) {
    return navigateTo("/auth");
  }
});

onMounted(() => {
  isProcessing.value = true;
  userStore.checkout.forEach((item) => {
    subtotal.value += item.price * item.quantity;
  });
});

const placeOrder = async () => {
  if (!user.value) {
    return navigateTo("/auth");
  }

  try {
    if (!currentAddress.value || !currentAddress.value.data) {
      return alert("Please provide a valid address");
    }

    isProcessing.value = true;

    const orderData = {
      userId: user.value.id,
      name: currentAddress.value.data.name,
      address: currentAddress.value.data.address,
      zipcode: currentAddress.value.data.zipcode,
      city: currentAddress.value.data.city,
      country: currentAddress.value.data.country,
      items: userStore.checkout.map((item) => ({
        productId: item.id,
        quantity: item.quantity,
        price: item.price,
        total: item.total
      })),
    };

    await useFetch("/api/prisma/create-order", {
      method: "POST",
      body: JSON.stringify(orderData),
      headers: { "Content-Type": "application/json" },
    });

    isProcessing.value = false;

    Swal.fire({
      title: "Order Placed!",
      text: "Your order was successful.",
      icon: "success",
      showCancelButton: true,
      confirmButtonText: "My order",
      iconColor: "#01fa00",
      cancelButtonText: "Back to home",
      confirmButtonColor: "#fd374f",
      cancelButtonColor: "#858585",
    }).then((result) => {
      if (result.isConfirmed) {
        navigateTo("/orders");
      } else {
        navigateTo("/");
      }
    });
  } catch (error) {
    isProcessing.value = false;
    alert("Failed to place order");
  }
};
</script>

<style>
#CheckoutPage {
  background-color: #f9fafb;
  padding-top: 2rem;
  padding-bottom: 2rem;
}

.shadow {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.transition-opacity {
  transition: opacity 0.3s ease-in-out;
}

.loading-icon {
  display: none;
}

.is-processing .loading-icon {
  display: inline-block;
}
</style>
