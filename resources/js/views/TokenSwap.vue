<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  ArrowUpDown, 
  Menu, 
  Wallet, 
  History,
  Info,
  ChevronDown,
  Plus
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const fromAmount = ref('0');
const toAmount = ref('0');

const connectWallet = () => {
  // Implementation for wallet connection
  console.log('Connecting wallet...');
};
</script>

<template>
  <div class="portal-swap-screen">
    <!-- Portal Header -->
    <TopHeader />

    <main class="swap-workspace">
      <div class="swap-panel">
        <!-- Swap Title Row -->
        <div class="panel-header">
          <div class="title-group">
            <div class="chain-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ring-ic"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line><line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line><line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line><line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line></svg>
            </div>
            <h2 class="panel-title">Swap</h2>
          </div>
          <button class="history-btn">
            <History size="20" />
          </button>
        </div>

        <div class="swap-card">
          <!-- From Input -->
          <div class="token-input-box">
            <div class="input-top">
              <span class="label">From</span>
              <div class="status-group">
                <span class="status dim">Not connected</span>
                <Wallet size="14" class="dim" />
              </div>
            </div>
            <div class="input-bottom">
              <button class="token-selector">
                <div class="token-art osis-icon">
                  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12,2L4.5,20.29L5.21,21L12,18L18.79,21L19.5,20.29L12,2Z" /></svg>
                  <div class="network-badge eth">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L4.5 20.29L5.21 21L12 18L18.79 21L19.5 20.29L12 2Z"/></svg>
                  </div>
                </div>
                <span class="token-name">OSIS</span>
                <ChevronDown size="16" />
              </button>
              <div class="amount-display">{{ fromAmount }}</div>
            </div>
          </div>

          <!-- Mid Swap Button -->
          <div class="swap-divider">
            <div class="swap-ring">
              <ArrowUpDown size="18" />
            </div>
          </div>

          <!-- To Input -->
          <div class="token-input-box">
            <div class="input-top">
              <span class="label">To</span>
              <div class="status-group">
                <span class="status dim">Not connected</span>
                <Wallet size="14" class="dim" />
              </div>
            </div>
            <div class="input-bottom">
              <button class="token-selector">
                <div class="token-art osis-icon alt">
                  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12,2L4.5,20.29L5.21,21L12,18L18.79,21L19.5,20.29L12,2Z" /></svg>
                  <div class="network-badge sol">
                    <svg viewBox="0 0 24 24" fill="currentColor"><rect x="4" y="4" width="16" height="3" /><rect x="4" y="10.5" width="16" height="3" /><rect x="4" y="17" width="16" height="3" /></svg>
                  </div>
                </div>
                <span class="token-name">OSIS</span>
                <ChevronDown size="16" />
              </button>
              <div class="amount-display">{{ toAmount }}</div>
            </div>
            <div class="price-info dim">1 OSIS = $0.05</div>
          </div>

          <!-- Action Button -->
          <button class="main-cta" @click="connectWallet">
            Connect source wallet
          </button>
        </div>
      </div>
    </main>

    <!-- Portal Footer -->
    <footer class="portal-footer">
      <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
      </div>
      <div class="social-icons">
        <a href="#"><svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.25 2.25h6.663l4.715 6.175 5.616-6.175zM17.083 19.77h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg></a>
        <a href="#"><svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037 19.736 19.736 0 0 0-4.885 1.515.069.069 0 0 0-.032.027C.533 9.048-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg></a>
      </div>
      <div class="powered-by">
        <span class="dim">Powered by</span>
        <span class="worm-logo">DESCI INTERNATIONAL</span>
      </div>
    </footer>
  </div>
</template>

<style scoped>
.portal-swap-screen {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  display: flex;
  flex-direction: column;
}



/* Workspace */
.swap-workspace {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 40px 20px;
}

.swap-panel {
  width: 100%;
  max-width: 440px;
}

.panel-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  padding: 0 4px;
}

.title-group {
  display: flex;
  align-items: center;
  gap: 12px;
}

.chain-icon {
  width: 28px;
  height: 28px;
  color: var(--primary);
}

.panel-title {
  font-size: 24px;
  font-weight: 700;
  color: var(--primary);
}

.history-btn {
  background: #1e1f26;
  border: 1px solid #2b2c35;
  color: #fff;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

/* Card */
.swap-card {
  background: #12131a;
  border: 1px solid #1e1f26;
  border-radius: 20px;
  padding: 4px; /* Matches the nested look */
}

.token-input-box {
  background: #1a1b23;
  padding: 20px;
  border-radius: 16px;
  margin: 4px;
}

.input-top {
  display: flex;
  justify-content: space-between;
  margin-bottom: 12px;
}

.label {
  font-size: 12px;
  font-weight: 600;
  color: var(--primary);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.status-group {
  display: flex;
  align-items: center;
  gap: 6px;
}

.status {
  font-size: 12px;
}

.dim {
  color: rgba(223, 255, 0, 0.4);
}

.input-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.token-selector {
  background: #2b2c35;
  border: 1px solid #3e3f4d;
  color: #fff;
  padding: 6px 14px 6px 6px;
  border-radius: 100px;
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  transition: background 0.2s;
}

.token-selector:hover {
  background: #3e3f4d;
}

.token-art {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

.osis-icon { background: var(--primary); color: #000; }
.osis-icon.alt { background: rgba(223, 255, 0, 0.2); color: var(--primary); }

.network-badge {
  position: absolute;
  bottom: -2px;
  right: -2px;
  width: 14px;
  height: 14px;
  background: #1a1b23;
  border-radius: 50%;
  padding: 2px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.network-badge.eth { color: #627eea; }
.network-badge.sol { color: var(--primary); }

.token-name {
  font-weight: 700;
  font-size: 14px;
}

.amount-display {
  font-size: 32px;
  font-weight: 700;
  color: #fff;
}

/* Divider */
.swap-divider {
  height: 2px;
  background: #12131a;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: -10px 0;
  position: relative;
  z-index: 2;
}

.swap-ring {
  background: #2b2c35;
  border: 4px solid #12131a;
  color: #fff;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.price-info {
  font-size: 12px;
  margin-top: 12px;
}

/* CTA */
.main-cta {
  width: calc(100% - 32px);
  margin: 16px;
  background: var(--primary);
  color: #000;
  border: none;
  padding: 16px;
  border-radius: 100px;
  font-weight: 700;
  font-size: 16px;
  cursor: pointer;
  transition: transform 0.2s, background 0.2s;
}

.main-cta:hover {
  background: var(--primary);
  opacity: 0.9;
  transform: translateY(-1px);
  box-shadow: 0 0 20px rgba(223, 255, 0, 0.4);
}

/* Footer */
.portal-footer {
  padding: 40px 32px;
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  align-items: center;
  border-top: 1px solid #1e1f26;
}

.footer-links {
  display: flex;
  gap: 24px;
}

.footer-links a {
  color: #fff;
  text-decoration: none;
  font-size: 12px;
  transition: color 0.2s;
}

.footer-links a:hover { color: #fff; }

.social-icons {
  display: flex;
  gap: 16px;
  justify-content: center;
}

.social-icons a {
  color: #fff;
  transition: opacity 0.2s;
}

.social-icons a:hover { opacity: 0.7; }

.powered-by {
  display: flex;
  gap: 8px;
  justify-content: flex-end;
  font-size: 12px;
  align-items: center;
}

.worm-logo {
  font-weight: 800;
  letter-spacing: 1px;
  color: var(--primary);
}

@media (max-width: 768px) {
  .portal-footer {
    grid-template-columns: 1fr;
    gap: 24px;
    text-align: center;
  }
  
  .footer-links, .social-icons, .powered-by {
    justify-content: center;
  }
}
</style>
