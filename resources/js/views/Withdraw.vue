<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  X, 
  ChevronDown, 
  ChevronLeft, 
  Info, 
  Wallet,
  ArrowUpRight,
  ArrowLeft
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

// State for Withdraw
const withdrawAddress = ref('');
const withdrawAmount = ref('');
const withdrawToken = ref('USDC');
const withdrawChain = ref('Base');

const goBack = () => {
    router.back();
};

const handleWithdraw = () => {
    // Logic for withdrawal
    console.log('Withdrawing:', {
        address: withdrawAddress.value,
        amount: withdrawAmount.value,
        token: withdrawToken.value,
        chain: withdrawChain.value
    });
};
</script>

<template>
    <div class="withdraw-page">
        <TopHeader />
        
        <div class="container narrow">
            <div class="page-header">
                <button class="back-link" @click="goBack">
                    <ArrowLeft size="18" /> Back to Laboratory Vault
                </button>
                <h1 class="title">Request <span class="accent">Withdrawal</span></h1>
                <p class="subtitle">Securely transfer your scientific assets to an external wallet or node.</p>
            </div>

            <div class="withdraw-card">
                <div class="card-body">
                    <div class="wallet-summary">
                        <div class="avatar-box">
                            <Wallet size="24" />
                        </div>
                        <div class="wallet-info">
                            <span class="label">Total Available balance</span>
                            <span class="value">$12,400.45</span>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Recipient address</label>
                        <div class="input-wrapper">
                            <input type="text" v-model="withdrawAddress" placeholder="0x..." class="dark-input" />
                            <button class="paste-btn">Paste</button>
                        </div>
                        <span class="input-hint">Enter the EVM compatible address (Polygon, Base, BSC)</span>
                    </div>

                    <div class="selectors-row">
                        <div class="sel-group">
                            <label>Token to withdraw</label>
                            <div class="sel-box">
                                <div class="coin-icon usdc"></div>
                                <span>{{ withdrawToken }}</span>
                                <ChevronDown size="16" class="ml-auto" />
                            </div>
                        </div>
                        <div class="sel-group">
                            <label>Destination Network</label>
                            <div class="sel-box">
                                <div class="chain-icon base"></div>
                                <span>{{ withdrawChain }}</span>
                                <ChevronDown size="16" class="ml-auto" />
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Withdraw Amount</label>
                        <div class="amount-box">
                            <input type="number" v-model="withdrawAmount" placeholder="0.00" class="no-bg-input" />
                            <div class="suffix-group">
                                <span class="token-name">USDC</span>
                                <button class="max-btn" @click="withdrawAmount = 12400.45">Max</button>
                            </div>
                        </div>
                        <div class="balance-row">
                            <span>≈ $0.00</span>
                            <span class="balance">Balance: 12,400.45 USDC</span>
                        </div>
                    </div>

                    <div class="summary-area">
                        <div class="sum-row">
                            <span>You will receive</span>
                            <span class="white">{{ withdrawAmount || '0.00' }} {{ withdrawToken }}</span>
                        </div>
                        <div class="sum-row">
                            <span>Network Fee</span>
                            <span class="white">~1.20 USDC</span>
                        </div>
                        <div class="sum-row total">
                            <span>Total Deduction</span>
                            <span class="accent">{{ withdrawAmount ? (parseFloat(withdrawAmount) + 1.20).toFixed(2) : '0.00' }} {{ withdrawToken }}</span>
                        </div>
                    </div>

                    <button 
                        class="action-submit-btn" 
                        :disabled="!withdrawAddress || !withdrawAmount"
                        @click="handleWithdraw"
                    >
                        {{ !withdrawAddress ? 'Enter Recipient Address' : 'Confirm Withdrawal' }}
                    </button>
                    
                    <div class="security-notice">
                        <ShieldCheck size="14" />
                        <span>Withdrawals are protected by 2FA and multi-sig verification nodes.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.withdraw-page {
    background: #000;
    min-height: 100vh;
    color: white;
    padding-bottom: 80px;
}

.container.narrow {
    max-width: 600px;
    margin: 0 auto;
    padding: 40px 20px;
}

.page-header {
    margin-bottom: 40px;
}

.back-link {
    background: transparent;
    border: none;
    color: #888;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 24px;
    cursor: pointer;
    padding: 0;
    transition: color 0.2s;
}

.back-link:hover {
    color: var(--primary);
}

.title {
    font-size: 32px;
    font-weight: 800;
    text-transform: uppercase;
    margin-bottom: 12px;
}

.accent {
    color: var(--primary);
}

.subtitle {
    color: #888;
    font-size: 15px;
}

.withdraw-card {
    background: #0d0d0d;
    border: 1px solid #1a1a1a;
    border-radius: 24px;
    overflow: hidden;
}

.card-body {
    padding: 32px;
    display: flex;
    flex-direction: column;
    gap: 28px;
}

.wallet-summary {
    background: #15171b;
    border: 1px solid #2a2e35;
    padding: 20px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    gap: 16px;
}

.avatar-box {
    width: 48px;
    height: 48px;
    background: rgba(223, 255, 0, 0.1);
    color: var(--primary);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.wallet-info {
    display: flex;
    flex-direction: column;
}

.wallet-info .label {
    font-size: 11px;
    text-transform: uppercase;
    color: #666;
    letter-spacing: 1px;
}

.wallet-info .value {
    font-size: 20px;
    font-weight: 800;
}

/* Inputs */
.input-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.input-group label {
    font-size: 13px;
    font-weight: 700;
    color: #ccc;
}

.input-wrapper {
    position: relative;
    display: flex;
}

.dark-input {
    width: 100%;
    background: #15171b;
    border: 1px solid #2a2e35;
    padding: 16px;
    border-radius: 12px;
    color: #fff;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s;
}

.dark-input:focus {
    border-color: var(--primary);
}

.paste-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: #2a2e35;
    border: none;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
}

.input-hint {
    font-size: 12px;
    color: #555;
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
    color: #666;
}

.sel-box {
    background: #15171b;
    border: 1px solid #2a2e35;
    padding: 12px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.ml-auto {
    margin-left: auto;
    color: #444;
}

/* Icons */
.coin-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-image: url('https://cryptologos.cc/logos/usd-coin-usdc-logo.png?v=024');
    background-size: cover;
}

.chain-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: #0052FF;
}

/* Amount */
.amount-box {
    background: #15171b;
    border: 1px solid #2a2e35;
    padding: 10px 16px;
    border-radius: 12px;
    display: flex;
    align-items: center;
}

.no-bg-input {
    background: transparent;
    border: none;
    color: #fff;
    font-size: 20px;
    font-weight: 700;
    flex: 1;
    outline: none;
    width: 100px;
}

.suffix-group {
    display: flex;
    align-items: center;
    gap: 12px;
}

.token-name {
    font-size: 14px;
    font-weight: 800;
    color: #888;
    padding-right: 12px;
    border-right: 1px solid #333;
}

.max-btn {
    background: rgba(223, 255, 0, 0.1);
    border: none;
    color: var(--primary);
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
}

.balance-row {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: #666;
}

.balance-row .balance {
    color: #888;
}

/* Summary */
.summary-area {
    background: rgba(255, 255, 255, 0.02);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.sum-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #888;
}

.sum-row.total {
    margin-top: 8px;
    padding-top: 12px;
    border-top: 1px solid #222;
    font-weight: 700;
}

.white {
    color: #fff;
}

/* Submit */
.action-submit-btn {
    width: 100%;
    background: var(--primary);
    color: #000;
    font-weight: 800;
    padding: 18px;
    border-radius: 14px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    transition: transform 0.2s, opacity 0.2s;
}

.action-submit-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    opacity: 0.9;
}

.action-submit-btn:disabled {
    background: #2a2e35;
    color: #666;
    cursor: not-allowed;
}

.security-notice {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 12px;
    color: #444;
}

@media (max-width: 600px) {
    .selectors-row {
        flex-direction: column;
    }
    
    .title {
        font-size: 24px;
    }
    
    .card-body {
        padding: 20px;
    }
}
</style>
