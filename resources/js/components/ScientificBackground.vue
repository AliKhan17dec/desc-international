<script setup>
import { onMounted, ref } from 'vue';

const cells = ref([]);

onMounted(() => {
  for (let i = 0; i < 10; i++) {
    cells.value.push({
      id: i,
      x: Math.random() * 100,
      y: Math.random() * 100,
      size: Math.random() * 40 + 20,
      opacity: Math.random() * 0.05 + 0.02,
      duration: Math.random() * 20 + 10,
      delay: Math.random() * -20,
      rotation: Math.random() * 360
    });
  }
});
</script>

<template>
  <div class="scientific-bg-overlay">
    <div 
      v-for="cell in cells" 
      :key="cell.id" 
      class="micro-organism"
      :style="{
        left: cell.x + '%',
        top: cell.y + '%',
        width: cell.size + 'px',
        height: cell.size + 'px',
        opacity: cell.opacity,
        animationDuration: cell.duration + 's',
        animationDelay: cell.delay + 's',
        transform: `rotate(${cell.rotation}deg)`
      }"
    >
      <svg viewBox="0 0 100 100" fill="currentColor">
        <!-- Germ / Bacteria Shape -->
        <path d="M50 10 C 70 10, 90 30, 90 50 C 90 70, 70 90, 50 90 C 30 90, 10 70, 10 50 C 10 30, 30 10, 50 10 Z" />
        <circle cx="30" cy="40" r="5" fill="#000" opacity="0.2" />
        <circle cx="60" cy="65" r="8" fill="#000" opacity="0.2" />
        <path d="M50 10 Q 55 0 60 10" stroke="currentColor" stroke-width="2" fill="none" />
        <path d="M90 50 Q 100 55 90 60" stroke="currentColor" stroke-width="2" fill="none" />
        <path d="M10 50 Q 0 45 10 40" stroke="currentColor" stroke-width="2" fill="none" />
      </svg>
    </div>
  </div>
</template>

<style scoped>
.scientific-bg-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: -1;
  overflow: hidden;
}

.micro-organism {
  position: absolute;
  color: var(--primary);
  animation: float-around linear infinite;
}

@keyframes float-around {
  0% { transform: translate(0, 0) rotate(0deg); }
  25% { transform: translate(30px, 50px) rotate(90deg); }
  50% { transform: translate(0, 100px) rotate(180deg); }
  75% { transform: translate(-30px, 50px) rotate(270deg); }
  100% { transform: translate(0, 0) rotate(360deg); }
}
</style>
