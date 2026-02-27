<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { Search, ChevronDown, Rocket, TrendingUp, Zap, Hexagon } from 'lucide-vue-next';
import BottomNav from './BottomNav.vue';
import TopHeader from './TopHeader.vue';

const router = useRouter();

const navigateToAsset = (asset) => {
  // For demo purposes, we'll just go to the HairDAO page (ID 1)
  // In a real app, use asset.id
  router.push('/asset/hairdao');
};

const trending = [
  { name: 'Cureopia', ticker: 'Rare diseases', change: '+59.1%', price: '$0.421' },
  { name: 'Quantum Biology DAO', ticker: 'Quantum Biology', change: '+18.7%', price: '$3.54' },
  { name: 'VitaDAO', ticker: 'Longevity', change: '-28.5%', price: '$2.12', down: true },
  { name: 'AUBURN', ticker: 'Life', change: '-22.1%', price: '$0.99', down: true },
];

const gainers = [
  { name: 'BLUPEARL', change: '+105.0%', price: '$0.03', volume: '14.2M' },
  { name: 'ValleyDAO', change: '+51.3%', price: '$1.02', volume: '2.82M' },
  { name: 'CryoDAO', change: '+44.5%', price: '$4.11', volume: '884K' },
  { name: 'Cerebrum DAO', change: '+33.1%', price: '$0.005', volume: '1.2M' },
];

const assets = [
  { rank: 1, name: 'H3 DAO', ticker: 'Hair care', price: '$26.46', change: '+1.7%', icon_color: '#FF5733' },
  { rank: 2, name: 'VitaDAO', ticker: 'Longevity', price: '$8.411', change: '+3.4%', icon_color: '#FFC300' },
  { rank: 3, name: 'MSG', ticker: 'Food', price: '$1.554', change: '-1.4%', down: true, icon_color: '#DAF7A6' },
  { rank: 4, name: 'Beura', ticker: 'Community', price: '$3.454', change: '+2.8%', icon_color: '#C70039' },
  { rank: 5, name: 'ValleyDAO', ticker: 'Synthetic Biology', price: '$1.723', change: '+5.7%', icon_color: '#900C3F' },
  { rank: 6, name: 'ATEN-HGT', ticker: 'Tech', price: '$2.341', change: '-0.2%', down: true, icon_color: '#581845' },
  { rank: 7, name: 'DidGPT', ticker: 'Meta search', price: '$0.032', change: '+4.5%', icon_color: '#28B463' },
  { rank: 8, name: 'Cerebrum DAO', ticker: 'Brain Computer', price: '$0.00068', change: '+1.2%', icon_color: '#1F618D' },
  { rank: 9, name: 'SpineDAO', ticker: 'Spine health', price: '$0.003', change: '+4.1%', icon_color: '#F39C12' },
  { rank: 10, name: 'Athena DAO', ticker: 'Womens Health', price: '$0.340', change: '+0.8%', icon_color: '#D35400' },
  { rank: 11, name: 'VITSANA', ticker: 'Health', price: '$0.429', change: '-0.5%', down: true, icon_color: '#7D3C98' },
  { rank: 12, name: 'MycoDAO', ticker: 'Fungal Research', price: '$0.005', change: '-0.1%', down: true, icon_color: '#2E86C1' },
];
</script>

<template>
  <div class="market-screen">
    <TopHeader />

    <div class="scroll-content">
      <!-- Trending Section -->
      <section class="section">
        <div class="section-header">
          <TrendingUp size="16" class="section-icon" />
          <span>Trending in DeSci</span>
        </div>
        <div class="card-list">
          <div v-for="item in trending" :key="item.name" class="mini-card">
            <div class="card-top">
              <div class="icon-circle" :class="{ 'down': item.down }"></div> <!-- Placeholder icon -->
              <div class="card-info">
                <span class="card-name">{{ item.name }}</span>
                <span class="card-ticker">{{ item.ticker }}</span>
              </div>
            </div>
            <div class="card-bottom">
              <span class="card-price">{{ item.price }}</span>
              <span class="card-change" :class="{ 'down': item.down }">{{ item.change }}</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Top Gainers Section -->
      <section class="section">
        <div class="section-header">
          <Rocket size="16" class="section-icon" />
          <span>Top Gainers</span>
        </div>
        <div class="gainer-list">
          <div v-for="item in gainers" :key="item.name" class="gainer-item">
            <div class="gainer-left">
              <div class="icon-circle small"></div>
              <div class="gainer-info">
                <span class="gainer-name">{{ item.name }}</span>
                <span class="gainer-vol">{{ item.volume }}</span>
              </div>
            </div>
            <div class="gainer-right">
              <span class="gainer-price">{{ item.price }}</span>
              <span class="gainer-change">{{ item.change }}</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Market List Section -->
      <section class="asset-section">
        <div class="filters">
          <button class="filter-btn">
            <Layers size="14" /> All Types <ChevronDown size="14" />
          </button>
          <button class="filter-btn">
            <Zap size="14" /> All Chains <ChevronDown size="14" />
          </button>
        </div>
        
        <div class="search-bar">
          <Search size="16" class="search-icon" />
          <input type="text" placeholder="Search assets" />
        </div>

        <div class="list-headers">
          <span># Asset</span>
          <span>Price</span>
        </div>

        <div class="asset-list">
          <div v-for="item in assets" :key="item.rank" class="asset-row" @click="navigateToAsset(item)">
            <div class="asset-rank">{{ item.rank }}</div>
            <div class="asset-main">
              <div class="asset-icon" :style="{ backgroundColor: item.icon_color }">
                {{ item.name[0] }}
              </div>
              <div class="asset-info">
                <span class="asset-name">{{ item.name }}</span>
                <span class="asset-ticker">{{ item.ticker }}</span>
              </div>
            </div>
            <div class="asset-price-col">
              <span class="asset-price">{{ item.price }}</span>
              <span class="asset-change" :class="{ 'down': item.down }">{{ item.change }}</span>
            </div>
          </div>
        </div>
      </section>
    </div>

    <BottomNav class="mobile-only" />

    <!-- Footer Links / Sitemap -->
    <div class="footer-links">
        <div class="x-logo">
            <Hexagon class="logo-icon" size="24" /> XBIO
        </div>
        <div class="link-col">
            <a href="#">Markets</a>
            <a href="#">Portfolio</a>
            <a href="#">Launchpad</a>
            <a href="#">Governance</a>
            <a href="#">Bridge</a>
            <a href="#">Auctions</a>
            <br>
            <a href="#">About Bio Protocol</a>
            <a href="#">About BIO Token</a>
            <a href="#">Key Docs</a>
            <a href="#">Bio Blog</a>
            <a href="#">Shop</a>
            <br>
            <a href="#">Discord Support</a>
            <a href="#">Email Support</a>
            <a href="#">Terms of Use</a>
        </div>
        <div class="socials">
             <!-- Placeholders for icons -->
        </div>
    </div>
  </div>
</template>

<style scoped>
.market-screen {
  background-color: var(--bg-color);
  min-height: 100vh;
  padding-bottom: 80px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px;
  position: sticky;
  top: 0;
  background: rgba(0,0,0,0.8);
  backdrop-filter: blur(10px);
  z-index: 50;
}

.logo {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--primary);
  font-weight: 700;
  font-size: 20px;
}

.header-actions {
  display: flex;
  align-items: center;
  gap: 12px;
}

.status-dot {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: 1px solid #333;
}
.status-dot.purple { background: #5D3FD3; }
.status-dot.green { background: #DFFF00; color: black; display: flex; align-items: center; justify-content: center; }

/* Sections */
.section {
  padding: 16px;
}

.section-header {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 12px;
  color: var(--primary);
  font-weight: 600;
  font-size: 14px;
}

/* Trending Cards */
.card-list {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}

.mini-card {
  background: var(--card-bg);
  padding: 12px;
  border-radius: 12px;
  border: 1px solid #222;
}

.card-top {
  display: flex;
  gap: 8px;
  margin-bottom: 8px;
}

.icon-circle {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #333;
}

.card-info {
  display: flex;
  flex-direction: column;
}

.card-name { font-size: 13px; font-weight: 600; }
.card-ticker { font-size: 11px; color: var(--text-muted); }

.card-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 13px;
}
.card-change { color: var(--positive-text); }
.card-change.down { color: var(--negative); }

/* Gainers */
.gainer-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.gainer-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: var(--card-bg);
  padding: 10px;
  border-radius: 8px;
}

.gainer-left { display: flex; gap: 10px; align-items: center; }
.gainer-info { display: flex; flex-direction: column; }
.gainer-name { font-weight: 600; font-size: 13px; }
.gainer-vol { font-size: 11px; color: var(--text-muted); }

.gainer-right { text-align: right; }
.gainer-change { color: var(--positive-text); display: block; font-size: 13px; }
.gainer-price { font-size: 11px; color: var(--text-muted); }

/* Asset List */
.filters {
  display: flex;
  gap: 10px;
  padding: 0 16px;
  margin-bottom: 12px;
}

.filter-btn {
  background: #222;
  border: none;
  color: white;
  padding: 8px 12px;
  border-radius: 20px;
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  cursor: pointer;
}

.search-bar {
  margin: 0 16px 16px 16px;
  background: #222;
  border-radius: 8px;
  display: flex;
  align-items: center;
  padding: 8px 12px;
}

.search-input {
  background: transparent;
  border: none;
  color: white;
  margin-left: 8px;
  width: 100%;
}
.search-input:focus { outline: none; }

.list-headers {
  display: flex;
  justify-content: space-between;
  padding: 0 16px;
  color: var(--text-muted);
  font-size: 11px;
  margin-bottom: 8px;
}

.asset-list {
  padding: 0 16px;
}

.asset-row {
  display: flex;
  align-items: center;
  padding: 12px 0;
  border-bottom: 1px solid #222;
}

.asset-rank {
  width: 24px;
  font-size: 12px;
  color: var(--text-muted);
}

.asset-main {
  flex: 1;
  display: flex;
  align-items: center;
  gap: 10px;
}

.asset-icon {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 12px;
  color: white;
}

.asset-info {
  display: flex;
  flex-direction: column;
}
.asset-name { font-weight: 500; font-size: 14px; }
.asset-ticker { font-size: 11px; color: var(--text-muted); }

.asset-price-col {
  text-align: right;
}
.asset-price { display: block; font-weight: 500; font-size: 14px; }
.asset-change { font-size: 11px; color: var(--positive-text); }
.asset-change.down { color: var(--negative); }


.footer-links {
    margin-top: 32px;
    padding: 32px 16px;
    background: #000;
}
.x-logo {
    display: flex;
    gap: 8px;
    color: var(--primary);
    margin-bottom: 24px;
    font-weight: bold;
}
.link-col {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.link-col a {
    color: #888;
    font-size: 12px;
}
</style>
