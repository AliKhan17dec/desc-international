<script setup>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { 
  ShieldCheck, 
  ExternalLink, 
  Search, 
  Download,
  Database,
  Lock,
  CheckCircle2,
  FileText,
  Activity,
  Globe,
  HelpCircle,
  ChevronRight,
  TrendingUp,
  Box,
  Share2,
  Twitter,
  Github,
  MessageCircle,
  Cpu
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const assetStats = [
  { asset: 'BTC', total: '652,624.84', client: '625,979.61', ratio: '104.26%', icon: 'https://cryptologos.cc/logos/bitcoin-btc-logo.png' },
  { asset: 'ETH', total: '4,642,351.48', client: '4,472,185.39', ratio: '103.80%', icon: 'https://cryptologos.cc/logos/ethereum-eth-logo.png' },
  { asset: 'USDT', total: '24,057,212,482.00', client: '21,392,104,821.00', ratio: '112.46%', icon: 'https://cryptologos.cc/logos/tether-usdt-logo.png' },
  { asset: 'USDC', total: '2,842,105,942.06', client: '2,710,042,391.00', ratio: '104.87%', icon: 'https://cryptologos.cc/logos/usd-coin-usdc-logo.png' },
  { asset: 'XRP', total: '3,842,105,984.00', client: '3,710,482,105.00', ratio: '103.55%', icon: 'https://cryptologos.cc/logos/xrp-xrp-logo.png' },
  { asset: 'SOL', total: '42,842,105.00', client: '40,482,105.00', ratio: '105.83%', icon: 'https://cryptologos.cc/logos/solana-sol-logo.png' },
];

const footerLinks = [
  {
    title: 'About Us',
    items: ['About', 'Careers', 'Announcements', 'News', 'Press', 'Legal', 'Privacy', 'Community']
  },
  {
    title: 'Products',
    items: ['Exchange', 'Academy', 'Launchpad', 'Trust Wallet', 'NFT', 'Card', 'Gift Card']
  },
  {
    title: 'Service',
    items: ['Downloads', 'Desktop App', 'Buy Crypto', 'Institutional Services', 'Referral', 'Affiliate', 'OTC Trading']
  },
  {
    title: 'Support',
    items: ['Support Center', 'Submit a Ticket', 'API Documentation', 'Fees', 'Verify Identity']
  }
];

const searchQuery = ref('');
const filteredAssets = computed(() => {
  if (!searchQuery.value) return assetStats;
  const q = searchQuery.value.toLowerCase();
  return assetStats.filter(a => a.asset.toLowerCase().includes(q));
});
</script>

<template>
  <div class="por-container">
    <TopHeader />

    <main class="por-main">
      <!-- Hero Section -->
      <section class="por-hero">
        <div class="hero-center">
           <h1 class="hero-title">Proof of Reserves</h1>
           <p class="hero-desc">25 Assets in Reserves | Updated: 2026-02-08 00:00:00 (UTC+0)</p>
           <button class="view-balance-btn">View My Balance</button>
        </div>
      </section>

      <!-- Asset Grid Section -->
      <section class="asset-grid-section">
        <div class="grid-header">
           <div class="header-left">
              <span class="active-tab">Assets (25)</span>
              <span class="inactive-tab">Details</span>
           </div>
           <div class="header-right">
              <div class="search-box">
                 <Search size="14" />
                 <input type="text" placeholder="Search" />
              </div>
           </div>
        </div>

        <div class="asset-grid">
           <div v-for="asset in filteredAssets" :key="asset.asset" class="asset-card">
              <div class="card-top">
                 <img :src="asset.icon" :alt="asset.asset" class="asset-logo" />
                 <span class="asset-name">{{ asset.asset }}</span>
              </div>
              <div class="card-stats">
                 <div class="stat-item">
                    <span class="stat-lbl">DESCI Total Net Balance</span>
                    <span class="stat-val">{{ asset.total }} {{ asset.asset }}</span>
                 </div>
                 <div class="stat-item">
                    <span class="stat-lbl">Total Client Net Balance</span>
                    <span class="stat-val">{{ asset.client }} {{ asset.asset }}</span>
                 </div>
                 <div class="stat-item">
                    <span class="stat-lbl">Reserve Ratio</span>
                    <span class="stat-val gold">{{ asset.ratio }}</span>
                 </div>
              </div>
           </div>
        </div>

        <div class="pagination">
           <button class="page-btn active">1</button>
           <button class="page-btn">2</button>
           <button class="page-btn">3</button>
           <button class="page-btn">4</button>
           <span class="dots">...</span>
           <button class="page-btn">5</button>
        </div>
      </section>

      <!-- Information Section -->
      <section class="info-sections">
        <!-- What is PoR -->
        <div class="info-block">
           <h2 class="info-title">What is Proof of Reserves (PoR)?</h2>
           <div class="info-split">
              <div class="info-text">
                 <p>When we say Proof of Reserves, we are specifically referring to those assets that we hold in custody for users. This means that we are showing evidence and proof that DeSci International has funds that cover all of our users’ assets 1:1, as well as some reserves.</p>
                 <p>When a user deposits one Bitcoin, DeSci’s reserves increase by at least one Bitcoin to ensure client funds are fully backed. It is important to note that this does not include DeSci’s corporate holdings, which are kept on a completely separate ledger.</p>
                 <div class="feature-list">
                    <div class="feat-item">
                       <CheckCircle2 size="16" class="gold" />
                       <span>1:1 Backing</span>
                    </div>
                    <div class="feat-item">
                       <CheckCircle2 size="16" class="gold" />
                       <span>Independent Wallets</span>
                    </div>
                 </div>
              </div>
              <div class="info-visual">
                 <div class="cube-graphic">
                    <Box size="140" stroke-width="1" class="main-cube" />
                    <div class="small-cube c1"></div>
                    <div class="small-cube c2"></div>
                 </div>
              </div>
           </div>
        </div>

        <!-- How it works -->
        <div class="info-block">
           <h2 class="info-title">How it works?</h2>
           <p class="section-desc">At DeSci International, user privacy is a priority. We use Merkle trees as a privacy-preserving tool to audit and secure user assets.</p>
           <div class="merkle-diagram">
              <div class="merkle-box root">Merkle Root</div>
              <div class="merkle-connect"></div>
              <div class="merkle-row">
                 <div class="merkle-box">Hash 1-2</div>
                 <div class="merkle-box">Hash 3-4</div>
              </div>
              <div class="merkle-row leaf">
                 <div class="merkle-box">User 1</div>
                 <div class="merkle-box">User 2</div>
                 <div class="merkle-box">User 3</div>
                 <div class="merkle-box">User 4</div>
              </div>
           </div>
        </div>

        <!-- Verification Process -->
        <div class="info-block">
           <h2 class="info-title">Verification Process</h2>
           <div class="process-steps">
              <div class="step-card">
                 <div class="step-num">1</div>
                 <h4 class="step-name">Log In & Authenticate</h4>
                 <p>Log in to your DeSci International account to access the verification portal.</p>
              </div>
              <div class="step-card">
                 <div class="step-num">2</div>
                 <h4 class="step-name">Locate Your Balance</h4>
                 <p>Access your personal balance statement and the corresponding Merkle leaf hash.</p>
              </div>
              <div class="step-card">
                 <div class="step-num">3</div>
                 <h4 class="step-name">Verify vs Root</h4>
                 <p>Compare your local hash against the published Merkle Root for the latest audit.</p>
              </div>
              <div class="step-card">
                 <div class="step-num">4</div>
                 <h4 class="step-name">Independent Audit</h4>
                 <p>Download the full verification script to run your own audit locally.</p>
              </div>
           </div>
        </div>
      </section>

      <!-- Footer Section -->
      <footer class="footer-section">
         <div class="footer-grid">
            <div v-for="cat in footerLinks" :key="cat.title" class="footer-col">
               <h3>{{ cat.title }}</h3>
               <ul>
                  <li v-for="item in cat.items" :key="item"><a href="#">{{ item }}</a></li>
               </ul>
            </div>
         </div>
         <div class="footer-bottom">
            <div class="comm-title">Community</div>
            <div class="social-row">
               <Twitter size="18" />
               <Github size="18" />
               <MessageCircle size="18" />
               <Globe size="18" />
            </div>
            <p class="copyright">DeSci International © 2026. Empowering Decentralized Science.</p>
         </div>
      </footer>
    </main>

    <div class="bottom-spacer"></div>
  </div>
</template>

<style scoped>
.por-container {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  overflow-x: hidden;
  width: 100%;
}

.por-main {
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
  box-sizing: border-box;
}

/* Hero */
.por-hero {
  padding: 60px 20px;
  text-align: center;
  background: radial-gradient(circle at center, #1e2329 0%, #000 70%);
}

.hero-title { font-size: 28px; font-weight: 800; margin-bottom: 20px; color: var(--primary);}
.hero-desc { font-size: 13px; color: #fff; margin-bottom: 30px; }
.view-balance-btn {
  background: var(--primary); color: #000; border: none; padding: 12px 32px;
  border-radius: 8px; font-weight: 800; font-size: 14px; cursor: pointer;
  width: 100%; max-width: 240px;
}

@media (min-width: 768px) {
  .hero-title { font-size: 36px; }
  .por-hero { padding: 80px 20px; }
}

/* Grid Section */
.asset-grid-section { padding: 40px 15px; width: 100%; box-sizing: border-box; }

.grid-header {
  display: flex; justify-content: space-between; align-items: flex-start;
  flex-direction: column; gap: 20px;
  margin-bottom: 30px; border-bottom: 1px solid #1a1a1a; padding-bottom: 15px;
}

@media (min-width: 768px) {
  .grid-header { flex-direction: row; align-items: center; }
}

.header-left { display: flex; gap: 20px; }
.active-tab { color: var(--primary); font-weight: 800; font-size: 14px; position: relative; }
.active-tab::after { content: ''; position: absolute; bottom: -16px; left: 0; width: 100%; height: 2px; background: var(--primary); }
.inactive-tab { color: #fff; font-size: 14px; cursor: pointer; }

.search-box {
  background: #1e2329; border-radius: 6px; padding: 8px 12px;
  display: flex; align-items: center; gap: 8px; border: 1px solid #2b3139;
  width: 100%; box-sizing: border-box;
}
.search-box input { background: transparent; border: none; color: #fff; font-size: 12px; outline: none; width: 100%; }

@media (min-width: 768px) {
  .search-box { width: auto; }
  .search-box input { width: 150px; }
}

.asset-grid {
  display: grid; grid-template-columns: 1fr; gap: 15px;
}

@media (min-width: 640px) {
  .asset-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (min-width: 1024px) {
  .asset-grid { grid-template-columns: repeat(3, 1fr); gap: 20px; }
}

.asset-card {
  background: #0d0d0d; border: 1px solid #1e2329; border-radius: 12px; padding: 20px;
}

.card-top { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
.asset-logo { width: 28px; height: 28px; }
.asset-name { font-size: 16px; font-weight: 800; }

.card-stats { display: flex; flex-direction: column; gap: 15px; }
.stat-item { display: flex; flex-direction: column; gap: 5px; }
.stat-lbl { font-size: 10px; color: #fff; text-transform: uppercase; font-weight: 700; }
.stat-val { font-size: 13px; font-weight: 700; word-break: break-all; }
.stat-val.gold { color: #DFFF00; font-size: 18px; font-weight: 900; }

.pagination { display: flex; justify-content: center; gap: 8px; margin-top: 30px; align-items: center; flex-wrap: wrap; }
.page-btn {
  background: transparent; border: 1px solid #2b3139; color: #fff;
  padding: 5px 10px; border-radius: 4px; font-size: 12px; cursor: pointer;
}
.page-btn.active { background: var(--primary); color: #000; border-color: var(--primary); font-weight: 800; }
.dots { color: #fff; }

/* Info Sections */
.info-sections { padding: 60px 15px; border-top: 1px solid #1a1a1a; width: 100%; box-sizing: border-box; }
.info-block { margin-bottom: 60px; max-width: 900px; margin-left: auto; margin-right: auto; }
.info-title { font-size: 22px; font-weight: 800; margin-bottom: 30px; text-align: center; }

@media (min-width: 768px) {
  .info-title { font-size: 28px; margin-bottom: 40px; }
  .info-block { margin-bottom: 100px; }
}

.info-split { display: grid; grid-template-columns: 1fr; gap: 40px; align-items: center; }

@media (min-width: 900px) {
  .info-split { grid-template-columns: 1.2fr 0.8fr; gap: 60px; }
}

.info-text p { font-size: 13px; color: #fff; line-height: 1.6; margin-bottom: 15px; }
.feature-list { display: flex; gap: 20px; margin-top: 20px; flex-wrap: wrap; }
.feat-item { display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; color: #fff; }
.gold { color: var(--primary); }

.info-visual { display: flex; justify-content: center; width: 100%; }
.cube-graphic { position: relative; color: var(--primary); width: 140px; height: 140px; }
.small-cube { position: absolute; width: 30px; height: 30px; border: 1px solid rgba(223, 255, 0, 0.3); border-radius: 6px; }
.c1 { top: -5px; left: -5px; animation: float 4s infinite ease-in-out; }
.c2 { bottom: -5px; right: -5px; animation: float 4s infinite ease-in-out 2s; }

@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

/* Merkle Diagram */
.merkle-diagram { display: flex; flex-direction: column; align-items: center; padding: 20px 0; width: 100%; overflow: hidden; }
.merkle-box {
  background: #1e2329; border: 1px solid #2b3139; padding: 8px 16px;
  border-radius: 6px; font-size: 11px; font-weight: 700; min-width: 80px; text-align: center;
}
.merkle-box.root { border-color: var(--primary); color: var(--primary); margin-bottom: 20px; }
.merkle-row { display: flex; gap: 10px; margin-top: 20px; flex-wrap: wrap; justify-content: center; }
.merkle-row.leaf { display: flex; gap: 10px; margin-top: 20px; flex-wrap: wrap; justify-content: center; }
.merkle-row.leaf .merkle-box { background: #000; border-style: dashed; padding: 6px 12px; min-width: 60px; font-size: 10px; }

/* Process Steps */
.process-steps { display: grid; grid-template-columns: 1fr; gap: 15px; }

@media (min-width: 640px) {
  .process-steps { grid-template-columns: repeat(2, 1fr); }
}

@media (min-width: 1024px) {
  .process-steps { grid-template-columns: repeat(4, 1fr); gap: 20px; }
}

.step-card { background: #0d0d0d; border: 1px solid #1e2329; border-radius: 12px; padding: 20px; text-align: center; }
.step-num {
  width: 28px; height: 28px; background: var(--primary); color: #000; border-radius: 50%;
  display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: 900; font-size: 12px;
}
.step-name { font-size: 14px; font-weight: 800; margin-bottom: 10px; }
.step-card p { font-size: 11px; color: #fff; line-height: 1.5; }

/* Footer */
.footer-section { padding: 60px 15px; border-top: 1px solid #1a1a1a; width: 100%; box-sizing: border-box; }
.footer-grid { display: grid; grid-template-columns: repeat(1, 1fr); gap: 30px; margin-bottom: 40px; }

@media (min-width: 480px) {
  .footer-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (min-width: 900px) {
  .footer-grid { grid-template-columns: repeat(4, 1fr); gap: 40px; }
}

.footer-col h3 { font-size: 14px; font-weight: 800; margin-bottom: 20px; }
.footer-col ul { list-style: none; padding: 0; }
.footer-col ul li { margin-bottom: 10px; }
.footer-col ul li a { color: #fff; text-decoration: none; font-size: 12px; transition: color 0.2s; }
.footer-col ul li a:hover { color: #fff; }

.footer-bottom { border-top: 1px solid #111; padding-top: 30px; text-align: center; }
.comm-title { font-size: 14px; font-weight: 800; margin-bottom: 15px; }
.social-row { display: flex; justify-content: center; gap: 20px; color: #fff; margin-bottom: 30px; }
.copyright { color: #fff; font-size: 11px; }

@media (max-width: 480px) {
  .por-hero { padding: 40px 15px; }
}
</style>
