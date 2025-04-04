<template>
  <div
    class="bg-white border rounded-xl shadow-md p-5 transform transition duration-300 hover:shadow-lg hover:scale-105"
  >
    <h3 class="text-xl font-semibold text-gray-800">{{ produto.nome }}</h3>
    <p class="text-gray-600 text-sm mt-2">{{ produto.descricao }}</p>
    <p class="text-blue-600 font-bold text-lg mt-3">R$ {{ produto.preco.toFixed(2) }}</p>
  </div>
</template>

<script setup>
defineProps({ produto: Object });
</script>
