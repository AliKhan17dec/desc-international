<script setup>
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { 
  ChevronLeft, 
  Share2, 
  Star, 
  Info, 
  ChevronRight, 
  PieChart as PieIcon,
  Clock,
  ArrowDownLeft,
  ArrowUpRight,
  User,
  ExternalLink,
  Target,
  BarChart3
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const route = useRoute();
const router = useRouter();

const activeTab = ref('Holdings');
const tabs = ['Holdings', 'Trade History', 'Balances History', 'Copy Traders'];

const trader = {
  name: 'hopyy',
  bio: 'All truth in the world is for broccoli14 to cost $1',
  followers: '2,219',
  stats: [
    { label: 'Days Trading', value: '808' },
    { label: 'Copiers', value: '289,300' },
    { label: 'Total Copiers', value: '1,716' },
    { label: 'Max Copiers', value: '5,427' },
    { label: 'Closed PnL', value: '0' }
  ],
  performance: {
    roi: '+334.75%',
    pnl: '+251,726.25',
    copierPnl: '-51,919.23 USDT',
    sharpe: '0.62',
    mdd: '23.92%',
    winRate: '9.09%',
    winDays: '55'
  },
  overview: [
    { label: 'Leading Balance', value: '33,413.58 USDT' },
    { label: 'AUM', value: '78,315.48 USDT' },
    { label: 'Profit Sharing', value: '10%' },
    { label: 'Minimum Copy Amount', value: '10.00/100.00 USDT' },
    { label: 'Last Trade', value: '2025-01-01 01:23' }
  ],
  assets: [
    { name: 'BROCCOLI14', weight: '81.0470%', color: '#3b82f6' },
    { name: 'HE', weight: '12.32%', color: '#facc15' },
    { name: 'GPS', weight: '6.23%', color: '#3b82f6' }
  ]
};

const navigateBack = () => router.back();
</script>

<template>
  <div class="trader-details-page">
    <TopHeader />
    
    <div class="main-content">
      <!-- Sub Header / Navigation -->
      <div class="sub-header">
        <div class="back-group" @click="navigateBack">
          <ChevronLeft size="20" />
          <span>Portfolios List</span>
        </div>
        <Share2 size="20" class="dim-icon" />
      </div>

      <!-- Hero Header Section -->
      <section class="trader-hero">
        <div class="trader-intro">
          <div class="avatar-row">
            <div class="avatar-large">
              <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=hopyy" alt="Avatar" />
            </div>
            <div class="social-actions">
              <div class="follower-count">
                <Star size="16" fill="currentColor" />
                <span>{{ trader.followers }}</span>
              </div>
            </div>
          </div>
          
          <div class="name-bio">
            <h1 class="trader-name">{{ trader.name }}</h1>
            <p class="bio-text">{{ trader.bio }} <ChevronRight size="14" class="inline-icon" /></p>
          </div>

          <div class="badge-row">
            <span class="badge blue">Spot Copy</span>
            <span class="badge gray">Public</span>
          </div>

          <div class="tag-row">
            <span class="tag">Top Performer</span>
            <span class="tag">Whale Manager</span>
          </div>

          <div class="main-stats-grid">
            <div v-for="stat in trader.stats" :key="stat.label" class="main-stat">
              <span class="label">{{ stat.label }}</span>
              <span class="value">{{ stat.value }}</span>
            </div>
          </div>

          <div class="action-btns">
            <button class="btn-copy" @click="router.push('/spot-copy-settings')">Copy</button>
            <button class="btn-mock">Mock Copy</button>
            <button class="btn-compare">Compare</button>
          </div>
        </div>
      </section>

      <!-- Dashboard Grid for Desktop -->
      <div class="trader-dashboard-grid">
        <div class="grid-column">
          <!-- Performance Section -->
          <section class="performance-card">
            <div class="card-header">
              <span class="card-title">Performance</span>
              <div class="time-selector">
                <span>30 Days</span>
                <ChevronRight size="14" />
              </div>
            </div>

            <div class="performance-grid">
              <div class="perf-item big">
                <span class="label">ROI</span>
                <span class="value pos">{{ trader.performance.roi }}</span>
              </div>
              <div class="perf-item big">
                <span class="label">PnL</span>
                <span class="value pos">{{ trader.performance.pnl }}</span>
              </div>
              <div class="perf-item">
                <span class="label">Copier PnL</span>
                <span class="value neg">{{ trader.performance.copierPnl }}</span>
              </div>
              <div class="perf-item">
                <span class="label">Sharpe Ratio</span>
                <span class="value">{{ trader.performance.sharpe }}</span>
              </div>
              <div class="perf-item">
                <span class="label">MDD</span>
                <span class="value">{{ trader.performance.mdd }}</span>
              </div>
              <div class="perf-item">
                <span class="label">Win Rate</span>
                <span class="value">{{ trader.performance.winRate }}</span>
              </div>
              <div class="perf-item">
                <span class="label">Win Days</span>
                <span class="value">{{ trader.performance.winDays }}</span>
              </div>
            </div>
          </section>

          <!-- Overview List -->
          <section class="overview-section">
            <div class="card-header">
                <span class="card-title">Lead Trader Overview</span>
            </div>
            <div class="overview-list">
                <div v-for="item in trader.overview" :key="item.label" class="overview-item">
                    <span class="label">{{ item.label }}</span>
                    <span class="value">{{ item.value }} <ChevronRight v-if="item.label === 'Leading Balance'" size="14" /></span>
                </div>
            </div>
          </section>
        </div>

        <div class="grid-column">
          <!-- Performance Chart -->
          <section class="chart-section">
            <div class="card-header">
                <div class="chart-tabs">
                    <span class="active">ROI</span>
                    <span>PnL</span>
                </div>
                <div class="time-selector">30 Days <ChevronRight size="14" /></div>
            </div>
            <div class="line-chart">
                <svg viewBox="0 0 100 40" preserveAspectRatio="none">
                    <path d="M0 38 L10 38 L20 37 L30 38 L40 37 L50 37 L60 38 L70 37 L80 37 L90 5 L100 8" fill="none" stroke="#DFFF00" stroke-width="1" />
                    <path d="M0 38 L10 38 L20 37 L30 38 L40 37 L50 37 L60 38 L70 37 L80 37 L90 5 L100 8 V40 H0 Z" fill="url(#gradient)" opacity="0.1" />
                </svg>
                <div class="chart-dates">
                    <span>12-04</span>
                    <span>12-14</span>
                    <span>12-24</span>
                </div>
            </div>
          </section>

          <!-- Asset Preferences -->
          <section class="assets-section">
            <div class="card-header">
                <span class="card-title">Asset Preferences <Info size="14" class="dim-icon" /></span>
                <span class="time-selector">30 Days <ChevronRight size="14" /></span>
            </div>
            <div class="donut-container">
                <div class="donut-chart">
                    <svg viewBox="0 0 40 40" class="donut">
                        <circle class="donut-ring" cx="20" cy="20" r="15.9155" fill="transparent" stroke="#1a1a1a" stroke-width="4"></circle>
                        <circle class="donut-segment" cx="20" cy="20" r="15.9155" fill="transparent" stroke="#3b82f6" stroke-width="4" stroke-dasharray="81 19" stroke-dashoffset="25"></circle>
                        <circle class="donut-segment" cx="20" cy="20" r="15.9155" fill="transparent" stroke="#facc15" stroke-width="4" stroke-dasharray="12 88" stroke-dashoffset="44"></circle>
                    </svg>
                </div>
                <div class="donut-legend">
                    <div v-for="asset in trader.assets" :key="asset.name" class="legend-item">
                        <div class="dot" :style="{ background: asset.color }"></div>
                        <span class="name">{{ asset.name }}</span>
                        <span class="weight">{{ asset.weight }}</span>
                    </div>
                </div>
            </div>
            <p class="refresh-note">*Figures are refreshed every 1-2 hours.</p>
          </section>
        </div>
      </div>

      <!-- Bottom Tabs Section -->
      <section class="details-tabs">
        <div class="tabs-scroll shadow-r">
          <div 
            v-for="tab in tabs" 
            :key="tab" 
            class="detail-tab" 
            :class="{ active: activeTab === tab }"
            @click="activeTab = tab"
          >
            {{ tab }}
          </div>
        </div>

        <div class="tab-content">
          <div v-if="activeTab === 'Holdings'" class="holdings-list">
            <div class="holding-card">
              <div class="card-top">
                <div class="asset-info">
                  <div class="asset-icon green">HE</div>
                  <div class="name-pnl">
                    <span class="symbol">HE</span>
                    <span class="pnl pos">+332.10 USDT <span class="perc">+2.18%</span></span>
                  </div>
                </div>
                <div class="date">2025-01-01 01:23:55</div>
              </div>
              <div class="card-stats">
                <div class="s-col">
                  <span class="l">Unrealized PnL</span>
                  <span class="v pos">332.10 USDT <Info size="10"/></span>
                </div>
                <div class="s-col">
                    <span class="l">Realized PnL</span>
                    <span class="v">0.00 USDT <Info size="10"/></span>
                </div>
              </div>
              <div class="more-details">
                <div class="row">
                  <span>Margin Amount...</span>
                  <span>1,024,32.41 </span>
                </div>
                <button class="btn-more">More <ChevronDown size="12"/></button>
              </div>
            </div>
          </div>

          <div v-if="activeTab === 'Copy Traders'" class="copy-traders-list">
            <div v-for="i in 3" :key="i" class="follower-card">
                <div class="f-info">
                    <span class="f-name">MCV*****RQ</span>
                    <span class="f-pnl pos">+$124.52</span>
                </div>
                <div class="f-stats">
                    <span>1,832.42 USDT</span>
                    <span class="pos">+17.18%</span>
                </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Generic Site Footer -->
      <footer class="trader-footer">
          <div class="footer-links">
              <div v-for="i in 5" :key="i" class="footer-col">
                  <span>About Us</span>
                  <ChevronDown size="14" />
              </div>
          </div>
      </footer>
    </div>
  </div>
</template>

<style scoped>
.trader-details-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  overflow-x: hidden;
}

.main-content {
  max-width: 1200px;
  margin: 0 auto;
  background: #000;
  padding-bottom: 80px;
}

@media (max-width: 1024px) {
  .main-content {
    max-width: 768px;
  }
}

/* Sub Header */
.sub-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 20px;
  border-bottom: 1px solid #111;
}

.back-group {
  display: flex;
  align-items: center;
  gap: 12px;
  cursor: pointer;
  font-size: 15px;
  font-weight: 600;
}

.dim-icon { color: #555; cursor: pointer; }

/* Hero Section */
.trader-hero {
  padding: 32px 20px;
  background: linear-gradient(180deg, #0d0d0d 0%, #000 100%);
}

.avatar-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 24px;
}

.avatar-large {
  width: 88px;
  height: 88px;
  background: #facc15;
  border-radius: 50%;
  overflow: hidden;
  border: 3px solid #222;
}

.avatar-large img { width: 100%; height: 100%; object-fit: cover; }

.follower-count {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #111;
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 14px;
  color: #fff;
}

.trader-name {
  font-size: 32px;
  font-weight: 800;
  margin-bottom: 12px;
}

.bio-text {
  font-size: 15px;
  color: #fff;
  margin-bottom: 24px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.badge-row {
  display: flex;
  gap: 12px;
  margin-bottom: 24px;
}

.badge {
  font-size: 12px;
  font-weight: 700;
  padding: 6px 12px;
  border-radius: 6px;
}

.badge.blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
.badge.gray { background: #1a1a1a; color: #888; }

.tag-row {
  display: flex;
  gap: 12px;
  margin-bottom: 32px;
}

.tag {
  font-size: 11px;
  font-weight: 900;
  color: var(--primary);
  background: rgba(223, 255, 0, 0.05);
  padding: 4px 12px;
  border: 1px solid rgba(223, 255, 0, 0.1);
  border-radius: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.main-stats-grid {
  display: flex;
  gap: 40px;
  margin-bottom: 40px;
  flex-wrap: wrap;
}

.main-stat {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.main-stat .label { font-size: 11px; color: #fff; text-transform: uppercase; font-weight: 700; letter-spacing: 1px; }
.main-stat .value { font-size: 18px; font-weight: 700; }

.action-btns {
  display: flex;
  gap: 16px;
}

.btn-copy {
  flex: 1;
  max-width: 280px;
  background: var(--primary);
  color: #000;
  border: none;
  padding: 16px;
  border-radius: 12px;
  font-weight: 800;
  font-size: 16px;
  cursor: pointer;
  transition: transform 0.2s;
}

.btn-copy:hover { transform: scale(1.02); }

.btn-mock {
  flex: 1;
  max-width: 280px;
  background: #1a1a1a;
  color: #fff;
  border: none;
  padding: 16px;
  border-radius: 12px;
  font-weight: 800;
  font-size: 16px;
  cursor: pointer;
}

.btn-compare {
  background: transparent;
  color: #666;
  border: none;
  font-weight: 700;
  font-size: 14px;
  text-decoration: underline;
  cursor: pointer;
  padding: 0;
}

/* Dashboard Grid Layout */
.trader-dashboard-grid {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 2px;
  background: #080808;
}

@media (max-width: 1024px) {
  .trader-dashboard-grid {
    grid-template-columns: 1fr;
  }
}

.grid-column {
  display: flex;
  flex-direction: column;
  background: #000;
}

/* Card Style Sections */
.performance-card, .overview-section, .chart-section, .assets-section {
    padding: 40px;
    height: 100%;
}

@media (max-width: 768px) {
  .performance-card, .overview-section, .chart-section, .assets-section {
    padding: 32px 20px;
  }
  .action-btns { flex-direction: column; }
  .btn-copy, .btn-mock { max-width: none; }
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
}

.card-title { font-size: 18px; font-weight: 700; }
.time-selector { font-size: 13px; color: #fff; display: flex; align-items: center; gap: 6px; cursor: pointer; }

.performance-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 32px 40px;
}

.perf-item { display: flex; flex-direction: column; gap: 8px; }
.perf-item .label { font-size: 12px; color: #fff; }
.perf-item .value { font-size: 16px; font-weight: 700; }
.perf-item.big .value { font-size: 28px; font-weight: 800; }
.value.pos { color: #DFFF00; }
.perf-item.big .value.neg { color: #FF00D6; }
.perf-item .value.neg { color: #fff; }

.overview-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.overview-item {
    display: flex;
    justify-content: space-between;
    font-size: 15px;
    padding-bottom: 12px;
    border-bottom: 1px solid #111;
}

.overview-item .label { color: #fff; }
.overview-item .value { font-weight: 700; display: flex; align-items: center; gap: 6px; }

/* Chart Section */
.chart-tabs { display: flex; gap: 32px; font-size: 16px; font-weight: 700; color: #444; }
.chart-tabs .active { color: #fff; position: relative; }
.chart-tabs .active::after { content: ''; position: absolute; bottom: -12px; left: 0; width: 100%; height: 3px; background: #fff; }

.line-chart {
    height: 240px;
    margin-top: 40px;
    position: relative;
    width: 100%;
}

.chart-dates {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #444;
    margin-top: 16px;
}

/* Assets Donut */
.donut-container {
    display: flex;
    align-items: center;
    gap: 48px;
}

.donut-chart { width: 140px; height: 140px; }
.donut-legend { flex: 1; display: flex; flex-direction: column; gap: 16px; }
.legend-item { display: flex; align-items: center; font-size: 14px; gap: 12px; }
.legend-item .dot { width: 10px; height: 10px; border-radius: 50%; }
.legend-item .name { flex: 1; color: #fff; font-weight: 600; }
.legend-item .weight { font-weight: 700; }
.refresh-note { font-size: 12px; color: #333; margin-top: 32px; }

/* Bottom Tabs */
.details-tabs {
  border-top: 8px solid #080808;
}

.tabs-scroll {
    display: flex;
    gap: 40px;
    padding: 0 40px;
    border-bottom: 1px solid #111;
}

@media (max-width: 768px) {
  .tabs-scroll { padding: 0 20px; gap: 24px; }
}

.detail-tab {
    padding: 24px 0;
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    white-space: nowrap;
    cursor: pointer;
}

.detail-tab.active {
    color: var(--primary);
    position: relative;
}

.detail-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--primary);
}

.tab-content { padding: 40px; }

@media (max-width: 768px) {
  .tab-content { padding: 24px 20px; }
}

/* Holdings Card */
.holding-card {
    background: #0d0d0d;
    border: 1px solid #1a1a1a;
    border-radius: 16px;
    padding: 24px;
    max-width: 600px;
}

.card-top {
    display: flex;
    justify-content: space-between;
    margin-bottom: 24px;
}

.asset-info { display: flex; gap: 16px; }
.asset-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; }
.asset-icon.green { background: #DFFF00; color: #000; }

.symbol { font-weight: 800; font-size: 18px; display: block; margin-bottom: 4px; }
.pnl { font-size: 14px; }
.pnl .perc { font-weight: 700; }

.card-top .date { font-size: 12px; color: #444; }

.card-stats { display: flex; gap: 60px; margin-bottom: 24px; }
.s-col { display: flex; flex-direction: column; gap: 6px; }
.s-col .l { font-size: 12px; color: #fff; }
.s-col .v { font-size: 15px; font-weight: 700; display: flex; align-items: center; gap: 6px; }

/* Footer */
.trader-footer {
    padding: 60px 40px;
    border-top: 8px solid #080808;
    background: #000;
}

.footer-col {
    display: flex;
    justify-content: space-between;
    padding: 24px 0;
    border-bottom: 1px solid #111;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
}
</style>
