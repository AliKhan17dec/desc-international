<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import { X, ChevronDown, Copy, ChevronLeft, Info } from 'lucide-vue-next';

const props = defineProps({
    showDeposit: Boolean,
    showWithdraw: Boolean
});

const emit = defineEmits(['close-deposit', 'close-withdraw']);

// State for Deposit
const depositToken = ref('USDT');
const depositChain = ref('BSC');
const depositAddress = '0x318a683EDA2acC00C22eA0cc02026f5F6196280F'; // Example from screenshot

// State for Withdraw
const withdrawAddress = ref('');
const withdrawAmount = ref('');
const withdrawToken = ref('USDC');
const withdrawChain = ref('Base');

const copyAddress = () => {
    navigator.clipboard.writeText(depositAddress);
    // Optional: show toast
};

</script>

<template>
    <!-- Deposit Modal Overlay -->
    <div v-if="showDeposit" class="modal-overlay" @click.self="$emit('close-deposit')">
        <div class="modal-card">
            <div class="modal-header">
                <button class="icon-btn" @click="$emit('close-deposit')"><ChevronLeft size="20" /></button>
                <div class="header-title-group">
                    <h2>Transfer Crypto</h2>
                    <span class="sub-balance">Polymarket Balance: $0.45</span>
                </div>
                <button class="icon-btn" @click="$emit('close-deposit')"><X size="20" /></button>
            </div>

            <div class="modal-body">
                <div class="selectors-row">
                    <div class="sel-group">
                        <label>Supported token</label>
                        <div class="sel-box">
                            <div class="coin-icon usdt"></div>
                            <span>{{ depositToken }}</span>
                            <ChevronDown size="16" class="ml-auto" />
                        </div>
                    </div>
                    <div class="sel-group">
                        <label>Supported chain</label>
                        <div class="sel-box">
                            <div class="chain-icon bsc"></div>
                            <span>{{ depositChain }}</span>
                            <ChevronDown size="16" class="ml-auto" />
                        </div>
                    </div>
                </div>

                <div class="qr-container">
                    <!-- CSS Generated QR Placeholder to look like screenshot -->
                    <div class="qr-code">
                        <div class="qr-pattern"></div>
                        <div class="qr-logo-overlay">
                            <div class="chain-icon bsc large"></div>
                        </div>
                    </div>
                </div>

                <div class="address-section">
                    <div class="addr-label-row">
                        <span>Your deposit address</span>
                        <Info size="14" class="info-icon" />
                        <a href="#" class="terms-link">Terms apply</a>
                    </div>
                    <div class="addr-box">
                        <span class="addr-text">{{ depositAddress }}</span>
                        <button class="copy-btn" @click="copyAddress">
                            <Copy size="16" /> Copy address
                        </button>
                    </div>
                </div>

                <div class="price-impact-row">
                     <div class="pi-left">
                        <span class="dollar-sign">$</span>
                        <span>Price impact: &lt; 0.25%</span>
                        <Info size="14" class="info-icon" />
                     </div>
                     <ChevronDown size="16" />
                </div>
            </div>
        </div>
    </div>

    <!-- Withdraw Modal Overlay -->
    <div v-if="showWithdraw" class="modal-overlay" @click.self="$emit('close-withdraw')">
        <div class="modal-card">
            <div class="modal-header center-title">
                <h2>Withdraw</h2>
                <button class="close-abs" @click="$emit('close-withdraw')"><X size="20" /></button>
            </div>

            <div class="modal-body">
                <div class="input-group">
                    <label>Recipient address</label>
                    <input type="text" v-model="withdrawAddress" placeholder="0x..." class="dark-input" />
                </div>

                <div class="input-group">
                    <label>Amount</label>
                    <div class="amount-box">
                        <input type="number" v-model="withdrawAmount" placeholder="0.00" class="no-bg-input" />
                        <div class="suffix-group">
                            <span class="token-name">USDC</span>
                            <button class="max-btn">Max</button>
                        </div>
                    </div>
                    <div class="balance-row">
                        <span>$0.00</span>
                        <span>Balance: 0.45 USDC</span>
                    </div>
                </div>

                <div class="selectors-row">
                    <div class="sel-group">
                        <label>Receive token</label>
                        <div class="sel-box">
                            <div class="coin-icon usdc"></div>
                            <span>{{ withdrawToken }}</span>
                            <ChevronDown size="16" class="ml-auto" />
                        </div>
                    </div>
                    <div class="sel-group">
                        <label>Receive chain</label>
                        <div class="sel-box">
                            <div class="chain-icon base"></div>
                            <span>{{ withdrawChain }}</span>
                            <ChevronDown size="16" class="ml-auto" />
                        </div>
                    </div>
                </div>

                <div class="summary-area">
                    <div class="sum-row">
                        <span>You will receive</span>
                        <span>-</span>
                    </div>
                    <div class="sum-row">
                        <span>Transaction breakdown</span>
                        <span>-</span>
                    </div>
                </div>

                <button class="action-submit-btn">Enter Recipient Address</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0,0,0,0.8);
    backdrop-filter: blur(5px);
    z-index: 2000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-card {
    background: #15171b; /* Dark theme typical of screenshots */
    border-radius: 16px;
    width: 100%;
    max-width: 420px;
    border: 1px solid #2a2e35;
    overflow: hidden;
    color: #fff;
    font-family: 'Inter', sans-serif;
    box-shadow: 0 20px 50px rgba(0,0,0,0.5);
}

.modal-header {
    display: flex;
    align-items: center;
    padding: 16px 20px;
    border-bottom: 1px solid #2a2e35;
    position: relative;
}
.modal-header.center-title {
    justify-content: center;
}
.close-abs {
    position: absolute;
    right: 20px;
    background: none;
    border: none;
    color: #fff;
    cursor: pointer;
}

.header-title-group {
    flex: 1;
    text-align: center;
}
.header-title-group h2 {
    font-size: 16px;
    font-weight: 700;
    margin: 0;
}
.sub-balance {
    font-size: 12px;
    color: #888;
}

.icon-btn {
    background: none;
    border: none;
    color: #ccc;
    cursor: pointer;
    padding: 4px;
}
.icon-btn:hover { color: #fff; }

.modal-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Tabs for Withdraw */
.tabs-row {
    display: flex;
    background: #1a1d21;
    padding: 4px;
    margin: 20px 20px 0;
    border-radius: 8px;
}
.tab {
    flex: 1;
    text-align: center;
    padding: 6px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    color: #666;
    border-radius: 6px;
}
.tab.active {
    background: #2a2e35;
    color: #fff;
}

/* Selectors */
.selectors-row {
    display: flex;
    gap: 16px;
}
.sel-group {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.sel-group label {
    font-size: 12px;
    color: #aaa;
}
.sel-box {
    background: #1e2025;
    border: 1px solid #2a2e35;
    padding: 10px 12px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}
.ml-auto { margin-left: auto; color: #666; }

/* Icons */
.coin-icon, .chain-icon {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-size: cover;
}
.usdt { background-image: url('https://cryptologos.cc/logos/tether-usdt-logo.png?v=024'); }
.usdc { background-image: url('https://cryptologos.cc/logos/usd-coin-usdc-logo.png?v=024'); }
.bsc { background-color: #F3BA2F; background-image: url('https://cryptologos.cc/logos/bnb-bnb-logo.png?v=024'); }
.base { background-color: #0052FF; border-radius: 50%; } /* Base usually blue circle */

/* QR Section */
.qr-container {
    display: flex;
    justify-content: center;
    padding: 10px 0;
}
.qr-code {
    width: 180px;
    height: 180px;
    background: #fff;
    border-radius: 12px;
    padding: 10px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}
.qr-pattern {
    width: 100%;
    height: 100%;
    background-image: radial-gradient(#000 30%, transparent 31%);
    background-size: 10px 10px;
}
.qr-logo-overlay {
    position: absolute;
    width: 40px;
    height: 40px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
.chain-icon.large { width: 28px; height: 28px; }

/* Address Box */
.address-section {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.addr-label-row {
    font-size: 12px;
    color: #ccc;
    display: flex;
    align-items: center;
    gap: 6px;
}
.info-icon { opacity: 0.5; }
.terms-link {
    margin-left: auto;
    color: #888;
    text-decoration: underline;
}

.addr-box {
    background: #1e2025;
    border: 1px solid #2a2e35;
    border-radius: 8px;
    overflow: hidden;
}
.addr-text {
    display: block;
    padding: 12px;
    font-family: monospace;
    font-size: 12px;
    color: #ccc;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    border-bottom: 1px solid #2a2e35;
}
.copy-btn {
    width: 100%;
    background: #2a2e35;
    border: none;
    color: #fff;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}
.copy-btn:hover { background: #353a42; }

/* Price Impact */
.price-impact-row {
    background: #1e2025;
    padding: 12px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 13px;
    color: #ccc;
    cursor: pointer;
}
.pi-left { display: flex; gap: 8px; align-items: center; }
.dollar-sign {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 1px solid #666;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
}

/* Withdraw specific */
.input-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.input-group label {
    font-size: 12px;
    color: #ccc;
}
.dark-input {
    background: #1e2025;
    border: 1px solid #2a2e35;
    padding: 12px;
    border-radius: 8px;
    color: #fff;
    font-size: 14px;
    outline: none;
}
.dark-input:focus { border-color: #444; }

.amount-box {
    background: #1e2025;
    border: 1px solid #2a2e35;
    padding: 8px 12px;
    border-radius: 8px;
    display: flex;
    align-items: center;
}
.no-bg-input {
    background: transparent;
    border: none;
    color: #fff;
    font-size: 16px;
    flex: 1;
    outline: none;
}
.suffix-group {
    display: flex;
    align-items: center;
    gap: 8px;
}
.token-name {
    font-size: 14px;
    font-weight: 600;
    color: #ccc;
    padding-right: 8px;
    border-right: 1px solid #333;
}
.max-btn {
    background: #2a2e35;
    border: none;
    color: #fff;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    cursor: pointer;
}
.balance-row {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #666;
}

.summary-area {
    margin-top: 10px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.sum-row {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: #888;
}

.action-submit-btn {
    width: 100%;
    background: #dfff00; /* Desci brand color */
    color: #000;
    font-weight: 700;
    padding: 14px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    margin-top: 10px;
    transition: opacity 0.2s;
}
.action-submit-btn:hover {
    opacity: 0.9;
}
</style>
