<script setup>
import { ref, onMounted } from 'vue'
import { getCountries } from './services/countryService'
import CountryCard from './components/CountryCard.vue'

const countries = ref([])
const loading = ref(true)
const error = ref(null)
const checkingAuth = ref(true)

const checkAuthentication = async () => {
  try {
    const response = await fetch(
      'http://localhost:8000/api/auth/user',
      {
        method: 'GET',
        credentials: 'include',
        headers: {
          Accept: 'application/json'
        }
      }
    )

    if (response.status === 401) {
      window.location.href = 'http://localhost:8000/login'
      return false
    }

    if (!response.ok) {
      throw new Error('Authentication check failed')
    }

    return true
  } catch (err) {
    console.error(err)
    error.value = 'Unable to verify authentication.'
    return false
  } finally {
    checkingAuth.value = false
  }
}

const loadCountries = async () => {
  try {
    countries.value = await getCountries()
  } catch (err) {
    console.error(err)
    error.value = 'Failed to load countries. Please try again later.'
  } finally {
    loading.value = false
  }
}

onMounted(async () => {
  const authenticated = await checkAuthentication()

  if (authenticated) {
    await loadCountries()
  }
})
</script>

<template>
  <main class="container">
    <header>
      <h1>Show Countries</h1>
      <p>Total countries: {{ countries.length }}</p>
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
  background: #120b5a2a;
}

header {
  text-align: center;
  margin-bottom: 40px;
}

header h1 {
  font-size: 2.5rem;
  margin-bottom: 8px;
  color: #040c4b;
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