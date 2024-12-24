<template>
  <div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="text-center">
      <h1 class="text-9xl font-extrabold text-red-500 tracking-widest">404</h1>
      <div class="bg-red-500 px-2 text-sm text-white rounded-full shadow-md mb-8">Page Not Found</div>
      <p class="text-gray-500 text-lg mb-6">Oops! The page you're looking for doesn't exist.</p>
      <NuxtLink
        to="/"
        class="px-6 py-3 text-white bg-red-500 rounded-lg shadow-md hover:bg-red-600 transition duration-300"
      >
        Go Back Home
      </NuxtLink>
    </div>
  </div>
</template>

<script setup>
// No additional JavaScript needed for this simple 404 page
</script>

<style scoped>
/* Custom styles can be added if necessary */
</style>
