<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { useRouter } from 'vue-router';
import { 
  Info, 
  ChevronRight,
  TrendingUp,
  LineChart,
  HelpCircle,
  LayoutGrid,
  Zap,
  ArrowRight,
  ChevronDown,
  Settings2,
  Wallet,
  Activity,
  RotateCcw,
  ArrowUpRight,
  Search,
  X,
  Bell,
  MoreHorizontal,
  ChevronLeft,
  ArrowUp,
  ArrowDown,
  Moon,
  Maximize2,
  Clock,
  Download,
  BookOpen,
  Layout
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';


const router = useRouter();

// State for live updates
const btcPrice = ref(67784.0);
const btcChange = ref(-1.56);
const spotPrice = ref(67814.39);
const spotChange = ref(-1.56);
const spreadRate = ref(-0.05480);
const countdown = ref("04:25:15");

// Active Tabs
const activeMainTab = ref('Chart');
const activeBottomTab = ref('Running');
const investmentAmount = ref('250.00');

const marketSearch = ref('');
const activeMarketSubTab = ref('USDⓈ-M');
const marketFilter = ref('All');
const isMarketOpen = ref(true);
const isConfigOpen = ref(true);
const marketPairs = ref([
  { coin: 'BTC', name: 'BTCUSDT', name2: 'BTC/USDT', funding: '0.00195%', apr: '0.23%', color: '#f7931a' },
  { coin: 'ETH', name: 'ETHUSDT', name2: 'ETH/USDT', funding: '-0.01823%', apr: '2.21%', color: '#627eea' },
  { coin: 'BCH', name: 'BCHUSDT', name2: 'BCH/USDT', funding: '0.01782%', apr: '2.16%', color: '#8dc351' },
  { coin: 'XRP', name: 'XRPUSDT', name2: 'XRP/USDT', funding: '-0.10242%', apr: '12.46%', color: '#23292f' },
  { coin: 'LTC', name: 'LTCUSDT', name2: 'LTC/USDT', funding: '0.03805%', apr: '4.62%', color: '#345d9d' },
  { coin: 'TRX', name: 'TRXUSDT', name2: 'TRX/USDT', funding: '-0.03020%', apr: '3.40%', color: '#ef0027' },
  { coin: 'ETC', name: 'ETCUSDT', name2: 'ETC/USDT', funding: '0.00289%', apr: '0.35%', color: '#328332' },
  { coin: 'LINK', name: 'LINKUSDT', name2: 'LINK/USDT', funding: '0.02599%', apr: '3.16%', color: '#2a5ada' },
  { coin: 'XLM', name: 'XLMUSDT', name2: 'XLM/USDT', funding: '-0.06450%', apr: '7.84%', color: '#000000' },
  { coin: 'ADA', name: 'ADAUSDT', name2: 'ADA/USDT', funding: '-0.00275%', apr: '0.33%', color: '#0033ad' },
  { coin: 'DASH', name: 'DASHUSDT', name2: 'DASH/USDT', funding: '-0.13757%', apr: '16.73%', color: '#008de4' },
]);

const filteredMarketPairs = computed(() => {
  let filtered = marketPairs.value;
  
  // Apply Search
  if (marketSearch.value) {
    const q = marketSearch.value.toLowerCase();
    filtered = filtered.filter(p => 
      p.coin.toLowerCase().includes(q) || 
      p.name.toLowerCase().includes(q)
    );
  }

  // Apply Pill Filter
  if (marketFilter.value === 'Positive Carry') {
    filtered = filtered.filter(p => !p.funding.startsWith('-'));
  } else if (marketFilter.value === 'Reverse Carry') {
    filtered = filtered.filter(p => p.funding.startsWith('-'));
  }
  
  return filtered;
});

const toggleMarket = () => { isMarketOpen.value = !isMarketOpen.value; };
const toggleConfig = () => { isConfigOpen.value = !isConfigOpen.value; };


// Hover Tracking
const hover1 = ref({ active: false, x: 0, price: 0 });
const hover2 = ref({ active: false, x: 0, price: 0 });

const handleHover = (e, index) => {
    const rect = e.currentTarget.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const factor = x / rect.width;
    const currentPrice = index === 1 ? btcPrice.value : spotPrice.value;
    
    if (index === 1) {
        hover1.value = { active: true, x, price: (currentPrice + (factor - 0.5) * 500).toFixed(1) };
    } else {
        hover2.value = { active: true, x, price: (currentPrice + (factor - 0.5) * 500).toFixed(1) };
    }
};

const clearHover = (index) => {
    if (index === 1) hover1.value.active = false;
    else hover2.value.active = false;
};

// Mock Data for Bar Charts (Candles)
const generateMockBars = (count) => {
    return Array.from({ length: count }, (_, i) => ({
        h: 40 + Math.random() * 60,
        y: 80 + Math.random() * 40,
        type: Math.random() > 0.4 ? 'up' : 'down'
    }));
};

const bars1 = ref(generateMockBars(25));
const bars2 = ref(generateMockBars(25));

// Simulation of live updates
let intervalId;
onMounted(() => {
    intervalId = setInterval(() => {
        btcPrice.value += (Math.random() - 0.5) * 2;
        spotPrice.value += (Math.random() - 0.5) * 2;
        
        // Update countdown
        let parts = countdown.value.split(':').map(Number);
        if (parts[2] > 0) parts[2]--;
        else if (parts[1] > 0) { parts[1]--; parts[2] = 59; }
        else if (parts[0] > 0) { parts[0]--; parts[1] = 59; parts[2] = 59; }
        countdown.value = parts.map(p => p.toString().padStart(2, '0')).join(':');

        // Shift bars occasionally
        if (Math.random() > 0.7) {
            bars1.value.shift();
            bars1.value.push({ h: 40 + Math.random() * 60, y: 80 + Math.random() * 40, type: Math.random() > 0.5 ? 'up' : 'down' });
            bars2.value.shift();
            bars2.value.push({ h: 40 + Math.random() * 60, y: 80 + Math.random() * 40, type: Math.random() > 0.5 ? 'up' : 'down' });
        }
    }, 2000);
});

onUnmounted(() => {
    if (intervalId) clearInterval(intervalId);
});

const goBack = () => router.back();
</script>

<template>
  <div class="arbitrage-page">
    <TopHeader />



    <!-- Ticker Section -->
    <div class="ticker-section">
      <div class="ticker-content">
        <div class="active-pair" @click="toggleMarket">
          <div class="pair-labels">
            <div class="p-row">
              <span class="b s">S</span> <span class="p-name">BTCUSDT</span> <span class="p-tag">Perp</span> <ChevronDown size="14" class="p-arrow" :class="{rotated: isMarketOpen}" />
            </div>
            <div class="p-row">
              <span class="b b">B</span> <span class="p-name dim">BTC/USDT</span>
            </div>
          </div>
        </div>

        <div class="ticker-controls">
          <Layout size="18" class="h-icon" :class="{active: isMarketOpen}" @click="toggleMarket" title="Toggle Market Sidebar" />
          <Settings2 size="18" class="h-icon" :class="{active: isConfigOpen}" @click="toggleConfig" title="Toggle Config Sidebar" />
        </div>



        <div class="ticker-stats">
          <div class="stat-item">
            <span class="stat-label">Spread Rate</span>
            <span class="stat-value neg">{{ spreadRate.toFixed(5) }}%</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">3d Funding APR</span>
            <span class="stat-value">0.00195% / <span class="green">0.23%</span></span>
          </div>
          <div class="stat-item">
            <span class="stat-label">7d Funding APR</span>
            <span class="stat-value neg">-0.00491% / <span class="green">0.25%</span></span>
          </div>
          <div class="stat-item">
            <span class="stat-label">30d Funding APR</span>
            <span class="stat-value">0.12452% / <span class="green">1.51%</span></span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Next Funding</span>
            <span class="stat-value green">0.00335%</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Countdown</span>
            <span class="stat-value">{{ countdown }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Workspace Grid -->
    <div class="workspace-grid" :class="{ 
      'market-hidden': !isMarketOpen,
      'config-hidden': !isConfigOpen
    }">
      
      <!-- Market Sidebar -->
      <aside class="market-sidebar" :class="{ 'is-closed': !isMarketOpen }">
        <div class="s-close-btn left-btn" v-if="isMarketOpen" @click="toggleMarket" title="Close Market">
          <ChevronLeft size="14" />
        </div>
        <div class="s-open-handle left-handle" v-else @click="toggleMarket" title="Open Market">
          <ChevronRight size="14" />
        </div>

        <div class="m-search-box">

          <Search size="14" class="dim" />
          <input type="text" placeholder="Search" v-model="marketSearch" />
        </div>
        
        <div class="m-tabs-wrap">
          <div class="m-main-tabs" @click="toggleMarket" style="cursor: pointer;">
            <span :class="{active: activeMarketSubTab === 'USDⓈ-M'}" @click.stop="activeMarketSubTab = 'USDⓈ-M'">USDⓈ-M</span>
            <span :class="{active: activeMarketSubTab === 'COIN-M'}" @click.stop="activeMarketSubTab = 'COIN-M'">COIN-M</span>
          </div>

          <div class="m-side-ctrls">
            <span class="dim">3D <ChevronDown size="10" /></span>
          </div>
        </div>

        <div class="m-filters">
          <span class="f-pill" :class="{active: marketFilter === 'All'}" @click="marketFilter = 'All'">All</span>
          <span class="f-pill" :class="{active: marketFilter === 'Positive Carry'}" @click="marketFilter = 'Positive Carry'">Positive Carry</span>
          <span class="f-pill" :class="{active: marketFilter === 'Reverse Carry'}" @click="marketFilter = 'Reverse Carry'">Reverse Carry</span>
        </div>


        <div class="m-list-header">
          <span class="h-col">Portfolio <ChevronDown size="10" /></span>
          <span class="h-col right">3D Funding% / APR <ChevronDown size="10" /></span>
        </div>

        <div class="m-list-scroll">
          <div v-for="item in filteredMarketPairs" :key="item.coin" class="m-item">
            <div class="m-item-left">
              <div class="m-coin-logo" :style="{backgroundColor: item.color}">{{ item.coin[0] }}</div>
              <div class="m-pair-detail">
                <div class="p-row">
                  <span class="b s">S</span> <span class="n">{{ item.name }}</span> <span class="tag">Perp</span>
                </div>
                <div class="p-row">
                   <span class="b b">B</span> <span class="n dim">{{ item.name2 }}</span>
                </div>
              </div>
            </div>
            <div class="m-item-right">
              <div class="f-val">{{ item.funding }}</div>
              <div class="a-val green">{{ item.apr }}</div>
            </div>
          </div>
        </div>
      </aside>

      <!-- Main Content Area -->
      <main class="main-content">
        <div class="content-header">
          <div class="c-tabs">
            <button :class="{active: activeMainTab==='Chart'}" @click="activeMainTab='Chart'">Chart</button>
            <button :class="{active: activeMainTab==='History'}" @click="activeMainTab='History'">Funding Rate History</button>
          </div>
        </div>

        <div class="charts-container" v-if="activeMainTab === 'Chart'">
          <div class="chart-wrapper">
            <div class="cw-head">
              <span class="cw-title">BTCUSDT <span class="tag">Perp</span> <span class="green">67,784.0</span> <span class="neg">-1.56%</span></span>
              <div class="cw-timeframes">
                <span>15m</span><span>1H</span><span>4H</span><span class="active">1D</span><span>1W</span>
              </div>
            </div>
            <div class="cw-body" @mousemove="handleHover($event, 1)" @mouseleave="clearHover(1)">
              <div class="chart-placeholder">
                <svg width="100%" height="100%" viewBox="0 0 500 300" preserveAspectRatio="none">
                  <line v-for="i in 8" :key="'v'+i" :x1="i*62.5" y1="0" :x2="i*62.5" y2="300" stroke="#1e2329" stroke-width="1"/>
                  <line v-for="j in 5" :key="'h'+j" x1="0" :y1="j*60" x2="500" :y2="j*60" stroke="#1e2329" stroke-width="1"/>
                  <rect v-for="(bar, i) in bars1" :key="i"
                        :x="i*20" :y="bar.y" width="10" :height="bar.h" 
                        :fill="bar.type === 'up' ? '#dfff00' : '#FF00D6'" 
                        opacity="0.8" />
                </svg>
                <div v-if="hover1.active" class="chart-crosshair" :style="{ left: hover1.x + 'px' }"></div>
                <div class="price-indicator">{{ btcPrice.toFixed(1) }}</div>
              </div>
              <div class="volume-placeholder">
                <svg width="100%" height="100%" viewBox="0 0 500 60" preserveAspectRatio="none">
                  <rect v-for="(bar, i) in bars1" :key="'vol'+i"
                        :x="i*20" :y="60 - (bar.h/2)" width="10" :height="bar.h/2" 
                        :fill="bar.type === 'up' ? '#dfff00' : '#FF00D6'" 
                        opacity="0.3" />
                </svg>
              </div>
            </div>
          </div>

          <div class="chart-wrapper border-left">
            <div class="cw-head">
              <span class="cw-title">BTC/USDT <span class="green">67,814.39</span> <span class="neg">-1.56%</span></span>
            </div>
            <div class="cw-body" @mousemove="handleHover($event, 2)" @mouseleave="clearHover(2)">
              <div class="chart-placeholder">
                <svg width="100%" height="100%" viewBox="0 0 500 300" preserveAspectRatio="none">
                  <line v-for="i in 8" :key="'v2'+i" :x1="i*62.5" y1="0" :x2="i*62.5" y2="300" stroke="#1e2329" stroke-width="1"/>
                  <line v-for="j in 5" :key="'h2'+j" x1="0" :y1="j*60" x2="500" :y2="j*60" stroke="#1e2329" stroke-width="1"/>
                  <rect v-for="(bar, i) in bars2" :key="i"
                        :x="i*20" :y="bar.y" width="10" :height="bar.h" 
                        :fill="bar.type === 'up' ? '#dfff00' : '#FF00D6'" 
                        opacity="0.8" />
                </svg>
                <div v-if="hover2.active" class="chart-crosshair" :style="{ left: hover2.x + 'px' }"></div>
                <div class="price-indicator pink">{{ spotPrice.toFixed(1) }}</div>
              </div>
              <div class="volume-placeholder">
                <svg width="100%" height="100%" viewBox="0 0 500 60" preserveAspectRatio="none">
                  <rect v-for="(bar, i) in bars2" :key="'vol2'+i"
                        :x="i*20" :y="60 - (bar.h/2)" width="10" :height="bar.h/2" 
                        :fill="bar.type === 'up' ? '#dfff00' : '#FF00D6'" 
                        opacity="0.3" />
                </svg>
              </div>
            </div>
          </div>

        </div>

        <div class="bottom-panel">
          <div class="bp-tabs">
            <div class="tabs-left">
              <button class="active">Arbitrage Bot <ChevronDown size="12" /></button>
              <button>Running</button>
              <button>History</button>
              <button>PNL Analysis</button>
            </div>
            <div class="tabs-right">
              <span class="refresh-text"><RotateCcw size="12" /> Refresh Running list</span>
            </div>
          </div>
          <div class="bp-content">
            <div class="empty-state">
              <div class="login-prompt">
                Log In or <span class="yellow">Register now</span> to start trading.
              </div>
            </div>
          </div>
        </div>
      </main>

      <!-- Right Config Sidebar -->
      <aside class="config-sidebar" :class="{ 'is-closed': !isConfigOpen }">
        <div class="s-close-btn right-btn" v-if="isConfigOpen" @click="toggleConfig" title="Close Config">
          <ChevronRight size="14" />
        </div>
        <div class="s-open-handle right-handle" v-else @click="toggleConfig" title="Open Config">
          <ChevronLeft size="14" />
        </div>

        <div class="cs-header">
          <div class="cs-title-wrap">
            <span class="cs-title" @click="toggleConfig" style="cursor: pointer;">Arbitrage Bot</span>
          </div>
          <div class="cs-ctrls">
            <BookOpen size="16" class="dim clickable" />
            <Layout size="16" class="dim clickable" :class="{active: isMarketOpen}" @click="toggleMarket" />
          </div>
        </div>



        <div class="cs-section">
          <div class="s-head">1. Portfolio <Info size="14" class="dim" /></div>
          <div class="portfolio-card">
            <div class="pc-row">
              <div class="pc-pair"><span class="b s">S</span> <strong>BTCUSDT</strong> <span class="tag">Perp</span> <span class="lev">2x</span></div>
              <span class="pc-price green">67,784.0</span>
            </div>
            <div class="pc-row">
              <div class="pc-pair"><span class="b b">B</span> <strong>BTC/USDT</strong></div>
              <span class="pc-price green">67,814.39</span>
            </div>
          </div>

          <div class="apr-grid">
            <div class="apr-item">
              <span class="label">3d APR</span>
              <span class="val green">0.23%</span>
            </div>
            <div class="apr-item">
              <span class="label">7d APR</span>
              <span class="val green">0.25%</span>
            </div>
            <div class="apr-item">
              <span class="label">30d APR</span>
              <span class="val green">1.51%</span>
            </div>
          </div>

          <div class="funding-info">
            <div class="fi-row">
              <span class="label">Next Funding</span>
              <span class="val green">0.00335%</span>
            </div>
            <div class="fi-row">
              <span class="label">Recommended min holding period</span>
              <div class="val-box">
                <span class="white">121 days</span>
                <ChevronRight size="14" />
              </div>
            </div>
          </div>
        </div>

        <div class="cs-section">
          <div class="s-head">2. Investment <Info size="14" class="dim" /></div>
          
          <div class="investment-input">
            <input type="text" placeholder="≥250.00" v-model="investmentAmount" />
            <span class="currency">USDT</span>
          </div>

          <div class="investment-slider">
            <div class="slider-track">
              <div class="slider-fill" style="width: 25%"></div>
              <div class="slider-knob" style="left: 25%"></div>
              <div class="slider-dots">
                <span v-for="d in 5" :key="d" :class="{active: d===2}"></span>
              </div>
            </div>
          </div>

          <div class="avail-row">
            <span class="dim">Available <Info size="12" /></span>
            <span class="white">0.00 USDT <span class="yellow">+</span></span>
          </div>
          <div class="pos-size-row">
            <span class="dim">Est. Position Size</span>
            <span class="white">-</span>
          </div>
          <div class="fee-level-row">
            <span class="yellow">Fee level</span>
          </div>

          <div class="entry-spread-box">
            <div class="es-head">
              <label class="custom-check">
                <input type="checkbox" checked />
                <span class="checkmark"></span>
                Entry spread
              </label>
              <Info size="14" class="dim" />
            </div>
            <div class="es-input">
              <input type="text" value="-0.1" />
              <span class="perc">%</span>
            </div>
            <div class="es-current">
              Current Entry Spread <span class="white">-0.04%</span>
            </div>
          </div>

          <div class="warning-tip">
            <Info size="14" class="dim" />
            <p>The entry spread you set is lower than the current spread. A position will open immediately after placing the order.</p>
          </div>

          <button class="create-btn">Create</button>
        </div>
      </aside>
    </div>

    <!-- Footer Status -->
    <footer class="binance-footer">
      <div class="f-left">
        <span class="status-item green"><Activity size="12" /> Stable connection</span>
      </div>
      <div class="f-middle">
        <div class="ticker-wrap">
          <span class="tk-item">IUDOT <span class="green">+14.94%</span> <span class="dim">0.053</span></span>
          <span class="tk-item">XRPUSDT <span class="neg">-1.93%</span> <span class="dim">1.4556</span></span>
          <span class="tk-item">PROM <span class="neg">-1.92%</span> <span class="dim">1.404</span></span>
          <span class="tk-item">BTC <span class="neg">-1.55%</span> <span class="dim">67784.0</span></span>
        </div>
      </div>
      <div class="f-right">
        <span>Announcements</span>
        <span>Futures Chatroom</span>
        <span>Cookie Preference</span>
      </div>
    </footer>
  </div>
</template>

<style scoped>
.arbitrage-page {
    background: #000;
    min-height: 100vh;
    color: #eaecef;
    font-family: "BinancePlex", "Inter", sans-serif;
    display: flex;
    flex-direction: column;
}

/* Colors */
.green { color: #dfff00 !important; }
.neg { color: #FF00D6 !important; }
.yellow { color: #dfff00 !important; }
.dim { color: #848e9c; }
.white { color: #eaecef; }


/* Binance Header */
.binance-header {
  height: 64px;
  background: #181a20;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 16px;
  border-bottom: 1px solid #2b3139;
}
.header-left { display: flex; align-items: center; gap: 24px; }
.logo-wrap { display: flex; align-items: center; gap: 8px; cursor: pointer; }
.mini-logo { width: 24px; height: 24px; }
.binance-logo-text { font-size: 18px; font-weight: 800; color: #fcd535; }
.main-nav { display: flex; gap: 16px; }
.nav-item { font-size: 14px; color: #eaecef; cursor: pointer; display: flex; align-items: center; gap: 4px; }
.nav-item:hover { color: #fcd535; }

.header-right { display: flex; align-items: center; gap: 16px; }
.deposit-btn { background: #dfff00; color: #181a20; border: none; padding: 6px 16px; border-radius: 4px; font-weight: 700; font-size: 14px; cursor: pointer; }

/* Ticker Section */

.ticker-section {
  background: #181a20;
  border-bottom: 1px solid #2b3139;
  height: 56px;
  display: flex;
  align-items: center;
  padding: 0 16px;
}
.ticker-content { display: flex; align-items: center; gap: 24px; }
.ticker-controls { display: flex; gap: 12px; border-right: 1px solid #2b3139; padding-right: 24px; }
.active-pair { cursor: pointer; padding: 4px; border-radius: 4px; }

.active-pair:hover { background: #2b3139; }
.pair-labels { display: flex; flex-direction: column; }
.p-row { display: flex; align-items: center; gap: 4px; line-height: 1; }
.b { font-size: 8px; font-weight: 800; padding: 1px 3px; border-radius: 2px; }
.b.s { background: rgba(255, 0, 214, 0.1); color: #FF00D6; }
.b.b { background: rgba(223, 255, 0, 0.1); color: #dfff00; }
.p-name { font-size: 14px; font-weight: 700; }
.p-tag { font-size: 10px; background: #2b3139; padding: 1px 4px; border-radius: 2px; color: #848e9c; }
.p-arrow { color: #848e9c; }

.ticker-stats { display: flex; gap: 24px; }
.stat-item { display: flex; flex-direction: column; }
.stat-label { font-size: 11px; color: #848e9c; }
.stat-value { font-size: 12px; font-weight: 700; white-space: nowrap; }

/* Workspace Grid Toggles */
.workspace-grid {
  flex: 1;
  display: grid;
  grid-template-columns: 320px 1fr 340px;
  max-width: 100vw;
  overflow: hidden;
  transition: grid-template-columns 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.workspace-grid.market-hidden {
  grid-template-columns: 0px 1fr 340px;
}
.workspace-grid.config-hidden {
  grid-template-columns: 320px 1fr 0px;
}
.workspace-grid.market-hidden.config-hidden {
  grid-template-columns: 0px 1fr 0px;
}

/* Sidebar hidden transition helpers */
.h-icon { transition: color 0.2s; cursor: pointer; }
.h-icon.active { color: #dfff00 !important; }
.p-arrow { transition: transform 0.3s ease; }
.p-arrow.rotated { transform: rotate(180deg); }

.market-sidebar, .config-sidebar {

  background: #181a20;
  display: flex;
  flex-direction: column;
  position: relative;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
}
.market-sidebar { border-right: 1px solid #2b3139; padding: 12px; }
.config-sidebar { border-left: 1px solid #2b3139; padding: 16px; }

.market-sidebar.is-closed { padding: 0; border-right: none; }
.config-sidebar.is-closed { padding: 0; border-left: none; }

.s-close-btn, .s-open-handle {
  position: absolute;
  background: #181a20;
  border: 1px solid #2b3139;
  border-radius: 50%;
  width: 22px;
  height: 22px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 100;
  color: #848e9c;
  top: 12px;
}
.s-close-btn:hover, .s-open-handle:hover { color: #dfff00; border-color: #dfff00; }

.left-btn { right: -11px; }
.right-btn { left: -11px; }

.left-handle { left: 4px; top: 50%; transform: translateY(-50%); }
.right-handle { right: 4px; top: 50%; transform: translateY(-50%); }

.is-closed > *:not(.s-open-handle) {
  visibility: hidden;
  opacity: 0;
}


.m-search-box { background: #2b3139; border-radius: 4px; display: flex; align-items: center; padding: 6px 10px; gap: 8px; margin-bottom: 12px; }
.m-search-box input { background: transparent; border: none; outline: none; color: #eaecef; font-size: 13px; flex: 1; }

.m-tabs-wrap { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
.m-main-tabs { display: flex; gap: 16px; }
.m-main-tabs span { font-size: 13px; font-weight: 700; color: #848e9c; cursor: pointer; }
.m-main-tabs span.active { color: #eaecef; position: relative; }
.m-main-tabs span.active::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 100%; height: 2px; background: #dfff00; }

.m-filters { display: flex; gap: 8px; margin-bottom: 12px; overflow-x: auto; }
.f-pill { font-size: 11px; background: #2b3139; padding: 2px 8px; border-radius: 4px; color: #848e9c; cursor: pointer; white-space: nowrap; }
.f-pill.active { background: #474d57; color: #eaecef; }

.m-list-header { display: flex; justify-content: space-between; font-size: 10px; color: #848e9c; text-transform: uppercase; margin-bottom: 8px; }
.m-item { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid #2b3139; cursor: pointer; }
.m-item:hover { background: rgba(255,255,255,0.02); }
.m-item-left { display: flex; align-items: center; gap: 10px; }
.m-coin-logo { width: 20px; height: 20px; border-radius: 50%; font-size: 10px; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #fff; }
.m-pair-detail { display: flex; flex-direction: column; gap: 2px; }
.m-pair-detail .n { font-size: 12px; font-weight: 700; }
.m-pair-detail .tag { font-size: 9px; color: #848e9c; }
.m-item-right { text-align: right; }
.m-item-right .f-val { font-size: 11px; }
.m-item-right .a-val { font-size: 12px; font-weight: 700; }
.m-list-scroll { flex: 1; overflow-y: auto; }

/* Main Content Area */
.main-content {
  display: flex;
  flex-direction: column;
  background: #0b0e11;
}
.content-header { background: #181a20; height: 40px; display: flex; align-items: center; padding: 0 16px; border-bottom: 1px solid #2b3139; }
.c-tabs { display: flex; gap: 24px; }
.c-tabs button { background: transparent; border: none; color: #848e9c; font-size: 13px; font-weight: 700; cursor: pointer; height: 40px; }
.c-tabs button.active { color: #eaecef; border-bottom: 2px solid #dfff00; }

.charts-container { flex: 1; display: grid; grid-template-columns: 1fr 1fr; }
.chart-wrapper { display: flex; flex-direction: column; border-right: 1px solid #2b3139; }
.chart-wrapper.border-left { border-left: 1px solid #2b3139; }
.cw-head { padding: 8px 12px; display: flex; justify-content: space-between; align-items: center; }
.cw-title { font-size: 12px; font-weight: 700; }
.cw-timeframes { display: flex; gap: 10px; font-size: 11px; color: #848e9c; }
.cw-timeframes span { cursor: pointer; }
.cw-timeframes span.active { color: #dfff00; }
.cw-body { flex: 1; display: flex; flex-direction: column; position: relative; }
.chart-placeholder { flex: 1; position: relative; }
.chart-crosshair { position: absolute; top: 0; bottom: 0; width: 1px; border-left: 1px dashed rgba(255,255,255,0.2); }
.price-indicator { position: absolute; right: 0; top: 50%; background: #dfff00; color: #000; font-size: 10px; font-weight: 800; padding: 2px 4px; border-radius: 2px; }
.price-indicator.pink { background: #FF00D6; color: #fff; }
.volume-placeholder { height: 60px; }


/* Bottom Panel */
.bottom-panel { background: #181a20; border-top: 1px solid #2b3139; height: 260px; display: flex; flex-direction: column; }
.bp-tabs { height: 40px; border-bottom: 1px solid #2b3139; display: flex; justify-content: space-between; align-items: center; padding: 0 16px; }
.tabs-left { display: flex; gap: 24px; }
.tabs-left button { background: transparent; border: none; color: #848e9c; font-size: 13px; font-weight: 700; cursor: pointer; }
.tabs-left button.active { color: #eaecef; }
.refresh-text { font-size: 11px; color: #848e9c; display: flex; align-items: center; gap: 6px; cursor: pointer; }
.bp-content { flex: 1; display: flex; align-items: center; justify-content: center; }
.login-prompt { background: #2b3139; padding: 8px 24px; border-radius: 4px; font-size: 13px; color: #848e9c; }

/* Config Sidebar */
.config-sidebar {
  background: #181a20;
  border-left: 1px solid #2b3139;
  display: flex;
  flex-direction: column;
  padding: 16px;
  overflow-y: auto;
}
.cs-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.cs-title-wrap { display: flex; align-items: center; gap: 12px; }
.cs-title { font-size: 16px; font-weight: 700; }
.cs-ctrls { display: flex; gap: 12px; }

.cs-section { margin-bottom: 24px; }
.s-head { font-size: 13px; font-weight: 700; margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }

.portfolio-card { background: #0b0e11; padding: 12px; border-radius: 8px; margin-bottom: 16px; }
.pc-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
.pc-row:last-child { margin-bottom: 0; }
.pc-pair { display: flex; align-items: center; gap: 6px; font-size: 12px; }
.pc-pair .tag { font-size: 9px; color: #848e9c; background: #2b3139; padding: 1px 3px; border-radius: 2px; }
.pc-pair .lev { font-size: 11px; color: #848e9c; }
.pc-price { font-size: 14px; font-weight: 700; }

.apr-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px; margin-bottom: 16px; }
.apr-item { display: flex; flex-direction: column; background: rgba(14,203,129,0.05); padding: 8px; border-radius: 4px; border: 1px solid rgba(14,203,129,0.1); }
.apr-item .label { font-size: 10px; color: #848e9c; }
.apr-item .val { font-size: 13px; font-weight: 700; }

.funding-info { display: flex; flex-direction: column; gap: 8px; }
.fi-row { display: flex; justify-content: space-between; align-items: center; }
.fi-row .label { font-size: 11px; color: #848e9c; }
.fi-row .val-box { display: flex; align-items: center; gap: 4px; font-size: 11px; color: #848e9c; }

.investment-input { background: #2b3139; border: 1px solid transparent; border-radius: 4px; display: flex; align-items: center; padding: 8px 12px; margin-bottom: 12px; }
.investment-input:focus-within { border-color: #fcd535; }
.investment-input input { background: transparent; border: none; outline: none; color: #eaecef; font-size: 16px; font-weight: 700; flex: 1; }
.investment-input .currency { font-size: 12px; font-weight: 700; }

.investment-slider { position: relative; height: 24px; display: flex; align-items: center; margin-bottom: 12px; }
.slider-track { height: 2px; background: #2b3139; width: 100%; position: relative; }
.slider-fill { height: 100%; background: #dfff00; }
.slider-knob { width: 12px; height: 12px; background: #fff; border: 2px solid #dfff00; border-radius: 50%; position: absolute; top: -5px; transform: translateX(-50%); }
.slider-dots { display: flex; justify-content: space-between; position: absolute; width: 100%; top: -3px; }
.slider-dots span { width: 8px; height: 8px; background: #181a20; border: 2px solid #2b3139; border-radius: 50%; }
.slider-dots span.active { border-color: #dfff00; background: #dfff00; }

.avail-row, .pos-size-row { display: flex; justify-content: space-between; font-size: 11px; margin-bottom: 6px; }
.fee-level-row { font-size: 11px; margin-bottom: 16px; cursor: pointer; }

.entry-spread-box { border: 1px solid #2b3139; border-radius: 8px; padding: 12px; margin-bottom: 16px; }
.es-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
.custom-check { display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; cursor: pointer; }
.es-input { background: #2b3139; border-radius: 4px; display: flex; align-items: center; padding: 6px 10px; margin-bottom: 8px; }
.es-input input { background: transparent; border: none; outline: none; color: #eaecef; font-size: 14px; font-weight: 700; flex: 1; }
.es-input .perc { font-size: 12px; color: #848e9c; }
.es-current { font-size: 11px; color: #848e9c; }

.warning-tip { background: rgba(132,142,156,0.05); padding: 10px; border-radius: 4px; display: flex; gap: 8px; margin-bottom: 24px; border: 1px solid rgba(132,142,156,0.1); }
.warning-tip p { font-size: 11px; color: #848e9c; margin: 0; line-height: 1.4; }

.create-btn { width: 100%; height: 48px; background: #dfff00; color: #181a20; border: none; border-radius: 4px; font-weight: 700; font-size: 16px; cursor: pointer; transition: opacity 0.2s; }
.create-btn:hover { opacity: 0.9; }

/* Custom Checkbox */
.checkmark { width: 14px; height: 14px; background: transparent; border: 1px solid #848e9c; border-radius: 2px; position: relative; }
input[type="checkbox"]:checked + .checkmark { background: #dfff00; border-color: #dfff00; }
input[type="checkbox"]:checked + .checkmark::after { content: ''; position: absolute; left: 4px; top: 1px; width: 4px; height: 8px; border: solid #181a20; border-width: 0 2px 2px 0; transform: rotate(45deg); }

input[type="checkbox"] { display: none; }

/* Footer */
.binance-footer { height: 32px; background: #181a20; border-top: 1px solid #2b3139; display: flex; justify-content: space-between; align-items: center; padding: 0 16px; font-size: 11px; color: #848e9c; }
.f-middle { flex: 1; overflow: hidden; margin: 0 32px; }
.ticker-wrap { display: flex; gap: 32px; animation: ticker-scroll 30s linear infinite; white-space: nowrap; }
.tk-item { display: flex; gap: 8px; }
.f-right { display: flex; gap: 16px; }

@keyframes ticker-scroll {
  from { transform: translateX(100%); }
  to { transform: translateX(-100%); }
}

/* Scrollbar Styling */
::-webkit-scrollbar { width: 4px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: #474d57; border-radius: 2px; }
::-webkit-scrollbar-thumb:hover { background: #848e9c; }

/* Desktop-only overrides for workspace */
@media (min-width: 1200px) {
  .market-sidebar { width: 320px; }
  .config-sidebar { width: 340px; }
}
</style>
