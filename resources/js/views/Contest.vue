<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  Trophy, 
  Calendar as CalendarIcon, 
  ChevronRight, 
  TrendingUp,
  Cpu,
  Zap,
  Globe,
  Twitter,
  Github,
  Award,
  BookMarked,
  Layout,
  MessageCircle,
  BarChart2,
  PieChart,
  Lightbulb,
  Puzzle,
  Gamepad,
  Target
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const contests = [
  { id: 1, title: 'FEBRUARY', subtitle: 'Join and grab share of prize pool', status: 'CLOSED', icon: BarChart2 },
  { id: 2, title: 'NOVEMBER', subtitle: 'Trading Competition', status: 'ENDED', icon: Layout },
  { id: 3, title: 'OCTOBER', subtitle: 'Global Trading Series', status: 'ENDED', icon: Target },
  { id: 4, title: 'SEPTEMBER', subtitle: 'Neural Strategy Challenge', status: 'ENDED', icon: Zap },
  { id: 5, title: 'TRADING JOURNEY', subtitle: 'Your Path to Proficiency', status: 'ENDED', icon: TrendingUp },
  { id: 6, title: 'CHALLENGE - JULY', subtitle: 'Summer Trading Blast', status: 'ENDED', icon: Gamepad },
  { id: 7, title: 'CHALLENGE - JUNE', subtitle: 'Ecosystem Expansion', status: 'ENDED', icon: Globe },
  { id: 8, title: 'MONTHLY CHALLENGE', subtitle: 'July Edition', status: 'ENDED', icon: Award },
  { id: 9, title: 'WARM-UP CHALLENGE', subtitle: 'Pre-season Training', status: 'ENDED', icon: Puzzle },
  { id: 10, title: 'TRADING BATTLE', subtitle: 'Elite Bot Competition', status: 'ENDED', icon: Lightbulb },
];

const usefulLinks = [
  { text: 'How to Spot Trade on DeSci Website', link: '#' },
  { text: 'How to Spot Trade on DeSci App', link: '#' },
  { text: 'How to buy crypto on DeSci P2P on App', link: '#' }
];

const footerLinks = [
  {
    title: 'About Us',
    items: ['About', 'Careers', 'Announcements', 'News', 'Press', 'Legal', 'Privacy', 'Community']
  },
  {
    title: 'Products',
    items: ['Exchange', 'Academy', 'Launchpad', 'Trust Wallet', 'NFT', 'Card', 'Gift Card']
  },
  {
    title: 'Service',
    items: ['Downloads', 'Desktop App', 'Buy Crypto', 'Institutional Services', 'Referral', 'Affiliate', 'OTC Trading']
  },
  {
    title: 'Support',
    items: ['Support Center', 'Submit a Ticket', 'API Documentation', 'Fees', 'Trading Rules', 'Verify Identity']
  }
];
</script>

<template>
  <div class="contest-page">
    <TopHeader />

    <div class="main-container">
      <!-- Hero Section -->
      <section class="hero-section">
        <div class="hero-visual">
          <div class="illus-box">
             <div class="checklist">
               <div class="check-item active"></div>
               <div class="check-item active"></div>
               <div class="check-item"></div>
             </div>
             <div class="trophy-orb">
               <Trophy size="48" class="gold-trophy" />
             </div>
          </div>
        </div>
        <h1 class="hero-title">DESCI MONTHLY CHALLENGE</h1>
        <p class="hero-subtitle">Take part in DeSci Monthly Challenge for easier and more interesting experience - Join now to start your journey.</p>
        <button class="join-now-btn">Join Now</button>
      </section>

      <!-- Calendar Section -->
      <section class="calendar-section">
        <div class="calendar-header">
           <h2>CALENDAR</h2>
        </div>

        <div class="contest-list">
          <div v-for="c in contests" :key="c.id" class="contest-row">
            <div class="row-inner">
               <div class="row-content">
                  <div class="row-tag">DESCI</div>
                  <h3 class="row-title">{{ c.title }}</h3>
                  <p class="row-desc">{{ c.subtitle }}</p>
                  <div class="row-actions">
                     <span class="view-details">Details ></span>
                  </div>
               </div>
               <div class="row-icon">
                  <component :is="c.icon" size="64" stroke-width="1" class="dim-icon" />
               </div>
               <div class="row-status">
                  <span class="status-badge" :class="c.status.toLowerCase()">{{ c.status }}</span>
               </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Useful Links Section -->
      <section class="useful-section">
        <h2 class="section-label">USEFUL LINKS</h2>
        <div class="links-box">
           <a v-for="l in usefulLinks" :key="l.text" href="#" class="useful-item">
              <span>{{ l.text }}</span>
              <ChevronRight size="14" class="yellow-txt" />
           </a>
        </div>
      </section>

      <!-- Massive Footer -->
      <footer class="footer-complex">
         <div class="footer-top-grid">
            <div v-for="cat in footerLinks" :key="cat.title" class="footer-column">
               <h3>{{ cat.title }}</h3>
               <ul>
                  <li v-for="item in cat.items" :key="item">
                     <span class="f-link-contest" @click="router.push('/coming-soon')">{{ item }}</span>
                  </li>
               </ul>
            </div>
         </div>
         
         <div class="footer-community">
            <h3>Community</h3>
            <div class="social-strip">
               <Twitter size="18" />
               <Github size="18" />
               <Globe size="18" />
               <MessageCircle size="18" />
            </div>
         </div>

         <div class="footer-disclaimer">
            <p>DeSci International © 2026. Scientific nodes and biological trading risk warning: Trading involves high risk. Only invest what you can afford to lose. All research assets are subject to market volatility.</p>
         </div>
      </footer>
    </div>
  </div>
</template>

<style scoped>
.contest-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  overflow-x: hidden; /* Prevent horizontal scroll */
  width: 100%;
}

.main-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px 80px;
}

@media (min-width: 768px) {
  .main-container { padding: 0 40px 80px; }
}

/* Hero */
.hero-section {
  padding: 40px 0;
  text-align: center;
  border-bottom: 1px solid #1a1a1a;
}

.hero-visual {
  display: flex;
  justify-content: center;
  margin-bottom: 30px;
}

.illus-box {
  position: relative;
  width: 120px;
  height: 120px;
  background: #0d0d0d;
  border: 1px solid #1e2329;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.checklist {
  display: flex;
  flex-direction: column;
  gap: 6px;
  width: 50px;
}

.check-item {
  height: 5px;
  background: #1e2329;
  border-radius: 3px;
  width: 100%;
  position: relative;
}

.check-item.active::before {
  content: '✓';
  position: absolute;
  left: -18px;
  top: -5px;
  color: var(--primary);
  font-size: 10px;
  font-weight: 900;
}

.trophy-orb {
  position: absolute;
  bottom: -10px;
  right: -10px;
  width: 60px;
  height: 60px;
  background: radial-gradient(circle, rgba(223, 255, 0, 0.2) 0%, transparent 70%);
  display: flex;
  align-items: center;
  justify-content: center;
}

.gold-trophy { color: var(--primary); }

.hero-title {
  font-size: 24px;
  font-weight: 900;
  margin-bottom: 12px;
  letter-spacing: -1px;
}

@media (min-width: 768px) {
  .hero-title { font-size: 32px; }
}

.hero-subtitle {
  font-size: 13px;
  color: #fff;
  max-width: 500px;
  margin: 0 auto 24px;
  line-height: 1.6;
}

.join-now-btn {
  background: var(--primary);
  color: #000;
  border: none;
  padding: 12px 0;
  width: 100%;
  max-width: 300px;
  border-radius: 8px;
  font-weight: 800;
  font-size: 16px;
  cursor: pointer;
  transition: transform 0.2s;
}

.join-now-btn:hover { transform: scale(1.02); }

/* Calendar */
.calendar-section {
  padding: 40px 0;
  max-width: 800px;
  margin: 0 auto;
}

.calendar-header h2 {
  font-size: 16px;
  font-weight: 800;
  margin-bottom: 30px;
  letter-spacing: 1px;
}

.contest-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.contest-row {
  background: #0d0d0d;
  border: 1px solid #1e2329;
  border-radius: 12px;
  overflow: hidden;
  transition: border-color 0.2s;
}

.contest-row:hover { border-color: var(--primary); }

.row-inner {
  display: flex;
  padding: 20px;
  align-items: center;
  flex-wrap: wrap; /* Key for mobile */
  gap: 20px;
}

.row-content { flex: 1; min-width: 200px; }

.row-tag {
  font-size: 10px;
  color: var(--primary);
  font-weight: 800;
  margin-bottom: 10px;
  display: inline-block;
  padding: 2px 8px;
  background: rgba(223, 255, 0, 0.1);
  border-radius: 4px;
}

.row-title {
  font-size: 20px;
  font-weight: 900;
  margin-bottom: 6px;
}

.row-desc {
  font-size: 12px;
  color: #fff;
  font-weight: 600;
  margin-bottom: 15px;
}

.view-details {
  font-size: 11px;
  color: #fff;
  cursor: pointer;
  font-weight: 700;
}

.row-icon {
  color: #1a1e23;
  display: none; /* Hide by default on mobile */
}

@media (min-width: 600px) {
  .row-icon { 
    display: block; 
    margin: 0 20px; 
  }
}

.dim-icon { opacity: 0.3; }

.row-status {
  width: 100%; /* Force status to wrap on small mobile */
  display: flex;
  justify-content: flex-start;
}

@media (min-width: 600px) {
  .row-status { width: auto; }
}

.status-badge {
  font-size: 10px;
  font-weight: 900;
  padding: 5px 12px;
  border-radius: 4px;
  background: #1e2329;
  color: #fff;
  white-space: nowrap;
}

.status-badge.active { background: var(--primary); color: #000; }

/* Useful Links */
.useful-section {
  padding: 40px 0;
  max-width: 800px;
  margin: 0 auto;
}

.section-label {
  font-size: 12px;
  color: #fff;
  font-weight: 800;
  margin-bottom: 15px;
}

.links-box {
  display: flex;
  flex-direction: column;
}

.useful-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 0;
  border-bottom: 1px solid #111;
  color: #fff;
  text-decoration: none;
  font-size: 13px;
  font-weight: 600;
}

.yellow-txt { color: var(--primary); }

/* Footer */
.footer-complex {
  margin-top: 60px;
  padding: 60px 0 30px;
  border-top: 1px solid #1a1a1a;
}

.footer-top-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
  margin-bottom: 50px;
}

@media (min-width: 1024px) {
  .footer-top-grid { grid-template-columns: repeat(4, 1fr); gap: 40px; }
}

.footer-column h3 {
  font-size: 14px;
  font-weight: 800;
  margin-bottom: 20px;
  color: #fff;
}

.footer-column ul { list-style: none; padding: 0; }
.footer-column ul li { margin-bottom: 10px; }
.footer-column ul li a {
  color: #848e9c;
  font-size: 12px;
  text-decoration: none;
  transition: color 0.2s;
}
.footer-column ul li a:hover { color: #fff; }
.f-link-contest { color: #fff; font-size: 12px; cursor: pointer; transition: color 0.2s; }
.f-link-contest:hover { color: #fff; }

.footer-community h3 { font-size: 14px; font-weight: 800; margin-bottom: 15px; }
.social-strip {
  display: flex;
  gap: 15px;
  color: #fff;
  margin-bottom: 40px;
  flex-wrap: wrap;
}

.footer-disclaimer {
  color: #fff;
  font-size: 11px;
  line-height: 1.6;
  max-width: 100%;
  border-top: 1px solid #111;
  padding-top: 25px;
}

@media (max-width: 480px) {
  .row-title { font-size: 18px; }
  .row-inner { padding: 15px; }
  .footer-top-grid { grid-template-columns: 1fr; }
}
</style>


