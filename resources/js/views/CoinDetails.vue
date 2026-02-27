<script setup>
import { 
  ArrowLeft, 
  Globe, 
  Twitter, 
  Share2, 
  FileText, 
  FlaskConical, 
  Users, 
  BookOpen, 
  ChevronDown, 
  ChevronRight, 
  MessageCircle,
  Play,
  TrendingUp,
  Info,
  Maximize2,
  ExternalLink,
  Github,
  Youtube,
  ArrowRight
} from 'lucide-vue-next';
import { useRouter, useRoute } from 'vue-router';
import { ref, onMounted, onUnmounted, computed } from 'vue';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const route = useRoute();
const goBack = () => router.back();

const activeTab = ref('Feed');

// Mock Data Map for dynamic details
const mockProjects = {
  '1': {
    name: "HairDAO",
    symbol: "HAIR",
    tags: ["DAO", "HAIR LOSS", "DECENTRALIZED"],
    description: "HairDAO is a decentralized autonomous organization focused on finding a cure for hair loss. By sourcing and funding early-stage research, HairDAO aims to accelerate the development of new treatments and ensure patients have a voice in the process.",
    sentiment: "88% Positive",
    communitySize: "1.2K",
    growth: "+5.04%",
    stats: [
        { label: 'Market Cap', value: '$11.33M' },
        { label: 'Price', value: '$16.3' },
        { label: 'Volume (24h)', value: '$45.3K' },
        { label: 'Supply', value: '695K HAIR' }
    ],
    feed: [
        { handle: '@HairDAO_Labs', time: '2h ago', text: 'New clinical data implementation for follicle regeneration is live on the testnet!', stats: '12 💬 45 🔁 156 ❤️', avatar: '/ipnft.png' }
    ]
  },
  '2': {
    name: "VitaDAO",
    symbol: "VITA",
    tags: ["DAO", "LONGEVITY", "RESEARCH"],
    description: "VitaDAO is a community-governed collective that funds and advances longevity research. Its mission is to extend human lifespan by supporting early-stage pharmaceutical research and intellectual property creation in the field of aging.",
    sentiment: "94% Positive",
    communitySize: "5.4K",
    growth: "+4.34%",
    stats: [
        { label: 'Market Cap', value: '$5.44M' },
        { label: 'Price', value: '$2.218' },
        { label: 'Volume (24h)', value: '$4.37K' },
        { label: 'Supply', value: '2.4M VITA' }
    ],
    feed: [
        { handle: '@VitaDAO', time: '5h ago', text: 'Proposal VDP-122: Funding for senolytic research at Copenhagen University has passed!', stats: '89 💬 120 🔁 542 ❤️', avatar: '/ipnft2.png' }
    ]
  },
  '3': {
    name: "VITA-FAST",
    symbol: "FAST",
    tags: ["IPT", "LONGEVITY", "DECENTRALIZED"],
    description: "VITA-FAST is an Intellectual Property Token (IPT) representing stake in a specific longevity drug candidate. It enables decentralized ownership and funding of clinical trials for promising anti-aging compounds.",
    sentiment: "82% Positive",
    communitySize: "890",
    growth: "-0.6%",
    stats: [
        { label: 'Market Cap', value: '$2.17M' },
        { label: 'Price', value: '$2.174' },
        { label: 'Volume (24h)', value: '$122' },
        { label: 'Supply', value: '1M FAST' }
    ],
    feed: [
        { handle: '@VitaFast', time: '1d ago', text: 'Phase 1 safety data is being validated on the OSIS bridge.', stats: '5 💬 10 🔁 34 ❤️', avatar: '/ipnft.png' }
    ]
  },
  '4': {
    name: "FACC",
    symbol: "FACC",
    tags: ["IPT", "BIOCHEM", "OPEN DATA"],
    description: "FACC focuses on accelerating biochemical breakthroughs through open-source data sharing and intellectual property tokenization. It bridges the gap between lab research and market validation using Web3 tools.",
    sentiment: "75% Positive",
    communitySize: "450",
    growth: "0%",
    stats: [
        { label: 'Market Cap', value: '$1.34M' },
        { label: 'Price', value: '$0.252' },
        { label: 'Volume (24h)', value: '$0' },
        { label: 'Supply', value: '5.3M FACC' }
    ],
    feed: [
        { handle: '@FACC_Global', time: 'Yesterday', text: 'Dataset alpha for biochemical markers is now available for DAO verification.', stats: '41 💬 23 🔁 55 ❤️', avatar: '/ipnft2.png' }
    ]
  },
  '5': {
    name: "ValleyDAO",
    symbol: "VALLEY",
    tags: ["DAO", "SYNTHETIC BIO", "SUSTAINABLE"],
    description: "ValleyDAO is a global community funding and democratizing access to synthetic biology technologies. We support researchers building solutions for a more sustainable future, from lab-grown food to carbon-sequestering materials.",
    sentiment: "91% Positive",
    communitySize: "2.1K",
    growth: "+1.34%",
    stats: [
        { label: 'Market Cap', value: '$1.22M' },
        { label: 'Price', value: '$0.11' },
        { label: 'Volume (24h)', value: '$9.2' },
        { label: 'Supply', value: '11M VALLEY' }
    ],
    feed: [
        { handle: '@ValleyDAO', time: '3h ago', text: 'Exciting progress in our carbon-capture biofuel project! Initial results exceed expectations.', stats: '56 💬 34 🔁 210 ❤️', avatar: '/ipnft.png' }
    ]
  },
  'OSIS': {
    name: "OSIS.science",
    symbol: "OSIS",
    tags: ["IP-NFT", "INFRASTRUCTURE", "OSIS COMPATIBLE"],
    description: "OSIS.science is the foundational protocol for decentralized science. It provides the infrastructure for IP-NFT creation, verification nodes, and a global marketplace for research assets. OSIS is the lifeblood of the DeSci ecosystem.",
    sentiment: "96% Positive",
    communitySize: "15.4K",
    growth: "+12.4%",
    stats: [
        { label: 'Market Cap', value: '$142.8M' },
        { label: 'Price', value: '$4.28' },
        { label: 'Volume (24h)', value: '$12.4M' },
        { label: 'Supply', value: '33.3M OSIS' }
    ],
    feed: [
        { handle: '@OSIS_Protocol', time: '1h ago', text: 'Mainnet upgrade v2.4 successfully deployed. Throughput increased by 40%.', stats: '230 💬 1.2K 🔁 4.5K ❤️', avatar: '/ipnft.png' }
    ]
  },
  'DNA': {
    name: "GenomicIP",
    symbol: "DNA",
    tags: ["IPT", "GENOMICS", "OPEN DATA"],
    description: "GenomicIP is a decentralized bio-data layer focused on genomic sequencing and intellectual property. By tokenizing genetic data, it enables researchers to access vast datasets while ensuring privacy and ownership for participants.",
    sentiment: "84% Positive",
    communitySize: "2.8K",
    growth: "+5.2%",
    stats: [
        { label: 'Market Cap', value: '$24.6M' },
        { label: 'Price', value: '$1.52' },
        { label: 'Volume (24h)', value: '$1.2M' },
        { label: 'Supply', value: '16.1M DNA' }
    ],
    feed: [
        { handle: '@GenomicIP', time: '1d ago', text: 'New partnership with global bio-banks to tokenize over 100,000 rare disease sequences.', stats: '45 💬 89 🔁 342 ❤️', avatar: '/ipnft2.png' }
    ]
  },
  'USDC': {
    name: "USD Circle",
    symbol: "USDC",
    tags: ["STABLECOIN", "OSIS NATIVE"],
    description: "USD Circle is a highly liquid stablecoin used across the OSIS ecosystem for research grants, asset purchases, and protocol fees. It maintains a 1:1 peg with the US Dollar through fully reserved assets.",
    sentiment: "100% Stable",
    communitySize: "10K",
    growth: "0%",
    stats: [
        { label: 'Market Cap', value: '$34B' },
        { label: 'Price', value: '$1.00' },
        { label: 'Volume (24h)', value: '$5B' },
        { label: 'Supply', value: '34B USDC' }
    ],
    feed: [
        { handle: '@CircleOSIS', time: '2d ago', text: 'Institutional vault integration complete for high-throughput research funding.', stats: '12 💬 23 🔁 89 ❤️', avatar: '/ipnft.png' }
    ]
  },
  'BTC': {
    name: "Bitcoin",
    symbol: "BTC",
    tags: ["CURRENCY", "POW", "STORE OF VALUE"],
    description: "Bitcoin is a decentralized digital currency, without a central bank or single administrator, that can be sent from user to user on the peer-to-peer bitcoin network without the need for intermediaries.",
    sentiment: "92% Positive",
    communitySize: "21M",
    growth: "+1.2%",
    stats: [
        { label: 'Market Cap', value: '$1.8T' },
        { label: 'Price', value: '$96,242' },
        { label: 'Volume (24h)', value: '$45B' },
        { label: 'Supply', value: '19.7M BTC' }
    ],
    feed: [
        { handle: '@BitcoinArchive', time: '1h ago', text: 'Institutional adoption is reaching new heights as major nodes integrate BTC verification.', stats: '450 💬 1.2K 🔁 5.6K ❤️', avatar: '/ipnft.png' }
    ]
  },
  'ETH': {
    name: "Ethereum",
    symbol: "ETH",
    tags: ["SMART CONTRACTS", "POS", "OSIS COMPATIBLE"],
    description: "Ethereum is a decentralized, open-source blockchain with smart contract functionality. Ether (ETH) is the native cryptocurrency of the platform. Among cryptocurrencies, Ether is second only to Bitcoin in market capitalization.",
    sentiment: "89% Positive",
    communitySize: "12M",
    growth: "-2.4%",
    stats: [
        { label: 'Market Cap', value: '$340B' },
        { label: 'Price', value: '$2,842' },
        { label: 'Volume (24h)', value: '$15B' },
        { label: 'Supply', value: '120M ETH' }
    ],
    feed: [
        { handle: '@EthHub', time: '3h ago', text: 'The next network upgrade is being stress-tested on major node partners.', stats: '230 💬 450 🔁 2.1K ❤️', avatar: '/ipnft2.png' }
    ]
  },
  'USDT': {
    name: "TetherUS",
    symbol: "USDT",
    tags: ["STABLECOIN", "FIAT-BACKED"],
    description: "Tether is a stablecoin cryptocurrency which is hosted on the Ethereum and Bitcoin blockchains, among others. Its tokens are issued by the Hong Kong company Tether Limited.",
    sentiment: "95% Stable",
    communitySize: "5M",
    growth: "0%",
    stats: [
        { label: 'Market Cap', value: '$120B' },
        { label: 'Price', value: '$1.00' },
        { label: 'Volume (24h)', value: '$65B' },
        { label: 'Supply', value: '120B USDT' }
    ],
    feed: [
        { handle: '@Tether_Official', time: '12h ago', text: 'Audit report for the latest quarter confirms 100% reserve backing.', stats: '12 💬 34 🔁 156 ❤️', avatar: '/ipnft.png' }
    ]
  },
  'SKIN': {
    name: "DermaLabs",
    symbol: "SKIN",
    tags: ["IP-NFT", "DAO", "SKINCARE", "WEB3"],
    description: "DermaLabs blends dermatologist-led science with community-powered research. Using decentralized trials, AI imaging, and SKIN token incentives, we turn every skincare journey into measurable evidence.",
    sentiment: "90% Positive",
    communitySize: "666",
    growth: "+0.7%",
    stats: [
        { label: 'Market Cap', value: '$12.4M' },
        { label: 'Volume (24h)', value: '$1.2M' },
        { label: 'Circulating Supply', value: '45.2M SKIN' },
        { label: 'Max Supply', value: '100M SKIN' }
    ],
    feed: [
        { handle: '@DermaDAO', time: 'Today', text: 'Structure defined via @OSISProtocol EIP-20! Proposals live!', stats: '141 💬 230 🔁 55 ❤️', avatar: '/ipnft.png' },
        { handle: '@SkinStandard', time: 'Yesterday', text: 'Analysis on acne and stress signaling gradient LIVE via IP-NFT!', stats: '332 💬 210 🔁 1.5K ❤️', avatar: '/ipnft2.png' }
    ]
  },
  'default': {
    name: "DermaLabs",
    symbol: "SKIN",
    tags: ["IP-NFT", "DAO", "SKINCARE", "WEB3"],
    description: "DermaLabs blends dermatologist-led science with community-powered research. Using decentralized trials, AI imaging, and SKIN token incentives, we turn every skincare journey into measurable evidence.",
    sentiment: "90% Positive",
    communitySize: "666",
    growth: "+0.7%",
    stats: [
        { label: 'Market Cap', value: '$12.4M' },
        { label: 'Volume (24h)', value: '$1.2M' },
        { label: 'Circulating Supply', value: '45.2M SKIN' },
        { label: 'Max Supply', value: '100M SKIN' }
    ],
    feed: [
        { handle: '@DermaDAO', time: 'Today', text: 'Structure defined via @OSISProtocol EIP-20! Proposals live!', stats: '141 💬 230 🔁 55 ❤️', avatar: '/ipnft.png' },
        { handle: '@SkinStandard', time: 'Yesterday', text: 'Analysis on acne and stress signaling gradient LIVE via IP-NFT!', stats: '332 💬 210 🔁 1.5K ❤️', avatar: '/ipnft2.png' }
    ]
  }
};

const project = computed(() => {
    const id = route.params.id;
    return mockProjects[id] || mockProjects['default'];
});

// Hero Image Carousel
const heroImages = ref([
    'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1200&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1200&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1563298723-dcfebaa392e3?q=80&w=1200&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1526336024174-e58f5cdd8e13?q=80&w=1200&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=1200&auto=format&fit=crop'
]);
const currentImageIndex = ref(0);
let autoScrollInterval = null;

const nextImage = () => {
    currentImageIndex.value = (currentImageIndex.value + 1) % heroImages.value.length;
};

const goToImage = (index) => {
    currentImageIndex.value = index;
};

onMounted(() => {
    // Auto-scroll every 5 seconds
    autoScrollInterval = setInterval(() => {
        nextImage();
    }, 5000);
});

onUnmounted(() => {
    if (autoScrollInterval) {
        clearInterval(autoScrollInterval);
    }
});

// Collapsible Sections
const sections = ref([
    { title: 'Research Hypothesis', open: false, content: 'Analysis of the current skincare market and the proposed decentralization of dermatological research nodes.' },
    { title: 'Value Capture Model', open: false, content: 'Explaining the SKIN token utility and how researchers are incentivized to contribute high-quality data.' },
    { title: 'Team', open: false, content: 'Meet the dermatologists and blockchain engineers leading the DermaLabs initiative.' },
    { title: 'Roadmap', open: false, content: 'Q3 2026: Beta testing of AI imaging model. Q4 2026: Launch of decentralized trials.' },
    { title: 'Recommended Reading', open: false, content: 'Access the full whitepaper and clinical feasibility studies for the SKIN protocol.' },
]);

const toggleSection = (index) => {
    sections.value[index].open = !sections.value[index].open;
};
</script>

<template>
  <div class="coin-details-page">
    <TopHeader />

    <main class="main-wrapper">
      <div class="layout-grid">
        
        <!-- Main Content -->
        <div class="content-area">
            <!-- Hero (Solid) -->
            <section class="hero-box">
                <div class="hero-media">
                    <transition name="fade" mode="out-in">
                        <img :key="currentImageIndex" :src="heroImages[currentImageIndex]" />
                    </transition>
                    <div class="media-overlay">
                        <div class="play-btn">
                            <Play size="32" fill="white" />
                        </div>
                    </div>
                    
                    <!-- Thumbnail Navigation -->
                    <div class="thumbnail-nav">
                        <div 
                            v-for="(image, index) in heroImages" 
                            :key="index"
                            class="thumbnail-item"
                            :class="{ active: currentImageIndex === index }"
                            @click="goToImage(index)"
                        >
                            <img :src="image" :alt="`Thumbnail ${index + 1}`" />
                        </div>
                    </div>
                </div>

                <div class="hero-header">
                    <div class="titles">
                        <div class="logo-box"><FlaskConical size="24" /></div>
                        <div class="names">
                            <h1>{{ project.name }} <span>{{ project.symbol }}</span></h1>
                            <div class="tags">
                                <span v-for="tag in project.tags" :key="tag">{{ tag }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="actions">
                        <button class="icon-btn"><Share2 size="18"/></button>
                        <button class="icon-btn" @click="goBack"><ArrowLeft size="18"/></button>
                    </div>
                </div>
            </section>

            <!-- Metrics -->
            <section class="info-grid">
                <div class="card desc-card">
                    <h3>Overview</h3>
                    <p>{{ project.description }}</p>
                    <div class="socials">
                        <a href="#"><Globe size="18" /></a>
                        <a href="#"><Twitter size="18" /></a>
                        <a href="#"><Github size="18" /></a>
                    </div>
                </div>
                <div class="card market-card">
                    <div class="card-head">
                        <span>Sentiment</span>
                        <span class="badge">{{ project.sentiment }}</span>
                    </div>
                    <div class="sentiment-votes">
                        <div class="vote up">👍 1.2K</div>
                        <div class="vote down">👎 84</div>
                    </div>
                </div>
            </section>

            <!-- Feed -->
            <section class="card feed-card">
                <div class="card-head">
                    <h3>Research Feed</h3>
                    <div class="tabs">
                        <span :class="{active: activeTab === 'Feed'}" @click="activeTab = 'Feed'">Feed</span>
                        <span :class="{active: activeTab === 'Forum'}" @click="activeTab = 'Forum'">Forum</span>
                    </div>
                </div>
                <div class="feed-list">
                    <div v-for="(post, i) in project.feed" :key="i" class="post">
                        <div class="avatar"><img :src="post.avatar" /></div>
                        <div class="p-body">
                            <div class="p-meta">
                                <strong>{{ post.handle }}</strong> • {{ post.time }}
                            </div>
                            <p>{{ post.text }}</p>
                            <div class="p-footer">{{ post.stats }}</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar-area">
            <div class="card summary-card gold-border">
                <h3>Project Summary</h3>
                <div class="stats-mini">
                    <div v-for="s in project.stats" :key="s.label" class="mini-s">
                        <span class="l">{{ s.label }}</span>
                        <span class="v">{{ s.value }}</span>
                    </div>
                </div>
                <button class="btn-primary">Contribute <ArrowRight size="16"/></button>
            </div>

            <div class="card knowledge-card">
                <h3>Knowledge Base</h3>
                <div class="faq">
                    <div v-for="(sec, i) in sections" :key="i" class="f-item" @click="toggleSection(i)">
                        <div class="f-head">
                            <span>{{ sec.title }}</span>
                            <ChevronDown size="14" :class="{rotate: sec.open}" />
                        </div>
                        <div v-if="sec.open" class="f-body">{{ sec.content }}</div>
                    </div>
                </div>
            </div>
            
            <div class="card links-list">
                 <h3>Resources</h3>
                 <div class="link-r"><BookOpen size="16"/> Whitepaper <ExternalLink size="12" /></div>
                 <div class="link-r"><FileText size="16"/> Audit <ExternalLink size="12" /></div>
            </div>
        </aside>
      </div>
    </main>

    <footer class="footer">
        <div class="footer-inner">
            <div class="brand">
                <FlaskConical size="20" class="gold" />
                <span>DeSci International</span>
            </div>
            <p>© 2026 Research Node V1</p>
        </div>
    </footer>
  </div>
</template>

<style scoped>
.coin-details-page { background: #000; min-height: 100vh; color: #fff; font-family: 'Inter', sans-serif; }
.main-wrapper { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
.gold { color: #dfff00; }

/* Hero */
.hero-box { background: #111; border: 1px solid #222; border-radius: 20px; overflow: hidden; margin-bottom: 30px; }
.hero-media { height: 300px; position: relative; }
.hero-media img { width: 100%; height: 100%; object-fit: cover; opacity: 0.6; }
.media-overlay { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; }
.play-btn { width: 64px; height: 64px; background: #dfff00; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: transform 0.3s ease; }
.play-btn:hover { transform: scale(1.1); }

/* Fade Transition */
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}

/* Thumbnail Navigation */
.thumbnail-nav {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    padding: 12px 20px;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    z-index: 10;
}

.thumbnail-item {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    opacity: 0.6;
}

.thumbnail-item:hover {
    opacity: 0.9;
    transform: translateY(-4px);
}

.thumbnail-item.active {
    border-color: #dfff00;
    opacity: 1;
    transform: scale(1.1);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-header { padding: 24px; display: flex; justify-content: space-between; align-items: center; }
.titles { display: flex; align-items: center; gap: 20px; }
.logo-box { width: 50px; height: 50px; background: #dfff00; color: #000; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
.names h1 { font-size: 24px; font-weight: 800; }
.names span { font-size: 14px; color: #666; font-weight: 500; }
.tags { display: flex; gap: 8px; margin-top: 8px; }
.tags span { font-size: 10px; color: #666; border: 1px solid #222; padding: 2px 8px; border-radius: 4px; }
.icon-btn { background: #1a1a1a; border: none; color: #fff; width: 40px; height: 40px; border-radius: 8px; cursor: pointer; }

/* Metrics */
.info-grid { display: grid; grid-template-columns: 1fr 280px; gap: 24px; margin-bottom: 30px; }
.card { background: #111; border: 1px solid #222; border-radius: 20px; padding: 24px; }
.card-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.card h3 { font-size: 16px; font-weight: 700; }
.desc-card p { font-size: 14px; color: #888; line-height: 1.6; margin-bottom: 20px; }
.socials { display: flex; gap: 16px; color: #444; }

.badge { background: #dfff00; color: #000; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 4px; }
.sentiment-votes { display: flex; gap: 12px; }
.vote { flex: 1; background: #0a0a0a; padding: 12px; border-radius: 12px; text-align: center; font-size: 13px; font-weight: 600; }

/* Tabs & Feed */
.tabs { display: flex; gap: 16px; font-size: 13px; font-weight: 700; color: #444; }
.tabs span { cursor: pointer; }
.tabs span.active { color: #dfff00; }
.post { display: flex; gap: 16px; padding-bottom: 20px; border-bottom: 1px solid #1a1a1a; margin-bottom: 20px; }
.avatar { width: 40px; height: 40px; border-radius: 50%; overflow: hidden; }
.p-meta { font-size: 13px; margin-bottom: 6px; }
.p-body p { font-size: 14px; color: #ccc; line-height: 1.5; margin-bottom: 10px; }
.p-footer { font-size: 12px; color: #444; }

/* Sidebar */
.layout-grid { display: grid; grid-template-columns: 1fr 340px; gap: 30px; }
.sidebar-area { display: flex; flex-direction: column; gap: 24px; }
.gold-border { border-color: rgba(223, 255, 0, 0.2); }
.stats-mini { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; }
.mini-s { display: flex; flex-direction: column; }
.mini-s .l { font-size: 10px; color: #444; text-transform: uppercase; }
.mini-s .v { font-size: 14px; font-weight: 700; color: #fff; }
.btn-primary { width: 100%; background: #dfff00; color: #000; border: none; padding: 14px; border-radius: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; }

.f-item { border-bottom: 1px solid #1a1a1a; padding: 12px 0; cursor: pointer; }
.f-head { display: flex; justify-content: space-between; align-items: center; font-size: 13px; font-weight: 600; }
.f-body { font-size: 12px; color: #666; margin-top: 10px; line-height: 1.5; }
.rotate { transform: rotate(180deg); }

.link-r { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #666; margin-bottom: 16px; }

/* Footer */
.footer { padding: 40px 20px; border-top: 1px solid #111; margin-top: 60px; }
.footer-inner { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #444; }

@media (max-width: 1024px) {
    .layout-grid { grid-template-columns: 1fr; }
    .info-grid { grid-template-columns: 1fr; }
}
</style>
