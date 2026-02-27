<script setup>
import { ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { 
  Home, 
  Activity, 
  Rocket, 
  User, 
  LayoutDashboard,
  Menu,
  Settings,
  Briefcase
} from 'lucide-vue-next';

const router = useRouter();
const route = useRoute();

const navItems = [
  { name: 'Home Page', icon: Home, path: '/' },
  { name: 'Swap', icon: Activity, path: '/token-swap' },
  { name: 'Market', icon: TrendingUp, path: '/market' },
  { name: 'Launchpad', icon: Rocket, path: '/launchpad' },
  { name: 'Portfolio', icon: Briefcase, path: '/portfolio' },
];

const navigate = (path) => {
  router.push(path);
};

const isActive = (path) => {
  return route.path === path;
};
</script>

<template>
  <div class="bottom-nav">
    <div 
      v-for="item in navItems" 
      :key="item.name" 
      class="nav-item" 
      :class="{ active: isActive(item.path) }"
      @click="navigate(item.path)"
    >
      <div class="icon-wrapper">
        <component :is="item.icon" size="22" />
      </div>
      <span>{{ item.name }}</span>
    </div>
  </div>
</template>

<style scoped>
.bottom-nav {
  position: fixed;
  bottom: 0px;
  left: 0;
  width: 100%;
  background: rgba(0, 0, 0, 0.95);
  backdrop-filter: blur(10px);
  border-top: 1px solid #1a1a1a;
  display: flex;
  justify-content: space-around;
  padding: 12px 0;
  z-index: 2000;
  padding-bottom: calc(12px + env(safe-area-inset-bottom));
}

.nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  font-size: 11px;
  color: #666;
  gap: 6px;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  flex: 1;
}

.icon-wrapper {
  transition: transform 0.3s;
}

.nav-item:active .icon-wrapper {
  transform: scale(1.2);
}

.nav-item.active {
  color: var(--primary);
}

.nav-item.active .icon-wrapper {
  color: var(--primary);
  filter: drop-shadow(0 0 8px rgba(223, 255, 0, 0.5));
}

.nav-item span {
  font-weight: 500;
}

@media (min-width: 1025px) {
  .bottom-nav {
    display: none;
  }
}
</style>
