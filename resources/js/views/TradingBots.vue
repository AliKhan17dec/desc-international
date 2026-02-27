<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  Bot, 
  ChevronDown, 
  ArrowLeft, 
  Filter, 
  Eye,
  Plus,
  ArrowRight
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const goBack = () => router.back();

const bots = [
  { pair: 'POLYX/USDT', roi: '936.98%', roi7d: '+112.5%', pnl7d: '+458.21', copiers: '12,402', runtime: '2d 4h', color: '#DFFF00' },
  { pair: 'ZRO/USDT', roi: '904.31%', roi7d: '+98.4%', pnl7d: '+389.44', copiers: '8,512', runtime: '5d 12h', color: '#DFFF00' },
  { pair: 'CYBER/USDT', roi: '668.76%', roi7d: '+45.1%', pnl7d: '+245.10', copiers: '4,210', runtime: '1d 2h', color: '#DFFF00' },
  { pair: 'LOKA/USDT', roi: '610.27%', roi7d: '+32.5%', pnl7d: '+132.55', copiers: '9,821', runtime: '8d 1h', color: '#DFFF00' },
  { pair: 'BROCCOLI/USDT', roi: '484.66%', roi7d: '+12.0%', pnl7d: '+72.00', copiers: '15,000', runtime: '12h 30m', color: '#DFFF00' },
  { pair: 'LUNA/USDT', roi: '366.91%', roi7d: '+99.9%', pnl7d: '+99.99', copiers: '7,432', runtime: '10d 5h', color: '#DFFF00' },
  { pair: 'TLM/USDT', roi: '322.06%', roi7d: '+15.2%', pnl7d: '+15.22', copiers: '3,110', runtime: '3d 9h', color: '#DFFF00' },
  { pair: 'JASMY/USDT', roi: '266.72%', roi7d: '+28.3%', pnl7d: '+28.33', copiers: '2,890', runtime: '6d 7h', color: '#DFFF00' },
];

</script>

<template>
  <div class="trading-bots-page">
    <TopHeader />
    
    <div class="container main-content">
      <!-- Nav Header -->
      <div class="nav-bar">
        <div class="back-link" @click="goBack">
          <ChevronLeft size="18" />
          <span>Portfolios List</span>
        </div>
      </div>

      <!-- Hero Section -->
      <div class="hero-section">
        <h1 class="page-title">Trading Bots</h1>
        
        <div class="profit-summary">
          <div class="stat-item">
            <div class="label">Total Profit (USDT) <Eye size="14" class="dim" /></div>
            <div class="value">0.0000</div>
          </div>
        </div>

        <div class="hero-actions">
          <button class="btn-primary">Trade Now</button>
          <button class="btn-secondary">Running Bots (0)</button>
        </div>
      </div>

      <!-- Bot Promo Banner -->
      <div class="bot-promo">
        <div class="promo-content">
          <div class="promo-text">
            <h3>Member-led Trading Bots</h3>
            <span class="promo-link">Join Now <ArrowRight size="14" /></span>
          </div>
          <div class="promo-art">
            <div class="robot-glow">
              <Bot size="40" stroke-width="1.5" />
            </div>
          </div>
        </div>
      </div>

      <!-- Marketplace Section -->
      <div class="marketplace">
        <div class="m-header">
          <h2>Bot Marketplace</h2>
          <ChevronDown size="16" class="dim" />
        </div>

        <div class="m-tabs">
          <div class="tab-item active">All Strategies</div>
          <div class="tab-item">Spot Grid</div>
          <div class="tab-item">Futures Grid</div>
          <Filter size="16" class="m-filter-icon" />
        </div>

        <!-- Bots List -->
        <div class="bots-container">
          <div v-for="(bot, index) in bots" :key="index" class="bot-row-card">
            <!-- Header Row -->
            <div class="bot-card-header">
              <div class="pair-info">
                <span class="pair">{{ bot.pair }}</span>
                <span class="strategy-badge">Grid</span>
              </div>
              <button class="btn-create-sm">Create</button>
            </div>

            <!-- Stats & Chart Row -->
            <div class="bot-card-body">
              <div class="stats-col">
                <div class="roi-val">{{ bot.roi }}</div>
                <div class="sub-stats">
                  <div class="ss-item">
                    <span class="ss-l">7D ROI</span>
                    <span class="ss-v green">{{ bot.roi7d }}</span>
                  </div>
                  <div class="ss-item">
                    <span class="ss-l">7D PnL</span>
                    <span class="ss-v green">{{ bot.pnl7d }}</span>
                  </div>
                </div>
              </div>
              <div class="chart-col">
                <svg viewBox="0 0 100 30" class="sparkline">
                  <path 
                    :d="index % 2 === 0 ? 'M0 25 Q 15 10, 30 18 T 60 5 T 100 8' : 'M0 20 Q 20 25, 40 10 T 70 15 T 100 5'" 
                    fill="none" 
                    :stroke="bot.color" 
                    stroke-width="2" 
                  />
                  <path 
                    :d="index % 2 === 0 ? 'M0 25 Q 15 10, 30 18 T 60 5 T 100 8 L 100 30 L 0 30 Z' : 'M0 20 Q 20 25, 40 10 T 70 15 T 100 5 L 100 30 L 0 30 Z'" 
                    :fill="index % 2 === 0 ? 'rgba(223, 255, 0, 0.05)' : 'rgba(223, 255, 0, 0.05)'"
                  />
                </svg>
              </div>
            </div>

            <!-- Footer Stats -->
            <div class="bot-card-footer">
              <div class="footer-stat">
                <span class="fl">Copiers</span>
                <span class="fv">{{ bot.copiers }}</span>
              </div>
              <div class="footer-stat">
                <span class="fl">Runtime</span>
                <span class="fv">{{ bot.runtime }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div class="m-pagination">
          <div class="p-btn active">1</div>
          <div class="p-btn">2</div>
          <div class="p-btn">3</div>
          <div class="p-btn">4</div>
          <div class="p-dots">...</div>
          <div class="p-btn">52</div>
          <ChevronRight size="16" class="dim" />
        </div>
      </div>

      <!-- Footer Replication -->
      <footer class="site-footer">
        <div class="accordion-footer">
          <div class="a-item"><span>About Us</span> <Plus size="14"/></div>
          <div class="a-item"><span>Products</span> <Plus size="14"/></div>
          <div class="a-item"><span>Business</span> <Plus size="14"/></div>
          <div class="a-item"><span>Learn</span> <Plus size="14"/></div>
          <div class="a-item"><span>Service</span> <Plus size="14"/></div>
          <div class="a-item"><span>Support</span> <Plus size="14"/></div>
        </div>

        <div class="social-links">
          <div v-for="i in 8" :key="i" class="soc-icon"></div>
        </div>

        <div class="footer-settings">
          <div class="fs-row">
            <span>English</span>
            <span>USD</span>
            <div class="theme-toggle">
              <span>Theme</span>
              <div class="t-switch"><div class="t-circle"></div></div>
            </div>
          </div>
          <div class="fs-copyright">
            Binance © 2026 <br/>
            Cookie Preferences
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<style scoped>
.trading-bots-page, .trading-bots-page * {
  box-sizing: border-box;
}

.trading-bots-page {
  background: #0b0e11;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  overflow-x: hidden;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
}

@media (max-width: 1200px) {
  .container {
    padding: 0 16px;
  }
}

/* Nav */
.nav-bar {
  padding: 16px 0;
}

.back-link {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #848e9c;
  font-size: 14px;
  cursor: pointer;
}

/* Hero */
.hero-section {
  padding: 24px 0 40px;
}

.page-title {
  font-size: 28px;
  font-weight: 600;
  margin-bottom: 32px;
}

.profit-summary .label {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  color: #848e9c;
  margin-bottom: 8px;
  text-decoration: underline;
  text-decoration-style: dotted;
}

.profit-summary .value {
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 32px;
}

.hero-actions {
  display: flex;
  gap: 12px;
}

.btn-primary {
  background: var(--primary);
  color: #000;
  border: none;
  padding: 10px 24px;
  border-radius: 8px;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
}

.btn-secondary {
  background: #2b3139;
  color: #fff;
  border: none;
  padding: 10px 24px;
  border-radius: 8px;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
}

/* Promo */
.bot-promo {
  background: #1e2329;
  border-radius: 16px;
  padding: 24px;
  margin-bottom: 40px;
}

.promo-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.promo-text h3 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 8px;
}

.promo-link {
  display: flex;
  align-items: center;
  gap: 4px;
  color: var(--primary);
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
}

.robot-glow {
  width: 64px;
  height: 64px;
  background: rgba(223, 255, 0, 0.1);
  border-radius: 50%;
  border: 1px solid rgba(223, 255, 0, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--primary);
}

/* Marketplace */
.marketplace {
  margin-bottom: 80px;
}

.m-header {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 24px;
}

.m-header h2 {
  font-size: 20px;
  font-weight: 600;
}

.m-tabs {
  display: flex;
  align-items: center;
  gap: 24px;
  border-bottom: 1px solid #1e2329;
  padding-bottom: 12px;
  margin-bottom: 32px;
}

.tab-item {
  font-size: 14px;
  color: #848e9c;
  cursor: pointer;
  position: relative;
}

.tab-item.active {
  color: #fff;
  font-weight: 600;
}

.tab-item.active::after {
  content: '';
  position: absolute;
  bottom: -13px;
  left: 0;
  width: 100%;
  height: 2px;
  background: var(--primary);
}

.m-filter-icon {
  margin-left: auto;
  color: #848e9c;
  cursor: pointer;
}

/* Bots Grid */
.bots-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
  gap: 20px;
}

@media (max-width: 480px) {
  .bots-container {
    grid-template-columns: 1fr;
  }
}

.bot-row-card {
  background: #1e2329;
  border-radius: 12px;
  padding: 20px;
  border: 1px solid transparent;
  transition: all 0.2s;
}

.bot-row-card:hover { border-color: #2b3139; }

.bot-card-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 24px;
}

.pair-info { display: flex; flex-direction: column; gap: 4px; }
.pair { font-size: 16px; font-weight: 700; }
.strategy-badge { font-size: 10px; background: #2b3139; color: #848e9c; padding: 2px 6px; border-radius: 4px; width: fit-content; }

.btn-create-sm {
  background: var(--primary);
  color: #000;
  border: none;
  padding: 6px 16px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
}

.bot-card-body {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.roi-val {
  font-size: 24px;
  font-weight: 700;
  color: #DFFF00;
  margin-bottom: 8px;
}

.sub-stats { display: flex; gap: 16px; }
.ss-item { display: flex; flex-direction: column; gap: 2px; }
.ss-l { font-size: 10px; color: #848e9c; }
.ss-v { font-size: 12px; font-weight: 600; }
.ss-v.green { color: #DFFF00; }

.chart-col { width: 100px; height: 40px; }
.sparkline { width: 100%; height: 100%; }

.bot-card-footer {
  display: flex;
  gap: 32px;
  padding-top: 16px;
  border-top: 1px solid #2b3139;
}

.footer-stat { display: flex; flex-direction: column; gap: 4px; }
.fl { font-size: 11px; color: #848e9c; }
.fv { font-size: 13px; font-weight: 600; }

/* Pagination */
.m-pagination {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 12px;
  margin-top: 40px;
}

.p-btn {
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  font-size: 14px;
  color: #848e9c;
  cursor: pointer;
}

.p-btn.active {
  background: #2b3139;
  color: #fff;
  font-weight: 600;
}

.p-dots { color: #474d57; }

/* Footer */
.site-footer {
  border-top: 8px solid #1e2329;
  padding: 40px 0;
  margin-top: 40px;
}

.accordion-footer .a-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 0;
  border-bottom: 1px solid #1e2329;
  color: #848e9c;
  font-size: 14px;
}

.social-links {
  display: flex;
  gap: 16px;
  margin: 32px 0;
  flex-wrap: wrap;
}

.soc-icon {
  width: 24px;
  height: 24px;
  background: #474d57;
  border-radius: 4px;
}

.footer-settings {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.fs-row {
  display: flex;
  align-items: center;
  gap: 24px;
  font-size: 14px;
  color: #848e9c;
}

.theme-toggle { display: flex; align-items: center; gap: 8px; }
.t-switch {
  width: 32px;
  height: 18px;
  background: #2b3139;
  border-radius: 10px;
  display: flex;
  align-items: center;
  padding-left: 4px;
}
.t-circle { width: 12px; height: 12px; background: #848e9c; border-radius: 50%; }

.fs-copyright { font-size: 12px; color: #474d57; line-height: 1.6; }

.dim { color: #474d57; }
</style>
