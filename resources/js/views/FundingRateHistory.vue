<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { ArrowLeft, Info } from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const goBack = () => router.back();

const activeTab = ref('Funding Rate History');

// Real-time funding rate data
const realtimeRate = {
    current: '+0.01%',
    countdown: '2:45:32'
};

// Historical funding rates
const fundingHistory = [
    { date: '26-02-25 12:00', type: 'Open', fundingRate: '+0.01%', nextTime: '3:00:00' },
    { date: '26-02-25 08:00', type: 'Trading Opened', fundingRate: '-0.01%', nextTime: 'Completed' },
    { date: '26-02-25 04:00', type: 'Open', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '26-02-25 00:00', type: 'Trading Opened', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '25-02-24 20:00', type: 'Open', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '25-02-24 16:00', type: 'Trading Opened', fundingRate: '-0.01%', nextTime: 'Completed' },
    { date: '25-02-24 12:00', type: 'Open', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '25-02-24 08:00', type: 'Trading Opened', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '25-02-24 04:00', type: 'Open', fundingRate: '-0.01%', nextTime: 'Completed' },
    { date: '25-02-24 00:00', type: 'Trading Opened', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '24-02-23 20:00', type: 'Open', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '24-02-23 16:00', type: 'Trading Opened', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '24-02-23 12:00', type: 'Open', fundingRate: '-0.01%', nextTime: 'Completed' },
    { date: '24-02-23 08:00', type: 'Trading Opened', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '24-02-23 04:00', type: 'Open', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '24-02-23 00:00', type: 'Trading Opened', fundingRate: '-0.01%', nextTime: 'Completed' },
    { date: '23-02-22 20:00', type: 'Open', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '23-02-22 16:00', type: 'Trading Opened', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '23-02-22 12:00', type: 'Open', fundingRate: '+0.01%', nextTime: 'Completed' },
    { date: '23-02-22 08:00', type: 'Trading Opened', fundingRate: '-0.01%', nextTime: 'Completed' },
];

</script>

<template>
    <div class="funding-screen">
        <TopHeader />
        
        <div class="scroll-content">
             <!-- Header -->
            <div class="nav-header">
                 <div class="left" @click="goBack">
                    <ArrowLeft class="icon-btn" />
                    <span class="nav-title">Back</span>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs-section">
                <div class="tab">
                    Chart
                </div>
                <div class="tab active">
                    Funding Rate History
                </div>
            </div>

            <!-- Real-Time Funding Rate -->
            <div class="realtime-section">
                <div class="section-title">
                    Real-Time Funding Rate <Info size="14" class="info-icon"/>
                </div>
                <div class="realtime-card">
                    <div class="rate-display">
                        <span class="label">Current Rate</span>
                        <span class="value positive">{{ realtimeRate.current }}</span>
                    </div>
                    <div class="countdown">
                        <span class="label">Countdown</span>
                        <span class="time">{{ realtimeRate.countdown }}</span>
                    </div>
                </div>
            </div>

            <!-- Chart Placeholder -->
            <div class="chart-section">
                <div class="chart-canvas">
                    <svg width="100%" height="120" viewBox="0 0 400 120" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="fundingGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#DFFF00;stop-opacity:0.2" />
                                <stop offset="100%" style="stop-color:#DFFF00;stop-opacity:0" />
                            </linearGradient>
                        </defs>
                        <!-- Grid -->
                        <line x1="0" y1="30" x2="400" y2="30" stroke="#222" stroke-width="1"/>
                        <line x1="0" y1="60" x2="400" y2="60" stroke="#222" stroke-width="1"/>
                        <line x1="0" y1="90" x2="400" y2="90" stroke="#222" stroke-width="1"/>
                        
                        <!-- Funding rate line (oscillating around center) -->
                        <path d="M 0 60 L 50 55 L 100 65 L 150 58 L 200 62 L 250 57 L 300 63 L 350 59 L 400 61" 
                              stroke="#DFFF00" 
                              stroke-width="2" 
                              fill="url(#fundingGradient)"/>
                        
                        <!-- Zero line -->
                        <line x1="0" y1="60" x2="400" y2="60" stroke="#666" stroke-width="1" stroke-dasharray="4,4"/>
                    </svg>
                    
                    <!-- Y-axis labels -->
                    <div class="y-axis-funding">
                        <span>+0.02%</span>
                        <span>0.00%</span>
                        <span>-0.02%</span>
                    </div>
                </div>
            </div>

            <!-- Recent & Rate Report -->
            <div class="history-section">
                <div class="section-title">
                    Recent & Rate Report
                </div>
                
                <div class="history-list">
                    <!-- Headers -->
                    <div class="history-header">
                        <span>Time</span>
                        <span>Funding Rate</span>
                        <span>Next Time</span>
                    </div>

                    <!-- List Items -->
                    <div v-for="(item, index) in fundingHistory" :key="index" class="history-item">
                        <div class="item-left">
                            <span class="item-date">{{ item.date }}</span>
                            <span class="item-type">{{ item.type }}</span>
                        </div>
                        <div class="item-center">
                            <span class="funding-rate" :class="{ positive: item.fundingRate.includes('+'), negative: item.fundingRate.includes('-') && !item.fundingRate.includes('+') }">
                                {{ item.fundingRate }}
                            </span>
                        </div>
                        <div class="item-right">
                            <span class="next-time" :class="{ completed: item.nextTime === 'Completed' }">
                                {{ item.nextTime }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Nav -->
        <div class="bot-nav">
            <div class="nav-item">
                <div class="icon-placeholder">🤖</div>
                <span>Trading Bots</span>
            </div>
            <div class="nav-item active">
                <div class="icon-placeholder">🕸️</div>
                <span>Trade</span>
            </div>
            <div class="nav-item">
                <div class="icon-placeholder">📄</div>
                <span>All Orders</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
.funding-screen {
  background-color: var(--bg-color);
  min-height: 100vh;
  padding-bottom: 90px;
  color: white;
  font-family: 'IBM Plex Sans', sans-serif;
}

.nav-header {
    display: flex;
    align-items: center;
    padding: 16px;
    background: transparent;
}
.left { display: flex; align-items: center; gap: 8px; cursor:pointer; color:#fff; font-size:14px;}
.nav-title { font-weight: 400; }
.icon-btn { color: #fff; }

/* Tabs */
.tabs-section {
    display: flex;
    gap: 24px;
    padding: 0 16px 12px 16px;
    border-bottom: 1px solid #222;
}
.tab {
    font-size: 14px;
    color: #fff;
    cursor: pointer;
    padding-bottom: 8px;
    position: relative;
}
.tab.active {
    color: white;
    font-weight: 600;
}
.tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--primary);
}

/* Real-Time Section */
.realtime-section {
    padding: 16px;
}
.section-title {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 12px;
    color: white;
}
.info-icon {
    color: #fff;
}

.realtime-card {
    background: #111;
    border-radius: 12px;
    padding: 16px;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.rate-display,
.countdown {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: center;
}

.label {
    font-size: 12px;
    color: #fff;
}

.value {
    font-size: 24px;
    font-weight: 700;
    font-family: 'IBM Plex Mono', monospace;
}
.value.positive {
    color: #DFFF00;
}
.value.negative {
    color: #f6465d;
}

.time {
    font-size: 20px;
    font-weight: 600;
    color: white;
    font-family: 'IBM Plex Mono', monospace;
}

/* Chart */
.chart-section {
    padding: 16px;
    margin-bottom: 8px;
}

.chart-canvas {
    position: relative;
    background: #0a0a0a;
    border-radius: 8px;
    padding: 16px 8px;
    min-height: 120px;
}

.y-axis-funding {
    position: absolute;
    right: 8px;
    top: 16px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: calc(100% - 32px);
    font-size: 10px;
    color: #fff;
}

/* History Section */
.history-section {
    padding: 0 16px 16px 16px;
}

.history-list {
    background: #0a0a0a;
    border-radius: 12px;
    overflow: hidden;
}

.history-header {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    padding: 12px 16px;
    font-size: 11px;
    color: #fff;
    border-bottom: 1px solid #1a1a1a;
    background: #111;
}

.history-item {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    padding: 14px 16px;
    border-bottom: 1px solid #1a1a1a;
    align-items: center;
}

.history-item:last-child {
    border-bottom: none;
}

.item-left {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.item-date {
    font-size: 13px;
    color: white;
    font-weight: 500;
}

.item-type {
    font-size: 11px;
    color: #fff;
}

.item-center {
    text-align: center;
}

.funding-rate {
    font-size: 13px;
    font-weight: 600;
    font-family: 'IBM Plex Mono', monospace;
}
.funding-rate.positive {
    color: #DFFF00;
}
.funding-rate.negative {
    color: #f6465d;
}

.item-right {
    text-align: right;
}

.next-time {
    font-size: 12px;
    color: white;
    font-family: 'IBM Plex Mono', monospace;
}
.next-time.completed {
    color: #fff;
}

/* Bottom Nav */
.bot-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: #111;
    border-top: 1px solid #fff;
    display: flex;
    justify-content: space-around;
    padding: 12px 0;
    z-index: 100;
}
.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    font-size: 10px;
    color: #fff;
    cursor: pointer;
}
.nav-item.active { color: var(--primary); }
.icon-placeholder { font-size: 18px; }
</style>
