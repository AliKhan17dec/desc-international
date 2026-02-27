<script setup>
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { 
  ArrowLeft, 
  Share, 
  MoreHorizontal,
  Headphones,
  ChevronRight,
  ChevronDown,
  Info
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const route = useRoute();
const router = useRouter();
const id = route.params.id;

// Mock data based on ID
const botDetails = ref({
    pair: 'BERA/USDT',
    price: '0.7123',
    change: '+11.76%',
    runtime: '22d 7h 20m',
    type: 'Spot grid',
    copiers: 2,
    totalCopiedPnl: '0',
    tradersInvestment: '505.41',
    roi: '+54.01%',
    pnl: '+213',
    investment: '1,034.31',
    creationTime: '2025-01-02 16:54:42',
    botId: '11631243567175720198',
    trader: 'ytdsole75',
    leaderboard: [
        { rank: 1, name: 'BGUSER-2KXV4EUDL', time: '8h 18m', amount: '645.47' },
        { rank: 2, name: 'vibec3', time: '3d 14m', amount: '129.93' }
    ]
});

const goBack = () => {
    router.back();
};

// Modal State
const showCopyModal = ref(false);
const investmentAmount = ref('');

const openCopyModal = () => {
    showCopyModal.value = true;
};

const handleConfirm = () => {
    if (!investmentAmount.value || investmentAmount.value <= 0) {
        alert('Please enter a valid investment amount greater than 0.');
        return;
    }
    
    // Simulate API processing
    // In a real app, this would be an axios.post call
    alert(`Successfully started copy trading with ${investmentAmount.value} USDT!`);
    showCopyModal.value = false;
    investmentAmount.value = '';
};
</script>

<template>
    <div class="desktop-detail-page">
        <TopHeader />
        
        <div class="main-container">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <span @click="router.push('/')">Home</span>
                <span class="sep">/</span>
                <span @click="router.push('/copy-trading')">Copy Trading</span>
                <span class="sep">/</span>
                <span class="active">Bot Details</span>
            </div>

            <!-- Header Info -->
            <div class="info-header">
                <div class="left-col">
                    <div class="pair-title">
                        <div class="icons">
                            <div class="coin-icon bera">B</div>
                            <div class="coin-icon usdt">T</div>
                        </div>
                        <h1>{{ botDetails.pair }}</h1>
                        <span class="tag-type">{{ botDetails.type }}</span>
                    </div>
                    <div class="price-info">
                        <span class="price-val">{{ botDetails.price }}</span>
                        <span class="price-change" :class="{ 'down-color': !botDetails.change.startsWith('+') }">{{ botDetails.change }}</span>
                    </div>
                </div>
                <div class="right-col">
                    <button class="action-btn outline"><Share size="18" /> Share</button>
                    <button class="action-btn primary" @click="openCopyModal">Copy</button>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Left Column: Performance & Charts -->
                <div class="left-content">
                    <!-- Performance Cards -->
                    <div class="stats-row">
                        <div class="stat-card highlight" :class="{ 'loss-bg': !botDetails.roi.startsWith('+') }">
                            <span class="label">Total ROI</span>
                            <span class="value" :class="botDetails.roi.startsWith('+') ? 'green' : 'red'">{{ botDetails.roi }}</span>
                        </div>
                        <div class="stat-card">
                            <span class="label">Total PnL (USDT)</span>
                            <span class="value" :class="botDetails.pnl.startsWith('+') ? 'green' : 'red'">{{ botDetails.pnl }}</span>
                        </div>
                        <div class="stat-card">
                            <span class="label">Runtime</span>
                            <span class="value">{{ botDetails.runtime }}</span>
                        </div>
                        <div class="stat-card">
                            <span class="label">Copiers</span>
                            <span class="value">{{ botDetails.copiers }}</span>
                        </div>
                    </div>

                    <!-- Main Chart Section -->
                    <div class="chart-section">
                        <div class="chart-header">
                             <h3>Performance Trend</h3>
                             <div class="pills">
                                 <span class="pill active">ROI</span>
                                 <span class="pill">PnL</span>
                             </div>
                        </div>
                        <div class="chart-area">
                            <!-- SVG Chart -->
                            <svg viewBox="0 0 800 250" class="main-chart">
                                <defs>
                                    <linearGradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                                        <stop offset="0%" :stop-color="botDetails.roi.startsWith('+') ? '#DFFF00' : '#FF00D6'" stop-opacity="0.2"/>
                                        <stop offset="100%" :stop-color="botDetails.roi.startsWith('+') ? '#DFFF00' : '#FF00D6'" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <path 
                                    d="M0 200 C 100 200, 150 100, 250 120 S 400 80, 500 90 S 650 40, 800 50" 
                                    fill="none" 
                                    :stroke="botDetails.roi.startsWith('+') ? '#DFFF00' : '#FF00D6'" 
                                    stroke-width="3"
                                />
                                <path d="M0 200 C 100 200, 150 100, 250 120 S 400 80, 500 90 S 650 40, 800 50 V 250 H 0 Z" fill="url(#chartGradient)" stroke="none"/>
                            </svg>
                            <div class="chart-dates">
                                <span>01-14</span>
                                <span>01-21</span>
                                <span>01-28</span>
                                <span>02-04</span>
                                <span>02-11</span>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Info Grid -->
                    <div class="details-grid">
                        <div class="detail-box">
                            <span class="d-label">Trader's Investment</span>
                            <span class="d-value">{{ botDetails.tradersInvestment }} USDT</span>
                        </div>
                        <div class="detail-box">
                            <span class="d-label">Total Copied PnL</span>
                            <span class="d-value">{{ botDetails.totalCopiedPnl }} USDT</span>
                        </div>
                        <div class="detail-box">
                            <span class="d-label">Bot ID</span>
                            <span class="d-value">{{ botDetails.botId }}</span>
                        </div>
                        <div class="detail-box">
                            <span class="d-label">Creation Time</span>
                            <span class="d-value">{{ botDetails.creationTime }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar -->
                <div class="right-sidebar">
                    <!-- Trader Profile -->
                    <div class="sidebar-card trader-card">
                        <h3>Elite Bot Trader</h3>
                        <div class="trader-row">
                            <div class="avatar-ph"></div>
                            <div class="trader-info">
                                <span class="t-name">{{ botDetails.trader }}</span>
                                <span class="t-link">View Profile <ChevronRight size="12"/></span>
                            </div>
                        </div>
                    </div>

                    <!-- Leaderboard -->
                    <div class="sidebar-card leaderboard-card">
                        <h3>Copier Leaderboard</h3>
                        <div class="lb-header">
                            <span>User</span>
                            <span>Profit</span>
                        </div>
                        <div class="lb-list">
                            <div v-for="item in botDetails.leaderboard" :key="item.name" class="lb-item">
                                <div class="lb-user">
                                    <span class="rank" :class="'r-'+item.rank">{{ item.rank }}</span>
                                    <div class="u-name-stack">
                                        <span class="u-n">{{ item.name }}</span>
                                        <span class="u-t">{{ item.time }}</span>
                                    </div>
                                </div>
                                <span class="lb-amt" :class="{ 'down-color': item.amount.toString().startsWith('-') }">
                                    {{ item.amount.toString().startsWith('-') ? '' : '+' }}{{ item.amount }}
                                </span>
                            </div>
                        </div>
                        <button class="view-all-btn">View All</button>
                    </div>

                    <!-- Bot Parameters (Mock) -->
                    <div class="sidebar-card params-card">
                        <h3>Bot Parameters</h3>
                        <div class="param-row">
                            <span>Price Range</span>
                            <span>0.55 - 0.85</span>
                        </div>
                        <div class="param-row">
                            <span>Grids</span>
                            <span>45</span>
                        </div>
                        <div class="param-row">
                            <span>Geometric</span>
                            <span>0.65%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copy Modal Overlay -->
        <div v-if="showCopyModal" class="modal-overlay" @click.self="showCopyModal = false">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Copy trading limit</h3>
                    <button class="close-btn" @click="showCopyModal = false">×</button>
                </div>
                
                <div class="modal-body">
                    <div class="input-group">
                        <label>Investment</label>
                        <div class="input-box">
                            <input type="number" v-model="investmentAmount" placeholder="> 0" />
                            <span class="currency">USDT</span>
                        </div>
                    </div>

                    <div class="info-row-modal">
                        <span>Available in spot account:</span>
                        <span class="val">1,241.52 USDT</span>
                    </div>

                    <div class="total-row">
                        <span>Total:</span>
                        <span class="total-val">{{ investmentAmount || 0 }} USDT</span>
                    </div>

                    <div class="modal-note">
                        The bot starts and stops with the elite trader. Bot parameters change with market after bot starts. 10% of the copier's profit will be shared with the elite trader.
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn cancel" @click="showCopyModal = false">Cancel</button>
                    <button class="btn confirm" @click="handleConfirm">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap');

.desktop-detail-page {
    background: #000;
    min-height: 100vh;
    color: #fff;
    font-family: 'IBM Plex Sans', sans-serif;
    width: 100%;
    overflow-x: hidden; /* Prevent horizontal scroll */
}

.main-container {
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px 24px;
    box-sizing: border-box;
}

/* Breadcrumb */
.breadcrumb {
    font-size: 14px;
    color: #fff;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.breadcrumb span { cursor: pointer; transition: color 0.2s; }
.breadcrumb span:hover { color: #fff; }
.breadcrumb .sep { cursor: default; color: #fff; }
.breadcrumb .active { color: #fff; cursor: default; }

/* Header Info */
.info-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 32px;
    border-bottom: 1px solid #1a1a1a;
    padding-bottom: 32px;
}

.pair-title {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 8px;
}

.icons { display: flex; position: relative; width: 48px; }
.coin-icon { 
    width: 32px; height: 32px; 
    border-radius: 50%; 
    background: #333; 
    border: 2px solid #000;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700;
}
.bera { background: #facc15; color: #000; z-index: 2; }
.usdt { background: #26a17b; color: #fff; margin-left: -12px; z-index: 1; }

h1 { font-size: 32px; font-weight: 700; margin: 0; }

.tag-type {
    background: #1a1a1a;
    color: #fca103;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.price-info { display: flex; align-items: baseline; gap: 12px; margin-left: 64px; }
.price-val { font-size: 24px; font-weight: 700; }
.price-change { color: #DFFF00; font-size: 18px; font-weight: 600; }
.price-change.down-color { color: #FF00D6; }

.right-col { display: flex; gap: 16px; }

.action-btn {
    padding: 12px 32px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}

.action-btn.outline {
    background: transparent;
    border: 1px solid #333;
    color: #fff;
}
.action-btn.outline:hover { background: #111; border-color: #555; }

.action-btn.primary {
    background: #fff;
    border: 1px solid #fff;
    color: #000;
    font-weight: 700;
}
.action-btn.primary:hover { background: #eaeaea; border-color: #eaeaea; }

/* Grid System */
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 32px;
}

/* Left Content */
.left-content { display: flex; flex-direction: column; gap: 32px; }

.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

.stat-card {
    background: #111;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    border: 1px solid #1a1a1a;
}

.stat-card.highlight { background: rgba(223, 255, 0, 0.05); border-color: rgba(223, 255, 0, 0.2); }

.stat-card .label { font-size: 13px; color: #fff; }
.stat-card .value { font-size: 24px; font-weight: 700; }
.stat-card .value.green { color: #DFFF00; }
.stat-card .value.red { color: #FF00D6; }

.stat-card.highlight.loss-bg {
    background: rgba(255, 0, 214, 0.05);
    border-color: rgba(255, 0, 214, 0.2);
}

.chart-section {
    background: #111;
    border-radius: 16px;
    padding: 24px;
    border: 1px solid #1a1a1a;
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.chart-header h3 { font-size: 18px; margin: 0; }

.pills { display: flex; background: #000; padding: 4px; border-radius: 8px; }
.pill { 
    padding: 6px 16px; 
    font-size: 13px; 
    cursor: pointer; 
    border-radius: 6px; 
    color: #fff;
    font-weight: 500;
}
.pill.active { background: #222; color: #fff; }

.chart-area { width: 100%; height: 300px; display: flex; flex-direction: column; }
.main-chart { flex: 1; width: 100%; }
.chart-dates { display: flex; justify-content: space-between; color: #fff; font-size: 12px; margin-top: 12px; }

.details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.detail-box {
    background: #111;
    padding: 20px;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: 1px solid #1a1a1a;
}

.detail-box .d-label { color: #fff; font-size: 14px; }
.detail-box .d-value { font-weight: 600; color: #fff; }

/* Right Sidebar */
.right-sidebar { display: flex; flex-direction: column; gap: 24px; }

.sidebar-card {
    background: #111;
    border-radius: 16px;
    padding: 24px;
    border: 1px solid #1a1a1a;
}

.sidebar-card h3 { font-size: 16px; margin: 0 0 20px 0; font-weight: 700; }

.trader-row { display: flex; align-items: center; gap: 16px; }
.avatar-ph { width: 48px; height: 48px; background: #333; border-radius: 50%; }
.trader-info { display: flex; flex-direction: column; gap: 4px; }
.t-name { font-weight: 700; font-size: 16px; }
.t-link { font-size: 13px; color: #DFFF00; cursor: pointer; display: flex; align-items: center; }

/* Leaderboard */
.lb-header { display: flex; justify-content: space-between; font-size: 12px; color: #fff; margin-bottom: 12px; }
.lb-item { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #1a1a1a; }
.lb-user { display: flex; align-items: center; gap: 12px; }
.rank { font-weight: 700; color: #fff; width: 20px; text-align: center; }
.rank.r-1, .rank.r-2, .rank.r-3 { color: #facc15; }
.u-name-stack { display: flex; flex-direction: column; }
.u-n { font-size: 13px; font-weight: 600; }
.u-t { font-size: 11px; color: #fff; }
.lb-amt { font-weight: 700; color: #DFFF00; font-size: 14px; }
.lb-amt.down-color { color: #fff; }

.view-all-btn { 
    width: 100%; 
    background: #1a1a1a; 
    border: none; 
    padding: 12px; 
    margin-top: 16px; 
    border-radius: 8px; 
    color: #fff; 
    font-weight: 600; 
    cursor: pointer; 
}
.view-all-btn:hover { background: #222; }

/* Params */
.param-row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #1a1a1a; font-size: 14px; }
.param-row span:first-child { color: #fff; }
.param-row span:last-child { font-weight: 600; }

@media (max-width: 1024px) {
    .dashboard-grid { grid-template-columns: 1fr; }
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .right-sidebar { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
}

@media (max-width: 768px) {
    .main-container { padding: 16px; }
    
    .info-header {
        flex-direction: column;
        gap: 20px;
        align-items: stretch;
    }

    .pair-title { 
        flex-wrap: wrap; 
        gap: 12px;
    }
    
    .right-col {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    
    .action-btn { 
        justify-content: center; 
        width: 100%;
        padding: 12px 16px;
    }

    .price-info { 
        margin-left: 0; 
        margin-top: 12px; 
        justify-content: space-between;
        width: 100%;
    }

    .details-grid { grid-template-columns: 1fr; gap: 12px; }
    
    .right-sidebar { grid-template-columns: 1fr; }
    
    /* Ensure no overflow on chart */
    .chart-area { width: 100%; height: auto; min-height: 250px; overflow: hidden; }
    .main-chart { width: 100%; height: auto; display: block; }
}

@media (max-width: 480px) {
    .stats-row { grid-template-columns: 1fr; gap: 12px; }
    
    .chart-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .pills { width: 100%; justify-content: space-between; }
    .pill { flex: 1; text-align: center; }

    .pair-title h1 { font-size: 24px; }
    .price-val { font-size: 24px; }
    .price-change { font-size: 16px; }
    
    .right-col { grid-template-columns: 1fr; }
    
    /* Text wrapping for long IDs */
    .d-value { word-break: break-all; }
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center; /* Center on desktop */
    z-index: 2000;
}

.modal-content {
    background: #1e2329;
    width: 400px;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

@media (max-width: 480px) {
    .modal-overlay {
        align-items: flex-end; /* Bottom sheet on mobile */
    }
    .modal-content {
        width: 100%;
        border-radius: 12px 12px 0 0;
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    border-bottom: 1px solid #2b3139;
}

.modal-header h3 { font-size: 16px; margin: 0; font-weight: 600; }
.close-btn { background: none; border: none; font-size: 24px; color: #fff; cursor: pointer; }

.modal-body {
    padding: 24px 20px;
}

.input-group label {
    display: block;
    font-size: 14px;
    color: #fff;
    margin-bottom: 8px;
}

.input-box {
    background: #2b3139;
    border-radius: 8px;
    padding: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: 1px solid transparent;
}
.input-box:focus-within { border-color: var(--primary); }
.input-box input { background: transparent; border: none; color: #fff; outline: none; flex: 1; font-weight: 600; }
.currency { font-size: 14px; color: #fff; font-weight: 500; }

.info-row-modal {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    margin-top: 12px;
    color: #fff;
}
.info-row-modal .val { color: #fff; }

.total-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    font-weight: 600;
    margin-top: 24px;
    padding-top: 16px;
    border-top: 1px solid #2b3139;
}

.modal-note {
    font-size: 12px;
    color: #fff;
    margin-top: 20px;
    line-height: 1.5;
}

.modal-footer {
    padding: 16px 20px;
    display: flex;
    gap: 16px;
    border-top: 1px solid #2b3139;
}

.modal-footer .btn {
    flex: 1;
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    font-size: 14px;
}

.btn.cancel { background: #2b3139; border: none; color: #fff; }
.btn.confirm { background: var(--primary); border: none; color: #000; }
</style>
