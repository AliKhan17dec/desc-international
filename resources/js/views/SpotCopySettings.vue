<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  ChevronLeft, 
  HelpCircle, 
  Info, 
  ChevronRight, 
  ChevronDown,
  ChevronUp,
  Plus
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const copyMode = ref('Fixed Amount'); // 'Fixed Ratio' or 'Fixed Amount'
const advancedOpen = ref(true);
const agreed = ref(true);
const autoInvest = ref(false);

const trader = {
  name: 'hopyy',
  bio: 'All I want in the world is for Broccoli714 to cost $1',
  pnl: '+256,654.69',
  roi: '+366.18%',
  profitSharing: '10.00%'
};

const goBack = () => router.back();
</script>

<template>
  <div class="settings-page">
    <TopHeader />
    
    <div class="main-content">
      <!-- Top Navigation -->
      <div class="site-nav">
        <div class="nav-left" @click="goBack">
          <ChevronLeft size="18" />
          <span>Portfolios List</span>
        </div>
        <div class="nav-right">
          <HelpCircle size="16" class="tutorial-icon" />
          <span>Tutorial</span>
        </div>
      </div>

      <div class="content-body">
        <h1 class="page-title">Spot Copy Settings</h1>

        <div class="settings-dashboard-grid">
          <!-- Left Column: Trader Info -->
          <div class="grid-column">
            <div class="trader-header">
              <div class="trader-main">
                <div class="avatar">
                  <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=hopyy" alt="Avatar" />
                </div>
                <div class="trader-info">
                  <div class="name-row">
                    <span class="name">{{ trader.name }}</span>
                  </div>
                  <div class="tag-row">
                    <span class="tag">Top Performer</span>
                    <span class="tag">Whale Manager</span>
                  </div>
                </div>
              </div>
              
              <div class="profit-sharing-bar">
                <Info size="14" class="info-icon" />
                <span>Profit Sharing {{ trader.profitSharing }}</span>
              </div>

              <div class="trader-bio">
                <p>{{ trader.bio }}</p>
                <span class="link">View Original</span>
              </div>

              <!-- PNL Card -->
              <div class="pnl-summary-card">
                <div class="stats">
                  <span class="label">7 Days PNL (USDT)</span>
                  <div class="value-row">
                    <span class="pnl-val">{{ trader.pnl }}</span>
                    <div class="mini-chart">
                      <svg viewBox="0 0 60 20">
                        <path d="M0 18 Q 10 18, 20 16 T 40 5 T 60 8" fill="none" stroke="#DFFF00" stroke-width="1.5" />
                      </svg>
                    </div>
                  </div>
                  <span class="roi-val">ROI <span class="pos">{{ trader.roi }}</span></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Column: Form -->
          <div class="grid-column">
            <div class="settings-form">
              <div class="tab-header">
                <div class="tabs">
                  <div 
                    class="tab" 
                    :class="{ active: copyMode === 'Fixed Ratio' }"
                    @click="copyMode = 'Fixed Ratio'"
                  >
                    Fixed Ratio
                  </div>
                  <div 
                    class="tab" 
                    :class="{ active: copyMode === 'Fixed Amount' }"
                    @click="copyMode = 'Fixed Amount'"
                  >
                    Fixed Amount
                  </div>
                </div>
                <Info size="14" class="help-gray" />
              </div>

              <p class="tab-note" v-if="copyMode === 'Fixed Ratio'">* Each order will be purchased proportionally.</p>
              <p class="tab-note" v-else>* Each order uses a fixed amount for purchase.</p>

              <!-- Input Fields -->
              <div class="form-group" v-if="copyMode === 'Fixed Amount'">
                <label>Cost Per Order</label>
                <div class="input-wrapper">
                  <input type="text" placeholder="10-1,000" />
                  <span class="suffix">USDT</span>
                </div>
              </div>

              <div class="form-group">
                <label>Copy Amount</label>
                <div class="input-wrapper">
                  <input type="text" :placeholder="copyMode === 'Fixed Ratio' ? '100-200,000' : '10-200,000'" />
                  <div class="suffix-group">
                    <span class="suffix">USDT</span>
                    <span class="max-link">Max</span>
                  </div>
                </div>
                <div class="available-balance">
                  <span>Available 0.00 USDT</span>
                  <Plus size="12" class="add-icon" />
                </div>
              </div>

              <div class="form-group clickable">
                <label>Copy Pairs</label>
                <div class="pairs-row">
                  <div class="coins">
                    <div class="coin-icon btc">₿</div>
                    <div class="coin-icon eth">Ξ</div>
                    <div class="coin-icon sol">S</div>
                    <span class="plus-count">99+</span>
                  </div>
                  <ChevronRight size="16" class="dim" />
                </div>
              </div>

              <div class="form-group">
                <label>Stop Loss <span class="badge-rec">Recommended</span></label>
                <div class="input-wrapper">
                  <input type="text" placeholder="0-95" />
                  <div class="suffix-group">
                    <span class="suffix">%</span>
                    <ChevronDown size="16" class="dim" />
                  </div>
                </div>
              </div>

              <!-- Advanced Settings -->
              <div class="advanced-section">
                <div class="advanced-header" @click="advancedOpen = !advancedOpen">
                    <span>Advanced Settings</span>
                    <component :is="advancedOpen ? ChevronUp : ChevronDown" size="18" />
                </div>
                
                <div class="advanced-content" v-if="advancedOpen">
                    <div class="adv-item">
                        <span class="l">Max entry slippage</span>
                        <div class="r">
                            <span>Default</span>
                            <ChevronDown size="14" />
                        </div>
                    </div>
                    <div class="adv-item">
                        <span class="l">Auto-Invest</span>
                        <div class="toggle-wrap" @click="autoInvest = !autoInvest">
                            <div class="toggle" :class="{ active: autoInvest }">
                                <div class="handle"></div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <!-- Final Actions -->
              <div class="agreement-row">
                <div class="checkbox" :class="{ checked: agreed }" @click="agreed = !agreed">
                    <div class="check-mark" v-if="agreed"></div>
                </div>
                <p>I have read and I agree to the <span class="link">User Service Agreement</span></p>
              </div>

              <button class="btn-copy">Copy</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Replication of the footer from screenshot -->
      <footer class="footer-links">
          <div class="f-col"><span>About Us</span> <Plus size="14"/></div>
          <div class="f-col"><span>Products</span> <Plus size="14"/></div>
          <div class="f-col"><span>Business</span> <Plus size="14"/></div>
          <div class="f-col"><span>Learn</span> <Plus size="14"/></div>
          <div class="f-col"><span>Service</span> <Plus size="14"/></div>
          <div class="f-col"><span>Support</span> <Plus size="14"/></div>
          
          <div class="community-row">
              <div class="social-icon"></div>
              <div class="social-icon"></div>
              <div class="social-icon"></div>
              <div class="social-icon"></div>
              <div class="social-icon"></div>
              <div class="social-icon"></div>
              <div class="social-icon"></div>
              <div class="social-icon"></div>
          </div>

          <div class="language-settings">
              <span>English</span>
              <span>USD</span>
              <div class="theme-toggle">
                  <span>Theme</span>
                  <div class="theme-switch">
                      <div class="icon-moon"></div>
                  </div>
              </div>
          </div>

          <div class="copyright">
              OSIS Protocol © 2025 <br/>
              Cookie Preferences
          </div>
      </footer>
    </div>
  </div>
</template>

<style scoped>
.settings-page, .settings-page * {
  box-sizing: border-box;
}

.settings-page {
  background: #0b0e11;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  overflow-x: hidden;
}

.main-content {
  max-width: 1200px;
  margin: 0 auto;
  background: #0b0e11;
  padding-bottom: 80px;
  width: 100%;
}

@media (max-width: 1024px) {
  .main-content {
    max-width: 600px;
  }
}

/* Nav */
.site-nav {
  display: flex;
  justify-content: space-between;
  padding: 16px 20px;
}

.nav-left, .nav-right {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  color: #fff;
  cursor: pointer;
}

.tutorial-icon { color: #fff; }

/* Page Title */
.content-body {
    padding: 16px 20px;
}

.page-title {
  font-size: clamp(24px, 4vw, 32px);
  font-weight: 600;
  margin-bottom: 32px;
}

.settings-dashboard-grid {
  display: grid;
  grid-template-columns: 1fr 1.5fr;
  gap: 48px;
  align-items: start;
}

@media (max-width: 1024px) {
  .settings-dashboard-grid {
    grid-template-columns: 1fr;
    gap: 32px;
  }
}

.grid-column {
  width: 100%;
}

/* Trader Card */
.trader-header {
  margin-bottom: 32px;
}

.trader-main {
  display: flex;
  gap: 12px;
  margin-bottom: 12px;
}

.avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  overflow: hidden;
  background: var(--primary);
}

.avatar img { width: 100%; height: 100%; object-fit: cover; }

.name { font-size: 18px; font-weight: 600; }

.tag-row {
  display: flex;
  gap: 8px;
  margin-top: 4px;
}

.tag {
    font-size: 10px;
    background: #2b3139;
    color: #fff;
    padding: 2px 6px;
    border-radius: 4px;
}

.profit-sharing-bar {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  color: #fff;
  margin-bottom: 12px;
  background: rgba(255, 255, 255, 0.03);
  width: fit-content;
  padding: 4px 8px;
  border-radius: 4px;
}

.trader-bio { font-size: 13px; color: #fff; margin-bottom: 24px; }
.trader-bio .link { color: var(--primary); font-weight: 500; margin-left: 8px; cursor: pointer; }

/* PNL Card */
.pnl-summary-card {
  background: #1e2329;
  border-radius: 12px;
  padding: 16px;
  border: 1px solid #2b3139;
}

.stats .label { font-size: 12px; color: #fff; display: block; margin-bottom: 8px; }

.value-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
}

.pnl-val { font-size: 24px; font-weight: 700; color: #DFFF00; }
.roi-val { font-size: 12px; color: #fff; }
.roi-val .pos { color: #DFFF00; font-weight: 600; margin-left: 4px; }

.mini-chart { width: 60px; height: 20px; }

/* Form */
.tab-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.tabs {
  display: flex;
  gap: 16px;
  border-bottom: 1px solid #2b3139;
  flex-wrap: wrap;
}

.tab {
  padding: 12px 0;
  font-size: 14px;
  color: #fff;
  cursor: pointer;
  position: relative;
  white-space: nowrap;
}

.tab.active {
  color: var(--primary);
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

.help-gray { color: #fff; cursor: pointer; }

.tab-note { font-size: 12px; color: #fff; margin-bottom: 24px; }

.form-group {
  margin-bottom: 24px;
}

.form-group label {
  display: block;
  font-size: 14px;
  color: #fff;
  margin-bottom: 8px;
}

.badge-rec {
  font-size: 10px;
  background: rgba(223, 255, 0, 0.1);
  color: var(--primary);
  padding: 2px 6px;
  border-radius: 4px;
  margin-left: 4px;
}

.input-wrapper {
  background: #2b3139;
  border-radius: 8px;
  display: flex;
  align-items: center;
  padding: 12px 16px;
  border: 1px solid transparent;
}

.input-wrapper:focus-within { border-color: var(--primary); }

.input-wrapper input {
  background: transparent;
  border: none;
  color: #fff;
  flex: 1;
  font-size: 14px;
  outline: none;
}

.suffix-group { display: flex; align-items: center; gap: 8px; }
.suffix { font-size: 14px; color: #fff; font-weight: 500; }
.max-link { color: var(--primary); font-size: 14px; font-weight: 600; cursor: pointer; }

.available-balance {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  color: #fff;
  margin-top: 8px;
}

.add-icon {
  background: #2b3139;
  color: var(--primary);
  border-radius: 2px;
}

.pairs-row {
  background: #2b3139;
  border-radius: 8px;
  padding: 12px 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
}

.coins {
  display: flex;
  align-items: center;
  gap: -4px;
}

.coin-icon {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: 700;
  border: 2px solid #2b3139;
  margin-left: -6px;
}

.coin-icon:first-child { margin-left: 0; }
.btc { background: var(--primary); color: #fff; }
.eth { background: #627eea; color: #fff; }
.sol { background: #14f195; color: #000; }

.plus-count {
  font-size: 12px;
  color: #fff;
  margin-left: 8px;
  font-weight: 500;
}

.dim { color: #fff; }

/* Advanced */
.advanced-section {
  margin: 32px 0;
}

.advanced-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #fff;
  font-size: 14px;
  cursor: pointer;
  margin-bottom: 20px;
}

.advanced-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.adv-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.adv-item .l { font-size: 14px; color: #fff; text-decoration: underline; text-decoration-style: dotted; }
.adv-item .r { display: flex; align-items: center; gap: 4px; font-size: 14px; font-weight: 500; }

.toggle-wrap { cursor: pointer; }
.toggle { width: 36px; height: 20px; background: #fff; border-radius: 10px; position: relative; transition: background 0.2s; }
.toggle.active { background: var(--primary); }
.handle { width: 14px; height: 14px; background: #fff; border-radius: 50%; position: absolute; top: 3px; left: 3px; transition: transform 0.2s; }
.toggle.active .handle { transform: translateX(16px); }

/* Agreement */
.agreement-row {
  display: flex;
  gap: 12px;
  margin-bottom: 32px;
}

.checkbox {
  width: 16px;
  height: 16px;
  border: 1px solid #fff;
  border-radius: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.checkbox.checked { background: var(--primary); border-color: var(--primary); }
.check-mark {
  width: 8px;
  height: 4px;
  border-left: 2px solid #000;
  border-bottom: 2px solid #000;
  transform: rotate(-45deg) translateY(-1px);
}

.agreement-row p { font-size: 13px; color: #fff; }
.agreement-row .link { color: var(--primary); font-weight: 500; cursor: pointer; }

/* Copy Button */
.btn-copy {
  width: 100%;
  background: var(--primary);
  color: #000;
  padding: 16px;
  border-radius: 12px;
  font-weight: 700;
  border: none;
  font-size: 16px;
  margin-bottom: 40px;
  cursor: pointer;
}

/* Footer Replication */
.footer-links {
    padding: 24px 20px;
    border-top: 8px solid #1e2329;
    margin-top: 20px;
}

.f-col {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid #1e2329;
    font-size: 14px;
    color: #fff;
}

.community-row {
    display: flex;
    gap: 16px;
    margin: 32px 0;
    flex-wrap: wrap;
}

.social-icon {
    width: 20px;
    height: 20px;
    background: #fff;
    mask: url('data:image/svg+xml;utf8,<svg ... />') no-repeat center;
}

.language-settings {
    display: flex;
    align-items: center;
    gap: 24px;
    font-size: 14px;
    color: #fff;
    margin-bottom: 32px;
}

.theme-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
}

.theme-switch {
    width: 32px;
    height: 18px;
    background: #2b3139;
    border-radius: 10px;
    display: flex;
    align-items: center;
    padding-left: 4px;
}

.icon-moon {
    width: 12px;
    height: 12px;
    background: #fff;
    border-radius: 50%;
}

.copyright {
    font-size: 12px;
    color: #fff;
    line-height: 1.6;
}
</style>
