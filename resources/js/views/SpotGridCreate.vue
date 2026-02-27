<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  ArrowLeft, 
  ChevronDown, 
  Info, 
  HelpCircle,
  RotateCcw,
  LayoutGrid,
  Zap,
  Bell,
  BarChart3,
  Search,
  Maximize2,
  Settings2,
  TrendingUp,
  Plus
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const goBack = () => router.back();

const investmentAmount = ref('23051');
const activePeriod = ref('1D');
const periods = ['Time', '1s', '15m', '1H', '4H', '1D', '1W'];

const basicInfo = [
    { label: 'PNL (USD)', value: '26,036.95', isPositive: true },
    { label: 'ROI', value: '0.61%', isPositive: true },
    { label: 'Runtime', value: '41d 8h 13m' },
    { label: '24H/Total Matched Trades', value: '22/52' },
    { label: 'Price Range', value: '13030985 - 14996253' },
    { label: 'Grid Number', value: '45' },
    { label: 'Mode', value: 'Arithmetic' }
];

const createBot = () => {
    alert('Spot Grid Bot successfully created!');
};
</script>

<template>
  <div class="spot-grid-create-screen">
    <TopHeader />
    
    <div class="main-container">
      <!-- Sub Nav -->
      <div class="sub-header">
          <div class="strategy-selector">
              <span>Spot Grid</span>
              <ChevronDown size="16" class="dim" />
          </div>
      </div>

      <div class="grid-content-layout">
        <!-- Left: Chart Section -->
        <div class="chart-section">
          <!-- Multi-Header -->
          <div class="chart-top-bar">
            <div class="periods">
                <span v-for="p in periods" :key="p" :class="{active: activePeriod === p}">{{ p }}</span>
                <ChevronDown size="14" class="dim" />
            </div>
            <div class="chart-tools">
                <LayoutGrid size="16" class="dim" />
                <BarChart3 size="16" class="dim" />
                <Settings2 size="16" class="dim" />
                <Maximize2 size="16" class="dim" />
            </div>
          </div>

          <!-- OHLC Data -->
          <div class="ohlc-header">
              <span class="date dim">2026/01/02</span>
              <span class="label dim">Open</span> <span class="val green">13,888,501</span>
              <span class="label dim">High</span> <span class="val green">14,170,829</span>
              <span class="label dim">Low</span> <span class="val green">13,802,800</span>
              <span class="label dim">Close</span> <span class="val green">14,092,957</span>
              <span class="label dim">CHANGE</span> <span class="val green">1.47%</span>
              <span class="label dim">Range</span> <span class="val green">2.61%</span>
          </div>

          <!-- Indicators -->
          <div class="indicator-header">
              <span class="ma7">MA(7): <span class="val orange">13,975,407</span></span>
              <span class="ma25">MA(25): <span class="val purple">13,845,248</span></span>
              <span class="ma99">MA(99): <span class="val blue">15,419,251</span></span>
          </div>

          <!-- Pair Price -->
          <div class="pair-price-row">
              <div class="p-left">
                  <ArrowLeft size="20" class="back-btn" @click="goBack" />
                  <span class="p-name">BTC/JPY</span>
                  <span class="p-price">14,095,635</span>
                  <span class="p-change positive">+2.27%</span>
              </div>
              <div class="p-right">
                  <TrendingUp size="18" class="bot-ic" />
                  <BarChart3 size="18" class="chart-ic dim" />
              </div>
          </div>

          <!-- Main Visualization -->
          <div class="chart-viz-area">
              <div class="price-y-axis">
                  <span>17,000,000</span>
                  <span class="upper-label">Upper Price (14,996,253)</span>
                  <span>16,000,000</span>
                  <span class="current-price-tag">14,095,635</span>
                  <span>15,000,000</span>
                  <span class="lower-label">Lower Price (13,030,985)</span>
                  <span>14,000,000</span>
              </div>

              <!-- SVGs for Candlesticks & Grids -->
              <div class="svg-container">
                  <!-- Grid Lines -->
                  <div class="grid-overlay">
                      <div class="grid-line upper"></div>
                      <div class="grid-line current"></div>
                      <div class="grid-line lower"></div>
                  </div>
                  <!-- Main Candle Wave (Simplified for Hi-Fi look) -->
                  <svg width="100%" height="300" viewBox="0 0 1000 300" preserveAspectRatio="none">
                      <path d="M0 250 L100 220 L200 240 L300 180 L400 210 L500 160 L600 190 L700 140 L800 170 L900 130 L1000 150" fill="none" stroke="#DFFF00" stroke-width="2" />
                      <path d="M0 260 L200 250 L400 255 L600 245 L800 250 L1000 248" fill="none" stroke="var(--primary)" stroke-width="1.5" />
                  </svg>
                  
                  <!-- Volume Sub-chart -->
                  <div class="vol-bars">
                      <div class="vol-label dim">Vol(BTC) <span class="white">266</span> Vol(JPY) <span class="blue">3.721B</span> <span class="red">178</span> <span class="purple">253</span></div>
                      <svg width="100%" height="40" viewBox="0 0 1000 40" preserveAspectRatio="none">
                          <rect x="100" y="20" width="8" height="20" fill="#f6465d" opacity="0.6" />
                           <rect x="120" y="10" width="8" height="30" fill="#DFFF00" opacity="0.6" />
                          <rect x="140" y="25" width="8" height="15" fill="#f6465d" opacity="0.6" />
                          <!-- ... recurring ... -->
                      </svg>
                  </div>
              </div>
          </div>

          <div class="chart-timeline">
              <span>11/01</span>
              <span>12/01</span>
              <span>2026</span>
          </div>
        </div>

        <!-- Right: Control Panel (Responsive) -->
        <div class="config-panel">
          <div class="inner-config">
            <div class="tabs-sub">
                <span>AI</span>
                <span class="active">Popular</span>
                <span>Manual</span>
            </div>

            <!-- Bot Strategy Banner -->
            <div class="bot-spec">
                <ArrowLeft size="16" class="dim" />
                <span class="pair">BTC/JPY</span>
                <span class="badge yellow">Trailing Up</span>
            </div>

            <div class="shared-param-info dim">
                <Info size="14" />
                <span>You are using a shared parameter. As market conditions differ...</span>
                <ChevronDown size="14" />
            </div>

            <!-- Basic Info Card -->
            <div class="section-card">
                <div class="card-title">Basic Info</div>
                <div class="basic-info-list">
                    <div v-for="info in basicInfo" :key="info.label" class="bi-row">
                        <span class="l dim">{{ info.label }}</span>
                        <span class="v" :class="{green: info.isPositive, white: !info.isPositive}">{{ info.value }}</span>
                    </div>
                </div>
                <div class="customize-link">Customize Parameters</div>
            </div>

            <!-- Investment Section -->
            <div class="section-card">
                <div class="card-title">
                    <span>Investment</span>
                    <span class="dim">JPY</span>
                </div>
                <div class="input-wrap">
                    <input type="text" v-model="investmentAmount" />
                    <span class="curr">JPY</span>
                </div>
                
                <!-- Custom Slider -->
                <div class="investment-slider">
                    <div class="slider-track">
                        <div class="point active"></div>
                        <div class="point"></div>
                        <div class="point"></div>
                        <div class="point"></div>
                        <div class="point"></div>
                    </div>
                    <div class="diamond-handle"></div>
                </div>

                <div class="avail-row">
                    <span class="dim">Available</span>
                    <span class="white">0 JPY <Plus size="14" class="plus-yellow" /></span>
                </div>
                <div class="avail-row">
                    <span class="dim">Qty/Order</span>
                    <span class="white">0.00 JPY</span>
                </div>
            </div>

            <!-- Advanced -->
            <div class="advanced-dropdown">
                <span>Advanced (Optional)</span>
                <ChevronDown size="16" />
            </div>

            <button class="btn-create" @click="createBot">Create</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.spot-grid-create-screen {
    background: #0b0e11;
    min-height: 100vh;
    color: #fff;
    font-family: 'IBM Plex Sans', sans-serif;
    overflow-x: hidden;
}

.main-container {
    max-width: 1200px;
    margin: 0 auto;
    background: #181a20;
    min-height: 100vh;
}

/* Sub Header */
.sub-header {
    padding: 12px 20px;
    border-bottom: 1px solid #2b3139;
}
.strategy-selector {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
}

.grid-content-layout {
    display: grid;
    grid-template-columns: 1fr;
}

@media (min-width: 1024px) {
    .grid-content-layout {
        grid-template-columns: 1fr 380px;
    }
}

/* Chart Section Styling */
.chart-section {
    padding: 16px 20px;
    background: #1e2329;
    border-bottom: 8px solid #0b0e11;
}

@media (min-width: 1024px) {
    .chart-section {
        border-bottom: none;
        border-right: 1px solid #2b3139;
    }
}

.chart-top-bar {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
}
.periods { display: flex; gap: 12px; align-items: center; }
.periods span { font-size: 12px; color: #fff; cursor: pointer; }
.periods span.active { color: #fff; font-weight: 600; }
.chart-tools { display: flex; gap: 14px; }

.ohlc-header, .indicator-header {
    display: flex;
    gap: 8px;
    font-size: 10px;
    margin-bottom: 8px;
    flex-wrap: wrap;
}
.dim { color: #fff; }
.green { color: #DFFF00; }
.orange { color: var(--primary); }
.purple { color: #9b59b6; }
.blue { color: #3b82f6; }
.white { color: #eaecef; }
.positive { color: #DFFF00; }

.pair-price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 16px 0;
    border-top: 1px solid #2b3139;
    padding-top: 16px;
}
.p-left { display: flex; align-items: center; gap: 12px; }
.back-btn { cursor: pointer; color: #848e9c; }
.p-name { font-size: 18px; font-weight: 700; }
.p-price { font-size: 18px; font-weight: 700; font-family: 'IBM Plex Mono', monospace; }
.p-change { font-size: 14px; font-weight: 600; }

.chart-viz-area {
    position: relative;
    height: 350px;
    margin-top: 20px;
}

.price-y-axis {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 120px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    font-size: 11px;
    color: #474d57;
    text-align: right;
    z-index: 5;
}

.upper-label { color: #f6465d; background: rgba(246, 70, 93, 0.1); padding: 2px 4px; border-radius: 2px; }
.lower-label { color: #3b82f6; background: rgba(59, 130, 246, 0.1); padding: 2px 4px; border-radius: 2px; }
.current-price-tag { background: #DFFF00; color: #000; font-weight: 800; padding: 2px 4px; border-radius: 2px; }

.svg-container { flex: 1; position: relative; height: 100%; }
.grid-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    pointer-events: none;
}
.grid-line { width: 100%; height: 1px; border-top: 1px dashed #2b3139; }
.grid-line.upper { border-top-color: rgba(246, 70, 93, 0.3); }
.grid-line.lower { border-top-color: rgba(59, 130, 246, 0.3); }

.vol-bars { position: absolute; bottom: 0; left: 0; width: 100%; }

/* Config Panel Styling */
.config-panel {
    background: #181a20;
    padding: 0;
}
.inner-config {
    padding: 20px;
}

.tabs-sub {
    display: flex;
    gap: 24px;
    margin-bottom: 24px;
    border-bottom: 1px solid #2b3139;
    padding-bottom: 8px;
}
.tabs-sub span { font-size: 14px; font-weight: 600; color: #848e9c; cursor: pointer; position: relative; }
.tabs-sub span.active { color: #fff; }
.tabs-sub span.active::after {
    content: ''; position: absolute; bottom: -10px; left: 0; width: 100%; height: 3px; background: var(--primary); border-radius: 2px;
}

.bot-spec { display: flex; align-items: center; gap: 8px; margin-bottom: 16px; }
.bot-spec .pair { font-size: 15px; font-weight: 700; }
.badge.yellow { background: rgba(223, 255, 0, 0.1); color: var(--primary); font-size: 10px; font-weight: 800; padding: 2px 6px; border-radius: 4px; }

.shared-param-info {
    font-size: 12px; 
    display: flex; 
    align-items: center; 
    gap: 8px; 
    background: #1e2329; 
    padding: 10px; 
    border-radius: 8px;
    margin-bottom: 20px;
}

.section-card {
    background: #1e2329;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 16px;
}
.card-title { font-size: 14px; font-weight: 700; margin-bottom: 16px; display: flex; justify-content: space-between; }

.bi-row { display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 10px; }
.customize-link { color: var(--primary); font-size: 12px; font-weight: 600; margin-top: 12px; text-decoration: underline; cursor: pointer; }

.input-wrap {
    background: #2b3139;
    border-radius: 8px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}
.input-wrap input { background: transparent; border: none; flex: 1; color: #fff; font-size: 16px; outline: none; }
.curr { color: #848e9c; font-weight: 600; font-size: 14px; }

.investment-slider {
    position: relative;
    height: 20px;
    margin: 24px 0;
}
.slider-track {
    width: 100%;
    height: 2px;
    background: #2b3139;
    display: flex;
    justify-content: space-between;
}
.point { width: 8px; height: 8px; background: #2b3139; border-radius: 50%; margin-top: -3px; }
.point.active { background: var(--primary); }
.diamond-handle {
    position: absolute;
    left: 20%;
    top: 5px;
    width: 10px;
    height: 10px;
    background: var(--primary);
    transform: rotate(45deg);
}

.avail-row { display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 8px; }
.plus-yellow { background: #2b3139; color: var(--primary); border-radius: 2px; cursor: pointer; }

.advanced-dropdown {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    font-size: 14px;
    color: #848e9c;
    border-top: 1px solid #2b3139;
}

.btn-create {
    width: 100%;
    background: var(--primary);
    color: #000;
    border: none;
    padding: 16px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
}
.btn-create:hover { background: #e0ac0a; }

.chart-timeline {
    display: flex;
    justify-content: space-between;
    font-size: 10px;
    color: #474d57;
    margin-top: 12px;
}
</style>
