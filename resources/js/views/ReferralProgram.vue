<script setup>
import { ref } from 'vue';
import { 
  Copy, 
  Share2, 
  Info, 
  ChevronRight, 
  Search,
  LayoutGrid,
  TrendingUp,
  Users,
  Wallet,
  ArrowUpRight,
  Settings,
  Bell,
  User,
  ExternalLink,
  MessageSquare,
  MessageCircle,
  Hash,
  ArrowLeft,
  X,
  HelpCircle,
  PlusCircle,
  Pencil,
  PieChart,
  Rocket,
  Facebook,
  Send
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const activeTab = ref('Overview');
const tabs = ['Overview', 'My Commission', 'Referrals', 'Units', 'Campaigns'];

const commissionStatsTabs = ['Deposit Refer Commission', 'Trade Win Commission'];
const activeCommTab = ref('Deposit Refer Commission');

const vipLevels = [
  { level: 'VIP 1', volume: '≥ 1,000,000 USD', bnb: '≥ 25 BNB' },
  { level: 'VIP 2', volume: '≥ 5,000,000 USD', bnb: '≥ 100 BNB' },
  { level: 'VIP 3', volume: '≥ 20,000,000 USD', bnb: '≥ 250 BNB' },
  { level: 'VIP 4', volume: '≥ 75,000,000 USD', bnb: '≥ 500 BNB' },
  { level: 'VIP 5', volume: '≥ 150,000,000 USD', bnb: '≥ 1,000 BNB' },
  { level: 'VIP 6', volume: '≥ 400,000,000 USD', bnb: '≥ 1,750 BNB' },
  { level: 'VIP 7', volume: '≥ 800,000,000 USD', bnb: '≥ 3,000 BNB' },
  { level: 'VIP 8', volume: '≥ 2,000,000,000 USD', bnb: '≥ 4,500 BNB' },
  { level: 'VIP 9', volume: '≥ 4,000,000,000 USD', bnb: '≥ 5,500 BNB' },
];

const copyToClipboard = (text) => {
  navigator.clipboard.writeText(text);
};
</script>

<template>
  <div class="referral-container">
    <TopHeader />
    
    <!-- Sub Header / Navigation -->
    <div class="sub-nav">
      <div class="nav-content">
        <div class="nav-links">
          <div 
            v-for="tab in tabs" 
            :key="tab"
            class="nav-tab"
            :class="{ active: activeTab === tab }"
            @click="activeTab = tab"
          >
            <Users v-if="tab === 'Referrals'" size="16" />
            {{ tab }}
          </div>
        </div>
      </div>
    </div>

    <main class="referral-main">
      <div v-if="activeTab === 'Overview'">
        <!-- Mobile Tier Pills (New element from screenshot, but user might want it) -->
        <!-- If "old shows" I shouldn't add new things, but the user requested "box designs as seen in screenshots" -->
        <!-- I'll keep the Tier Pills and Promo area only if requested, but for now I'll stick to the "Old" structure with new "Box" styling -->
        
        <div class="page-title-row">
          <h1>Overview</h1>
          <div class="title-pills">
            <span class="pill gold">Total Rebate: 20%</span>
            <span class="pill gray">Referral Tier 1: 40%</span>
          </div>
        </div>

        <!-- Strategy Cards -->
        <div class="strategy-grid">
          <div class="strategy-card">
            <div class="strat-icon"><Settings size="24" color="#fffd00" /></div>
            <div class="strat-info">
              <p>Set the percentage of commission you want to share with your invitees.</p>
            </div>
            <div class="strat-image">
              <img src="https://img.icons8.com/isometric-folders/100/null/folder-invoices.png" alt="Icon" />
            </div>
          </div>
          <div class="strategy-card">
            <div class="strat-icon"><Share2 size="24" color="#fffd00" /></div>
            <div class="strat-info">
              <p>Share your referral link or QR code on different social media platforms.</p>
            </div>
            <div class="strat-image">
              <img src="https://img.icons8.com/isometric-folders/100/null/group.png" alt="Icon" />
            </div>
          </div>
          <div class="strategy-card">
            <div class="strat-icon"><Wallet size="24" color="#fffd00" /></div>
            <div class="strat-info">
              <p>Sit back and enjoy up to 50% commission from your referral's trades.</p>
            </div>
            <div class="strat-image">
              <img src="https://img.icons8.com/isometric-folders/100/null/briefcase.png" alt="Icon" />
            </div>
          </div>
        </div>

        <div class="stats-overview-header desktop-only">
          <div class="default-link-label">Default link: <span class="link-name">Referral</span></div>
          <button class="btn-change-rebate">Change Referral Link</button>
        </div>

        <!-- Mobile Header for Default Link Section -->
        <div class="mobile-section-header mobile-only">
          <div class="header-text">
            <h3>Default Link</h3>
            <span class="note">Note: -</span>
          </div>
          <div class="edit-shortcut">
            <Pencil size="16" />
          </div>
        </div>

        <!-- Stats Row -->
        <div class="stats-row mobile-grid-layout">
          <!-- Link Box -->
          <div class="mini-card link-share-box m-order-1">
            <div class="copy-fields">
              <div class="copy-item-row">
                <span class="lbl">Referral Link</span>
                <span class="val-link">https://osi..._4281</span>
                <Copy size="14" class="copy-ic" @click="copyToClipboard('https://osis.io/ref_4281')" />
              </div>
              <div class="copy-item-row">
                <span class="lbl">Referral Code</span>
                <span class="val-link">53172021</span>
                <Copy size="14" class="copy-ic" @click="copyToClipboard('53172021')" />
              </div>
            </div>
            <div class="social-icons">
               <div class="sm-circle whatsapp"><MessageCircle size="14" /></div>
               <div class="sm-circle facebook"><Facebook size="14" /></div>
               <div class="sm-circle messenger"><MessageSquare size="14" /></div>
               <div class="sm-circle twitter"><Twitter size="14" /></div>
               <div class="sm-circle reddit">R</div>
               <div class="sm-circle grid"><LayoutGrid size="14" /></div>
               <div class="sm-circle share"><Share2 size="14" /></div>
            </div>
          </div>

          <!-- Commission Boxes -->
          <!-- We keep them separate for desktop grid but can wrap/flex them for mobile if needed -->
          <!-- On mobile we'll use a specific grid row for these two -->
          <div class="mini-card referral-comm-box m-order-2">
            <div class="mini-title">Spot <span class="desktop-only">Commission</span><span class="mobile-only">(You/Invitee)</span></div>
            <div class="mini-values">
              <div class="val-group desktop-only">
                <span class="lbl">You</span>
                <span class="val">20%</span>
              </div>
              <div class="val-group desktop-only">
                <span class="lbl">Invitee</span>
                <span class="val">0%</span>
              </div>
              <div class="val-group mobile-only full-width">
                <span class="val-dual"><span class="you">20%</span> / <span class="invitee">0%</span></span>
              </div>
            </div>
          </div>

          <div class="mini-card trade-win-box m-order-3">
            <div class="mini-title">Futures <span class="desktop-only">Commission</span><span class="mobile-only">(You/Invitee)</span></div>
            <div class="mini-values">
              <div class="val-group desktop-only">
                <span class="lbl">You</span>
                <span class="val">10%</span>
              </div>
              <div class="val-group desktop-only">
                <span class="lbl">Invitee</span>
                <span class="val">0%</span>
              </div>
              <div class="val-group mobile-only full-width">
                <span class="val-dual"><span class="you">10%</span> / <span class="invitee">0%</span></span>
              </div>
            </div>
          </div>
        </div>

        <div class="comm-tab-switcher">
          <span 
            v-for="ctab in commissionStatsTabs" 
            :key="ctab"
            class="ct-tab"
            :class="{ active: activeCommTab === ctab }"
            @click="activeCommTab = ctab"
          >{{ ctab }}</span>
        </div>

        <!-- Bonus Section -->
        <div class="bonus-section-container">
          <div class="bonus-stats-row">
            <div class="bonus-box">
              <div class="lbl">Total Bonus (USDT) <Info size="14" /></div>
              <div class="val">0</div>
              <div class="sub">≈ $0</div>
            </div>
            <div class="bonus-box">
              <div class="lbl">Today Bonus (USDT)</div>
              <div class="val">0</div>
              <div class="sub">≈ $0</div>
            </div>
          </div>

          <div class="bonus-bottom-row">
            <div class="referrals-count-box">
               <div class="lbl">Total Referrals <Info size="14" /></div>
               <div class="val">0</div>
            </div>

            <div class="comm-level-card">
              <h3 class="card-title">{{ activeCommTab }}</h3>
              <div class="levels-list">
                <template v-if="activeCommTab === 'Deposit Refer Commission'">
                  <div class="level-item"><span>Layer 1:</span> <span class="pct">5%</span></div>
                  <div class="level-item"><span>Layer 2:</span> <span class="pct">4%</span></div>
                  <div class="level-item"><span>Layer 3:</span> <span class="pct">1%</span></div>
                </template>
                <template v-else>
                  <div class="level-item"><span>Layer 1:</span> <span class="pct">4%</span></div>
                  <div class="level-item"><span>Layer 2:</span> <span class="pct">1%</span></div>
                </template>
              </div>
            </div>
          </div>
        </div>



        <!-- VIP Table -->
        <div class="vip-table-container">
          <table class="vip-table">
            <thead>
              <tr>
                <th>VIP Layer</th>
                <th>30-Day Trade Volume (USD) <Info size="14" /></th>
                <th>And/Or</th>
                <th>BNB Balance</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="vip in vipLevels" :key="vip.level">
                <td class="vip-lvl-cell">{{ vip.level }}</td>
                <td>{{ vip.volume }}</td>
                <td class="and-or">And</td>
                <td>{{ vip.bnb }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Other tabs placeholder -->
      <div v-else class="tab-placeholder">
        <div class="empty-state">
          <LayoutGrid size="64" color="#2b3139" />
          <p>No data available for {{ activeTab }} yet.</p>
        </div>
      </div>
    </main>

    <!-- Floating CS Icon -->
    <div class="cs-floating">
      <div class="cs-bubble">
        <MessageSquare size="24" color="#000" />
      </div>
    </div>
  </div>
</template>

<style scoped>
.referral-container {
  background-color: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  padding-bottom: 80px;
}

/* Sub Nav */
.sub-nav {
  background: #000;
  border-bottom: 1px solid #1e2329;
  padding: 0 40px;
}
.nav-content {
  max-width: 1400px;
  margin: 0 auto;
}
.nav-links {
  display: flex;
  gap: 32px;
}
.nav-tab {
  padding: 18px 0;
  font-size: 14px;
  color: #848e9c;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  position: relative;
  transition: color 0.2s;
}
.nav-tab:hover {
  color: #fffd00;
}
.nav-tab.active {
  color: #fffd00;
  font-weight: 600;
}
.nav-tab.active::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: #fffd00;
}

/* Main */
.referral-main {
  max-width: 1400px;
  margin: 0 auto;
  padding: 32px 40px;
}

.page-title-row {
  display: flex;
  align-items: center;
  gap: 20px;
  margin-bottom: 32px;
}
.page-title-row h1 {
  font-size: 32px;
  font-weight: 700;
  margin: 0;
}
.title-pills {
  display: flex;
  gap: 12px;
}
.pill {
  padding: 4px 10px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: 600;
}
.pill.gold {
  background: rgba(255, 253, 0, 0.1);
  color: #fffd00;
}
.pill.gray {
  background: #2b3139;
  color: #848e9c;
}

/* Strategy Cards */
.strategy-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-bottom: 40px;
}
.strategy-card {
  background: #1e2329;
  border-radius: 12px;
  padding: 24px;
  display: flex;
  flex-direction: column;
  position: relative;
  min-height: 140px;
  transition: transform 0.2s;
}
.strategy-card:hover {
  transform: translateY(-2px);
}
.strat-icon {
  margin-bottom: 16px;
}
.strat-info p {
  font-size: 14px;
  line-height: 1.4;
  color: #eaecef;
  margin: 0;
  max-width: 85%;
}
.strat-image {
  position: absolute;
  bottom: 0px;
  right: 0px;
  width: 100px;
  height: 100px;
  opacity: 0.1;
  pointer-events: none;
}
.strat-image img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

/* Stats Row */
.stats-overview-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.default-link-label {
  font-size: 14px;
  color: #848e9c;
}
.link-name {
  color: #fffd00;
  font-weight: 600;
  margin-left: 4px;
}
.btn-change-rebate {
  background: #fffd00;
  color: #000;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: opacity 0.2s;
}
.btn-change-rebate:hover { opacity: 0.9; }

.stats-row {
  display: grid;
  grid-template-columns: 1fr 1fr 1.5fr;
  gap: 20px;
  margin-bottom: 24px;
}
.mini-card {
  background: #1e2329;
  border-radius: 8px;
  padding: 24px;
}
.mini-title {
  color: #848e9c;
  font-size: 14px;
  margin-bottom: 16px;
  font-weight: 500;
}
.mini-values {
  display: flex;
  gap: 40px;
}
.val-group {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.val-group .lbl {
  font-size: 12px;
  color: #848e9c;
}
.val-group .val {
  font-size: 20px;
  font-weight: 700;
}

.copy-fields {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-bottom: 16px;
}
.copy-item-row {
  display: flex;
  align-items: center;
  gap: 12px;
}
.copy-item-row .lbl {
  font-size: 12px;
  color: #848e9c;
  width: 90px;
}
.copy-item-row .val-link {
  font-size: 13px;
  font-weight: 600;
  color: #fff;
}
.copy-ic {
  color: #848e9c;
  cursor: pointer;
  margin-left: auto;
}

.social-icons {
  display: flex;
  gap: 8px;
}
.sm-circle {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #2b3139;
  color: #fff;
  cursor: pointer;
  font-size: 10px;
  font-weight: 700;
}

.whatsapp { background: #25D366; }
.facebook { background: #1877F2; }
.messenger { background: #0084FF; }
.twitter { background: #000; }
.reddit { background: #FF4500; }
.grid { background: #474d57; }
.share { background: #848e9c; }

/* Bonus Section Layout */
.comm-tab-switcher {
  display: flex;
  gap: 24px;
  margin-bottom: 24px;
  border-bottom: 1px solid #1e2329;
}
.ct-tab {
  font-size: 14px;
  padding-bottom: 10px;
  cursor: pointer;
  color: #848e9c;
  position: relative;
}
.ct-tab.active {
  color: #fffd00;
  font-weight: 700;
}
.ct-tab.active::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: #fffd00;
}

.bonus-section-container {
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin-bottom: 40px;
}
.bonus-stats-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.bonus-box {
  background: #1e2329;
  border-radius: 8px;
  padding: 24px;
}
.bonus-box .lbl {
  font-size: 13px;
  color: #848e9c;
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.bonus-box .val {
  font-size: 28px;
  font-weight: 700;
}
.bonus-box .sub {
  font-size: 12px;
  color: #5e6673;
}

.bonus-bottom-row {
  display: grid;
  grid-template-columns: 320px 1fr;
  gap: 20px;
}
.referrals-count-box {
  background: #1e2329;
  border-radius: 8px;
  padding: 24px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.referrals-count-box .lbl {
  font-size: 13px;
  color: #848e9c;
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}
.referrals-count-box .val {
  font-size: 32px;
  font-weight: 700;
}

.comm-level-card {
  background: #dfff00;
  color: #000;
  border-radius: 12px;
  padding: 32px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.comm-level-card .card-title {
  font-size: 22px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 20px;
}
.levels-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.level-item {
  display: flex;
  justify-content: space-between;
  font-size: 18px;
  font-weight: 500;
  color: #333;
  padding-bottom: 8px;
  border-bottom: 1px solid #eee;
}
.level-item:last-child { border-bottom: none; }
.level-item .pct { font-weight: 800; font-size: 20px; }

/* VIP Table */
.vip-table-container {
  overflow-x: auto !important;
  margin-top: 40px;
  width: 100%;
}
.vip-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
}
.vip-table th {
  padding: 16px;
  font-size: 14px;
  color: #848e9c;
  border-bottom: 1px solid #1e2329;
}
.vip-table td {
  padding: 24px 16px;
  font-size: 15px;
  font-weight: 600;
  border-bottom: 1px solid #1e2329;
}
.vip-lvl-cell { font-weight: 700; color: #fff; }

/* Alert */


/* CS Bubble */
.cs-floating {
  position: fixed;
  bottom: 40px;
  right: 40px;
}
.cs-bubble {
  width: 56px;
  height: 56px;
  background: #fffd00;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

/* Tab Placeholder Styling */
.tab-placeholder {
  padding: 100px 0;
  text-align: center;
}
.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
  color: #474d57;
}

/* MOBILE BOX DESIGN CHANGES ONLY */
@media (max-width: 768px) {
  .desktop-only { display: none !important; }
  .mobile-only { display: flex !important; }

  .referral-main { padding: 20px 16px; }
  .sub-nav { padding: 0 16px; }
  .nav-links { gap: 16px; overflow-x: auto; scrollbar-width: none; }
  .nav-tab { 
    white-space: nowrap; 
    font-size: 13px; 
    color: #fff;
  }
  .nav-tab.active {
    color: #fffd00;
  }


  /* Section Header Styling */
  .mobile-section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 24px 0 12px 0;
  }
  .mobile-section-header h3 {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
  }
  .mobile-section-header .note {
    font-size: 14px;
    color: #848e9c;
  }
  .edit-shortcut {
    background: #fffd00;
    border-radius: 6px;
    padding: 6px;
    display: flex;
    color: #000;
  }

  /* Grid Redesign */
  .mobile-grid-layout {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 12px !important;
    margin-bottom: 24px;
  }
  .m-order-1 {
    grid-column: span 2;
    order: 1;
  }
  .m-order-2 {
    grid-column: span 1;
    order: 2;
  }
  .m-order-3 {
    grid-column: span 1;
    order: 3;
  }

  /* Box Contents */
  .mini-card { 
    background: #1e2329 !important; 
    border-radius: 12px !important; 
    padding: 16px !important;
  }
  .mini-title {
    font-size: 12px !important;
    margin-bottom: 8px !important;
  }
  .val-dual {
    font-weight: 700;
    font-size: 16px;
    display: block;
    margin-top: 4px;
  }
  .val-dual .invitee { color: #848e9c; }
  .full-width { width: 100%; }

  /* Existing elements adaptation */
  .strategy-grid { grid-template-columns: 1fr; gap: 12px; }
  .strategy-card { 
    background: #1e2329; 
    border-radius: 12px !important; 
    padding: 20px !important; 
    min-height: auto;
  }
  .strat-image { opacity: 0.05; width: 80px; height: 80px; }
  
  .bonus-stats-row { grid-template-columns: 1fr; gap: 12px; }
  .bonus-box { 
    background: #1e2329 !important; 
    border-radius: 12px !important; 
  }

  .bonus-bottom-row { grid-template-columns: 1fr; }
  .referrals-count-box { 
    background: #1e2329 !important; 
    border-radius: 12px !important;
    padding: 20px !important;
    margin-bottom: 12px;
  }

  .comm-level-card { 
    border-radius: 12px !important; 
    padding: 20px !important; 
  }

  .info-alert {
    background: #1e222a !important;
    border: none !important;
    border-radius: 12px !important;
    padding: 16px !important;
    margin-bottom: 40px;
  }

  /* Social Icons Row for Mobile */
  .social-icons {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    overflow-x: auto;
    gap: 12px !important;
    margin-top: 16px;
    padding-bottom: 4px;
    scrollbar-width: none;
  }
  .social-icons::-webkit-scrollbar { display: none; }
  
  .sm-circle {
    width: 36px !important;
    height: 36px !important;
    flex-shrink: 0;
  }
}

.desktop-only { display: block; }
.mobile-only { display: none; }

@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
.spinning { animation: spin 10s linear infinite; }
</style>
