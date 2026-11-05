<script setup>
import { ref, onMounted } from 'vue'
import { getCountries } from './services/countryService'
import CountryCard from './components/CountryCard.vue'

// reactive variables
const countries = ref([])
const loading = ref(true)
const error = ref(null)

// call api οταν φορτωνει η σελιδα
onMounted(async () => {
  try {
    countries.value = await getCountries()
  } catch (err) {
    console.error(err)
    error.value = 'Failed to load countries. Please try again later.'
  } finally {
    loading.value = false
  }
})
</script>

<template>
  <main class="container">
    <header>
      <h1>Countries Explorer</h1>
      <p>Explore countries around the world</p>
    </header>

    <!-- Loading state -->
    <p v-if="loading">Loading countries...</p>

    <!-- Error state -->
    <p v-else-if="error" class="error">
      {{ error }}
    </p>

    <!-- Countries list -->
    <section v-else class="countries-grid">
      <CountryCard
        v-for="country in countries"
        :key="country.name"
        :country="country"
      />
    </section>
  </main>
</template>

<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 24px;
}

header {
  text-align: center;
  margin-bottom: 40px;
}

header h1 {
  font-size: 2.5rem;
  margin-bottom: 8px;
}

header p {
  color: #777;
}

.countries-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 24px;
}

.error {
  color: red;
  text-align: center;
}
</style>