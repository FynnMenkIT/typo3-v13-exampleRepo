<template>
  <main>
    <h1>TYPO3 Headless + Vue.js</h1>
    <section v-if="data">
      <pre>{{ data }}</pre>
    </section>
    <section v-else>
      <em>Lade Daten von TYPO3 ...</em>
    </section>
  </main>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const data = ref(null);

onMounted(async () => {
  try {
    // Beispiel: API-Request an TYPO3 Headless-Endpoint
    const response = await axios.get('/api/?type=1533906440');
    data.value = response.data;
  } catch (e) {
    data.value = 'Fehler beim Laden der Daten';
  }
});
</script>

<style scoped>
main {
  max-width: 600px;
  margin: 2rem auto;
  font-family: system-ui, sans-serif;
}
pre {
  background: #f5f5f5;
  padding: 1rem;
  border-radius: 6px;
  overflow-x: auto;
}
</style>
