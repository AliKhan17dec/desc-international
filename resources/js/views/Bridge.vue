<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  ArrowDownUp,
  Twitter,
  MessageSquare,
  ChevronDown,
  Clock,
  Wallet,
  Send,
  Linkedin,
  Youtube,
  Cloud
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const navigate = (path) => router.push(path);
</script>

<template>
  <div class="bridge-page">
    <!-- Main Background -->
    <div class="portal-gradient"></div>

    <TopHeader />
    <div class="bridge-layout">

      <!-- Bridge Widget -->
      <main class="bridge-widget-container">
        <div class="bridge-card">
          <div class="card-header">
            <div class="bridge-title">
              <span class="link-ic">
                <ArrowDownUp size="20" />
              </span>
              <h2>USDC Transfer</h2>
            </div>
            <button class="wallet-history">
              <Clock size="20" />
            </button>
          </div>

          <!-- FROM CARD -->
          <div class="transfer-box from-box">
            <div class="box-labels">
              <span class="label-txt">From</span>
              <div class="connection-status">
                <span>Not connected</span>
                <Wallet size="14" />
              </div>
            </div>
            <div class="selection-row">
              <div class="token-selector">
                <div class="token-ic-wrap">
                  <img src="https://cryptologos.cc/logos/usd-coin-usdc-logo.png" alt="USDC" />
                  <span class="network-badge solana"></span>
                </div>
                <span class="token-name">USDC</span>
                <ChevronDown size="16" />
              </div>
              <div class="balance-display">0</div>
            </div>
          </div>

          <!-- CONNECTOR -->
          <div class="bridge-connector">
            <div class="swap-ic-btn">
              <ArrowDownUp size="20" />
            </div>
          </div>

          <!-- TO CARD -->
          <div class="transfer-box to-box">
            <div class="box-labels">
              <span class="label-txt">To</span>
              <div class="connection-status">
                <span>Not connected</span>
                <Wallet size="14" />
              </div>
            </div>
            <div class="selection-row">
              <div class="token-selector">
                <div class="token-ic-wrap">
                  <img src="https://cryptologos.cc/logos/usd-coin-usdc-logo.png" alt="USDC" />
                  <span class="network-badge ethereum"></span>
                </div>
                <span class="token-name">USDC</span>
                <ChevronDown size="16" />
              </div>
              <div class="balance-display">0</div>
            </div>
            <div class="rate-info">
              1 USDC = $1.00
            </div>
          </div>

          <!-- CONNECT CALL -->
          <button class="btn-connect-wallet">
            Connect source wallet
          </button>
        </div>
      </main>
    </div>

    <!-- Massive Global Footer (Imported structure) -->
    <footer class="main-footer">
        <div class="container footer-content">
            <div class="footer-left">
                <div class="f-logo">
                    <img src="/logo.png" alt="Desci" />
                    <span>DESCI INTERNATIONAL</span>
                </div>
            </div>

            <div class="footer-nav-grid">
                <div class="footer-column">
                    <div class="f-link" @click="navigate('/launchpad')">Launchpad</div>
                    <div class="f-link" @click="navigate('/portfolio')">Portfolio</div>
                    <div class="f-link" @click="navigate('/referral')">Earn OSIS XP</div>
                    <div class="f-link" @click="navigate('/market')">Markets</div>
                    <div class="f-link" @click="navigate('/bridge')">Bridge</div>
                    <div class="f-link" @click="navigate('/coming-soon')">Auctions (Claim)</div>
                </div>
                <div class="footer-column">
                    <div class="f-link" @click="navigate('/coming-soon')">About OSIS Protocol</div>
                    <div class="f-link" @click="navigate('/coming-soon')">For Researchers</div>
                    <div class="f-link" @click="navigate('/coming-soon')">OSIS Token</div>
                    <div class="f-link" @click="navigate('/announcements')">Blog</div>
                </div>
                <div class="footer-column">
                    <div class="f-link" @click="navigate('/governance')">Governance</div>
                    <div class="f-link" @click="navigate('/coming-soon')">Docs</div>
                    <div class="f-link" @click="navigate('/coming-soon')">Careers</div>
                    <div class="f-link" @click="navigate('/coming-soon')">Email Support</div>
                    <div class="f-link" @click="navigate('/coming-soon')">Terms of Use</div>
                    <div class="f-link" @click="navigate('/coming-soon')">Privacy Policy</div>
                    <div class="f-link" @click="navigate('/coming-soon')">Cookie preferences</div>
                </div>
            </div>

            <div class="footer-socials">
                <a href="#"><Twitter size="20" /></a>
                <a href="#"><Send size="20" /></a>
                <a href="#"><Linkedin size="20" /></a>
                <a href="#"><MessageSquare size="20" /></a>
                <a href="#"><Youtube size="20" /></a>
                <a href="#"><Cloud size="20" /></a>
            </div>
        </div>
    </footer>
  </div>
</template>

<style scoped>
.bridge-page {
  min-height: 100vh;
  background: #000;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  position: relative;
  overflow-x: hidden;
  display: flex;
  flex-direction: column;
}

.portal-gradient {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at center, rgba(223, 255, 0, 0.05) 0%, #000 70%);
  opacity: 0.8;
  z-index: 0;
  pointer-events: none;
}

.bridge-layout {
  position: relative;
  z-index: 10;
  width: 100%;
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 120px 20px 60px 20px;
}

/* Bridge Card */
.bridge-widget-container {
  width: 100%;
  max-width: 460px;
}

.bridge-card {
  background: #0f1112; /* Darker bg to match screenshot */
  border: 1px solid #1e2023;
  border-radius: 24px;
  padding: 24px;
  box-shadow: 0 40px 100px rgba(0,0,0,0.8);
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.bridge-title {
  display: flex;
  align-items: center;
  gap: 12px;
}

.link-ic { color: #fff; opacity: 0.8; }
.bridge-title h2 { font-size: 20px; font-weight: 600; color: #fff; margin: 0; }

.wallet-history {
  background: #1a1c20;
  border: 1px solid #2a2d33;
  width: 36px;
  height: 36px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  cursor: pointer;
  transition: all 0.2s;
}
.wallet-history:hover {
    color: #fff;
    background: #25282e;
}

/* Transfer Boxes */
.transfer-box {
  background: #131416;
  border-radius: 16px;
  padding: 20px;
  border: 1px solid transparent; /* No border in screenshot, or very subtle */
  transition: border 0.2s;
}

.from-box:hover, .to-box:hover {
    border-color: #2a2d33;
}

.box-labels {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.label-txt { font-size: 13px; color: #fff; font-weight: 500; }
.connection-status {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  color: #fff;
}

.selection-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.token-selector {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #1a1b1e;
  padding: 6px 12px 6px 6px;
  border-radius: 24px;
  cursor: pointer;
  border: 1px solid #2a2d33;
  transition: all 0.2s;
}
.token-selector:hover {
    background: #25282e;
    border-color: #3e4249;
}

.token-ic-wrap {
  position: relative;
  width: 28px;
  height: 28px;
}

.token-ic-wrap img { width: 100%; height: 100%; border-radius: 50%; }
.network-badge {
  position: absolute;
  bottom: -2px;
  right: -2px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: 2px solid #1a1b1e;
}
.network-badge.solana { background: #14f195; }
.network-badge.ethereum { background: #627eea; }

.token-name { font-weight: 600; font-size: 15px; color: #fff; }

.balance-display {
  font-size: 32px;
  font-weight: 500;
  color: #fff; /* Dimmed 0 */
}

/* Connector */
.bridge-connector {
  height: 0; /* Overlap boxes */
  position: relative;
  display: flex;
  justify-content: center;
  z-index: 5;
}

.swap-ic-btn {
  width: 36px;
  height: 36px;
  background: #1a1b1e;
  border: 4px solid #0f1112; /* Matches card bg to create 'cutout' effect */
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  top: -18px;
  cursor: pointer;
  color: #fff;
  transition: all 0.2s;
}

.swap-ic-btn:hover { 
    color: #fff;
    transform: rotate(180deg); 
}

/* To Box Spacing */
.to-box {
    margin-top: 4px;
}

.rate-info {
  margin-top: 12px;
  font-size: 12px;
  color: #fff;
  font-weight: 500;
}

/* CTA Button */
.btn-connect-wallet {
  width: 100%;
  background: var(--primary); 
  color: #000;
  border: none;
  padding: 16px;
  border-radius: 16px;
  font-weight: 700;
  font-size: 16px;
  margin-top: 24px;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-connect-wallet:hover { 
  opacity: 0.9;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(223, 255, 0, 0.15);
}

/* GLOBAL FOOTER STYLES (Copied/Adapted) */
.main-footer {
    border-top: 1px solid #1a1a1a;
    padding: 80px 0 40px;
    background: #000;
    margin-top: auto;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 60px;
}

.f-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
}
.f-logo img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}
.f-logo span {
    font-weight: 700;
    letter-spacing: 1px;
    font-size: 14px;
}

.footer-nav-grid {
    display: flex;
    gap: 80px;
    flex-wrap: wrap;
}

.footer-column {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.f-link {
    font-size: 14px;
    color: #fff;
    cursor: pointer;
    transition: color 0.2s;
}
.f-link:hover {
    color: #fff;
}

.footer-socials {
    display: flex;
    gap: 16px;
}
.footer-socials a {
    color: #fff;
    transition: color 0.2s;
}
.footer-socials a:hover {
    color: var(--primary);
}

@media (max-width: 1024px) {
    .footer-content {
        flex-direction: column;
        gap: 40px;
    }
    .footer-nav-grid {
        gap: 40px;
    }
}
@media (max-width: 768px) {
    .footer-nav-grid {
        flex-direction: column;
        gap: 30px;
    }
}
</style>
