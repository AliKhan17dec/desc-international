<script setup>
import { ref, defineEmits } from 'vue';
import { Search, X, TrendingUp, Zap } from 'lucide-vue-next';

const emit = defineEmits(['close', 'select-pair']);

const searchQuery = ref('');
const activeMarketType = ref('USD©-M');
const activeFilter = ref('All');

const marketTypes = ['USD©-M', 'COIN-M'];
const filters = ['All', 'Positive Carry', 'Reverse Carry'];

const tradingPairs = [
    { 
        icon: '₿', 
        iconColor: '#F7931A',
        pair: 'BTC/USDT', 
        tag: 'Perp',
        portfolio: true,
        funding3d: '0.04447%',
        apr: '5.41%',
        change: '+5.41%',
        isPositive: true
    },
    { 
        icon: 'Ξ', 
        iconColor: '#627EEA',
        pair: 'ETH/USDT', 
        tag: 'Perp',
        portfolio: false,
        funding3d: '0.04627%',
        apr: '6.72%',
        change: '+6.72%',
        isPositive: true
    },
    { 
        icon: 'B', 
        iconColor: '#8DC351',
        pair: 'BCH/USDT', 
        tag: 'Perp',
        portfolio: false,
        funding3d: '-0.08773%',
        apr: '10.67%',
        change: '+10.67%',
        isPositive: true
    },
    { 
        icon: 'X', 
        iconColor: '#E84142',
        pair: 'XRP/USDT', 
        tag: 'Perp',
        portfolio: false,
        funding3d: '0.00791%',
        apr: '0.96%',
        change: '+0.96%',
        isPositive: true
    },
    { 
        icon: 'L', 
        iconColor: '#345D9D',
        pair: 'LTC/USDT', 
        tag: 'Perp',
        portfolio: false,
        funding3d: '0.06912%',
        apr: '8.40%',
        change: '+8.40%',
        isPositive: true
    },
    { 
        icon: 'T', 
        iconColor: '#F32F6F',
        pair: 'TRX/USDT', 
        tag: 'Perp',
        portfolio: false,
        funding3d: '-0.02810%',
        apr: '-3.41%',
        change: '-3.41%',
        isPositive: false
    },
    { 
        icon: 'E', 
        iconColor: '#50AF95',
        pair: 'ETC/USDT', 
        tag: 'Perp',
        portfolio: false,
        funding3d: '0.02976%',
        apr: '3.61%',
        change: '+3.61%',
        isPositive: true
    },
];

const filteredPairs = ref(tradingPairs);

const handleSearch = () => {
    if (!searchQuery.value) {
        filteredPairs.value = tradingPairs;
        return;
    }
    filteredPairs.value = tradingPairs.filter(pair => 
        pair.pair.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
};

const selectPair = (pair) => {
    emit('select-pair', pair);
    emit('close');
};

const closeModal = () => {
    emit('close');
};
</script>

<template>
    <div class="modal-overlay" @click.self="closeModal">
        <div class="market-modal">
            <!-- Header -->
            <div class="modal-header">
                <h3>Market</h3>
                <X size="20" class="close-btn" @click="closeModal" />
            </div>

            <!-- Search -->
            <div class="search-section">
                <div class="search-box">
                    <Search size="16" class="search-icon" />
                    <input 
                        type="text" 
                        v-model="searchQuery" 
                        @input="handleSearch"
                        placeholder="Search" 
                    />
                </div>
            </div>

            <!-- Market Type Tabs -->
            <div class="market-tabs">
                <div 
                    v-for="type in marketTypes" 
                    :key="type"
                    class="tab"
                    :class="{ active: activeMarketType === type }"
                    @click="activeMarketType = type"
                >
                    {{ type }}
                </div>
                <div class="tab-actions">
                    <span>3D</span>
                    <Zap size="14" />
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="filter-tabs">
                <div 
                    v-for="filter in filters" 
                    :key="filter"
                    class="filter-tab"
                    :class="{ active: activeFilter === filter }"
                    @click="activeFilter = filter"
                >
                    {{ filter }}
                </div>
                <div class="info-icon">?</div>
            </div>

            <!-- Table Header -->
            <div class="table-header">
                <div class="col-pair">Portfolio <TrendingUp size="12" /></div>
                <div class="col-funding">3D Funding% <TrendingUp size="12" /></div>
                <div class="col-apr">APR <TrendingUp size="12" /></div>
            </div>

            <!-- Pairs List -->
            <div class="pairs-list">
                <div 
                    v-for="(pair, index) in filteredPairs" 
                    :key="index"
                    class="pair-row"
                    @click="selectPair(pair)"
                >
                    <!-- Left: Icon + Name -->
                    <div class="pair-info">
                        <div class="pair-icon" :style="{ backgroundColor: pair.iconColor }">
                            {{ pair.icon }}
                        </div>
                        <div class="pair-details">
                            <div class="pair-name-row">
                                <span v-if="pair.portfolio" class="portfolio-star">⭐</span>
                                <span class="pair-name">{{ pair.pair }}</span>
                                <span class="pair-tag">{{ pair.tag }}</span>
                            </div>
                            <div class="pair-subtitle">{{ pair.pair.split('/')[1] }}</div>
                        </div>
                    </div>

                    <!-- Right: Stats -->
                    <div class="pair-stats">
                        <div class="stat-item">
                            <span class="funding-val">{{ pair.funding3d }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="apr-val" :class="{ positive: pair.isPositive, negative: !pair.isPositive }">
                                {{ pair.change }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: flex-end;
    z-index: 9999;
    backdrop-filter: blur(4px);
}

.market-modal {
    background: #1a1a1a;
    width: 100%;
    max-height: 80vh;
    border-radius: 16px 16px 0 0;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

/* Header */
.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid #2a2a2a;
}

.modal-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: white;
}

.close-btn {
    color: #888;
    cursor: pointer;
}

/* Search */
.search-section {
    padding: 16px 20px;
}

.search-box {
    background: #0a0a0a;
    border: 1px solid #333;
    border-radius: 8px;
    padding: 10px 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-icon {
    color: #666;
}

.search-box input {
    background: transparent;
    border: none;
    color: white;
    font-size: 14px;
    width: 100%;
    outline: none;
}

.search-box input::placeholder {
    color: #666;
}

/* Market Tabs */
.market-tabs {
    display: flex;
    align-items: center;
    padding: 0 20px 12px 20px;
    border-bottom: 1px solid #2a2a2a;
}

.market-tabs .tab {
    font-size: 14px;
    color: #666;
    cursor: pointer;
    padding: 8px 16px;
    position: relative;
    font-weight: 500;
}

.market-tabs .tab.active {
    color: var(--primary);
}

.market-tabs .tab.active::after {
    content: '';
    position: absolute;
    bottom: -13px;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--primary);
}

.tab-actions {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: #888;
}

/* Filter Tabs */
.filter-tabs {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    gap: 12px;
}

.filter-tab {
    font-size: 13px;
    color: #666;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 4px;
}

.filter-tab.active {
    color: white;
    background: #2a2a2a;
}

.info-icon {
    margin-left: auto;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    border: 1px solid #666;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    color: #666;
    cursor: pointer;
}

/* Table Header */
.table-header {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    padding: 12px 20px;
    font-size: 11px;
    color: #666;
    background: #131313;
}

.col-pair,
.col-funding,
.col-apr {
    display: flex;
    align-items: center;
    gap: 4px;
}

.col-funding,
.col-apr {
    justify-content: flex-end;
}

/* Pairs List */
.pairs-list {
    flex: 1;
    overflow-y: auto;
    padding: 0 20px 20px 20px;
}

.pair-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    padding: 14px 0;
    border-bottom: 1px solid #222;
    cursor: pointer;
    transition: background 0.2s;
}

.pair-row:hover {
    background: rgba(255, 255, 255, 0.02);
}

/* Pair Info */
.pair-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.pair-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    color: white;
}

.pair-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.pair-name-row {
    display: flex;
    align-items: center;
    gap: 6px;
}

.portfolio-star {
    font-size: 10px;
}

.pair-name {
    font-size: 14px;
    font-weight: 600;
    color: white;
}

.pair-tag {
    background: #333;
    color: #888;
    font-size: 9px;
    padding: 2px 4px;
    border-radius: 2px;
}

.pair-subtitle {
    font-size: 11px;
    color: #666;
}

/* Stats */
.pair-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    align-items: center;
}

.stat-item {
    text-align: right;
}

.funding-val {
    font-size: 13px;
    color: white;
    font-weight: 500;
}

.apr-val {
    font-size: 13px;
    font-weight: 600;
}

.apr-val.positive {
    color: #DFFF00;
}

.apr-val.negative {
    color: #f6465d;
}

/* Scrollbar */
.pairs-list::-webkit-scrollbar {
    width: 4px;
}

.pairs-list::-webkit-scrollbar-thumb {
    background: #333;
    border-radius: 2px;
}
</style>
