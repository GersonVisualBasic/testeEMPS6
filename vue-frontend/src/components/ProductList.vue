<template>
  <div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
      
      <SearchBar @search="filtrarProdutos" />

      <div v-if="loading" class="text-center text-gray-500 mt-4">Carregando...</div>
      <div v-else-if="erro" class="text-red-600 text-center mt-4">Erro ao carregar produtos</div>
      
      <div v-else class="overflow-x-auto mt-6">
        <table class="w-full border border-gray-200 shadow-md rounded-lg overflow-hidden">
          <thead class="bg-blue-600 text-white">
            <tr>
              <th class="px-6 py-3 text-left">ID</th>
              <th class="px-6 py-3 text-left">Nome</th>
              <th class="px-6 py-3 text-left">Descrição</th>
              <th class="px-6 py-3 text-right cursor-pointer" @click="ordenarPorPreco">
                Preço (R$) 
                <span v-if="ordemPreco === 'asc'">🔼</span>
                <span v-if="ordemPreco === 'desc'">🔽</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="produto in produtosPaginados" :key="produto.id" class="hover:bg-gray-100">
              <td class="px-6 py-4 text-gray-700">{{ produto.id }}</td>
              <td class="px-6 py-4 font-semibold text-gray-800">{{ produto.nome }}</td>
              <td class="px-6 py-4 text-gray-600">{{ produto.descricao }}</td>
              <td class="px-6 py-4 text-right text-blue-600 font-bold">R$ {{ produto.preco.toFixed(2) }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="flex justify-between mt-4">
        <button 
          @click="paginaAtual--" 
          :disabled="paginaAtual === 1"
          class="px-4 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50"
        >
          Anterior
        </button>
        
        <span class="text-gray-700">Página {{ paginaAtual }} de {{ totalPaginas }}</span>

        <button 
          @click="paginaAtual++" 
          :disabled="paginaAtual === totalPaginas"
          class="px-4 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50"
        >
          Próximo
        </button>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import axios from "axios";
import SearchBar from "./SearchBar.vue";

const produtos = ref([]);
const produtosFiltrados = ref([]);
const loading = ref(true);
const erro = ref(false);
const ordemPreco = ref("asc"); 

const paginaAtual = ref(1);
const itensPorPagina = 5;

const carregarProdutos = async () => {
  try {
    const { data } = await axios.get("http://localhost:8000/api/produtos.php");
    produtos.value = data;
    produtosFiltrados.value = data;
  } catch {
    erro.value = true;
  } finally {
    loading.value = false;
  }
};

const filtrarProdutos = (query) => {
  produtosFiltrados.value = produtos.value.filter((p) =>
    p.nome.toLowerCase().includes(query.toLowerCase())
  );
};

const ordenarPorPreco = () => {
  ordemPreco.value = ordemPreco.value === "asc" ? "desc" : "asc";
  produtosFiltrados.value.sort((a, b) => 
    ordemPreco.value === "asc" ? a.preco - b.preco : b.preco - a.preco
  );
};

const totalPaginas = computed(() => Math.ceil(produtosFiltrados.value.length / itensPorPagina));
const produtosPaginados = computed(() => {
  const inicio = (paginaAtual.value - 1) * itensPorPagina;
  return produtosFiltrados.value.slice(inicio, inicio + itensPorPagina);
});

onMounted(carregarProdutos);
</script>
