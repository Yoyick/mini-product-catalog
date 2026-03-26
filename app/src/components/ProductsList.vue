<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-6 text-center">Mini Product Catalog</h1>

    <!-- Price filter -->
    <div class="mb-6 flex gap-3 items-center justify-center">
      <label class="font-medium">Min Price (€):</label>
      <input
        v-model.number="minPrice"
        type="number"
        step="0.01"
        class="border rounded px-3 py-1 w-24"
        @input="fetchProducts(1)"
        placeholder="0.00"
      />
    </div>

    <!-- Product list -->
    <ul>
      <li
        v-for="product in products"
        :key="product.id"
        class="border-b py-4 last:border-b-0"
      >
        <div class="font-semibold text-lg">{{ product.name }} — {{ product.priceFormatted }}</div>
        <div class="text-gray-600">{{ product.description }}</div>
      </li>
    </ul>

    <!-- Pagination -->
    <div class="mt-6 flex gap-2 justify-center">
      <button
        v-for="p in totalPages"
        :key="p"
        @click="fetchProducts(p)"
        :class="[
          'px-4 py-1 rounded border transition-colors',
          p === currentPage ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'
        ]"
      >
        {{ p }}
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const products = ref([])
const minPrice = ref(0)
const currentPage = ref(1)
const totalPages = ref(1)
const perPage = 5 // producten per pagina

async function fetchProducts(page = 1) {
  currentPage.value = page
  let url = `/api/products?minPrice=${minPrice.value}`
  const res = await fetch(url)
  const data = await res.json()

  // Client-side pagination
  totalPages.value = Math.ceil(data.length / perPage)
  const start = (page - 1) * perPage
  const end = start + perPage
  products.value = data.slice(start, end)
}

onMounted(() => fetchProducts())
</script>