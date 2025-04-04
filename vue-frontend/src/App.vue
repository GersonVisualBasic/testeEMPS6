<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-2xl p-6 max-w-3xl w-full">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">
        🛍️ Lista de Produtos
      </h2>
      <ProductList />
    </div>
  </div>
</template>

<script setup>
import ProductList from "./components/ProductList.vue";
</script>
