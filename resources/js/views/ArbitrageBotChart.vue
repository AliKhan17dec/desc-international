<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { ArrowLeft, ChevronDown, User, Menu, Bell, HelpCircle } from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const goBack = () => router.back();

const activeTab = ref('Funding Rate History');
const activePeriod = ref('1D');
const periods = ['15m', '1H', '4H', '1D', '1W'];

// Funding Data
const realTimeFunding = {
    symbol: 'POLYXUSDT Perp',
    interval: '8h',
    nextFunding: '00:27:34',
    fundingRate: '-0.01870%',
    interestRate: '0.0100%',
    capFloor: '2.5000% / -2.5000%'
};

const historyList = [
    { time: '2026-01-03 23:30', interval: '8h', rate: '-0.012354%', price: '0.05635002' },
    { time: '2026-01-03 21:30', interval: '8h', rate: '-0.012568%', price: '0.05622312' },
    { time: '2026-01-03 20:30', interval: '8h', rate: '-0.012892%', price: '0.05601310' },
    { time: '2026-01-03 19:30', interval: '8h', rate: '-0.012981%', price: '0.05620000' },
    { time: '2026-01-03 18:30', interval: '8h', rate: '-0.011234%', price: '0.05610122' },
    { time: '2026-01-03 17:30', interval: '8h', rate: '-0.014231%', price: '0.05634333' },
    { time: '2026-01-03 16:30', interval: '8h', rate: '-0.012231%', price: '0.05600111' },
    { time: '2026-01-03 15:30', interval: '8h', rate: '-0.011882%', price: '0.05592399' },
    { time: '2026-01-03 14:30', interval: '8h', rate: '-0.012553%', price: '0.05581122' },
    { time: '2026-01-03 13:30', interval: '8h', rate: '-0.013112%', price: '0.05572333' },
    { time: '2026-01-03 12:30', interval: '8h', rate: '-0.012999%', price: '0.05611233' },
    { time: '2026-01-03 11:30', interval: '8h', rate: '-0.012323%', price: '0.05599222' },
];

// Exact data from screenshot
const chart1 = {
    pair: 'POLYXUSDT',
    tag: 'Perp',
    price: '0.05687',
    change: '-0.68%',
    isPricePositive: true,
    isChangePositive: false,
    stats: {
        date: '2026/01/02',
        open: '0.05728',
        high: '0.05753',
        low: '0.05492',
        close: '0.05687',
        changeVal: '-0.68%',
        range: '4.55%'
    },
    ma: {
        ma7: '0.05404',
        ma25: '0.05371',
        ma99: '0.07621'
    },
    volume: {
        polyx: '183.783M',
        usdt: '10.277M',
        amount: '611.542M',
        amount2: '655.698M'
    }
};

const chart2 = {
    pair: 'POLYX/USDT',
    price: '0.0570',
    change: '-2.39%',
    isPricePositive: true,
    isChangePositive: false,
    stats: {
        date: '2026/01/02',
        open: '0.0583',
        high: '0.0587',
        low: '0.0549',
        close: '0.0570',
        changeVal: '-2.39%',
        range: '6.50%'
    },
    ma: {
        ma7: '0.0545',
        ma25: '0.0719',
        ma99: '0.0763'
    },
    volume: {
        polyx: '13.006M',
        usdt: '731.572K',
        amount: '53.013M',
        amount2: '59.944M'
    }
};

</script>

<template>
    <div class="chart-screen">
        <TopHeader />
        
        <div class="desktop-container">
            <!-- Binance-like Subheader -->
            <div class="sub-nav">
                <div class="nav-left" @click="goBack">
                    <ArrowLeft size="18" />
                    <span>Back</span>
                </div>
            </div>

            <!-- Main Tabs -->
            <div class="tabs-row">
                <div class="tab" :class="{active: activeTab === 'Chart'}" @click="activeTab = 'Chart'">Chart</div>
                <div class="tab" :class="{active: activeTab === 'Funding Rate History'}" @click="activeTab = 'Funding Rate History'">Funding Rate History</div>
            </div>

            <!-- TAB 1: Chart Content -->
            <div v-if="activeTab === 'Chart'" class="chart-content">
                <!-- CHART 1 -->
                <div class="chart-block">
                    <!-- Period & Price Header -->
                    <div class="block-header">
                        <div class="period-list">
                            <span v-for="p in periods" :key="p" 
                                  :class="{active: activePeriod === p}"
                                  @click="activePeriod = p">{{ p }}</span>
                            <ChevronDown size="12" class="dim" />
                        </div>
                        <div class="pair-stats-header">
                            <span class="p-name">{{ chart1.pair }}</span>
                            <span class="p-tag">{{ chart1.tag }}</span>
                            <span class="p-price" :class="{positive: chart1.isPricePositive}">{{ chart1.price }}</span>
                            <span class="p-change" :class="{negative: !chart1.isChangePositive}">{{ chart1.change }}</span>
                        </div>
                    </div>

                    <!-- OHLC Row -->
                    <div class="ohlc-row">
                        <span class="dim arrow-down">▼</span>
                        <span class="date">{{ chart1.stats.date }}</span>
                        <span class="label">Open</span> <span class="val red">{{ chart1.stats.open }}</span>
                        <span class="label">High</span> <span class="val red">{{ chart1.stats.high }}</span>
                        <span class="label">Low</span> <span class="val red">{{ chart1.stats.low }}</span>
                        <span class="label">Close</span> <span class="val red">{{ chart1.stats.close }}</span>
                        <span class="label">CHANGE</span> <span class="val red">{{ chart1.stats.changeVal }}</span>
                        <span class="label">Range</span> <span class="val red">{{ chart1.stats.range }}</span>
                    </div>

                    <!-- MA Row -->
                    <div class="ma-row">
                        <span class="dim arrow-down">▼</span>
                        <span class="ma-item yellow">MA(7) {{ chart1.ma.ma7 }}</span>
                        <span class="ma-item pink">MA(25) {{ chart1.ma.ma25 }}</span>
                        <span class="ma-item purple">MA(99) {{ chart1.ma.ma99 }}</span>
                    </div>

                    <!-- Chart Area -->
                    <div class="chart-area-wrap">
                        <div class="canvas-box">
                            <!-- Background Grid Labels -->
                            <div class="y-labels">
                                <span>0.10000</span>
                                <span>0.08000</span>
                            </div>
                            <!-- Current Price Badge -->
                            <div class="price-badge-right green">{{ chart1.price }}</div>
                            <!-- Low Label -->
                            <div class="low-pivot">
                                <div class="pivot-line"></div>
                                <span>0.04530</span>
                            </div>
                            
                            <!-- SVG Chart Simulation -->
                            <svg width="100%" height="150" viewBox="0 0 1000 150" preserveAspectRatio="none">
                                <rect x="50" y="80" width="10" height="20" fill="#FF00D6" />
                                <rect x="70" y="70" width="10" height="40" fill="#FF00D6" />
                                <rect x="90" y="90" width="10" height="30" fill="#DFFF00" />
                                <rect x="110" y="85" width="10" height="15" fill="#FF00D6" />
                                <rect x="130" y="75" width="10" height="50" fill="#FF00D6" />
                                <rect x="150" y="100" width="10" height="10" fill="#DFFF00" />
                                <path d="M0 100 L200 80 L400 90 L600 70 L800 85 L1000 75" fill="none" stroke="var(--primary)" stroke-width="1.5" />
                                <path d="M0 110 L200 95 L400 100 L600 85 L800 95 L1000 88" fill="none" stroke="#f25dfc" stroke-width="1.5" />
                            </svg>
                        </div>
                    </div>

                    <!-- Volume Stats Area -->
                    <div class="volume-block">
                        <div class="vol-labels">
                            <span class="dim arrow-down">▼</span>
                            <span class="label">Vol(POLYX)</span> <span class="val white">{{ chart1.volume.polyx }}</span>
                            <span class="label">Vol(USDT)</span> <span class="val white">{{ chart1.volume.usdt }}</span>
                            <span class="label amount cyan">{{ chart1.volume.amount }}</span>
                            <span class="label amount pink">{{ chart1.volume.amount2 }}</span>
                        </div>
                        <div class="vol-viz">
                            <div class="vol-bars">
                                <div class="v-bar green" style="height: 40%"></div>
                                <div class="v-bar red" style="height: 60%"></div>
                                <div class="v-bar green" style="height: 30%"></div>
                                <div class="v-bar green" style="height: 70%"></div>
                                <div class="v-bar red" style="height: 20%"></div>
                                <div class="v-bar red" style="height: 50%"></div>
                            </div>
                            <div class="vol-labels-y">
                                <span>2B</span>
                                <span>1B</span>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-row">
                        <span class="time">12/01</span>
                        <span class="year">2026</span>
                    </div>
                </div>

                <!-- CHART 2 -->
                <div class="chart-block border-top">
                    <!-- Similar Chart 2 Structure ... -->
                     <div class="block-header">
                        <div class="period-list">
                            <span v-for="p in periods" :key="p" :class="{active: activePeriod === p}">{{ p }}</span>
                            <ChevronDown size="12" class="dim" />
                        </div>
                        <div class="pair-stats-header">
                            <span class="p-name">{{ chart2.pair }}</span>
                            <span class="p-price" :class="{positive: chart2.isPricePositive}">{{ chart2.price }}</span>
                            <span class="p-change" :class="{negative: !chart2.isChangePositive}">{{ chart2.change }}</span>
                        </div>
                    </div>
                    <div class="ohlc-row">
                        <span class="dim arrow-down">▼</span>
                        <span class="date">{{ chart2.stats.date }}</span>
                        <span class="label">Open</span> <span class="val red">{{ chart2.stats.open }}</span>
                        <span class="label">High</span> <span class="val red">{{ chart2.stats.high }}</span>
                        <span class="label">Low</span> <span class="val red">{{ chart2.stats.low }}</span>
                        <span class="label">Close</span> <span class="val red">{{ chart2.stats.close }}</span>
                        <span class="label">CHANGE</span> <span class="val red">{{ chart2.stats.changeVal }}</span>
                        <span class="label">Range</span> <span class="val red">{{ chart2.stats.range }}</span>
                    </div>
                    <!-- MA/Chart simulation omitted for space, identical to Chart 1 pattern -->
                    <div class="chart-area-wrap">
                        <div class="canvas-box">
                            <svg width="100%" height="150" viewBox="0 0 1000 150" preserveAspectRatio="none">
                                <rect x="50" y="90" width="10" height="15" fill="#FF00D6" />
                                <rect x="80" y="100" width="10" height="20" fill="#DFFF00" />
                                <rect x="110" y="80" width="10" height="40" fill="#FF00D6" />
                                <path d="M0 120 L300 100 L1000 95" fill="none" stroke="var(--primary)" stroke-width="1.5" />
                            </svg>
                        </div>
                    </div>
                    <div class="timeline-row">
                        <span class="time">12/01</span>
                        <span class="year">2026</span>
                    </div>
                </div>
            </div>

            <!-- TAB 2: Funding Rate History Content -->
            <div v-else class="funding-content">
                <!-- Real-Time Funding Rate -->
                <div class="funding-section">
                    <div class="section-top-link">
                        <span>Real-Time Funding Rate</span>
                        <ChevronRight size="16" />
                    </div>
                    <div class="funding-table">
                        <div class="f-row"><span class="fl">Symbol</span><span class="fv white">{{ realTimeFunding.symbol }}</span></div>
                        <div class="f-row"><span class="fl">Interval</span><span class="fv white">{{ realTimeFunding.interval }}</span></div>
                        <div class="f-row"><span class="fl">Time to Next Funding</span><span class="fv white">{{ realTimeFunding.nextFunding }}</span></div>
                        <div class="f-row"><span class="fl">Funding Rate</span><span class="fv positive">{{ realTimeFunding.fundingRate }}</span></div>
                        <div class="f-row"><span class="fl">Interest Rate</span><span class="fv white">{{ realTimeFunding.interestRate }}</span></div>
                        <div class="f-row"><span class="fl">Funding Cap/Floor</span><span class="fv white">{{ realTimeFunding.capFloor }}</span></div>
                    </div>
                </div>

                <!-- Funding Rates Graph -->
                <div class="funding-section border-top">
                    <div class="section-title-box">
                        <span class="st">Funding Rates - 3d (APY/APR)</span>
                    </div>
                    <div class="apy-chart-wrap">
                        <div class="y-labels-abs">
                            <span>0.04000%</span>
                            <span>0.00000%</span>
                            <span>-0.08000%</span>
                        </div>
                        <svg width="100%" height="120" viewBox="0 0 1000 120" preserveAspectRatio="none">
                            <path d="M0 60 L100 40 L200 55 L300 30 L400 70 L500 50 L600 80 L700 45 L800 60 L900 35 L1000 65" fill="none" stroke="var(--primary)" stroke-width="2" />
                            <path d="M0 60 L100 40 L200 55 L300 30 L400 70 L500 50 L600 80 L700 45 L800 60 L900 35 L1000 65 V120 H0 Z" fill="url(#grad)" opacity="0.2" />
                            <defs>
                                <linearGradient id="grad" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color:var(--primary);stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:var(--primary);stop-opacity:0" />
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="x-labels-funding">
                            <span>01-02</span>
                            <span>01-02</span>
                            <span>01-03</span>
                            <span>01-03</span>
                            <span>01-03</span>
                        </div>
                    </div>
                </div>

                <!-- History List -->
                <div class="funding-section border-top">
                    <div class="section-top-link">
                        <span>Funding Rate History</span>
                        <ChevronRight size="16" />
                    </div>
                    <div class="history-list">
                        <div v-for="(item, idx) in historyList" :key="idx" class="history-item">
                            <div class="h-row"><span class="hl">Time</span><span class="hv white">{{ item.time }}</span></div>
                            <div class="h-row"><span class="hl">Funding Interval</span><span class="hv white">{{ item.interval }}</span></div>
                            <div class="h-row"><span class="hl">Funding Rate</span><span class="hv red">{{ item.rate }}</span></div>
                            <div class="h-row"><span class="hl">Mark Price</span><span class="hv white">{{ item.price }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.chart-screen {
    background: #181a20;
    min-height: 100vh;
    color: #fff;
    font-family: 'IBM Plex Sans', sans-serif;
    width: 100%;
    overflow-x: hidden;
}

.desktop-container {
    max-width: 1000px;
    margin: 0 auto;
    background: #111417;
    width: 100%;
    min-height: 100vh;
}

/* Sub Nav */
.sub-nav {
    padding: 16px 20px;
    display: flex;
    align-items: center;
    background: #181a20;
}
.nav-left { display: flex; align-items: center; gap: 8px; cursor: pointer; color: #fff; font-size: 14px; }

/* Tabs */
.tabs-row {
    display: flex;
    gap: 32px;
    padding: 0 20px;
    background: #181a20;
}

.tab {
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    padding-bottom: 12px;
    cursor: pointer;
    position: relative;
    white-space: nowrap;
}

.tab.active { color: #fff; }
.tab.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--primary);
    border-radius: 2px;
}

/* Common Section */
.border-top { border-top: 8px solid #0b0e11; }

/* Chart Styling ... same as previous */
.chart-block { padding: 20px; background: #181a20; }
.block-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
.period-list { display: flex; align-items: center; gap: 16px; }
.period-list span { font-size: 13px; color: #fff; cursor: pointer; }
.period-list span.active { color: #fff; font-weight: 600; }
.pair-stats-header { display: flex; align-items: center; gap: 12px; }
.p-name { font-size: 14px; font-weight: 700; }
.p-price { font-size: 14px; font-weight: 700; }
.p-change { font-size: 13px; font-weight: 600; }
.positive { color: #DFFF00; }
.red { color: #FF00D6; }
.dim { color: #fff; }
.white { color: #eaecef; }

.ohlc-row { font-size: 11px; display: flex; align-items: center; gap: 8px; margin-bottom: 8px; flex-wrap: wrap; }
.ma-row { font-size: 11px; display: flex; align-items: center; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
.chart-area-wrap { height: 200px; position: relative; border-bottom: 1px solid #2b3139; margin-bottom: 8px; }
.canvas-box { position: relative; height: 100%; }
.y-labels { position: absolute; right: 8px; top: 8px; display: flex; flex-direction: column; gap: 24px; font-size: 11px; color: #fff; text-align: right; }
.price-badge-right { position: absolute; right: 0; top: 50%; transform: translateY(-50%); color: #fff; font-size: 11px; padding: 4px 8px; border-radius: 4px; z-index: 10; }
.price-badge-right.green { background: #DFFF00; }
.low-pivot { position: absolute; bottom: 20px; left: 40%; display: flex; flex-direction: column; align-items: center; }
.timeline-row { display: flex; justify-content: space-between; font-size: 11px; color: #fff; padding-top: 12px; }

/* Funding Content */
.funding-content {
    background: #181a20;
}
.funding-section {
    padding: 20px;
    background: #181a20;
}
.section-top-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #fff;
}

.funding-table {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.f-row {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
}
.fl { color: #fff; }
.fv { font-weight: 500; }

.section-title-box {
    margin-bottom: 16px;
}
.st { font-size: 13px; color: #fff; font-weight: 500; }

.apy-chart-wrap {
    height: 160px;
    position: relative;
    padding-top: 20px;
}
.y-labels-abs {
    position: absolute;
    left: 0;
    top: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100px;
    font-size: 10px;
    color: #fff;
}
.x-labels-funding {
    display: flex;
    justify-content: space-between;
    padding-top: 12px;
    font-size: 11px;
    color: #fff;
}

.history-list {
    display: flex;
    flex-direction: column;
}
.history-item {
    padding: 16px 0;
    border-bottom: 1px solid #2b3139;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.h-row {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
}
.hl { color: #fff; }
.hv { font-weight: 500; }
</style>
