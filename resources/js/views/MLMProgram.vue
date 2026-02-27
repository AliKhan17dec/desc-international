<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  Copy, 
  ExternalLink, 
  ChevronDown, 
  Info, 
  BarChart3, 
  Users, 
  UserCheck, 
  Wallet,
  TrendingUp,
  Share2,
  Calendar,
  Monitor,
  Hexagon,
  Smartphone,
  Gift,
  HelpCircle,
  Search,
  User,
  Menu
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const activeSubTab = ref('Overview');
const subNavItems = ['Overview', 'My Commission', 'Referrals', 'Links', 'Campaigns'];

const activeStatsTab = ref('All');
const statsTabs = ['All', 'Spot', 'Futures'];

const vipLevels = [
  { level: 'VIP 1', volume: '≥ 1,000,000 USD', condition: 'And', balance: '25 BNB' },
  { level: 'VIP 2', volume: '≥ 5,000,000 USD', condition: 'And', balance: '100 BNB' },
  { level: 'VIP 3', volume: '≥ 20,000,000 USD', condition: 'And', balance: '250 BNB' },
  { level: 'VIP 4', volume: '≥ 75,000,000 USD', condition: 'And', balance: '500 BNB' },
  { level: 'VIP 5', volume: '≥ 150,000,000 USD', condition: 'And', balance: '1,000 BNB' },
  { level: 'VIP 6', volume: '≥ 400,000,000 USD', condition: 'And', balance: '1,750 BNB' },
  { level: 'VIP 7', volume: '≥ 800,000,000 USD', condition: 'And', balance: '3,000 BNB' },
  { level: 'VIP 8', volume: '≥ 2,000,000,000 USD', condition: 'And', balance: '4,500 BNB' },
  { level: 'VIP 9', volume: '≥ 4,000,000,000 USD', condition: 'And', balance: '5,500 BNB' },
];

const copyToClipboard = (text) => {
  navigator.clipboard.writeText(text);
};
</script>

<template>
  <div class="mlm-page">
    <TopHeader />

    <!-- Sub-Header Navigation -->
    <div class="mlm-nav-bar">
      <div class="container nav-content">
        <div class="main-category">
           <Users size="18" class="yellow-ic" />
           <span class="active-cat">Referral</span>
        </div>
        <div class="sub-tabs">
          <button 
            v-for="tab in subNavItems" 
            :key="tab"
            :class="{ active: activeSubTab === tab }"
            @click="activeSubTab = tab"
          >
            {{ tab }}
          </button>
        </div>
      </div>
    </div>

    <!-- Main Content Body -->
    <div class="mlm-body">
      <div class="container">
        
        <!-- SECTION TITLE & TIERS -->
        <div class="section-header">
           <h1>Overview</h1>
           <div class="tier-badges">
              <span class="tier-pill spot">Spot Tier 0-20%</span>
              <span class="tier-pill futures">Futures Tier 0-10%</span>
           </div>
        </div>

        <!-- OVERVIEW STEPS -->
        <div class="overview-steps">
           <div class="step-box">
              <div class="step-num">1</div>
              <div class="step-icon-wrap"><Hexagon size="32" stroke-width="1.5" /></div>
              <p>Set the percentage of commission you want to share with your referrals.</p>
           </div>
           <div class="step-box">
              <div class="step-num">2</div>
              <div class="step-icon-wrap"><Smartphone size="32" stroke-width="1.5" /></div>
              <p>Share your referral link or QR code on different social media platforms.</p>
           </div>
           <div class="step-box">
              <div class="step-num">3</div>
              <div class="step-icon-wrap">
                <div class="gift-stats-wrap">
                   <Gift size="28" stroke-width="1.5" />
                   <Monitor size="20" class="mini-monitor" />
                </div>
              </div>
              <p>Sit back and enjoy up to 50% commission from your referral's trades.</p>
           </div>
        </div>

        <!-- MANAGEMENT GRID -->
        <div class="link-mgmt-grid">
           <!-- Default Link -->
           <div class="mgmt-card">
              <div class="card-top">
                 <span class="card-lbl">Default Link <Info size="14" class="info-ic" /></span>
                 <button class="yellow-link-btn">Change Default Link</button>
              </div>

              <div class="comm-details-row">
                 <div class="comm-box">
                    <span class="box-title">Spot</span>
                    <div class="comm-split">
                       <div class="split-item">
                          <span class="sub-lbl">You</span>
                          <span class="val-big">20%</span>
                       </div>
                       <div class="split-item">
                          <span class="sub-lbl">Invitee</span>
                          <span class="val-big">0%</span>
                       </div>
                    </div>
                 </div>
                 <div class="comm-box">
                    <span class="box-title">Futures</span>
                    <div class="comm-split">
                       <div class="split-item">
                          <span class="sub-lbl">You</span>
                          <span class="val-big">10%</span>
                       </div>
                       <div class="split-item">
                          <span class="sub-lbl">Invitee</span>
                          <span class="val-big">0%</span>
                       </div>
                    </div>
                 </div>
              </div>
           </div>

           <!-- Referral Data -->
           <div class="mgmt-card">
              <div class="card-rows">
                 <div class="data-row">
                    <span class="row-lbl">Referral Link</span>
                    <div class="row-val-wrap">
                       <span class="row-val-txt">xosis.me/...a48m</span>
                       <Copy size="14" class="copy-ic" @click="copyToClipboard('xosis.me/...a48m')" />
                       <ExternalLink size="14" class="ext-ic" />
                    </div>
                 </div>
                 <div class="data-row">
                    <span class="row-lbl">Referral Code</span>
                    <div class="row-val-wrap">
                       <span class="row-val-txt">889114382</span>
                       <Copy size="14" class="copy-ic" @click="copyToClipboard('889114382')" />
                    </div>
                 </div>
                 <div class="social-share-strip">
                    <div class="soc-icon tg"></div>
                    <div class="soc-icon fb"></div>
                    <div class="soc-icon rd"></div>
                    <div class="soc-icon x"></div>
                    <div class="soc-icon qr"></div>
                    <div class="soc-icon more"><Share2 size="12" /></div>
                 </div>
              </div>
           </div>
        </div>

        <!-- STATISTICS DASHBOARD -->
        <div class="stats-dashboard">
           <div class="stats-nav">
              <div class="tabs-left">
                 <button v-for="t in statsTabs" :key="t" :class="{active: activeStatsTab === t}" @click="activeStatsTab = t">{{ t }}</button>
              </div>
              <div class="filter-right">
                 <div class="date-pill">
                    <span>2024-01-10 → 2024-02-09</span>
                    <Calendar size="14" />
                 </div>
                 <div class="search-box">
                    <Search size="14" />
                 </div>
              </div>
           </div>

           <div class="main-stats-row">
              <div class="main-stat-card">
                 <div class="st-head">Total Commission (USDC) <Info size="14" class="info-ic" /></div>
                 <div class="st-val">0</div>
                 <div class="st-sub">≈ $0</div>
              </div>
              <div class="main-stat-card">
                 <div class="st-head">Total Trading Volume <Info size="14" class="info-ic" /></div>
                 <div class="st-val">0</div>
                 <div class="st-sub">≈ $0</div>
              </div>
           </div>

           <div class="referral-grid-wrap">
              <div class="ref-total-box">
                 <div class="st-head">Total Referrals <Info size="14" class="info-ic" /></div>
                 <div class="st-val">0</div>
              </div>
              <div class="ref-sub-grid">
                 <div class="ref-sub-item">
                    <span class="sub-lbl">Verified <HelpCircle size="12" class="ic-dim" /></span>
                    <span class="sub-val">0</span>
                 </div>
                 <div class="ref-sub-item">
                    <span class="sub-lbl">Deposited <HelpCircle size="12" class="ic-dim" /></span>
                    <span class="sub-val">0</span>
                 </div>
                 <div class="ref-sub-item">
                    <span class="sub-lbl">First-time Trade <HelpCircle size="12" class="ic-dim" /></span>
                    <span class="sub-val">0</span>
                 </div>
                 <div class="ref-sub-item">
                    <span class="sub-lbl">Traded <HelpCircle size="12" class="ic-dim" /></span>
                    <span class="sub-val">0</span>
                 </div>
              </div>
           </div>
        </div>



        <!-- VIP REQUIREMENTS -->
        <div class="vip-section">
           <table class="vip-table">
              <thead>
                 <tr>
                    <th>VIP Level</th>
                    <th>30-Day Trade Volume (USDT) <Info size="12" class="info-ic" /></th>
                    <th>And/Or</th>
                    <th>XOSIS Balance</th>
                 </tr>
              </thead>
              <tbody>
                 <tr v-for="v in vipLevels" :key="v.level">
                    <td class="vip-hl">{{ v.level }}</td>
                    <td>{{ v.volume }}</td>
                    <td class="cond-txt">{{ v.condition }}</td>
                    <td>{{ v.balance }}</td>
                 </tr>
              </tbody>
           </table>
        </div>

        <!-- SUPPORT FAB -->
        <div class="support-fab">
           <Headphones size="20" />
        </div>

      </div>
    </div>
  </div>
</template>

<style scoped>
.mlm-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: "IBM Plex Sans", sans-serif;
  overflow-x: hidden; /* CRITICAL: Prevent horizontal scroll on the entire page */
  width: 100%;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px; /* Reduced fixed padding for better mobile fit */
}

@media (min-width: 1024px) {
  .container { padding: 0 40px; }
}

/* Sub-Nav Styles */
.mlm-nav-bar {
  background: #0b0e11;
  border-bottom: 1px solid #1e2329;
  width: 100%;
}

.nav-content {
  display: flex;
  align-items: center;
  gap: 20px;
}

.main-category {
  display: flex;
  align-items: center;
  gap: 10px;
  border-right: 1px solid #1e2329;
  padding-right: 15px;
  height: 60px;
  flex-shrink: 0;
}

.yellow-ic { color: var(--primary); }
.active-cat {
  font-weight: 700;
  position: relative;
  font-size: 14px;
}
.active-cat::after {
  content: '';
  position: absolute;
  bottom: -21px;
  left: 0;
  width: 100%;
  height: 3px;
  background: var(--primary);
}

.sub-tabs {
  display: flex;
  gap: 20px;
  overflow-x: auto; /* Allow tabs to scroll on mobile without breaking page */
  scrollbar-width: none;
  -ms-overflow-style: none;
}
.sub-tabs::-webkit-scrollbar { display: none; }

.sub-tabs button {
  background: transparent;
  border: none;
  color: #fff;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  padding: 20px 0;
  transition: color 0.2s;
  white-space: nowrap;
}

.sub-tabs button:hover, .sub-tabs button.active { color: #fff; }
.sub-tabs button.active { color: var(--primary); }

/* Body Content */
.mlm-body { padding: 30px 0 80px; }

.section-header {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  gap: 15px;
  margin-bottom: 30px;
}

.section-header h1 { font-size: 20px; font-weight: 700; margin: 0; }

.tier-badges { display: flex; gap: 8px; flex-wrap: wrap; }
.tier-pill {
  font-size: 10px;
  font-weight: 700;
  padding: 4px 8px;
  border-radius: 4px;
  background: rgba(223, 255, 0, 0.1);
  color: var(--primary);
}

/* Overview Steps */
.overview-steps {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-bottom: 30px;
}

.step-box {
  background: #0b0e11;
  border: 1px solid #1e2329;
  border-radius: 12px;
  padding: 20px;
  position: relative;
}

@media (min-width: 1024px) {
  .step-box { padding: 30px; }
}

.step-num {
  position: absolute;
  top: 10px; left: 10px;
  width: 18px; height: 18px;
  background: #2b3139;
  color: #fff;
  border-radius: 50%;
  font-size: 10px;
  display: flex; align-items: center; justify-content: center;
}

.step-icon-wrap { margin-bottom: 15px; color: #fff; text-align: center; width: 100%; display: flex; justify-content: center;}

.gift-stats-wrap { position: relative; width: 40px; height: 40px; }
.mini-monitor { position: absolute; bottom: -5px; right: -5px; background: #0b0e11; padding: 2px; }

.step-box p { font-size: 12px; color: #fff; line-height: 1.5; margin: 0; text-align: center; }

/* Management Cards */
.link-mgmt-grid {
  display: grid;
  grid-template-columns: 1.4fr 1fr;
  gap: 20px;
  margin-bottom: 30px;
}

.mgmt-card {
  background: #0b0e11;
  border: 1px solid #1e2329;
  border-radius: 12px;
  padding: 20px;
  min-width: 0; /* Prevent flex overflow */
}

.card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px; }
.card-lbl { font-size: 13px; font-weight: 700; display: flex; align-items: center; gap: 6px; }

.yellow-link-btn {
  background: rgba(223, 255, 0, 0.1);
  color: var(--primary);
  border: none;
  padding: 6px 12px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 700;
  cursor: pointer;
}

.comm-details-row { display: flex; gap: 15px; }

@media (max-width: 480px) {
  .comm-details-row { flex-direction: column; }
}

.comm-box {
  flex: 1;
  background: #000;
  border: 1px solid #1e2329;
  border-radius: 12px;
  padding: 15px;
}

.box-title { font-size: 13px; color: #fff; display: block; margin-bottom: 15px; }
.comm-split { display: flex; justify-content: space-between; gap: 10px;}
.sub-lbl { font-size: 10px; color: #fff; margin-bottom: 2px; display: block; }
.val-big { font-size: 16px; font-weight: 800; }

.card-rows { display: flex; flex-direction: column; gap: 15px; }
.data-row { display: flex; flex-direction: column; gap: 6px; }
.row-lbl { font-size: 11px; color: #fff; }
.row-val-wrap {
  display: flex; align-items: center; gap: 10px;
  background: #1e2329; padding: 10px 12px; border-radius: 8px;
  min-width: 0;
}
.row-val-txt { flex: 1; font-size: 13px; font-weight: 600; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.copy-ic { color: #fff; cursor: pointer; flex-shrink: 0; }
.copy-ic:hover { color: var(--primary); }

.social-share-strip { display: flex; gap: 10px; margin-top: 5px; flex-wrap: wrap; }
.soc-icon { width: 26px; height: 26px; border-radius: 50%; background: #1e2329; cursor: pointer; }
.soc-icon.more { background: #2b3139; display: flex; align-items: center; justify-content: center; }

/* Dashboard */
.stats-dashboard {
  background: #0b0e11;
  border: 1px solid #1e2329;
  border-radius: 12px;
  padding: 15px;
  margin-bottom: 24px;
}

@media (min-width: 768px) {
  .stats-dashboard { padding: 24px; }
}

.stats-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;}
.tabs-left { display: flex; gap: 20px; }
.tabs-left button { background: transparent; border: none; font-size: 13px; color: #fff; cursor: pointer; padding: 0; }
.tabs-left button.active { color: var(--primary); font-weight: 700; }

.filter-right { display: flex; gap: 10px; flex-wrap: wrap; }
.date-pill {
  background: #1e2329; padding: 5px 10px; border-radius: 6px;
  display: flex; align-items: center; gap: 8px; font-size: 11px; color: #fff;
}

.main-stats-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px; }
.main-stat-card { background: #1e2329; border-radius: 12px; padding: 20px; }
.st-head { font-size: 11px; color: #fff; margin-bottom: 8px; display: flex; align-items: center; gap: 5px; }
.st-val { font-size: 24px; font-weight: 900; }

.referral-grid-wrap { display: grid; grid-template-columns: 1fr 2fr; gap: 15px; }
.ref-total-box { background: #1e2329; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: center; }
.ref-sub-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
.ref-sub-item { background: #1e2329; border-radius: 12px; padding: 15px; min-width: 0; }
.sub-val { font-size: 16px; font-weight: 700; margin-top: 5px; display: block; }

/* Notice */
.notice-bar {
  background: rgba(223, 255, 0, 0.05);
  border: 1px solid rgba(223, 255, 0, 0.2);
  border-radius: 8px; padding: 12px 15px;
  display: flex; gap: 12px; color: #fff; font-size: 11px; line-height: 1.5; margin-bottom: 30px;
}
.notice-bar a { color: var(--primary); text-decoration: underline; cursor: pointer; }

/* Table */
.vip-section { 
  background: #0b0e11; 
  border: 1px solid #1e2329; 
  border-radius: 12px; 
  overflow-x: auto; /* Allow the table itself to scroll horizontally */
  width: 100%;
}

.vip-table { width: 100%; border-collapse: collapse; min-width: 600px; } /* Ensures the table doesn't compress too much */
.vip-table th { background: #1e2329; text-align: left; padding: 12px 20px; font-size: 11px; color: #fff; font-weight: 600; white-space: nowrap; }
.vip-table td { padding: 15px 20px; font-size: 12px; border-bottom: 1px solid #1e2329; white-space: nowrap; }
.vip-hl { color: #fff; font-weight: 700; }
.cond-txt { color: #fff; }

@media (max-width: 1024px) {
  .link-mgmt-grid, .overview-steps, .main-stats-row, .referral-grid-wrap { grid-template-columns: 1fr; }
  .ref-sub-grid { grid-template-columns: repeat(2, 1fr); }
  .nav-content { gap: 15px; }
}

@media (max-width: 600px) {
  .st-val { font-size: 20px; }
  .ref-sub-item { padding: 12px; }
  .sub-val { font-size: 14px; }
}

.support-fab {
  position: fixed;
  bottom: 80px;
  right: 20px;
  width: 44px; height: 44px;
  background: var(--primary); color: #000;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.4);
  z-index: 100;
}
</style>

