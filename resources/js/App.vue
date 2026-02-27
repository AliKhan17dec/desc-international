<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import MobileBottomNav from './components/MobileBottomNav.vue';
import ScientificBackground from './components/ScientificBackground.vue';
</script>

<template>
  <div class="app-container">
    <!-- <ScientificBackground /> -->
    <router-view />
    <MobileBottomNav />
  </div>
</template>

<style>
#app {
  width: 100%;
  margin: 0 auto;
}
</style>
