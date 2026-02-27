<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  ChevronDown,
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const bots = [
  { 
    id: 1, 
    pair: 'OMG/USDT', 
    rank: 1, 
    runtime: '12d 11h 20m', 
    type: 'Spot grid', 
    roi: '+76.44%', 
    pnl: '+51.25 USDT', 
    drawdown: '12.54%', 
    aum: '100.21 USDT', 
    profitShare: '10%', 
    trader: 'Nguyen Van Tung', 
    avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Nguyen' 
  },
  { 
    id: 2, 
    pair: 'XRP/USDT', 
    rank: 2, 
    runtime: '8d 14h 10m', 
    type: 'Spot grid', 
    roi: '+19.41%', 
    pnl: '+1,241.10 USDT', 
    drawdown: '5.21%', 
    aum: '1,014.21 USDT', 
    profitShare: '10%', 
    trader: 'ytdsole75', 
    avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=ytd' 
  },
  { 
    id: 3, 
    pair: '1000PEPE/USDT', 
    rank: 3, 
    runtime: '3d 10h 04m', 
    type: 'Spot grid', 
    roi: '+93.38%', 
    pnl: '+124.58 USDT', 
    drawdown: '25.4%', 
    aum: '48.24 USDT', 
    profitShare: '10%', 
    trader: 'Bjorn10', 
    avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Bjorn' 
  },
  { 
    id: 4, 
    pair: 'ORDI/USDT', 
    rank: 4, 
    runtime: '15d 2h 30m', 
    type: 'Spot grid', 
    roi: '+36.91%', 
    pnl: '+19.5 USDT', 
    drawdown: '8.12%', 
    aum: '210.00 USDT', 
    profitShare: '10%', 
    trader: 'Nguyen', 
    avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Ng' 
  },
   { 
    id: 5, 
    pair: 'CFX/USDT', 
    rank: 5, 
    runtime: '22d 2h 10m', 
    type: 'Spot grid', 
    roi: '+36.4%', 
    pnl: '+34.8 USDT', 
    drawdown: '20.67%', 
    aum: '150.70 USDT', 
    profitShare: '10%', 
    trader: 'DigiBot', 
    avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Digi' 
  },
  { 
    id: 6, 
    pair: 'LUNA/USDT', 
    rank: 6, 
    runtime: '2d 4h 15m', 
    type: 'Spot grid', 
    roi: '-15.24%', 
    pnl: '-12.50 USDT', 
    drawdown: '35.12%', 
    aum: '25.00 USDT', 
    profitShare: '10%', 
    trader: 'RiskTaker', 
    avatar: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Risk' 
  },
];

const goToDetail = (id) => {
  router.push(`/copy-trading/${id}`);
};
</script>

<template>
  <div class="copy-trading-page">
    <TopHeader />
    
    <div class="main-content">
        <div class="header-filters">
            <div class="filter-row">
                <span class="filter-item active">All Pairs</span>
                <span class="filter-item">⁠ROI (High to Low) <ChevronDown size="14" /></span>
                <span class="filter-item">⁠PnL (High to Low) <ChevronDown size="14" /></span>
                <span class="filter-item">⁠Copiers (High to Low)</span>
                <span class="filter-item">⁠⁠Drawdown (Low to High)</span>
            </div>
        </div>

        <div class="bots-grid">
            <div 
                v-for="bot in bots" 
                :key="bot.id" 
                class="bot-card"
                @click="goToDetail(bot.id)"
            >
                <div class="card-header">
                    <div class="pair-section">
                        <h3 class="pair-name">{{ bot.pair }}</h3>
                        <span class="rank-badge">#{{ bot.rank }}</span>
                    </div>
                    <div class="meta-section">
                        <span class="runtime">Runtime {{ bot.runtime }}</span>
                        <span class="bot-type">{{ bot.type }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="roi-data">
                        <span class="label">Total ROI</span>
                        <span class="roi-val" :class="{ 'down-color': !bot.roi.startsWith('+') }">{{ bot.roi }}</span>
                        <span class="pnl-val" :class="{ 'down-color': !bot.pnl.startsWith('+') }">{{ bot.pnl }}</span>
                    </div>
                    <div class="chart-data">
                        <span class="chart-label">30-day profit</span>
                        <svg viewBox="0 0 100 40" class="sparkline">
                            <path 
                                d="M0 35 Q 25 30, 50 15 T 100 5" 
                                fill="none" 
                                :stroke="bot.roi.startsWith('+') ? '#DFFF00' : '#FF00D6'" 
                                stroke-width="2" 
                            />
                            <linearGradient :id="'grad-' + bot.id" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" :style="{ 'stop-color': bot.roi.startsWith('+') ? '#DFFF00' : '#FF00D6', 'stop-opacity': 0.2 }" />
                                <stop offset="100%" :style="{ 'stop-color': bot.roi.startsWith('+') ? '#DFFF00' : '#FF00D6', 'stop-opacity': 0 }" />
                            </linearGradient>
                            <path 
                                d="M0 35 Q 25 30, 50 15 T 100 5 V 40 H 0 Z" 
                                :fill="'url(#grad-' + bot.id + ')'" 
                                stroke="none" 
                            />
                        </svg>
                    </div>
                </div>

                <div class="card-stats">
                    <div class="stat-row">
                        <span class="s-label">Max drawdown</span>
                        <span class="s-val">{{ bot.drawdown }}</span>
                    </div>
                    <div class="stat-row">
                        <span class="s-label">AUM</span>
                        <span class="s-val">{{ bot.aum }}</span>
                    </div>
                    <div class="stat-row">
                        <span class="s-label">Profit share ratio</span>
                        <span class="s-val">{{ bot.profitShare }}</span>
                    </div>
                    <div class="stat-row trader-row">
                        <span class="s-label">Elite bot trader</span>
                        <div class="trader-info">
                            <img :src="bot.avatar" class="t-avatar" />
                            <span class="t-name">{{ bot.trader }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="copy-btn" @click.stop="goToDetail(bot.id)">Copy</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap');

.copy-trading-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  overflow-x: hidden;
}

.main-content {
  max-width: 1400px;
  margin: 0 auto;
  padding: 32px 24px;
}

@media (max-width: 768px) {
  .main-content {
    padding: 16px 12px;
  }
}

/* Filters */
.header-filters {
    margin-bottom: 24px;
    border-bottom: 1px solid #1a1a1a;
    padding-bottom: 16px;
}

.filter-row {
    display: flex;
    gap: 32px;
    align-items: center;
    overflow-x: auto;
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}

.filter-row::-webkit-scrollbar {
    display: none; /* Chrome, Safari and Opera */
}

.filter-item {
    font-size: 14px;
    font-weight: 500;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
}

.filter-item.active {
    color: #fff;
    font-weight: 700;
}

/* Grid */
.bots-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

@media (max-width: 480px) {
    .bots-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}

/* Card */
.bot-card {
    background: #111; /* Slightly lighter than pure black bg */
    border: 1px solid #1a1a1a;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    cursor: pointer;
}

.bot-card:hover {
    border-color: #DFFF00; /* Primary Desci color */
    transform: translateY(-8px);
    background: #161616;
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(223, 255, 0, 0.1);
}

/* Header */
.card-header {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.pair-section {
    display: flex;
    align-items: center;
    gap: 8px;
}

.pair-name {
    font-size: 18px;
    font-weight: 700;
    color: #fff;
    margin: 0;
}

.rank-badge {
    background-color: #DFFF00;
    color: #000;
    font-size: 10px;
    font-weight: 800;
    padding: 1px 6px;
    border-radius: 4px;
}

.meta-section {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 12px;
}

.runtime {
    color: #fff;
}

.bot-type {
    color: #DFFF00;
    background: rgba(223, 255, 0, 0.1);
    padding: 2px 6px;
    border-radius: 4px;
}

/* Body */
.card-body {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}

.roi-data {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.roi-data .label {
    font-size: 12px;
    color: #fff;
}

.roi-val {
    font-size: 32px;
    font-weight: 700;
    color: #DFFF00;
    line-height: 1;
}

.roi-val.down-color {
    color: #FF00D6;
}

.pnl-val {
    font-size: 14px;
    color: #fff;
    font-weight: 500;
}

.pnl-val.down-color {
    color: #fff;
}

.chart-data {
    width: 100px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 4px;
}

.chart-label {
    font-size: 10px;
    color: #fff;
}

.sparkline {
    width: 100%;
    height: 48px;
}

/* Stats */
.card-stats {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 40px;
}

.stat-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
}

.s-label {
    color: #fff;
}

.s-val {
    color: #fff;
    font-weight: 600;
}

.trader-row {
    margin-top: 4px;
}

.trader-info {
    display: flex;
    align-items: center;
    gap: 8px;
}

.t-avatar {
    width: 18px;
    height: 18px;
    border-radius: 50%;
}

.t-name {
    color: #fff;
    font-size: 13px;
    font-weight: 500;
}

/* Footer Action */
.card-footer {
    margin-top: 4px;
}

.copy-btn {
    width: 100%;
    background: #1e1e1e;
    color: #fff;
    border: 1px solid #2b3139;
    padding: 10px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.copy-btn:hover {
    background: #2a2a2a;
    border-color: #444;
}
@media (max-width: 768px) {
  .main-content { padding: 16px; }

  .header-filters {
    margin-bottom: 20px;
    padding-bottom: 12px;
  }

  /* Filters wrap on mobile instead of scroll */
  .filter-row {
    flex-wrap: wrap;
    gap: 10px;
    padding-bottom: 0;
    margin: 0;
    padding: 0;
    justify-content: flex-start;
  }
  
  .filter-item {
    font-size: 12px;
    padding: 6px 12px;
    background: #111;
    border: 1px solid #1a1a1a;
    border-radius: 6px;
  }
  
  .filter-item.active {
    background: rgba(223, 255, 0, 0.1);
    border-color: #DFFF00;
  }

  .bots-grid {
    grid-template-columns: 1fr; /* Single column on mobile */
    gap: 16px;
  }

  .bot-card {
    padding: 16px;
  }

  .roi-val { font-size: 28px; }

  .card-stats {
    margin-top: 24px;
    gap: 10px;
  }
}

@media (max-width: 480px) {
  .bot-card {
    padding: 16px;
    gap: 16px;
  }

  .pair-name {
    font-size: 16px;
  }

  .roi-val {
    font-size: 24px;
  }

  .pnl-val {
    font-size: 12px;
  }

  .s-label, .s-val, .t-name {
    font-size: 12px;
  }
}

@media (min-width: 769px) and (max-width: 1024px) {
  .bots-grid {
    grid-template-columns: repeat(2, 1fr); /* Two columns on tablet */
  }
}
</style>
