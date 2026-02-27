<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  ChevronLeft, 
  ChevronDown, 
  Eye, 
  Plus,
  FileSearch
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const activeTab = ref('Ongoing');
const portfolioTabs = ['Ongoing (0)', 'Closed (0)', 'Mock (0)'];

const stats = [
  { label: 'Total Copying Balance (USDT)', value: '0.0000', hasEye: true },
  { label: 'Total Realized PNL (USDT)', value: '0.0000', hasEye: false },
  { label: 'Total Unrealized PnL (USDT)', value: '0.0000', hasEye: false },
  { label: 'Net Profit (USDT)', value: '0.0000', hasEye: false }
];

const goBack = () => router.back();
</script>

<template>
  <div class="portfolios-list-page">
    <TopHeader />
    
    <div class="main-content">
      <!-- Nav Header -->
      <div class="nav-bar">
        <div class="back-link" @click="goBack">
          <ChevronLeft size="18" />
          <span>Portfolios List</span>
        </div>
      </div>

      <!-- Tab Bar Section -->
      <div class="tabs-container">
        <div class="type-dropdown">
          <span>Spot Copy</span>
          <ChevronDown size="14" />
        </div>
        
        <div class="status-tabs">
          <div 
            v-for="tab in portfolioTabs" 
            :key="tab"
            class="status-tab"
            :class="{ active: tab.startsWith(activeTab) }"
            @click="activeTab = tab.split(' ')[0]"
          >
            {{ tab }}
          </div>
        </div>
      </div>

      <!-- Stats Block -->
      <div class="stats-section">
        <div v-for="stat in stats" :key="stat.label" class="stat-group">
          <div class="stat-label">
            <span>{{ stat.label }}</span>
            <Eye v-if="stat.hasEye" size="14" class="dim" />
          </div>
          <div class="stat-value">{{ stat.value }}</div>
        </div>
      </div>

      <!-- Empty State -->
      <div class="empty-state">
        <div class="empty-icon-wrap">
          <FileSearch size="64" stroke-width="1" class="empty-icon" />
        </div>
        <p class="no-records">No records</p>
        <button class="view-list-btn" @click="router.push('/copy-trading')">
          View Portfolio List
        </button>
      </div>

      <!-- site footer replication -->
      <footer class="footer-links">
        <div class="f-col"><span>About Us</span> <Plus size="14"/></div>
        <div class="f-col"><span>Products</span> <Plus size="14"/></div>
        <div class="f-col"><span>Business</span> <Plus size="14"/></div>
        <div class="f-col"><span>Learn</span> <Plus size="14"/></div>
        <div class="f-col"><span>Service</span> <Plus size="14"/></div>
        <div class="f-col"><span>Support</span> <Plus size="14"/></div>
        
        <div class="community-row">
            <div v-for="i in 8" :key="i" class="social-icon"></div>
        </div>

        <div class="language-settings">
            <span>English</span>
            <span>USD</span>
            <div class="theme-toggle">
                <span>Theme</span>
                <div class="theme-switch">
                    <div class="icon-moon"></div>
                </div>
            </div>
        </div>

        <div class="copyright">
            Binance © 2026 <br/>
            Cookie Preferences
        </div>
      </footer>
    </div>
  </div>
</template>

<style scoped>
.portfolios-list-page, .portfolios-list-page * {
  box-sizing: border-box;
}

.portfolios-list-page {
  background: #0b0e11;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  overflow-x: hidden;
}

.main-content {
  max-width: 1200px;
  margin: 0 auto;
  background: #0b0e11;
  width: 100%;
}

@media (max-width: 1024px) {
  .main-content {
    max-width: 600px;
  }
}

/* Nav bar */
.nav-bar {
  padding: 16px 20px;
}

.back-link {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #fff;
  font-size: 14px;
  cursor: pointer;
}

/* Tabs */
.tabs-container {
  display: flex;
  align-items: center;
  padding: 0 20px 16px;
  gap: 24px;
  border-bottom: 1px solid #1e2329;
}

.type-dropdown {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 14px;
  font-weight: 500;
  color: #fff;
  cursor: pointer;
}

.status-tabs {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
}

.status-tab {
  font-size: 13px;
  color: #fff;
  cursor: pointer;
  padding: 4px 0;
}

.status-tab.active {
  color: #fff;
  font-weight: 600;
  position: relative;
}

/* Dashboard Stats */
.stats-section {
  padding: 24px 20px;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 32px;
}

@media (max-width: 768px) {
  .stats-section {
    grid-template-columns: 1fr;
    gap: 24px;
  }
}

.stat-group {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.stat-label {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  color: #fff;
  text-decoration: underline;
  text-decoration-style: dotted;
}

.dim { color: #fff; }

.stat-value {
  font-size: 20px;
  font-weight: 600;
  color: #fff;
}

/* Empty State */
.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 80px 20px 120px;
}

.empty-icon-wrap {
  margin-bottom: 16px;
  opacity: 0.2;
}

.empty-icon { color: #fff; }

.no-records {
  font-size: 14px;
  color: #fff;
  margin-bottom: 24px;
}

.view-list-btn {
  background: var(--primary);
  color: #000;
  border: none;
  padding: 10px 24px;
  border-radius: 8px;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
  transition: opacity 0.2s;
}

.view-list-btn:hover {
  opacity: 0.9;
}

/* Footer Section */
.footer-links {
    padding: 32px 20px;
    border-top: 8px solid #1e2329;
}

.f-col {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid #1e2329;
    font-size: 14px;
    color: #fff;
    cursor: pointer;
}

.community-row {
    display: flex;
    gap: 16px;
    margin: 32px 0;
    flex-wrap: wrap;
}

.social-icon {
    width: 20px;
    height: 20px;
    background: #fff;
    border-radius: 4px;
}

.language-settings {
    display: flex;
    align-items: center;
    gap: 24px;
    font-size: 14px;
    color: #fff;
    margin-bottom: 32px;
}

.theme-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
}

.theme-switch {
    width: 32px;
    height: 18px;
    background: #2b3139;
    border-radius: 10px;
    display: flex;
    align-items: center;
    padding-left: 4px;
}

.icon-moon {
    width: 12px;
    height: 12px;
    background: #fff;
    border-radius: 50%;
}

.copyright {
    font-size: 12px;
    color: #fff;
    line-height: 1.6;
}
</style>
