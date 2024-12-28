<template>
    <div class="md:flex gap-6 justify-between mx-auto w-full animate-pulse">
      <!-- Placeholder for the product image -->
      <div class="md:w-[40%]">
        <div class="h-[474px]  w-[475px] bg-slate-300 rounded-lg"></div>
 
        <!-- Placeholder for additional images -->
        <div class="flex items-center justify-center mt-4 space-x-1 justify-between md:flex-nowrap">
          <div v-for="index in 5" :key="'image-placeholder-' + index" class="w-[85px] h-[85px] bg-slate-300 rounded-md"></div>
        </div>
      </div>
 
      <!-- Placeholder for product details -->
      <div class="md:w-[55%] bg-white p-6 rounded-lg shadow-md flex flex-col justify-between">
        <div>
          <!-- Placeholder for product title -->
          <div class="h-[28px] bg-slate-300 rounded-md w-[70%] mb-4"></div>
 
          <!-- Placeholder for product description -->
          <div class="space-y-2">
            <div class="h-[20px] bg-slate-300 rounded-md w-[90%]"></div>
            <div class="h-[20px] bg-slate-300 rounded-md w-[85%]"></div>
            <div class="h-[20px] bg-slate-300 rounded-md w-[80%]"></div>
          </div>
 
          <!-- Placeholder for rating -->
          <div class="flex items-center my-4">
            <div v-for="index in 5" :key="'star-placeholder-' + index" class="w-[20px] h-[20px] bg-slate-300 rounded-full mr-2"></div>
            <div class="h-[20px] bg-slate-300 rounded-md w-[120px]"></div>
          </div>
 
          <!-- Placeholder for price -->
          <div class="h-[32px] bg-slate-300 rounded-md w-[50%] my-4"></div>
 
          <!-- Placeholder for delivery and shipping info -->
          <div class="space-y-2">
            <div class="h-[20px] bg-slate-300 rounded-md w-[70%]"></div>
            <div class="h-[20px] bg-slate-300 rounded-md w-[60%]"></div>
          </div>
        </div>
 
        <!-- Placeholder for add to cart button -->
        <div class="mt-6 h-[48px] bg-slate-300 rounded-lg w-full"></div>
      </div>
    </div>
  </template>
 
  <script setup>
  // Đây chỉ là layout chờ, không cần logic xử lý
  </script>
 
  <style scoped>
  .animate-pulse {
    animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }
 
  @keyframes pulse {
    0%, 100% {
      opacity: 1;
    }
    50% {
      opacity: 0.5;
    }
  }
  </style>
 

