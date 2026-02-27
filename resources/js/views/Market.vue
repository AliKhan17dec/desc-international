<script setup>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { 
  Search, 
  ChevronDown,
  ArrowUpRight,
  TrendingUp,
  FlaskConical,
  Dna,
  Zap,
  ArrowRight,
  Filter,
  Globe,
  Database
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const trendingDeSci = [
  { name: 'Curetopia', id: '8', category: 'Rare Diseases', performance: '35.67%', change: '-0.23%', up: false },
  { name: 'HairDAO', id: '8', category: 'Hair Loss', performance: '37.94%', change: '+0.29%', up: true },
  { name: 'Quantum Biology DAO', id: '8', category: 'Quantum Biology', performance: '34.37%', change: '-0.29%', up: false },
  { name: 'PsyDAO', id: '8', category: 'Psychedelics', performance: '25.29%', change: '-0.07%', up: false },
];

const topGainers = [
  { name: 'AthenaDAO', id: '8', category: "Women's Health", marketCap: '752.74K', change: '+2.14%', up: true },
  { name: 'Quantum Biology DAO', id: '8', category: 'Quantum Biology', marketCap: '443.87K', change: '+1.37%', up: true },
  { name: 'CryoDAO', id: '8', category: 'Cryopreservation', marketCap: '434.64K', change: '+22%', up: true },
  { name: 'Cerebrum DAO', id: '8', category: 'Brain Longevity', marketCap: '1.07M', change: '+100%', up: true },
];

const assets = [
  { 
    rank: 1, name: 'HairDAO', category: 'Hair Loss', tags: ['DAO'], chains: ['eth', 'sol'], 
    mcap: '$11.33M', price: '$16.3', change: '-5.04%', volume: '$45.3K', up: false 
  },
  { 
    rank: 2, name: 'VitaDAO', category: 'Longevity', tags: ['DAO'], chains: ['eth', 'sol'], 
    mcap: '$5.44M', price: '$2.218', change: '+4.34%', volume: '$4,372', up: true 
  },
  { 
    rank: 3, name: 'VITA-FAST', category: 'Longevity', tags: ['IPT'], chains: ['eth'], 
    mcap: '$2.17M', price: '$2.174', change: '-0.6%', volume: '$122', up: false 
  },
  { 
    rank: 4, name: 'FACC', category: 'Biochem', tags: ['IPT'], chains: ['eth'], 
    mcap: '$1.34M', price: '$0.252', change: '0%', volume: '$0', up: true 
  },
  { 
    rank: 5, name: 'ValleyDAO', category: 'Synthetic Biology', tags: ['DAO'], chains: ['eth', 'sol', 'base'], 
    mcap: '$1.22M', price: '$0.11', change: '+1.34%', volume: '$9.2', up: true 
  },
];

const filterType = ref('All Types');
const filterTypes = ['All Types', 'Agent', 'DAO', 'IPT'];
const searchQuery = ref('');

const filteredAssets = computed(() => {
  if (!searchQuery.value) return assets;
  const q = searchQuery.value.toLowerCase();
  return assets.filter(a => 
    a.name.toLowerCase().includes(q) || 
    a.category.toLowerCase().includes(q)
  );
});

const navigateToAsset = (id) => {
    router.push(`/asset/${id || '8'}`);
};

const getSparklinePath = (data) => {
    // Simple mock sparkline
    return "M 0 15 L 20 10 L 40 18 L 60 5 L 80 12 L 100 8";
};
</script>

<template>
  <div class="market-page">
    <TopHeader />
    
    <main class="main-wrapper">
      <header class="page-header">
          <div class="header-left">
            <h1>DeSci Markets</h1>
            <p>Explore the frontier of decentralized biotechnology.</p>
          </div>
          <div class="header-right">
              <div class="global-stat">
                  <span class="lbl">Global MCap</span>
                  <span class="val">$142.8M <span class="up">+4.2%</span></span>
              </div>
              <div class="global-stat">
                  <span class="lbl">24h Volume</span>
                  <span class="val">$12.4M</span>
              </div>
          </div>
      </header>

      <!-- Stats Section -->
      <section class="top-stats">
        <div class="stats-card">
          <div class="card-title">
            <TrendingUp size="18" class="gold" />
            <span>Trending Insights</span>
          </div>
          <div class="card-list">
            <div v-for="item in trendingDeSci" :key="item.name" class="mini-row" @click="navigateToAsset(item.id)">
              <div class="row-left">
                <div class="row-ic"><FlaskConical size="14" /></div>
                <div class="row-names">
                  <span class="n">{{ item.name }}</span>
                  <span class="c">{{ item.category }}</span>
                </div>
              </div>
              <div class="row-right">
                <span class="p">{{ item.performance }}</span>
                <span class="ch" :class="{ up: item.up, down: !item.up }">{{ item.change }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="stats-card">
          <div class="card-title">
            <Zap size="18" class="gold" />
            <span>Breakout Potential</span>
          </div>
          <div class="card-list">
            <div v-for="item in topGainers" :key="item.name" class="mini-row" @click="navigateToAsset(item.id)">
              <div class="row-left">
                <div class="row-ic"><Dna size="14" /></div>
                <div class="row-names">
                  <span class="n">{{ item.name }}</span>
                  <span class="c">{{ item.category }}</span>
                </div>
              </div>
              <div class="row-right">
                <span class="p">{{ item.marketCap }}</span>
                <span class="ch" :class="{ up: item.up, down: !item.up }">{{ item.change }}</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Controls Section -->
      <section class="controls-section">
        <div class="filters">
            <button 
                v-for="type in filterTypes" 
                :key="type"
                class="filter-pill"
                :class="{ active: filterType === type }"
                @click="filterType = type"
            >
                {{ type }}
            </button>
        </div>
        
        <div class="actions">
            <div class="search-input">
                <Search size="16" />
                <input type="text" placeholder="Search tokens..." v-model="searchQuery" />
            </div>
            <button class="action-btn"><Filter size="16" /></button>
            <button class="action-btn"><Globe size="16" /></button>
        </div>
      </section>

      <!-- Assets Table -->
      <div class="table-container">
        <table class="assets-table">
          <thead>
            <tr>
              <th class="hide-mobile">#</th>
              <th>Proprietary Asset</th>
              <th class="hide-tablet">Ecosystem</th>
              <th>Market Cap</th>
              <th>Valuation</th>
              <th class="hide-mobile">Growth (7D)</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="asset in filteredAssets" :key="asset.rank" @click="navigateToAsset(asset.rank)">
              <td class="rank-td hide-mobile">{{ asset.rank }}</td>
              <td>
                <div class="asset-cell">
                  <div class="asset-icon">
                    <Database v-if="asset.tags.includes('DAO')" size="16" />
                    <Zap v-else size="16" />
                  </div>
                  <div class="asset-info">
                    <div class="name-row">
                      <span class="name">{{ asset.name }}</span>
                      <span class="tag" :class="asset.tags[0].toLowerCase()">{{ asset.tags[0] }}</span>
                    </div>
                    <span class="category">{{ asset.category }}</span>
                  </div>
                </div>
              </td>
              <td class="hide-tablet">
                <div class="chain-dots">
                  <div v-for="chain in asset.chains" :key="chain" class="dot" :class="chain"></div>
                </div>
              </td>
              <td class="mcap-td">{{ asset.mcap }}</td>
              <td>
                <div class="price-stack">
                  <span class="price">{{ asset.price }}</span>
                  <span class="change" :class="{ up: asset.up, down: !asset.up }">{{ asset.change }}</span>
                </div>
              </td>
              <td class="hide-mobile">
                <div class="spark-box">
                    <svg width="80" height="20" viewBox="0 0 100 30">
                        <path :d="getSparklinePath()" fill="none" :stroke="asset.up ? '#dfff00' : '#FF00D6'" stroke-width="2" />
                    </svg>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="brand">
               <FlaskConical size="20" class="gold" />
               <span>DeSci Markets</span>
            </div>
            <div class="links">
                <a href="#">Audit Logs</a>
                <a href="#">Research Ethics</a>
                <a href="#">Protocol Specs</a>
            </div>
        </div>
    </footer>
  </div>
</template>

<style scoped>
.market-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'Inter', sans-serif;
}

.main-wrapper {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 20px;
}

.up { color: #dfff00 !important; }
.down { color: #FF00D6 !important; }
.gold { color: #dfff00; }

/* Header */
.page-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; }
.header-left h1 { font-size: 32px; font-weight: 800; margin-bottom: 8px; }
.header-left p { color: #666; }
.header-right { display: flex; gap: 40px; }
.global-stat { display: flex; flex-direction: column; }
.lbl { font-size: 11px; text-transform: uppercase; color: #444; letter-spacing: 1px; margin-bottom: 4px; }
.val { font-size: 16px; font-weight: 700; }

/* Stats Grid */
.top-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 40px; }
.stats-card { background: #111; border: 1px solid #222; border-radius: 16px; padding: 20px; }
.card-title { display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 700; margin-bottom: 20px; }

.card-list { display: flex; flex-direction: column; gap: 12px; }
.mini-row { display: flex; justify-content: space-between; align-items: center; padding: 6px; border-radius: 8px; cursor: pointer; }
.mini-row:hover { background: #1a1a1a; }
.row-left { display: flex; align-items: center; gap: 12px; }
.row-ic { width: 32px; height: 32px; background: #0a0a0a; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #dfff00; }
.row-names { display: flex; flex-direction: column; }
.n { font-size: 13px; font-weight: 700; }
.c { font-size: 10px; color: #444; }
.row-right { text-align: right; }
.p { font-size: 13px; font-weight: 700; }
.ch { font-size: 10px; }

/* Controls */
.controls-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
.filters { display: flex; gap: 8px; }
.filter-pill { background: transparent; border: 1px solid #222; color: #666; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; cursor: pointer; }
.filter-pill.active { background: #fff; border-color: #fff; color: #000; }

.actions { display: flex; gap: 10px; }
.search-input { background: #111; border: 1px solid #222; border-radius: 8px; padding: 0 12px; display: flex; align-items: center; gap: 8px; }
.search-input input { background: transparent; border: none; color: #fff; outline: none; font-size: 13px; height: 36px; width: 180px; }
.action-btn { width: 36px; height: 36px; background: #111; border: 1px solid #222; border-radius: 8px; color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; }

/* Table */
.table-container { background: #111; border: 1px solid #222; border-radius: 16px; overflow: hidden; }
.assets-table { width: 100%; border-collapse: collapse; }
.assets-table th { text-align: left; padding: 16px 20px; font-size: 11px; text-transform: uppercase; color: #444; border-bottom: 1px solid #222; }
.assets-table tr { cursor: pointer; }
.assets-table tr:hover { background: #161616; }
.assets-table td { padding: 16px 20px; border-bottom: 1px solid #1a1a1a; font-size: 14px; }

.rank-td { color: #333; font-weight: 800; }
.asset-cell { display: flex; align-items: center; gap: 12px; }
.asset-icon { width: 36px; height: 36px; background: #0d0d0d; border-radius: 10px; border: 1px solid #222; display: flex; align-items: center; justify-content: center; color: #dfff00; }
.name-row { display: flex; align-items: center; gap: 8px; }
.name { font-weight: 700; }
.tag { font-size: 9px; font-weight: 800; padding: 2px 4px; border-radius: 3px; }
.dao { background: rgba(223, 255, 0, 0.1); color: #dfff00; }
.category { font-size: 11px; color: #444; }

.chain-dots { display: flex; gap: 4px; }
.dot { width: 6px; height: 6px; border-radius: 50%; }
.eth { background: #627eea; }
.sol { background: #14f195; }

.price-stack { display: flex; flex-direction: column; }
.price { font-weight: 700; }
.change { font-size: 11px; }

/* Footer */
.footer { padding: 40px 20px; border-top: 1px solid #111; margin-top: 60px; }
.footer-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
.brand { display: flex; align-items: center; gap: 10px; font-weight: 700; }
.links { display: flex; gap: 20px; font-size: 13px; color: #444; }
.links a { text-decoration: none; color: inherit; }

@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; gap: 20px; }
    .top-stats { grid-template-columns: 1fr; }
    .controls-section { flex-direction: column; gap: 20px; align-items: stretch; }
    .actions { justify-content: space-between; }
    .search-input { flex: 1; }
    .hide-tablet, .hide-mobile { display: none; }
}
</style>
