<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  CheckCircle2, 
  Globe, 
  Twitter, 
  Github, 
  MessageCircle, 
  Send 
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const footerLinks = [
  {
    title: 'About Us',
    items: ['About', 'Careers', 'Announcements', 'News', 'Press', 'Legal', 'Privacy', 'Building Trust', 'Blog', 'Community', 'Risk Warning', 'Notices', 'Downloads', 'Desktop Application', 'Secure Internal Communication Channel']
  },
  {
    title: 'Products',
    items: ['Exchange', 'Buy Crypto', 'Pay', 'Crypto Payments', 'Desci Junior', 'Academy', 'Gift Card', 'Launchpool', 'Auto-Invest', 'ETH Staking', 'NFT', 'BABT', 'Research', 'Charity']
  },
  {
    title: 'Business',
    items: ['P2P Merchant Application', 'P2Pro Merchant Application', 'Listing Application', 'Institutional & VIP Services', 'Labs', 'Desci Connect']
  },
  {
    title: 'Service',
    items: ['Affiliate', 'Referral', 'BNB', 'OTC & Execution Services', 'Historical Market Data', 'Trading Insight', 'Proof of Reserves']
  },
  {
    title: 'Learn',
    items: ['Learn & Earn', 'Browse Crypto Prices', 'Bitcoin Price', 'Ethereum Price', 'Browse Crypto Price Predictions', 'Bitcoin Price Prediction', 'Ethereum Price Prediction', 'Ethereum Upgrade (Pectra)', 'Buy Bitcoin', 'Buy BNB', 'Buy XRP', 'Buy Dogecoin', 'Buy Ethereum', 'Buy Tradable Altcoins']
  },
  {
    title: 'Support',
    items: ['24/7 Chat Support', 'Support Center', 'Product Feedback & Suggestions', 'Fees', 'APIs', 'Desci Verify', 'Trading Parameters', 'Desci Airdrop Portal', 'Law Enforcement Requests', 'How to Raise a Complaint']
  }
];

const user = ref({
    uid: '809784391',
    verified: true
});
</script>

<template>
  <div class="ident-page">
    <TopHeader />
    
    <div class="layout-body">
        <!-- Main Content -->
        <main class="main-content">
            <h1 class="page-title">Identification</h1>
            
            <div class="user-ident-head">
                <div class="avatar-ph">
                     <span class="red-dot"></span>
                </div>
                <div class="uid-box">
                    <div class="uid-row">ID: {{ user.uid }}</div>
                    <div class="ver-badge">
                        <CheckCircle2 size="12" /> Verified
                    </div>
                </div>
            </div>

            <!-- Upgrade Card -->
            <div class="upgrade-card">
                <div class="upg-content">
                    <h2 class="upg-title">Upgrade to increase your fiat limits to 2M USD Daily.</h2>
                    <div class="req-section">
                        <span class="req-label">Require:</span>
                        <ul class="req-list">
                            <li>• Proof of address</li>
                        </ul>
                    </div>
                    <button class="start-btn">Start now</button>
                </div>
            </div>

            <!-- Account Limits -->
            <div class="info-section">
                <h3 class="sect-head">Account Limits</h3>
                <div class="limit-row">
                    <span class="l-label">Fiat Deposit & Withdrawal Limits</span>
                    <span class="l-val">50K USD Daily</span>
                </div>
                <div class="limit-row">
                    <span class="l-label">Crypto Deposit Limit</span>
                    <span class="l-val">Unlimited</span>
                </div>
                 <div class="limit-row">
                    <span class="l-label">Crypto Withdrawal Limit</span>
                    <span class="l-val">8M USDT Daily</span>
                </div>
                 <div class="limit-row">
                    <span class="l-label">P2P Transaction Limits</span>
                    <span class="l-val">Unlimited</span>
                </div>
            </div>

             <!-- Personal Info -->
            <div class="info-section">
                <div class="sect-header-row">
                    <h3 class="sect-head">Personal Information</h3>
                    <span class="link-gold">Update Identity</span>
                </div>
            </div>
        </main>
    </div>

    <!-- Massive Desktop Footer -->
    <footer class="mega-footer">
        <div class="footer-container">
            <div class="footer-socials-col">
                <h4 class="f-col-title">Community</h4>
                <div class="social-grid">
                    <div class="s-icon"><MessageCircle size="20"/></div>
                    <div class="s-icon"><Twitter size="20"/></div>
                    <div class="s-icon"><Send size="20"/></div>
                    <div class="s-icon"><Github size="20"/></div>
                </div>
                
                <div class="f-settings-row">
                     <button class="f-set-btn"><Globe size="14"/> English</button>
                     <button class="f-set-btn">USD-$</button>
                     <div class="f-theme-tog">
                        Theme <div class="tog-switch"><div class="tog-ball"></div></div>
                     </div>
                </div>
            </div>
            
            <div class="links-cols-wrap">
                <div v-for="col in footerLinks" :key="col.title" class="f-links-col">
                    <h4 class="f-col-title">{{ col.title }}</h4>
                    <div class="f-link-list">
                         <a v-for="item in col.items" :key="item" href="#" class="f-link">{{ item }}</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="copyright">Desci International © 2026</p>
            <p class="cookie-pref">Cookie Preferences</p>
            <p class="disclaimer">
                Binance ADGM entities are regulated by the Financial Services Regulatory Authority (FSRA) of the Abu Dhabi Global Markets (ADGM) as follows: (1) Nest Exchange Limited is recognized as a Recognized Investment Exchange (Derivatives), with a stipulation... <br/><br/>
                Risk Warning: Virtual Asset prices can be volatile. The value of your investment may down or up and you may not get back the amount invested...
            </p>
        </div>
    </footer>
  </div>
</template>

<style scoped>
.ident-page {
    background: #000;
    min-height: 100vh;
    color: #eaecef;
    font-family: 'IBM Plex Sans', sans-serif;
    overflow-x: hidden;
    width: 100%;
    display: flex;
    flex-direction: column;
}

.layout-body {
    display: flex;
    justify-content: center; /* Center the content */
    width: 100%;
    flex: 1;
}

/* Main Content */
.main-content {
    width: 100%;
    max-width: 1000px;
    padding: 32px 20px;
    margin: 0 auto;
}

.page-title {
    font-size: 32px;
    font-weight: 600;
    margin-bottom: 32px;
    color: #eaecef;
}

.user-ident-head {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 32px;
}

.avatar-ph {
    width: 48px;
    height: 48px;
    background: #2b3139;
    border-radius: 50%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.red-dot {
    position: absolute;
    top: 2px;
    right: 2px;
    width: 10px;
    height: 10px;
    background: #f6465d;
    border-radius: 50%;
    border: 2px solid #181a20;
}

.uid-row {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 4px;
}

.ver-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background-color: rgba(14, 203, 129, 0.15);
    color: #DFFF00;
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 4px;
}

/* Upgrade Card */
.upgrade-card {
    background: #1e2329;
    border-radius: 8px;
    padding: 32px;
    margin-bottom: 40px;
    /* border: 1px solid #2b3139; */
}

.upg-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 24px;
    color: #eaecef;
}

.req-section {
    margin-bottom: 32px;
}

.req-label {
    font-size: 14px;
    color: #848e9c;
    display: block;
    margin-bottom: 8px;
}

.req-list {
    list-style: none;
    padding: 0;
    font-size: 14px;
    color: #eaecef;
}

.start-btn {
    background: #fcd535; /* Binance yellow-ish */
    color: #181a20;
    border: none;
    font-weight: 500;
    padding: 10px 24px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    min-width: 120px;
}
.start-btn:hover {
    opacity: 0.9;
}

/* Info Section */
.info-section {
    margin-bottom: 40px;
}

.sect-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.sect-head {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 24px;
    color: #eaecef;
}
.sect-header-row .sect-head { margin-bottom: 0; }

.limit-row {
    display: flex;
    justify-content: space-between;
    padding: 16px 0;
    border-bottom: 1px solid #2b3139;
}
.limit-row:first-of-type { border-top: 1px solid #2b3139; }

.l-label {
    font-size: 14px;
    color: #eaecef;
}

.l-val {
    font-size: 14px;
    font-weight: 500;
    color: #eaecef;
}

.link-gold {
    color: #c99400; /* Darker gold/yellow for link */
    font-size: 14px;
    cursor: pointer;
}
.link-gold:hover {
    color: #fcd535;
}


/* Footer */
.mega-footer {
    background: #0b0e11;
    border-top: 1px solid #1e2329;
    padding: 64px 40px 24px;
    margin-top: auto;
}

.footer-container {
    display: flex;
    gap: 60px;
    max-width: 1400px;
    margin: 0 auto;
}

.footer-socials-col {
    width: 200px;
    flex-shrink: 0;
}

.social-grid {
    display: flex;
    gap: 16px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.s-icon {
    color: #fff;
    cursor: pointer;
}
.s-icon:hover { color: #eaecef; }

.f-settings-row {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.f-set-btn {
    background: #2b3139;
    border: none;
    color: #eaecef;
    padding: 8px 16px;
    border-radius: 4px;
    text-align: left;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.f-theme-tog {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    color: #fff;
}

.tog-switch {
    width: 32px;
    height: 16px;
    background: #2b3139;
    border-radius: 10px;
    position: relative;
    cursor: pointer;
}
.tog-ball {
    width: 12px;
    height: 12px;
    background: #fff;
    border-radius: 50%;
    position: absolute;
    top: 2px;
    left: 2px;
}

.links-cols-wrap {
    flex: 1;
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 24px;
}

.f-col-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 24px;
    color: #eaecef;
}

.f-link-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.f-link {
    font-size: 14px;
    color: #fff;
    white-space: nowrap;
}
.f-link:hover {
    color: #eaecef;
}

.footer-bottom {
    max-width: 1400px;
    margin: 60px auto 0;
    border-top: 1px solid #1e2329;
    padding-top: 24px;
    text-align: center;
}

.copyright {
    color: #fff;
    font-size: 14px;
    margin-bottom: 16px;
}

.cookie-pref {
    color: #fff;
    font-size: 14px;
    margin-bottom: 24px;
    cursor: pointer;
}

.disclaimer {
    color: #fff;
    font-size: 12px;
    line-height: 1.5;
    max-width: 1000px;
    margin: 0 auto;
    font-style: italic;
}

@media (max-width: 1024px) {
    .links-cols-wrap {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .layout-body {
        flex-direction: column;
    }
    .footer-container {
        flex-direction: column;
    }
    .links-cols-wrap {
        grid-template-columns: repeat(2, 1fr);
    }
    .social-grid {
        justify-content: flex-start;
    }
    .f-settings-row {
        flex-direction: row;
        flex-wrap: wrap;
    }
}

@media (max-width: 640px) {
    .main-content {
        padding: 24px 16px;
    }
    .page-title {
        font-size: 24px;
        margin-bottom: 24px;
    }
    .user-ident-head {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    .upgrade-card {
        padding: 20px;
    }
    .upg-title {
        font-size: 18px;
    }
    .limit-row {
        flex-direction: column;
        gap: 4px;
        align-items: flex-start;
    }
    .l-val {
        margin-top: 4px;
        font-weight: 600;
    }
    .links-cols-wrap {
        grid-template-columns: 1fr;
    }
    .mega-footer {
        padding: 40px 20px 24px;
    }
    .footer-container {
        gap: 40px;
    }
}
</style>
