<template>
  <div>
    <h1>Mini Product Catalog</h1>
    <div v-if="loading">Laden…</div>
    <div v-else>
      <ul>
        <li v-for="product in products" :key="product.id">
          <strong>{{ product.name }}</strong> — {{ product.priceFormatted }}
          <p>{{ product.description }}</p>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const products = ref([])
const loading = ref(true)

onMounted(async () => {
  try {
    const res = await fetch('/api/products')
    products.value = await res.json()
  } catch (err) {
    console.error('Fout bij ophalen van producten:', err)
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
h1 {
  font-size: 1.8rem;
  margin-bottom: 1rem;
}
ul {
  list-style: none;
  padding: 0;
}
li {
  margin-bottom: 1rem;
  border-bottom: 1px solid #eee;
  padding-bottom: 0.5rem;
}
</style>