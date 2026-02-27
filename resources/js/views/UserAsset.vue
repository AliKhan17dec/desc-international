<script setup>
import { ref, computed, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { 
  Wallet, 
  History, 
  ArrowRightLeft, 
  Clock, 
  Search, 
  Filter,
  Download,
  ArrowUpRight,
  ArrowDownLeft,
  FlaskConical,
  Dna,
  Database,
  ShieldCheck,
  ChevronRight
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';
import TransactionModals from '../components/TransactionModals.vue';

const props = defineProps({
    tab: { type: String, default: 'assets' }
});

const route = useRoute();
const router = useRouter();

const currentTab = ref(props.tab || 'assets');
const showDepositModal = ref(false);

watch(() => props.tab, (newTab) => {
    currentTab.value = newTab || 'assets';
});

const assets = [
  { name: 'OSIS.science', symbol: 'OSIS', balance: '12,400', value: '$53,072', change: '+12.4%', icon: FlaskConical },
  { name: 'GenomicIP', symbol: 'DNA', balance: '2,800', value: '$4,256', change: '+5.2%', icon: Dna },
  { name: 'USD Circle', symbol: 'USDC', balance: '1,240', value: '$1,240', change: '0.0%', icon: Database },
];

const transactionHistory = [
  { type: 'Deposit', asset: 'USDC', amount: '+5,000', date: '2026-02-05 14:20', status: 'Completed' },
  { type: 'Swap', asset: 'OSIS', amount: '+2,400', date: '2026-02-04 09:12', status: 'Completed' },
  { type: 'Withdraw', asset: 'ETH', amount: '-0.5', date: '2026-02-03 18:45', status: 'Processing' },
];

const historySearch = ref('');
const filteredHistory = computed(() => {
  if (!historySearch.value) return transactionHistory;
  const q = historySearch.value.toLowerCase();
  return transactionHistory.filter(tx => 
    tx.asset.toLowerCase().includes(q) || 
    tx.type.toLowerCase().includes(q)
  );
});

const navigate = (path) => router.push(path);
</script>

<template>
  <div class="asset-page">
    <TopHeader />
    
    <div class="container">
      <div class="page-header">
        <h1 class="title">Laboratory <span class="accent">Vault</span></h1>
        <p class="subtitle">Management center for your scientific assets, research grants, and transaction history.</p>
      </div>

      <!-- Portfolio Summary -->
      <div class="portfolio-hero">
        <div class="total-balance">
            <span class="label">Total Portfolio Value</span>
            <div class="value-row">
                <span class="value">$58,568.24</span>
                <span class="currency">USD</span>
                <span class="trend up">+8.2%</span>
            </div>
        </div>
        <div class="hero-actions">
            <button class="action-btn primary" @click="showDepositModal = true"><ArrowDownLeft size="20" /> Deposit</button>
            <button class="action-btn secondary" @click="navigate('/dashboard/withdrawls')"><ArrowUpRight size="20" /> Withdraw</button>
        </div>
      </div>

      <!-- Tab Navigation -->
      <div class="asset-tabs">
        <button class="tab-btn" :class="{ active: currentTab === 'assets' }" @click="currentTab = 'assets'">Balances</button>
        <button class="tab-btn" :class="{ active: currentTab === 'history' }" @click="currentTab = 'history'">Asset History</button>
        <button class="tab-btn" :class="{ active: currentTab === 'convert' }" @click="currentTab = 'convert'">Convert History</button>
        <button class="tab-btn" :class="{ active: currentTab === 'transactions' }" @click="currentTab = 'transactions'">Transactions</button>
      </div>

      <TransactionModals 
        :showDeposit="showDepositModal"
        @close-deposit="showDepositModal = false"
      />

      <!-- Tab Content -->
      <div class="tab-content">
        <!-- Balances Tab -->
        <div v-if="currentTab === 'assets'" class="balances-view">
            <div class="table-container">
                <table class="asset-table">
                    <thead>
                        <tr>
                            <th>Asset</th>
                            <th>Total Balance</th>
                            <th>Value (USD)</th>
                            <th class="desktop-only">24h Change</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="asset in assets" :key="asset.symbol" @click="navigate('/asset/' + asset.symbol)" style="cursor: pointer">
                            <td>
                                <div class="asset-info">
                                    <div class="icon-box"><component :is="asset.icon" size="20" /></div>
                                    <div class="name-box">
                                        <span class="name">{{ asset.name }}</span>
                                        <span class="symbol">{{ asset.symbol }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="bold">{{ asset.balance }}</span></td>
                            <td><span>{{ asset.value }}</span></td>
                            <td class="desktop-only"><span class="up">{{ asset.change }}</span></td>
                            <td><button class="trade-link" @click="navigate('/token-swap')">Trade</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- History Tab (Unified view for simplicity in this demo) -->
        <div v-else class="history-view">
            <div class="history-filters">
                <div class="search-box">
                    <Search size="16" />
                    <input type="text" placeholder="Filter by asset or type..." v-model="historySearch" />
                </div>
                <button class="export-btn"><Download size="16" /> Export CSV</button>
            </div>
            
            <div class="table-container">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Asset</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="tx in filteredHistory" :key="tx.date">
                            <td><span class="tx-type">{{ tx.type }}</span></td>
                            <td><span class="tx-asset">{{ tx.asset }}</span></td>
                            <td><span class="tx-amount" :class="tx.amount.startsWith('+') ? 'up' : 'down'">{{ tx.amount }}</span></td>
                            <td><span class="tx-date">{{ tx.date }}</span></td>
                            <td>
                                <div class="status-pill" :class="tx.status.toLowerCase()">
                                    {{ tx.status }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.asset-page {
  background: #000;
  min-height: 100vh;
  color: white;
  padding-bottom: 80px;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 20px;
}

.page-header { margin-bottom: 40px; }
.title { font-size: 36px; font-weight: 800; text-transform: uppercase; }
.accent { color: var(--primary); }
.subtitle { color: #fff; font-size: 16px; max-width: 600px; }

/* Portfolio Hero */
.portfolio-hero {
    background: #0d0d0d;
    border: 1px solid #1a1a1a;
    border-radius: 24px;
    padding: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    flex-wrap: wrap;
    gap: 32px;
}

.total-balance .label { font-size: 12px; text-transform: uppercase; color: #fff; letter-spacing: 1px; margin-bottom: 12px; display: block; }
.value-row { display: flex; align-items: baseline; gap: 12px; }
.value-row .value { font-size: 44px; font-weight: 800; }
.value-row .currency { font-size: 18px; color: #fff; font-weight: 700; }
.value-row .trend { font-size: 18px; font-weight: 700; }
.up { color: var(--primary); }
.down { color: #ff3b30; }

.hero-actions { display: flex; gap: 16px; }
.action-btn {
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 800;
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    transition: all 0.3s;
}

.action-btn.primary { background: var(--primary); color: black; border: none; }
.action-btn.secondary { background: #1a1a1a; color: white; border: 1px solid #222; }
.action-btn:hover { transform: translateY(-3px); }

/* Tabs */
.asset-tabs {
    display: flex;
    gap: 8px;
    border-bottom: 1px solid #1a1a1a;
    margin-bottom: 32px;
}

.tab-btn {
    padding: 16px 24px;
    background: transparent;
    border: none;
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    position: relative;
    transition: color 0.3s;
}

.tab-btn.active { color: var(--primary); }
.tab-btn.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--primary);
}

/* Tables */
.table-container { overflow-x: auto; }
.asset-table, .history-table { width: 100%; border-collapse: collapse; }
.asset-table th, .history-table th { text-align: left; padding: 16px; font-size: 12px; color: #fff; text-transform: uppercase; border-bottom: 1px solid #1a1a1a; }
.asset-table td, .history-table td { padding: 20px 16px; border-bottom: 1px solid #111; }

.asset-info { display: flex; align-items: center; gap: 16px; }
.icon-box { width: 40px; height: 40px; background: #1a1a1a; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); }
.name-box .name { display: block; font-weight: 700; }
.name-box .symbol { font-size: 12px; color: #fff; }

.bold { font-weight: 800; font-size: 16px; }

.trade-link { background: transparent; border: 1px solid #fff; color: #fff; padding: 6px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all 0.3s; }
.trade-link:hover { border-color: var(--primary); color: var(--primary); }

/* History View */
.history-filters { display: flex; justify-content: space-between; margin-bottom: 24px; }
.search-box { background: #111; border: 1px solid #1a1a1a; padding: 10px 16px; border-radius: 10px; display: flex; align-items: center; gap: 12px; flex: 1; max-width: 300px; }
.search-box input { background: transparent; border: none; color: white; outline: none; font-size: 14px; width: 100%; }

.export-btn { background: transparent; border: none; color: #fff; font-size: 13px; font-weight: 700; display: flex; align-items: center; gap: 8px; cursor: pointer; }

.tx-type { font-weight: 700; }
.tx-amount.up { color: var(--primary); }
.tx-amount.down { color: #ff3b30; }
.tx-date { color: #fff; font-size: 13px; }

.status-pill { font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 4px 10px; border-radius: 6px; width: fit-content; }
.status-pill.completed { background: rgba(223, 255, 0, 0.1); color: var(--primary); }
.status-pill.processing { background: rgba(59, 130, 246, 0.1); color: #3B82F6; }

@media (max-width: 768px) {
    .desktop-only { display: none; }
    
    .title { font-size: 26px; }
    .subtitle { font-size: 13px; }
    
    .portfolio-hero { padding: 24px; text-align: center; justify-content: center; }
    .total-balance { width: 100%; }
    .value-row { justify-content: center; flex-wrap: wrap; gap: 8px; }
    .value-row .value { font-size: 28px; }
    .value-row .currency, .value-row .trend { font-size: 14px; }
    
    .hero-actions { width: 100%; flex-direction: column; gap: 12px; }
    .action-btn { justify-content: center; width: 100%; padding: 12px; }
    
    .asset-tabs { 
        flex-wrap: wrap;
        gap: 8px;
        border-bottom: none;
    }
    
    .tab-btn { 
        padding: 10px 14px; 
        font-size: 13px;
        background: #0d0d0d;
        border: 1px solid #1a1a1a;
        border-radius: 8px;
        flex: 1 1 calc(50% - 8px);
        min-width: 120px;
    }
    
    .tab-btn.active { 
        background: var(--primary); 
        color: black; 
        border-color: var(--primary);
    }
    
    .tab-btn.active::after { display: none; }
    
    .history-filters { flex-direction: column; gap: 12px; }
    .search-box { max-width: 100%; }
    
    /* Optimize Table for small screens */
    .table-container { overflow-x: visible; }
    .asset-table, .history-table { font-size: 12px; }
    
    /* Hide non-essential columns on mobile */
    .asset-table th:nth-child(2), .asset-table td:nth-child(2),
    .asset-table th:nth-child(3), .asset-table td:nth-child(3) { display: none; }
    
    .history-table th:nth-child(3), .history-table td:nth-child(3),
    .history-table th:nth-child(4), .history-table td:nth-child(4) { display: none; }

    .asset-table th, .asset-table td, 
    .history-table th, .history-table td { 
        padding: 12px 6px; 
    }
}

@media (max-width: 480px) {
    .container { padding: 20px 12px; }
    .tab-btn { flex: 1 1 100%; }
    
    .asset-info { gap: 8px; }
    .icon-box { width: 28px; height: 28px; }
    .name-box .name { font-size: 12px; }
    .name-box .symbol { font-size: 10px; }
    
    .trade-link { padding: 4px 8px; font-size: 11px; }
}
</style>
