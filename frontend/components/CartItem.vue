<template>
  <div 
    class="flex justify-start my-4 p-4 border-b transition transform hover:shadow-lg hover:-translate-y-1"
  >
    <div 
      @mouseenter="isHover = true"
      @mouseleave="isHover = false"
      class="flex items-center cursor-pointer"
    >
      <div 
        @click="isSelected = !isSelected"
        class="flex items-center justify-center h-5 w-5 rounded-full border mr-4"
        :class="[
          isHover ? 'border-red-500' : 'border-gray-400',
          isSelected ? 'bg-red-500' : ''
        ]"
      >
        <div class="h-2 w-2 rounded-full bg-white"></div>
      </div>
    </div>
    <img 
      class="rounded-md w-24 md:w-36" 
      :src="product.url"
      alt="Product Image"
    >
    <div class="flex-1 pl-4">
      <div class="flex justify-between items-center mb-2">
        <div class="flex items-center space-x-2">
          <span class="bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">Welcome Deal</span>
          <div class="truncate text-xl font-semibold">{{ product.title }}</div>
        </div>
        <button 
          @click="removeFromCart"
          class="text-gray-500 hover:text-red-500"
        >
          <Icon name="material-symbols:delete-outline" size="25" />
        </button>
      </div>
      <div class="text-xl font-semibold">
        $ <span class="font-bold">{{ (product.price / 100).toFixed(2) }}</span>
      </div>
      <p class="text-green-600 text-s font-semibold mt-1">
        Free 11-day delivery over ￡8.28
      </p>
      <p class="text-green-600 text-s font-semibold mt-1">
        Free Shipping
      </p>
    </div>
  </div>
</template>

<script setup>
import { useUserStore } from '~/stores/user';
const userStore = useUserStore();

const props = defineProps(['product', 'selectedArray']);
const { product, selectedArray } = toRefs(props);

const emit = defineEmits(['selectedRadio']);

let isHover = ref(false);
let isSelected = ref(false);

const removeFromCart = () => {
  userStore.cart = userStore.cart.filter(prod => prod.id !== product.value.id);
};

watch(() => isSelected.value, (val) => {
  emit('selectedRadio', { id: product.value.id, val });
});
</script>

<style scoped>
.transition {
  transition: all 0.2s ease-in-out;
}
</style>
