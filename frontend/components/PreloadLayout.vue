<template>
    <div
      class="bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 h-[496px] w-full mx-auto animate-pulse"
    >
      <!-- Placeholder cho hình ảnh -->
      <div class="relative h-[284px] bg-slate-300 rounded-t-xl"></div>
 
      <!-- Placeholder cho xếp hạng -->
      <div class="space-x-1 flex justify-center mt-4">
        <div class="w-4 h-4 bg-slate-300 rounded-full"></div>
        <div class="w-4 h-4 bg-slate-300 rounded-full"></div>
        <div class="w-4 h-4 bg-slate-300 rounded-full"></div>
        <div class="w-4 h-4 bg-slate-300 rounded-full"></div>
        <div class="w-4 h-4 bg-slate-300 rounded-full"></div>
      </div>
 
      <!-- Placeholder cho tiêu đề -->
      <div class="mt-4 h-[28px] bg-slate-300 rounded-md w-[70%] mx-auto"></div>
 
      <!-- Placeholder cho mô tả -->
      <div class="mt-2 h-[24px] bg-slate-300 rounded-md w-[60%] mx-auto"></div>
 
      <!-- Placeholder cho giá và nút bấm -->
      <div class="flex flex-col items-center mt-6 space-y-3">
        <div class="h-[24px] bg-slate-300 rounded-md w-[50%]"></div>
        <div class="h-[24px] bg-slate-300 rounded-md w-[30%]"></div>
      </div>
    </div>
  </template>
 
  <script setup>
  // Không cần thêm logic vì đây chỉ là layout loading
  </script>
 
  <style scoped>
  /* Tạo hiệu ứng animate-pulse */
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

