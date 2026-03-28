<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-6 text-center">Mini Product Catalog</h1>

    <!-- Search bar -->
    <div class="mb-6 flex gap-3 items-center justify-center">
      <label class="font-medium">Search:</label>
      <input
        v-model="searchQuery"
        type="text"
        class="border rounded px-3 py-1 w-64"
        @input="handleInput"
        placeholder="Search products..."
      />
    </div>

    <!-- Price + Stock filter -->
    <div class="mb-6 flex gap-6 items-center justify-center">
      <div class="flex items-center gap-2">
        <label class="font-medium">Min Price (€):</label>
        <input
          v-model.number="minPrice"
          type="number"
          step="0.1"
          class="border rounded px-3 py-1 w-24"
          @input="handleInput"
          placeholder="0.00"
        />
      </div>
      <div class="flex items-center gap-2">
        <label class="font-medium">Min Stock:</label>
        <input
          v-model.number="minStock"
          type="number"
          class="border rounded px-3 py-1 w-24"
          @input="handleInput"
          placeholder="0"
        />
      </div>
    </div>

    <div class="mb-6 flex gap-3 items-center justify-center">
      <label class="font-medium">Filters:</label>
      <button
        @click="minPrice=0; minStock=0; fetchProducts(1)"
        class="text-blue-600 underline"
      >
        Reset filters
      </button>
    </div>      

    <!-- Product grid -->
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
      <div 
        v-for="product in products" 
        :key="product.id"
        class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow p-4"
      >
        <div class="flex justify-between items-start mb-2">
          <h2 class="font-bold text-lg text-gray-800 line-clamp-1">{{ product.name }}</h2>
          <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">
            {{ product.priceFormatted }}
          </span>
        </div>
        
        <p class="text-gray-500 text-sm mb-4 line-clamp-2 h-10">
          {{ product.description || 'Geen beschrijving beschikbaar.' }}
        </p>

        <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-50">
          <span :class="[
            'text-xs font-medium px-2 py-1 rounded-full',
            product.stock > 5 ? 'bg-blue-50 text-blue-600' : 'bg-red-50 text-red-600'
          ]">
            Voorraad: {{ product.stock }}
          </span>
          <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded-lg transition-colors">
            Bekijk deal
          </button>
        </div>
      </div>
    </div>
    <div v-if="products.length === 0" class="text-center py-20 bg-gray-50 rounded-xl">
      <p class="text-gray-500 italic">Geen producten gevonden voor deze filters... 🔍</p>
      <button
        @click="searchQuery=''; minPrice=0; minStock=0; fetchProducts(1)"
        class="text-blue-600 underline mt-2"
      >
        Reset filter
      </button>
    </div>

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
const searchQuery = ref('')
const minPrice = ref(0)
const minStock = ref(0)
const currentPage = ref(1)
const totalPages = ref(1)
const perPage = 5 // producten per pagina

const searchTimeout = ref(null)

function handleInput() {
  clearTimeout(searchTimeout.value)
  searchTimeout.value = setTimeout(() => {
    fetchProducts(1)
  }, 300) // Wacht 300ms na de laatste toetsaanslag
}

async function fetchProducts(page = 1) {
  currentPage.value = page
  const params = new URLSearchParams()
  params.set('minPrice', String(minPrice.value))
  params.set('minStock', String(minStock.value))

  if (searchQuery.value.trim()) {
    params.set('search', searchQuery.value.trim())
  }

  const res = await fetch(`/api/products?${params.toString()}`)
  const data = await res.json()

  // Client-side pagination
  totalPages.value = Math.max(1, Math.ceil(data.length / perPage))
  const start = (page - 1) * perPage
  const end = start + perPage
  products.value = data.slice(start, end)
}

onMounted(() => fetchProducts())
</script>