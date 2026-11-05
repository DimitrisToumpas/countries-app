<script setup>
defineProps({
    country: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div class="country-card">
        <img :src="country.flag" :alt="`${country.name} flag`" />

        <h3>{{ country.name }}</h3>
    </div>
</template>