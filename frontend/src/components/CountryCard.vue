<script setup>
defineProps({
    country: {
        type: Object,
        required: true
    }
});
</script>

<template>
  <article class="country-card">
    <div class="flag-container">
      <img
        :src="country.flag"
        :alt="`${country.name} flag`"
      />
    </div>

    <h3>{{ country.name }}</h3>
  </article>
</template>

<style scoped>
.country-card {
  border: 1px solid #a29da3;
  border-radius: 12px;
  padding: 16px;
  text-align: center;
  background: rgb(255, 255, 255);
  box-shadow: 0 8px 4px rgba(0, 0, 0, 0.1);
}

.flag-container {
  width: 100%;
  height: 140px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background: #f9fafb;
  border-radius: 8px;
}

.flag-container img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.country-card h3 {
  margin-top: 14px;
  font-size: 18px;
  font-weight: 600;
}
</style>