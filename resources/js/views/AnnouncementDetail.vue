<script setup>
import { ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { 
  ArrowLeft, 
  Search, 
  Menu as MenuIcon,
  Share2,
  ChevronRight,
  ExternalLink,
  Calendar,
  Clock,
  ArrowDown
} from 'lucide-vue-next';
import AnnouncementsHeader from '../components/AnnouncementsHeader.vue';

const router = useRouter();
const route = useRoute();

const announcement = {
  id: route.params.id,
  title: 'Wednesday Airdrop: Trade to earn from Dual pools of $120,000!',
  date: 'Feb 4, 2026',
  badge: 'Lucky Draw',
  heroImage: 'https://img.freepik.com/free-photo/financial-trade-charts_53876-15096.jpg', // Placeholder for simulation
  content: `
    The Supercharged Wednesday Airdrop is back with two prize pools: Lucky Draw and Shared Rewards!
    
    Beyond the guaranteed Lucky Draw, you can leverage your trading volume to share an extra prize pool through points!
  `,
  details: [
    { label: 'Event period', val: 'Feb 4, 2026, 10AM UTC - Feb 10, 2026, 11:59PM UTC' },
    { label: 'Draw period', val: 'Feb 4, 2026, 10AM UTC - Feb 17, 2026, 11:59PM UTC' }
  ]
};
</script>

<template>
  <div class="detail-screen">
    <AnnouncementsHeader />

    <main class="scroll-content">
      <div class="content-container">
        <!-- Breadcrumbs -->
        <nav class="breadcrumbs">
          <span @click="router.push('/announcements')">Announcement</span>
          <ChevronRight size="14" />
          <span>ALL</span>
          <ChevronRight size="14" />
          <span class="active">Current Page</span>
        </nav>

        <h1 class="main-title">{{ announcement.title }}</h1>
        
        <div class="meta-row">
          <div class="m-pill">{{ announcement.badge }}</div>
          <span class="m-date">{{ announcement.date }}</span>
          <Share2 size="18" class="share-icon" />
        </div>

        <p class="disclaimer">
          <strong>Disclaimer:</strong> This is a general announcement. Products and services referred to here may not be available in your region. Please refer to T&Cs for more details.
        </p>

        <!-- Hero Section -->
        <div class="hero-card">
           <div class="hero-overlay">
              <div class="hero-text">
                <div class="hero-brand">XOSIS</div>
                <h2>Wednesday Airdrop</h2>
                <p>(USDT Exclusive)</p>
                <div class="hero-cta">Join Now</div>
              </div>
           </div>
           <div class="floating-icons">
              <div class="icon-blob">🏠</div>
              <div class="icon-blob">💰</div>
              <div class="icon-blob"></div>
           </div>
        </div>

        <div class="article-body">
          <p>{{ announcement.content }}</p>

          <div class="event-info">
             <div v-for="info in announcement.details" :key="info.label" class="info-row">
                <span class="i-label">📅 {{ info.label }}:</span>
                <span class="i-val">{{ info.val }}</span>
             </div>
          </div>

          <div class="participation-guide">
             <h3>✅ How to participate</h3>
             <p>Simply register for the event to get started.</p>
             <button class="register-btn">Register Now</button>
          </div>

          <div class="extra-steps">
             <h3>🎁 How to earn lucky draw tickets</h3>
             <p>Complete tasks to unlock entries across multiple reward tiers.</p>
          </div>
          
          <div class="read-more">
             <span>Read More</span>
             <ArrowDown size="16" />
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="ann-footer">
        <div class="footer-brand">XOSIS</div>
        <div class="qr-placeholder">
          <div class="qr-box"></div>
           <span>Scan code to download APP</span>
        </div>
        <div class="tos-links">
          <a href="#">Terms of Service</a> | <a href="#">Privacy Policy</a>
        </div>
      </footer>
    </main>
  </div>
</template>

<style scoped>
.detail-screen {
  background-color: #000;
  min-height: 100vh;
  color: white;
  font-family: 'Inter', sans-serif;
}

.content-container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 48px 20px;
}

.breadcrumbs {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  color: #fff;
  margin-bottom: 32px;
}

.breadcrumbs span { cursor: pointer; transition: color 0.2s; }
.breadcrumbs span:hover { color: #fff; }
.breadcrumbs span.active { color: #DFFF00; cursor: default; }

.main-title {
  font-size: clamp(28px, 4vw, 42px);
  font-weight: 900;
  line-height: 1.1;
  margin-bottom: 32px;
  letter-spacing: -0.5px;
}

.meta-row {
  display: flex;
  align-items: center;
  gap: 20px;
  margin-bottom: 40px;
}

.m-pill {
  background: rgba(223, 255, 0, 0.1);
  color: #DFFF00;
  font-size: 12px;
  font-weight: 800;
  padding: 6px 14px;
  border-radius: 6px;
  text-transform: uppercase;
}

.m-date { 
  color: #fff; 
  font-size: 14px; 
  font-weight: 500;
}

.share-icon { 
  margin-left: auto; 
  color: #fff; 
  cursor: pointer;
  transition: color 0.2s;
}
.share-icon:hover { color: #fff; }

.disclaimer {
  background: #0d0d0d;
  border: 1px solid #1a1a1a;
  padding: 20px;
  border-radius: 12px;
  font-size: 13px;
  color: #fff;
  line-height: 1.7;
  margin-bottom: 48px;
}

/* Hero Card */
.hero-card {
  height: clamp(240px, 30vh, 400px);
  background: linear-gradient(135deg, #1a1a1a 0%, #000 100%);
  border-radius: 20px;
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  padding: 60px;
  margin-bottom: 60px;
  border: 1px solid #222;
  box-shadow: 0 40px 100px rgba(0,0,0,0.5);
}

.hero-text {
  position: relative;
  z-index: 2;
  max-width: 500px;
}

.hero-brand { 
  font-weight: 800; 
  color: #DFFF00; 
  font-size: 16px; 
  margin-bottom: 12px; 
  letter-spacing: 2px;
}

.hero-text h2 { 
  font-size: clamp(32px, 5vw, 48px);
  font-weight: 950; 
  margin-bottom: 8px; 
  line-height: 1;
}

.hero-text p { 
  color: #fff; 
  font-weight: 700; 
  margin-bottom: 32px;
  font-size: 18px;
}

.hero-cta {
  display: inline-block;
  background: #DFFF00;
  color: #000;
  padding: 12px 32px;
  border-radius: 8px;
  font-weight: 800;
  font-size: 15px;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s;
}
.hero-cta:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(223, 255, 0, 0.3);
}

.floating-icons {
  position: absolute;
  right: 10%;
  top: 50%;
  transform: translateY(-50%);
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
}

.icon-blob {
  font-size: clamp(32px, 6vw, 64px);
  filter: drop-shadow(0 0 20px rgba(255,123,0,0.15));
  animation: float 6s ease-in-out infinite;
}
.icon-blob:nth-child(2) { animation-delay: -2s; }
.icon-blob:nth-child(3) { animation-delay: -4s; }

@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-20px); }
}

.article-body {
  line-height: 1.8;
  color: #fff;
  font-size: 17px;
}

.event-info {
  margin: 60px 0;
  display: grid;
  grid-template-columns: 1fr;
  gap: 24px;
}

@media (min-width: 768px) {
  .event-info {
    grid-template-columns: 1fr 1fr;
    padding: 32px;
    background: #080808;
    border-radius: 16px;
    border: 1px solid #111;
  }
}

.info-row {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.i-label { font-weight: 800; color: #fff; font-size: 15px; }
.i-val { color: #fff; font-size: 15px; }

.participation-guide, .extra-steps {
  margin-top: 64px;
}

.participation-guide h3, .extra-steps h3 {
  color: #fff;
  font-size: 22px;
  font-weight: 800;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 12px;
}

.register-btn {
  margin-top: 32px;
  background: #DFFF00;
  color: #000;
  border: none;
  padding: 16px 48px;
  border-radius: 8px;
  font-weight: 800;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.2s;
}
.register-btn:hover {
  background: #c8e600;
  transform: scale(1.02);
}

.read-more {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  margin-top: 80px;
  color: #DFFF00;
  font-weight: 800;
  cursor: pointer;
  opacity: 0.6;
  transition: opacity 0.2s;
}
.read-more:hover { opacity: 1; }

@media (max-width: 768px) {
  .hero-card { padding: 32px; }
  .floating-icons { display: none; }
  .main-title { font-size: 28px; }
}

/* Footer (Simplified) */
.ann-footer {
  margin-top: 100px;
  background: #0d0d0d;
  padding: 80px 20px;
  text-align: center;
  border-top: 1px solid #1a1a1a;
}

.footer-brand { 
  font-size: 36px; 
  font-weight: 900; 
  margin-bottom: 40px; 
  letter-spacing: -1px;
}

.qr-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
  margin-bottom: 48px;
}

.qr-box { 
  width: 120px; 
  height: 120px; 
  background: white; 
  border-radius: 8px; 
  box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}
.qr-placeholder span { font-size: 13px; color: #fff; font-weight: 600; }

.tos-links { font-size: 14px; color: #fff; }
.tos-links a { transition: color 0.2s; }
.tos-links a:hover { color: #888; }
</style>
