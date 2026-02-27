<script setup>
import { useRoute, useRouter } from 'vue-router'
import { Construction, ArrowLeft, Microscope, Rocket, Globe } from 'lucide-vue-next'
import TopHeader from '../components/TopHeader.vue'

const route = useRoute()
const router = useRouter()

const featureName = route.name && route.name !== 'NotFound' 
  ? route.name.replace(/([A-Z])/g, ' $1').trim() 
  : 'This Feature'

const goHome = () => router.push('/')
</script>

<template>
  <div class="coming-soon-wrapper">
    <TopHeader />
    
    <main class="content-area">
      <div class="glass-container">
        <div class="glow-orb"></div>
        
        <div class="main-content">
          <div class="icon-stack">
            <div class="icon-bg pulse"></div>
            <Construction class="main-icon" size="48" />
          </div>
          
          <h1 class="title">Coming <span class="accent">Soon</span></h1>
          <p class="description">
            The <span class="feature-highlight">{{ featureName }}</span> module is currently being finalized in our laboratory.
          </p>
          
          <div class="status-grid">
            <div class="status-item">
              <Microscope size="18" />
              <span>Analyzing</span>
            </div>
            <div class="status-item active">
              <Rocket size="18" />
              <span>Developing</span>
            </div>
            <div class="status-item">
              <Globe size="18" />
              <span>Deploying</span>
            </div>
          </div>

          <button class="back-home-btn" @click="goHome">
            <ArrowLeft size="18" />
            <span>Back to Home Page</span>
          </button>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
.coming-soon-wrapper {
  min-height: 100vh;
  background: radial-gradient(circle at top right, #0a1000, #000);
  color: white;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.content-area {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px 20px;
}

.glass-container {
  position: relative;
  width: 100%;
  max-width: 600px;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 40px;
  padding: 60px 40px;
  text-align: center;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.glow-orb {
  position: absolute;
  top: -100px;
  left: 50%;
  transform: translateX(-50%);
  width: 300px;
  height: 300px;
  background: var(--primary);
  filter: blur(120px);
  opacity: 0.15;
  z-index: 0;
}

.main-content {
  position: relative;
  z-index: 1;
}

.icon-stack {
  position: relative;
  width: 100px;
  height: 100px;
  margin: 0 auto 32px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon-bg {
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(223, 255, 0, 0.1);
  border-radius: 30px;
  transform: rotate(45deg);
}

.pulse {
  animation: pulse-ring 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse-ring {
  0% { transform: rotate(45deg) scale(0.95); opacity: 0.5; }
  50% { transform: rotate(45deg) scale(1.05); opacity: 0.8; }
  100% { transform: rotate(45deg) scale(0.95); opacity: 0.5; }
}

.main-icon {
  color: var(--primary);
}

.title {
  font-size: 48px;
  font-weight: 800;
  margin-bottom: 16px;
  letter-spacing: -1px;
}

.accent {
  color: var(--primary);
}

.description {
  font-size: 18px;
  color: #888;
  line-height: 1.6;
  margin-bottom: 48px;
}

.feature-highlight {
  color: white;
  font-weight: 600;
}

.status-grid {
  display: flex;
  justify-content: center;
  gap: 32px;
  margin-bottom: 60px;
}

.status-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  color: #444;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.status-item.active {
  color: var(--primary);
}

.status-item.active svg {
  filter: drop-shadow(0 0 8px var(--primary));
}

.back-home-btn {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  background: #111;
  border: 1px solid #222;
  color: white;
  padding: 16px 32px;
  border-radius: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
}

.back-home-btn:hover {
  background: #1a1a1a;
  border-color: #333;
  transform: translateY(-2px);
}

@media (max-width: 480px) {
  .glass-container {
    padding: 40px 20px;
    border-radius: 0;
    background: transparent;
    border: none;
    box-shadow: none;
  }
  
  .title {
    font-size: 36px;
  }
}
</style>
