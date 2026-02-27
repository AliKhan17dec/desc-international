<script setup>
import { useRouter, useRoute } from 'vue-router';
import { 
  Home, 
  TrendingUp, 
  ArrowLeftRight, 
  Rocket, 
  Briefcase 
} from 'lucide-vue-next';

const router = useRouter();
const route = useRoute();

const navItems = [
  { name: 'Home Page', icon: Home, path: '/' },
  { name: 'Market', icon: TrendingUp, path: '/market' },
  { name: 'Swap', icon: ArrowLeftRight, path: '/token-swap' },
  { name: 'Launchpad', icon: Rocket, path: '/launchpad' },
  { name: 'Portfolio', icon: Briefcase, path: '/portfolio' }
];

const navigate = (path) => {
  router.push(path);
};

const isActive = (path) => route.path === path;
</script>

<template>
  <nav class="mobile-bottom-nav">
    <div 
      v-for="item in navItems" 
      :key="item.name" 
      class="nav-tab" 
      :class="{ active: isActive(item.path) }"
      @click="navigate(item.path)"
    >
      <component :is="item.icon" size="22" class="nav-icon" />
      <span class="nav-label">{{ item.name }}</span>
    </div>
  </nav>
</template>

<style scoped>
.mobile-bottom-nav {
  display: none;
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 65px;
  background: rgba(0, 0, 0, 0.8);
  backdrop-filter: blur(10px);
  border-top: 1px solid rgba(223, 255, 0, 0.1);
  z-index: 2000;
  justify-content: space-around;
  align-items: center;
  padding-bottom: env(safe-area-inset-bottom);
}

@media (max-width: 768px) {
  .mobile-bottom-nav {
    display: flex;
  }
}

.nav-tab {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #666;
  flex: 1;
  transition: all 0.2s ease;
  cursor: pointer;
}

.nav-tab.active {
  color: var(--primary);
}

.nav-tab.active .nav-icon {
  filter: drop-shadow(0 0 8px var(--primary));
}

.nav-icon {
  margin-bottom: 4px;
}

.nav-label {
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.nav-tab:active .nav-icon {
  transform: scale(0.9);
}
</style>
