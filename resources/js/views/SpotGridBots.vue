<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  ChevronDown, 
  Settings2, 
  Info, 
  Plus, 
  ChevronRight,
  LayoutGrid,
  Zap,
  TrendingUp,
  BarChart3,
  Search,
  Maximize2,
  Filter,
  Users
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const activeTab = ref('Popular');
const periods = ['1s', '15m', '1H', '4H', '1D', '1W'];
const activePeriod = ref('1D');

const popularBots = [
    {
        pair: 'BTC/JPY',
        strategy: 'Trailing Up',
        copiers: 80,
        pnl: '+26,036.95',
        roi: '+0.61%',
        runtime: '4d 8h 13m',
        minInvestment: '8,051 JPY',
        matchedTrades: '22/52',
        mdd: '1.43%',
        isPositive: true
    },
    {
        pair: 'BTC/JPY',
        strategy: 'Grid',
        copiers: 144,
        pnl: '+15,098.39',
        roi: '+1.99%',
        runtime: '5d 14h 37m',
        minInvestment: '2,985 JPY',
        matchedTrades: '31/112',
        mdd: '1.41%',
        isPositive: true
    },
    {
        pair: 'BTC/JPY',
        strategy: 'Grid',
        copiers: 23,
        pnl: '+3,450.12',
        roi: '+0.45%',
        runtime: '2d 6h 11m',
        minInvestment: '5,100 JPY',
        matchedTrades: '12/45',
        mdd: '0.88%',
        isPositive: true
    }
];

const navigateToCreate = () => router.push('/spot-grid-create');

</script>

<template>
  <div class="spot-grid-screen">
    <TopHeader />
    
    <div class="desktop-container">
      <!-- Sub Nav -->
      <div class="sub-header-row">
        <div class="bot-type-selector">
            <span>Spot Grid</span>
            <ChevronDown size="16" class="dim" />
        </div>
      </div>

      <!-- Chart Section -->
      <div class="chart-section">
          <div class="chart-controls">
              <div class="period-selector">
                  <span v-for="p in periods" :key="p" :class="{active: activePeriod === p}">{{ p }}</span>
                  <ChevronDown size="14" class="dim" />
              </div>
              <div class="chart-actions">
                  <LayoutGrid size="18" class="dim" />
                  <BarChart3 size="18" class="dim" />
                  <Settings2 size="18" class="dim" />
                  <Maximize2 size="18" class="dim" />
              </div>
          </div>

          <div class="ohlc-header">
              <span class="date dim">2026/01/02</span>
              <span class="label dim">Open</span> <span class="val green">13,888,501</span>
              <span class="label dim">High</span> <span class="val green">14,170,829</span>
              <span class="label dim">Low</span> <span class="val green">13,802,800</span>
              <span class="label dim">Close</span> <span class="val green">14,092,957</span>
              <span class="label dim">CHANGE</span> <span class="val green">1.47%</span>
              <span class="label dim">Range</span> <span class="val green">2.61%</span>
          </div>

          <div class="pair-price-row">
              <div class="p-left">
                  <span class="p-name">BTC/JPY</span>
                  <span class="p-price">14,092,957</span>
                  <span class="p-change positive">+2.26%</span>
              </div>
              <div class="p-right">
                  <TrendingUp size="18" class="bot-ic" />
                  <BarChart3 size="18" class="chart-ic" />
              </div>
          </div>

          <div class="main-chart-area">
              <div class="price-labels">
                  <span>15,500,000</span>
                  <span>15,000,000</span>
                  <span>14,500,000</span>
                  <span class="current-price-label">14,092,957</span>
                  <span>13,500,000</span>
                  <span>13,000,000</span>
              </div>
              <div class="chart-viz">
                  <svg width="100%" height="200" viewBox="0 0 1000 200" preserveAspectRatio="none">
                      <path d="M0 150 L100 120 L200 140 L300 80 L400 110 L500 60 L600 90 L700 40 L800 70 L900 30 L1000 50" fill="none" stroke="#DFFF00" stroke-width="2" />
                      <path d="M0 160 L200 150 L400 155 L600 145 L800 150 L1000 148" fill="none" stroke="var(--primary)" stroke-width="1.5" />
                      <line x1="0" y1="180" x2="1000" y2="180" stroke="#2b3139" stroke-width="1" />
                  </svg>
                  <div class="vol-bars-row">
                      <div class="vol-label dim">Vol(BTC) <span class="white">266</span> Vol(JPY) <span class="blue">3.72B</span> <span class="red">173</span> <span class="purple">253</span></div>
                      <div class="vol-graph">
                          <svg width="100%" height="30" viewBox="0 0 1000 30" preserveAspectRatio="none">
                              <rect x="100" y="15" width="10" height="15" fill="#f6465d" opacity="0.5" />
                              <rect x="120" y="10" width="10" height="20" fill="#DFFF00" opacity="0.5" />
                              <rect x="140" y="20" width="10" height="10" fill="#f6465d" opacity="0.5" />
                          </svg>
                      </div>
                  </div>
              </div>
          </div>

          <div class="chart-footer-dates">
              <span>11/01</span>
              <span>12/01</span>
              <span>2026</span>
          </div>
      </div>

      <!-- Strategy Tabs -->
      <div class="strategy-tabs-row">
          <div class="s-tabs">
              <span :class="{active: activeTab === 'AI'}">AI</span>
              <span :class="{active: activeTab === 'Popular'}">Popular</span>
              <span :class="{active: activeTab === 'Manual'}">Manual</span>
          </div>
          <div class="s-filters">
              <div class="f-item">Top PNL <ChevronDown size="12" /></div>
              <div class="f-item">Pair <ChevronDown size="12" /></div>
              <Filter size="16" class="dim" />
          </div>
      </div>

      <!-- Bot List -->
      <div class="bot-list">
          <div v-for="(bot, idx) in popularBots" :key="idx" class="bot-card">
              <div class="card-top">
                  <div class="c-left">
                      <span class="c-pair">{{ bot.pair }}</span>
                      <div class="c-meta">
                          <span class="c-strat dim">{{ bot.strategy }}</span>
                          <span class="c-divider dim">|</span>
                          <Users size="12" class="dim" />
                          <span class="c-count dim">{{ bot.copiers }}</span>
                      </div>
                  </div>
                  <button class="copy-btn">Copy</button>
              </div>

              <div class="card-mid">
                  <div class="pnl-group">
                      <span class="pnl-label dim">PNL (USD)</span>
                      <span class="pnl-val" :class="bot.isPositive ? 'positive' : 'negative'">{{ bot.pnl }}</span>
                  </div>
                  <div class="mini-chart">
                      <svg width="80" height="30" viewBox="0 0 80 30" preserveAspectRatio="none">
                          <path 
                            d="M0 25 L10 20 L20 22 L30 15 L40 18 L50 10 L60 12 L70 5 L80 8" 
                            fill="none" 
                            :stroke="bot.isPositive ? '#DFFF00' : '#FF00D6'" 
                            stroke-width="1.5" 
                          />
                      </svg>
                  </div>
              </div>

              <div class="card-stats-grid">
                  <div class="cs-item">
                      <span class="cl dim">ROI</span>
                      <span class="cv white">{{ bot.roi }}</span>
                  </div>
                  <div class="cs-item">
                      <span class="cl dim">Runtime</span>
                      <span class="cv white">{{ bot.runtime }}</span>
                  </div>
                  <div class="cs-item">
                      <span class="cl dim">Min. Investment</span>
                      <span class="cv white">{{ bot.minInvestment }}</span>
                  </div>
                  <div class="cs-item">
                      <span class="cl dim">24H/Total Matched Trades</span>
                      <span class="cv white">{{ bot.matchedTrades }}</span>
                  </div>
                  <div class="cs-item right">
                      <span class="cl dim">7D MDD</span>
                      <span class="cv white">{{ bot.mdd }}</span>
                  </div>
              </div>
          </div>
      </div>

      <!-- Bottom Nav (Trading/Trade/All Orders) -->
      <div class="bottom-actions-nav">
          <div class="ba-item">
              <LayoutGrid size="20" class="dim" />
              <span>Trading Bots</span>
          </div>
          <div class="ba-item active">
              <div class="trade-ic-box">
                  <RotateCcw size="20" />
              </div>
              <span>Trade</span>
          </div>
          <div class="ba-item">
              <BarChart3 size="20" class="dim" />
              <span>All Orders</span>
          </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.spot-grid-screen {
    background: #000;
    min-height: 100vh;
    color: #fff;
    font-family: 'IBM Plex Sans', sans-serif;
    overflow-x: hidden;
}

.desktop-container {
    max-width: 1000px;
    margin: 0 auto;
    background: #181a20;
    min-height: 100vh;
}

/* Sub Header */
.sub-header-row {
    padding: 12px 20px;
}
.bot-type-selector {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

/* Chart Section */
.chart-section {
    padding: 0 20px 20px;
    border-bottom: 8px solid #0b0e11;
}
.chart-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}
.period-selector {
    display: flex;
    align-items: center;
    gap: 12px;
}
.period-selector span {
    font-size: 13px;
    color: #848e9c;
    cursor: pointer;
}
.period-selector span.active { color: #fff; font-weight: 600; }
.chart-actions {
    display: flex;
    align-items: center;
    gap: 16px;
}

.ohlc-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    margin-bottom: 12px;
    flex-wrap: wrap;
}
.dim { color: #fff; }
.green { color: #DFFF00; }
.white { color: #eaecef; }
.red { color: #f6465d; }
.blue { color: #3b82f6; }
.purple { color: #9b59b6; }

.pair-price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}
.p-left { display: flex; align-items: center; gap: 12px; }
.p-name { font-size: 18px; font-weight: 700; }
.p-price { font-size: 18px; font-weight: 700; }
.p-change { font-size: 14px; font-weight: 600; }
.positive { color: #DFFF00; }
.negative { color: #FF00D6; }

.p-right { display: flex; gap: 16px; color: #848e9c; }
.bot-ic { color: #3b82f6; }

.main-chart-area {
    display: flex;
    position: relative;
    height: 250px;
}
.price-labels {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    font-size: 11px;
    color: #474d57;
    text-align: right;
    width: 80px;
    z-index: 2;
}
.current-price-label {
    background: #DFFF00;
    color: #fff;
    padding: 2px 4px;
    border-radius: 2px;
}

.chart-viz { flex: 1; position: relative; }
.vol-bars-row {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
}
.vol-label { font-size: 10px; margin-bottom: 4px; }
.chart-footer-dates {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: #474d57;
    margin-top: 12px;
}

/* Strategy Tabs */
.strategy-tabs-row {
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.s-tabs { display: flex; gap: 24px; }
.s-tabs span {
    font-size: 14px;
    font-weight: 600;
    color: #848e9c;
    cursor: pointer;
    position: relative;
    padding-bottom: 8px;
}
.s-tabs span.active { color: #fff; }
.s-tabs span.active::after {
    content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 3px; background: var(--primary); border-radius: 2px;
}
.s-filters { display: flex; align-items: center; gap: 16px; font-size: 13px; color: #eaecef; }
.f-item { display: flex; align-items: center; gap: 4px; cursor: pointer; }

/* Bot Cards */
.bot-list {
    padding: 0 16px 100px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.bot-card {
    background: #1e2329;
    border-radius: 12px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    border: 1px solid transparent;
}
.bot-card:hover { border-color: var(--primary)55; }

.card-top { display: flex; justify-content: space-between; align-items: flex-start; }
.c-pair { font-size: 15px; font-weight: 700; color: #fff; }
.c-meta { display: flex; align-items: center; gap: 6px; margin-top: 4px; }
.c-strat { font-size: 12px; }
.c-count { font-size: 12px; }
.copy-btn {
    background: var(--primary);
    color: #000;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
}

.card-mid { display: flex; justify-content: space-between; align-items: flex-end; }
.pnl-group { display: flex; flex-direction: column; }
.pnl-label { font-size: 12px; margin-bottom: 4px; }
.pnl-val { font-size: 20px; font-weight: 800; }
.pnl-val.positive { color: #DFFF00; }
.pnl-val.negative { color: #FF00D6; }

.card-stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 12px;
}
.cs-item { display: flex; flex-direction: column; gap: 4px; }
.cs-item.right { text-align: right; }
.cl { font-size: 11px; }
.cv { font-size: 13px; font-weight: 600; }

/* Bottom Action Nav */
.bottom-actions-nav {
    position: fixed;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    max-width: 1000px;
    background: #181a20;
    border-top: 1px solid #2b3139;
    display: flex;
    justify-content: space-around;
    padding: 12px 0;
    z-index: 100;
}
.ba-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    color: #848e9c;
    font-size: 11px;
    cursor: pointer;
}
.ba-item.active { color: #fff; }
.trade-ic-box {
    width: 40px;
    height: 40px;
    background: #1e2329;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: -24px;
    border: 4px solid #181a20;
    color: var(--primary);
}

@media (max-width: 768px) {
    .desktop-container {
        padding-bottom: 80px;
    }
    .card-stats-grid {
        grid-template-columns: 1fr 1fr;
    }
}
</style>
