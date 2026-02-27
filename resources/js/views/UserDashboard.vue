<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { 
  User, 
  ShieldCheck, 
  Search, 
  Eye, 
  EyeOff, 
  MessageCircle, 
  Twitter, 
  Github, 
  Globe, 
  Pencil, 
  ChevronDown,
  TrendingUp,
  FlaskConical,
  Microscope,
  Zap,
  ArrowRight,
  FileSearch,
  Mail,
  Smartphone,
  Shield,
  Pencil as EditIcon,
  HelpCircle,
  Bell,
  ArrowUpRight,
  ChevronRight,
  LayoutDashboard,
  Wallet,
  Settings,
  Award
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const showBalance = ref(true);

const assets = ref([
  { coin: 'USDT', name: 'TetherUS', total: '1,240.85', available: '1,240.85', inOrder: '0.00', value: '1.00', up: true },
  { coin: 'BTC', name: 'Bitcoin', total: '0.04821', available: '0.04821', value: '96,242', up: true },
  { coin: 'ETH', name: 'Ethereum', total: '0.42105', available: '0.42105', value: '2,842', up: false },
  { coin: 'SKIN', name: 'DermaLabs', total: '2,500', available: '2,500', value: '0.45', up: true },
]);

const newsFeed = ref([
  { id: 1, date: '2026-02-12', title: 'DeSci International Stage 1 nodes deployed', type: 'System' },
  { id: 2, date: '2026-02-10', title: 'New IP-NFT verification protocols', type: 'Protocol' },
  { id: 3, date: '2026-02-09', title: 'Weekly Research Summary: Longevity', type: 'Research' },
]);

const userData = ref(null);

onMounted(() => {
    const stored = localStorage.getItem('user');
    if (stored) {
        try {
            userData.value = JSON.parse(stored);
        } catch (e) {
            console.error('Failed to parse user data');
        }
    }
});

const navigate = (path) => {
  if (path) router.push(path);
};
</script>

<template>
  <div class="dashboard-page">
    <TopHeader />

    <main class="main-container">
      <!-- Profile Header -->
      <section class="profile-header">
          <div class="header-left">
              <div class="avatar-box">
                  <User size="32" class="gold-icon" />
              </div>
              <div class="profile-titles">
                  <h2>{{ userData ? userData.name : 'Guest Researcher' }}</h2>
                  <p>UID: {{ userData ? userData.id : '---' }} | Tier 0 Node Member</p>
              </div>
          </div>
          <div class="header-right">
              <div class="security-badges">
                  <ShieldCheck size="18" class="active-icon" title="KYC Verified" />
                  <Mail size="18" class="active-icon" title="Email Verified" />
                  <Smartphone size="18" title="SMS Not Linked" />
              </div>
              <button class="icon-btn"><Settings size="18"/></button>
          </div>
      </section>

      <!-- Dashboard Content Grid -->
      <div class="dashboard-grid">
          <!-- Main Financials -->
          <div class="financials-column">
              <div class="card balance-card">
                  <div class="card-head">
                      <span class="label">Protocol Balance</span>
                      <button class="eye-toggle" @click="showBalance = !showBalance">
                          <Eye v-if="showBalance" size="14" />
                          <EyeOff v-else size="14" />
                      </button>
                  </div>
                  <div class="card-body">
                      <h1>{{ showBalance ? '14,242.85' : '********' }} <span class="currency">USD</span></h1>
                      <p class="btc-val">≈ {{ showBalance ? '0.14821059' : '********' }} BTC</p>
                  </div>
                  <div class="pnl-bar">
                      <span class="pnl-lbl">Today's PnL</span>
                      <span class="pnl-val positive">+$124.50 (0.88%)</span>
                  </div>
                  <div class="action-buttons">
                      <button class="btn btn-primary" @click="navigate('/deposit')">Deposit</button>
                      <button class="btn btn-border" @click="navigate('/dashboard/withdrawls')">Withdraw</button>
                      <button class="btn btn-border" @click="navigate('/token-swap')">Swap</button>
                  </div>
              </div>

              <div class="card assets-card">
                  <div class="card-head">
                      <h3>Proprietary Assets</h3>
                      <button class="text-link">History <ArrowUpRight size="14"/></button>
                  </div>
                  <div class="asset-rows">
                      <div v-for="a in assets" :key="a.coin" class="asset-row" @click="navigate(`/asset/${a.coin}`)">
                          <div class="asset-info">
                              <div class="coin-symbol-box">{{ a.coin.charAt(0) }}</div>
                              <div class="coin-names">
                                  <span class="symbol">{{ a.coin }}</span>
                                  <span class="name">{{ a.name }}</span>
                              </div>
                          </div>
                          <div class="asset-values">
                              <span class="total">{{ a.total }}</span>
                              <span class="fiat" :class="{ up: a.up, down: !a.up }">${{ a.value }}</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Side Updates -->
          <div class="updates-column">
              <div class="card promo-card" @click="navigate('/spot-grid-bots')">
                  <div class="promo-content">
                      <div class="promo-icon"><FlaskConical size="24" class="gold-icon" /></div>
                      <div class="promo-text">
                          <h4>Explore Algo Lab</h4>
                          <p>Deploy research bots on nodes.</p>
                      </div>
                  </div>
                  <ArrowRight size="20" class="gold-icon" />
              </div>

              <div class="card announcements-card">
                  <div class="card-head">
                      <h3>Lab Announcements</h3>
                      <Bell size="18" class="dim" />
                  </div>
                  <div class="ann-list">
                      <div v-for="item in newsFeed" :key="item.id" class="ann-item" @click="navigate('/announcements')">
                          <span class="ann-meta">{{ item.date }} • {{ item.type }}</span>
                          <p class="ann-title">{{ item.title }}</p>
                      </div>
                  </div>
              </div>

              <div class="card support-card">
                  <HelpCircle size="24" class="gold-icon" />
                  <div class="support-text">
                      <h4>DeSci Support</h4>
                      <p>24/7 dedicated node assistance.</p>
                  </div>
                  <ChevronRight size="18" class="dim" />
              </div>
          </div>
      </div>
    </main>

    <footer class="dashboard-footer">
        <div class="footer-inner">
            <div class="footer-left">
                <Award size="20" class="gold-icon" />
                <span>DeSci International Dashboard</span>
            </div>
            <div class="footer-right">© 2026 Protocol Nodes V2.4</div>
        </div>
    </footer>
  </div>
</template>

<style scoped>
.dashboard-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'Inter', sans-serif;
}

.main-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 20px;
}

.gold-icon { color: #dfff00; }
.dim { color: #444; }
.positive { color: #dfff00; }
.up { color: #dfff00; }
.down { color: #FF00D6; }

/* Profile Header */
.profile-header {
    background: #111;
    border: 1px solid #222;
    border-radius: 20px;
    padding: 24px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}
.header-left { display: flex; align-items: center; gap: 20px; }
.avatar-box { width: 56px; height: 56px; background: #0d0d0d; border: 1px solid #222; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
.profile-titles h2 { font-size: 22px; font-weight: 700; }
.profile-titles p { font-size: 13px; color: #666; margin-top: 4px; }

.header-right { display: flex; align-items: center; gap: 24px; }
.security-badges { display: flex; gap: 12px; color: #333; }
.active-icon { color: #dfff00; }
.icon-btn { background: transparent; border: none; color: #666; cursor: pointer; }

/* Grid */
.dashboard-grid { display: grid; grid-template-columns: 1fr 360px; gap: 30px; }
@media (max-width: 1024px) {
    .dashboard-grid { grid-template-columns: 1fr; }
}

.financials-column, .updates-column { display: flex; flex-direction: column; gap: 24px; }

/* Card */
.card { background: #111; border: 1px solid #222; border-radius: 20px; padding: 24px; }
.card-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.card-head h3 { font-size: 16px; font-weight: 700; }
.label { font-size: 12px; color: #666; text-transform: uppercase; font-weight: 700; }
.text-link { background: transparent; border: none; font-size: 12px; color: #666; display: flex; align-items: center; gap: 6px; cursor: pointer; }

/* Balance Card */
.balance-card { border-color: rgba(223, 255, 0, 0.1); background: linear-gradient(135deg, #111 0%, #0d0d0d 100%); }
.eye-toggle { background: transparent; border: none; color: #444; cursor: pointer; }
.card-body h1 { font-size: 36px; font-weight: 800; }
.currency { font-size: 18px; color: #444; }
.btc-val { font-size: 13px; color: #444; margin-top: 4px; }
.pnl-bar { margin-top: 24px; background: rgba(255, 255, 255, 0.02); padding: 12px 16px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; }
.pnl-lbl { font-size: 12px; color: #666; }
.pnl-val { font-size: 14px; font-weight: 700; }
.action-buttons { margin-top: 30px; display: flex; gap: 12px; }
.btn { flex: 1; padding: 12px; border-radius: 10px; font-weight: 700; font-size: 14px; cursor: pointer; }
.btn-primary { background: #dfff00; color: #000; border: none; }
.btn-border { background: transparent; border: 1px solid #222; color: #fff; }

/* Assets Rows */
.asset-rows { display: flex; flex-direction: column; gap: 8px; }
.asset-row { display: flex; justify-content: space-between; align-items: center; padding: 12px; border-radius: 12px; cursor: pointer; transition: background 0.2s; }
.asset-row:hover { background: #1a1a1a; }
.asset-info { display: flex; align-items: center; gap: 12px; }
.coin-symbol-box { width: 40px; height: 40px; background: #0a0a0a; border: 1px solid #1a1a1a; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #dfff00; }
.coin-names { display: flex; flex-direction: column; }
.symbol { font-weight: 700; font-size: 15px; }
.name { font-size: 11px; color: #444; }
.asset-values { text-align: right; }
.total { font-weight: 700; display: block; }
.fiat { font-size: 11px; }

/* Promo Card */
.promo-card { cursor: pointer; display: flex; justify-content: space-between; align-items: center; }
.promo-content { display: flex; align-items: center; gap: 16px; }
.promo-icon { width: 48px; height: 48px; background: rgba(223, 255, 0, 0.05); border-radius: 12px; display: flex; align-items: center; justify-content: center; }
.promo-text h4 { font-size: 15px; font-weight: 700; }
.promo-text p { font-size: 11px; color: #666; }

/* Ann Card */
.ann-list { display: flex; flex-direction: column; gap: 16px; }
.ann-item { cursor: pointer; }
.ann-meta { font-size: 10px; color: #444; text-transform: uppercase; }
.ann-title { font-size: 13px; color: #888; margin-top: 4px; line-height: 1.4; }
.ann-item:hover .ann-title { color: #fff; }

/* Support Card */
.support-card { display: flex; align-items: center; gap: 16px; cursor: pointer; }
.support-text h4 { font-size: 14px; font-weight: 700; }
.support-text p { font-size: 11px; color: #444; }

/* Footer */
.dashboard-footer { padding: 40px 20px; border-top: 1px solid #111; margin-top: 40px; }
.footer-inner { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; font-size: 12px; color: #444; font-weight: 600; }
.footer-left { display: flex; align-items: center; gap: 10px; }

@media (max-width: 768px) {
    .profile-header { flex-direction: column; align-items: flex-start; gap: 20px; }
    .header-right { width: 100%; justify-content: space-between; }
    .action-buttons { gap: 8px; }
    .btn { padding: 8px 12px; font-size: 12px; border-radius: 8px; }
}
</style>
