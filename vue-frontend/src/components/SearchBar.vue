<template>
    <input
      v-model="searchQuery"
      placeholder="Buscar produto..."
      class="w-full p-2 border rounded"
      @input="buscar"
    />
  </template>
  
  <script setup>
  import { ref } from "vue";
  const searchQuery = ref("");
  const emit = defineEmits(["search"]);
  
  const buscar = () => emit("search", searchQuery.value);
  </script>
  