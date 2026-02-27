<script setup>
import { 
  ArrowLeft, Info, ChevronRight, Check, AlertCircle 
} from 'lucide-vue-next';
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const goBack = () => router.back();

const copyMode = ref('Fixed Amount');
const copyAmount = ref('');
const stopLoss = ref('');
const agree = ref(false);

const trader = {
    name: 'happyy',
    tags: ['Top Performer', 'Whale Manager'],
    profitShare: '10.00%',
    bio: 'All I want in the world is for Broccoli14 to cost $1',
    pnl: '+256,654.69',
    roi: '+366.18%',
};

</script>

<template>
  <div class="copy-settings-screen">
    <TopHeader />

    <div class="scroll-content">
        <!-- Nav -->
        <div class="nav-header">
             <div class="left" @click="goBack">
                <ArrowLeft class="icon-btn" />
                <span class="nav-title">Portfolios List</span>
            </div>
            <div class="right">
                <span class="tutorial-link">? Tutorial</span>
            </div>
        </div>

        <h1 class="page-title">Spot Copy Settings</h1>

        <!-- Trader Info -->
        <div class="trader-info">
             <div class="trader-top">
                 <img src="https://randomuser.me/api/portraits/men/1.jpg" class="avatar" />
                 <div class="t-details">
                     <h3>{{ trader.name }}</h3>
                     <div class="tags">
                         <span v-for="tag in trader.tags" :key="tag" class="tag">{{ tag }}</span>
                     </div>
                 </div>
             </div>
             <div class="profit-badge">
                 🏆 Profit Sharing {{ trader.profitShare }}
             </div>
             <p class="bio">{{ trader.bio }}</p>
             <a href="#" class="view-original">View Original</a>

             <!-- Mini PnL Card -->
             <div class="mini-pnl-card">
                 <div class="mp-content">
                     <span class="lbl">7 Days PNL (USDT)</span>
                     <span class="val positive">{{ trader.pnl }}</span>
                     <span class="roi">ROI {{ trader.roi }}</span>
                 </div>
                 <div class="mini-chart">
                      <svg width="60" height="30">
                          <path d="M0,25 Q30,25 40,20 T60,5" fill="none" stroke="#DFFF00" stroke-width="2" />
                      </svg>
                 </div>
             </div>
        </div>

        <!-- Copy Settings Form -->
        <div class="settings-form">
            <div class="tabs-row">
                <div class="tab">Fixed Ratio</div>
                <div class="tab active">Fixed Amount</div>
                <Info size="14" class="info-icon" />
            </div>
            <p class="helper-text">* Each order uses a fixed amount for purchase.</p>

            <div class="form-group">
                <label>Cost Per Order</label>
                <div class="input-wrapper">
                    <input type="text" placeholder="10-1,000" />
                    <span class="suffix">USDT</span>
                </div>
            </div>

            <div class="form-group">
                <label>Copy Amount</label>
                <div class="input-wrapper">
                    <input type="text" v-model="copyAmount" placeholder="10-200,000" />
                    <span class="suffix warning">USDT Max</span>
                </div>
                <div class="balance-row">
                    <span>Available 0.00 USDT</span>
                    <span class="add-icon">⊕</span>
                </div>
            </div>

            <div class="form-item-row">
                <span>Copy Pairs</span>
                <div class="pairs-preview">
                    <div class="stack-icons">
                        <span class="coin-icon orange"></span>
                        <span class="coin-icon blue"></span>
                        <span class="coin-icon green"></span>
                    </div>
                    <span>99+</span>
                    <ChevronRight size="14" />
                </div>
            </div>

            <div class="form-group">
                <label>Stop Loss <span class="tag-rec">Recommended</span></label>
                <div class="input-wrapper">
                    <input type="text" v-model="stopLoss" placeholder="0-95" />
                    <span class="suffix">% <ChevronRight size="12" class="rotate-90" /></span>
                </div>
            </div>

             <div class="accordion-item">
                <span>Advanced Settings</span>
                <ChevronRight size="14" class="rotate-90" />
            </div>

             <div class="setting-row">
                <span class="dashed-underline">Max entry slippage</span>
                <span class="val-link">Default <ChevronRight size="12" class="rotate-90" /></span>
            </div>

            <div class="setting-row">
                <span class="dashed-underline">Auto-Invest</span>
                <div class="toggle-switch"></div>
            </div>

            <!-- Agreement -->
            <div class="agreement-box" @click="agree = !agree">
                <div class="checkbox" :class="{ checked: agree }">
                    <Check v-if="agree" size="12" />
                </div>
                <span class="agree-text">I have read and agree to the <span class="highlight">User Service Agreement</span></span>
            </div>

            <!-- Submit Button -->
            <button class="submit-btn" :disabled="!agree">Copy</button>

        </div>

        <!-- Footer (Simplified) -->
        <div class="footer-links">
            <div class="x-logo">OSIS</div>
             <!-- Links ... -->
        </div>
    </div>
  </div>
</template>

<style scoped>
.copy-settings-screen {
  background-color: var(--bg-color);
  min-height: 100vh;
  padding-bottom: 80px;
  color: white;
}

.nav-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    background: black;
}
.left { display: flex; align-items: center; gap: 8px; cursor:pointer; color:#fff; font-size:14px;}
.tutorial-link { color: #fff; font-size: 14px; }

.page-title {
    padding: 0 20px;
    font-size: 20px;
    margin: 0 0 20px 0;
}

/* Trader Info */
.trader-info { padding: 0 20px; margin-bottom: 24px; }
.trader-top { display: flex; gap: 12px; align-items: center; margin-bottom: 12px; }
.avatar { width: 40px; height: 40px; border-radius: 50%; }
.t-details h3 { margin: 0 0 4px 0; font-size: 16px; }
.tags { display: flex; gap: 4px; }
.tag { font-size: 10px; background: #222; color: #fff; padding: 2px 6px; border-radius: 4px; }

.profit-badge { 
    display: inline-block; 
    font-size: 11px; 
    background: #222; 
    border: 1px solid #333; 
    padding: 4px 8px; 
    border-radius: 12px; 
    margin-bottom: 12px; 
    color: #fff;
}
.bio { font-size: 13px; color: #fff; margin-bottom: 4px; }
.view-original { font-size: 12px; color: var(--primary); text-decoration: none; display: block; margin-bottom: 16px; }

.mini-pnl-card {
    background: #111;
    border: 1px solid #222;
    padding: 16px;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.mp-content { display: flex; flex-direction: column; }
.mp-content .lbl { font-size: 11px; color: #fff; margin-bottom: 4px; }
.mp-content .val { font-size: 20px; font-weight: 700; color: var(--primary); margin-bottom: 4px; }
.mp-content .roi { font-size: 11px; color: #fff; }

/* Settings Form */
.settings-form { padding: 0 20px; }
.tabs-row { display: flex; align-items: center; gap: 16px; margin-bottom: 8px; position:relative; }
.tab { font-size: 14px; color: #fff; cursor: pointer; padding-bottom: 4px; }
.tab.active { color: white; border-bottom: 2px solid var(--primary); font-weight: 600; }
.info-icon { margin-left: auto; color: #fff; }
.helper-text { font-size: 11px; color: #fff; margin-bottom: 20px; }

.form-group { margin-bottom: 20px; }
.form-group label { display: block; font-size: 13px; color: #fff; margin-bottom: 8px; }
.tag-rec { background: #333; color: var(--primary); font-size: 9px; padding: 2px 4px; border-radius: 2px; margin-left: 4px; }

.input-wrapper {
    background: #111;
    border: 1px solid #333;
    border-radius: 6px;
    display: flex;
    align-items: center;
    padding: 0 12px;
    height: 44px;
}
.input-wrapper input {
    background: transparent;
    border: none;
    color: white;
    flex: 1;
    height: 100%;
    font-size: 14px;
    outline: none;
}
.suffix { font-size: 13px; color: #fff; font-weight: 600; display:flex; align-items:center; gap:4px; }
.suffix.warning { color: #FFA500; }
.rotate-90 { transform: rotate(90deg); }

.balance-row { display: flex; justify-content: space-between; font-size: 11px; color: #fff; margin-top: 6px; }
.add-icon { color: var(--primary); font-size: 14px; font-weight: bold; cursor: pointer; }

.form-item-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    font-size: 13px;
    color: #fff;
}
.pairs-preview { display: flex; align-items: center; gap: 8px; color: white; font-size: 12px; }
.stack-icons { display: flex; }
.coin-icon { width: 16px; height: 16px; border-radius: 50%; margin-left: -6px; border: 1px solid #111; }
.coin-icon:first-child { margin-left: 0; }
.coin-icon.orange { background: orange; }
.coin-icon.blue { background: blue; }
.coin-icon.green { background: #DFFF00; }

.accordion-item { display: flex; justify-content: space-between; font-size: 13px; color: #fff; margin-bottom: 20px; cursor: pointer; }

.setting-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 13px; }
.dashed-underline { border-bottom: 1px dashed #fff; color: #fff; padding-bottom: 2px; }
.val-link { display: flex; align-items: center; gap: 4px; cursor: pointer; }

.toggle-switch {
    width: 36px; height: 20px;
    background: #333;
    border-radius: 10px;
    position: relative;
}
.toggle-switch::after {
    content: '';
    position: absolute;
    top: 2px; left: 2px;
    width: 16px; height: 16px;
    background: #666;
    border-radius: 50%;
}

.agreement-box { display: flex; gap: 10px; align-items: flex-start; margin-bottom: 24px; cursor: pointer; }
.checkbox { 
    width: 16px; height: 16px; border: 1px solid #666; border-radius: 3px; 
    display: flex; align-items: center; justify-content: center;
}
.checkbox.checked { background: var(--primary); border-color: var(--primary); color: black; }
.agree-text { font-size: 11px; color: #fff; line-height: 1.4; }
.highlight { color: var(--primary); }

.submit-btn {
    width: 100%;
    background: #333; /* Disabled look initially */
    color: #888;
    border: none;
    padding: 14px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 14px;
}
.submit-btn:not(:disabled) {
    background: var(--primary);
    color: black;
    cursor: pointer;
}

.footer-links { padding: 40px 20px; background: black; text-align: center; color: #fff; font-size: 12px; margin-top:20px; }
</style>
