<script setup>
import { ref, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { 
  ArrowLeft, 
  Globe, 
  Twitter, 
  MessageCircle,
  ChevronDown,
  ChevronUp,
  RefreshCw,
  Search,
  MoreHorizontal,
  Play,
  ThumbsUp,
  ThumbsDown,
  Users,
  TrendingUp,
  FileText,
  Share2,
  ExternalLink,
  ShieldCheck,
  Award
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const route = useRoute();
const router = useRouter();
const projectsDB = {
    'holl': {
        name: 'Hail',
        symbol: 'HLI',
        tags: ['IPT', 'HEALTH', 'HUMAN TRIAL'],
        description: "The first human trial that will tell you - with blood - which training actually grows your brain. 100 Berlin gym-goers. 2 training arms. 200+ BDNF blood draws.",
        stats: { mCap: '$5.2M', growthRate: '+18.2%', volume: '$240K' },
        sentiment: { score: 98, label: 'Very Bullish', up: '1.4K', down: '12' },
        image: '/ipnft.png'
    },
    'foxo3': {
        name: 'Foxo3',
        symbol: 'FOXO3',
        tags: ['IPT', 'LONGEVITY', 'RNA'],
        description: "This project will design a new RNA therapeutic that nudges the longevity-linked FOXO3 gene into its health-promoting form to halt tissue breakdown.",
        stats: { mCap: '$3.8M', growthRate: '+4.5%', volume: '$110K' },
        sentiment: { score: 91, label: 'Bullish', up: '820', down: '55' },
        image: '/ipnft2.png'
    },
    'relleva': {
        name: 'Relleva',
        symbol: 'RLV',
        tags: ['IPT', 'THERAPEUTIC', 'CANNABIS'],
        description: "Relleva is redefining therapeutic innovation through the world's first proprietary cannabis and hemp pre-roll blend engineered for targeted pain relief.",
        stats: { mCap: '$2.4M', growthRate: '+2.1%', volume: '$75K' },
        sentiment: { score: 87, label: 'Positive', up: '640', down: '88' },
        image: '/ipnft3.png'
    },
    'neuron-gale': {
        name: 'Neuron-Gale',
        symbol: 'GALE',
        tags: ['IPT', 'NEUROTIC', 'INHIBITORS'],
        description: "The galectin-3 inhibitors project tests a small molecule under development for peripheral indications for treating neuroinflammation in an Alzheimer's mouse model.",
        stats: { mCap: '$6.1M', growthRate: '+9.2%', volume: '$310K' },
        sentiment: { score: 95, label: 'Bullish', up: '1.2K', down: '22' },
        image: '/ipnft4.png'
    },
    'vitastem': {
        name: 'VitaStem by Aubral',
        symbol: 'VITASTEM',
        tags: ['IPT', 'LONGEVITY', 'AI'],
        description: "VitaStem — The first AI-enabled longevity project and inaugural IP-Token launched by Aubral, VitaDAO's decentralized scientific agent.",
        stats: { mCap: '$7.4M', growthRate: '+12.8%', volume: '$520K' },
        sentiment: { score: 96, label: 'Strong Bullish', up: '1.6K', down: '18' },
        image: '/ipnft5.png'
    },
    'd1ckgpt': {
        name: 'D1ckGPT',
        symbol: 'DOCK',
        tags: ['AGENT', 'OSISAGENT', 'HEALTH'],
        description: "D1ckGPT is an OSISAgent that makes your health stronger by assessing its age and guiding you on how to reverse it. Trained on 800+ clinician-curated studies.",
        stats: { mCap: '$4.2M', growthRate: '+6.5%', volume: '$150K' },
        sentiment: { score: 89, label: 'Positive', up: '940', down: '72' },
        image: '/ipnft2.png'
    },
    'gocart': {
        name: 'GoCART',
        symbol: 'GCART',
        tags: ['IPT', 'CANCER', 'CELL THERAPY'],
        description: "GoCART Therapeutics is building a new generation of safer, smarter cell therapies for cancer. Our technology uses a biological 'AND-gate' — a two-key safety system.",
        stats: { mCap: '$9.1M', growthRate: '+14.5%', volume: '$620K' },
        sentiment: { score: 97, label: 'Bullish', up: '2.1K', down: '34' },
        image: '/ipnft2.png'
    },
    'dogyears': {
        name: 'DogYears - Follistatin',
        symbol: 'DFST',
        tags: ['IPT', 'GENE THERAPY', 'CANINE'],
        description: "We are developing a new gene therapy to help our canine companions stay stronger, move more comfortably, and enjoy healthier lives as they age.",
        stats: { mCap: '$5.5M', growthRate: '+7.4%', volume: '$210K' },
        sentiment: { score: 93, label: 'Bullish', up: '880', down: '44' },
        image: '/ipnft3.png'
    },
    'vitaseno': {
        name: 'VitaSeno by Aubral',
        symbol: 'VITASENO',
        tags: ['IPT', 'SENESCENCE', 'LONGEVITY'],
        description: "As we age, our bodies accumulate senescent, or 'zombie', cells which are highly damaged, yet refuse to die. They disrupt tissue homeostasis.",
        stats: { mCap: '$8.2M', growthRate: '+11.7%', volume: '$430K' },
        sentiment: { score: 94, label: 'Bullish', up: '1.2K', down: '28' },
        image: '/ipnft4.png'
    },
    'ibonova': {
        name: 'Ibonova',
        symbol: 'IBNFT',
        tags: ['IPT', 'PTSD', 'SYNTHETIC'],
        description: "We're building a safe, affordable, and ethically sourced Ibogaine therapy for PTSD - using synthetic production, personalized protocols.",
        stats: { mCap: '$4.4M', growthRate: '+5.2%', volume: '$120K' },
        sentiment: { score: 88, label: 'Positive', up: '620', down: '94' },
        image: '/ipnft5.png'
    },
    'nootropics': {
        name: 'NootropicsDAO',
        symbol: 'NOOTROPICS',
        tags: ['DAO', 'NOOTROPICS', 'BIOHACK'],
        description: "Nootropics DAO is building the world's most effective global infrastructure for decentralized research, discovery, and commercialization of powerful solution.",
        stats: { mCap: '$12.1M', growthRate: '+8.5%', volume: '$820K' },
        sentiment: { score: 92, label: 'Bullish', up: '1.8K', down: '62' },
        image: '/ipnft2.png'
    },
    'dermalabs': {
        name: 'DermaLabs',
        symbol: 'SKIN',
        tags: ['DAO', 'AGING', 'SKINCARE'],
        description: "DermaLabs blends dermatologist-led science with community-powered research. Using decentralized trials, AI imaging, and SKIN token incentives.",
        stats: { mCap: '$1.5M', growthRate: '+0.7%', volume: '$85K' },
        sentiment: { score: 92, label: 'Very Positive', up: '666', down: '8' },
        image: '/ipnft.png'
    }
};

const project = computed(() => {
    const id = route.params.id;
    return projectsDB[id] || projectsDB['dermalabs'];
});

const feed = [
  {
    id: 1,
    user: 'ResearchDAO',
    handle: '@researchdao',
    content: 'Clinical trial protocols for osis-skin-v2 officially approved by the ethical committee. Phase 1 enrollment starts Monday!',
    date: 'Today, 3:23 PM',
    likes: 124,
    retweets: 45,
    replies: 12,
    views: '12.5K'
  },
  {
    id: 2,
    user: 'HealthAlpha',
    handle: '@alpha_health',
    content: 'The dataset quality on the latest DermaLabs IP-NFT is unprecedented. This is how we scale science.',
    date: 'Yesterday, 8:00 AM',
    likes: 856,
    retweets: 230,
    replies: 45,
    views: '45.2K'
  }
];

const accordions = ref([
  { title: 'Clinical Protocols', open: false, content: 'Details on the randomized controlled trial designs for atmospheric pollution impact on skin aging.' },
  { title: 'Governance Rights', open: false, content: 'Voting weight distribution for IP-NFT holders regarding regional lab expansion.' },
  { title: 'Core Researchers', open: false, content: 'Academic credentials and previous clinical publication history of lead scientists.' },
  { title: 'Grant Roadmap', open: false, content: 'Milestone-based funding tranches for the next 12 months of development.' },
]);

const toggleAccordion = (index) => {
  accordions.value[index].open = !accordions.value[index].open;
};

const goBack = () => router.back();
</script>

<template>
  <div class="project-details-page">
    <TopHeader />

    <main class="main-wrapper">
      <div class="layout-grid">
        <!-- Main Column -->
        <div class="primary-col">
            <!-- Hero Visual -->
            <section class="hero-visual glass-base">
                <div class="media-frame">
                    <img :src="project.image" class="hero-img" />
                    <div class="media-overlay">
                        <div class="play-trigger"><Play size="48" fill="white" /></div>
                        <div class="status-bar">
                            <span class="live-tag">OFFICIAL MEDIA</span>
                            <span class="v-time">0:45 / 3:12</span>
                        </div>
                    </div>
                </div>

                <div class="hero-header-info">
                    <div class="identity-box">
                        <div class="p-logo"><Award size="28" /></div>
                        <div class="titles">
                            <div class="t-row">
                                <h1>{{ project.name }}</h1>
                                <span class="symbol">{{ project.symbol }}</span>
                            </div>
                            <div class="tags">
                                <span v-for="tag in project.tags" :key="tag" class="tag">{{ tag }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="h-actions">
                        <button class="icon-btn"><Share2 size="18" /></button>
                        <button class="icon-btn" @click="goBack"><ArrowLeft size="18" /></button>
                    </div>
                </div>
            </section>

            <!-- Description -->
            <section class="details-section glass-card">
                <h3 class="section-label">Institutional Overview</h3>
                <p class="desc-text">{{ project.description }}</p>
                <p class="desc-text">This project utilizes autonomous osis-verification nodes to ensure datasets remain immutable and verifiable by peer-institutes globally. Participation grants direct governance in the DAO's research direction.</p>
                <div class="resource-pill-row">
                    <div class="res-pill"><FileText size="14" /> Protocol Paper</div>
                    <div class="res-pill"><ShieldCheck size="14" /> Audit v1.2</div>
                    <div class="res-pill"><Globe size="14" /> Website</div>
                </div>
            </section>

            <!-- Community Feed -->
            <section class="community-section">
                <div class="ch-row">
                    <h3>Research Feed</h3>
                    <div class="h-tabs">
                        <span class="active">Official</span>
                        <span>Forum</span>
                    </div>
                </div>
                <div class="feed-stack">
                    <div v-for="post in feed" :key="post.id" class="post-glass">
                        <div class="p-left">
                            <div class="p-avatar">{{ post.user.charAt(0) }}</div>
                        </div>
                        <div class="p-right">
                            <div class="p-meta">
                                <span class="p-user">{{ post.user }}</span>
                                <span class="p-handle">{{ post.handle }}</span>
                                <span class="p-date">{{ post.date }}</span>
                            </div>
                            <p class="p-content">{{ post.content }}</p>
                            <div class="p-stats">
                                <span>💬 {{ post.replies }}</span>
                                <span>🔁 {{ post.retweets }}</span>
                                <span>❤️ {{ post.likes }}</span>
                            </div>
                        </div>
                    </div>
                    <button class="view-more-btn">Engage on OSIS Social</button>
                </div>
            </section>
        </div>

        <!-- Sidebar Column -->
        <aside class="sidebar-col">
            <!-- Sentiment -->
            <div class="sidebar-card glass-card premium">
                <div class="card-head">
                    <span class="c-lbl">Institutional Sentiment</span>
                    <span class="c-badge">{{ project.sentiment.label }}</span>
                </div>
                <div class="voter-grid">
                    <div class="v-box bullish">
                        <span class="v-ic">👍</span>
                        <span class="v-num">{{ project.sentiment.up }} Enthusiastic</span>
                    </div>
                    <div class="v-box bearish">
                        <span class="v-ic">👎</span>
                        <span class="v-num">{{ project.sentiment.down }} Critical</span>
                    </div>
                </div>
                <div class="v-track">
                    <div class="v-fill" :style="{width: project.sentiment.score + '%'}"></div>
                </div>
            </div>

            <!-- Stats -->
            <div class="stat-boxes">
                <div class="mini-card glass-card">
                    <Users size="18" class="gold" />
                    <div class="m-vals">
                        <span class="m-val">{{ project.stats.mCap }}</span>
                        <span class="m-lbl">Institutional MCap</span>
                    </div>
                </div>
                <div class="mini-card glass-card">
                    <TrendingUp size="18" class="gold" />
                    <div class="m-vals">
                        <span class="m-val green">{{ project.stats.growthRate }}</span>
                        <span class="m-lbl">Weekly Velocity</span>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="cta-block glass-card">
                <button class="primary-btn-glow">Apply for Research Grant</button>
                <div class="sec-btns">
                    <button class="s-btn"><Twitter size="18" /></button>
                    <button class="s-btn"><MessageCircle size="18" /></button>
                    <button class="s-btn"><ExternalLink size="18" /></button>
                </div>
            </div>

            <!-- Accordions -->
            <div class="sidebar-card glass-card accordion-box">
                <h4 class="box-title">Research Documentation</h4>
                <div class="accordion-stack">
                    <div v-for="(acc, i) in accordions" :key="i" class="acc-row" @click="toggleAccordion(i)">
                        <div class="acc-head">
                            <span>{{ acc.title }}</span>
                            <ChevronDown size="16" :class="{rot180: acc.open}" />
                        </div>
                        <transition name="slide">
                            <div v-if="acc.open" class="acc-content">{{ acc.content }}</div>
                        </transition>
                    </div>
                </div>
            </div>
        </aside>
      </div>
    </main>

    <!-- Global Footer -->
    <footer class="p-footer">
        <div class="f-wrap">
            <div class="f-info">
                <Award size="32" class="gold" />
                <div class="f-texts">
                    <span class="f-brand">OSIS Protocol Node</span>
                    <p>© 2026 OSIS Distributed Labs</p>
                </div>
            </div>
            <div class="f-links">
                <a href="#">Privacy</a>
                <a href="#">Whitepaper</a>
                <a href="#">Support</a>
            </div>
        </div>
    </footer>
  </div>
</template>

<style scoped>
.project-details-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'Inter', sans-serif;
  overflow-x: hidden;
}

.main-wrapper {
  max-width: 1400px;
  margin: 0 auto;
  padding: 40px 20px;
}

.layout-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 32px;
}

@media (min-width: 1024px) {
    .layout-grid { grid-template-columns: 1fr 380px; }
}

.gold { color: var(--primary); }
.green { color: #00ff88; }
.rot180 { transform: rotate(180deg); }

/* Glass Cards */
.glass-base { background: rgba(255, 255, 255, 0.02); border-radius: 24px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.05); }
.glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border-radius: 20px; padding: 24px; border: 1px solid rgba(255, 255, 255, 0.08); }

/* Hero Section */
.hero-visual { margin-bottom: 32px; }
.media-frame { position: relative; aspect-ratio: 16/9; background: #000; }
.hero-img { width: 100%; height: 100%; object-fit: cover; opacity: 0.7; }
.media-overlay { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: radial-gradient(circle, transparent 0%, rgba(0,0,0,0.4) 100%); }
.play-trigger { width: 80px; height: 80px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #000; cursor: pointer; border: 4px solid rgba(255,255,255,0.1); }

.status-bar { position: absolute; bottom: 20px; left: 20px; right: 20px; display: flex; justify-content: space-between; font-size: 11px; font-weight: 700; color: #fff; text-transform: uppercase; }

.hero-header-info { padding: 30px; display: flex; justify-content: space-between; align-items: center; }
.identity-box { display: flex; gap: 20px; align-items: center; }
.p-logo { width: 56px; height: 56px; background: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #000; }
.titles h1 { font-size: 28px; font-weight: 800; margin-bottom: 8px; }
.symbol { font-size: 14px; color: var(--primary); background: rgba(223, 255, 0, 0.1); padding: 2px 8px; border-radius: 4px; margin-left: 10px; }
.tags { display: flex; gap: 8px; }
.tag { font-size: 10px; font-weight: 700; color: #666; border: 1px solid rgba(255,255,255,0.1); padding: 2px 8px; border-radius: 4px; }

.h-actions { display: flex; gap: 12px; }
.icon-btn { width: 44px; height: 44px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; }

/* Details Section */
.details-section { margin-bottom: 32px; }
.section-label { font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #444; margin-bottom: 16px; font-weight: 800; }
.desc-text { font-size: 16px; line-height: 1.7; color: #888; margin-bottom: 20px; }
.resource-pill-row { display: flex; gap: 12px; }
.res-pill { font-size: 12px; font-weight: 600; padding: 8px 16px; background: rgba(255,255,255,0.05); border-radius: 10px; display: flex; align-items: center; gap: 8px; color: #fff; cursor: pointer; }

/* Community Section */
.ch-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.ch-row h3 { font-size: 20px; font-weight: 700; }
.h-tabs { display: flex; gap: 20px; font-size: 14px; font-weight: 600; color: #444; }
.h-tabs span { cursor: pointer; }
.h-tabs span.active { color: var(--primary); }

.feed-stack { display: flex; flex-direction: column; gap: 16px; }
.post-glass { background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 16px; padding: 20px; display: flex; gap: 16px; }
.p-avatar { width: 44px; height: 44px; background: #111; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--primary); border: 1px solid rgba(255,255,255,0.05); }
.p-right { flex: 1; }
.p-meta { display: flex; gap: 8px; align-items: center; font-size: 12px; margin-bottom: 8px; }
.p-user { font-weight: 700; font-size: 14px; color: #fff; }
.p-handle, .p-date { color: #444; }
.p-content { font-size: 14px; line-height: 1.5; color: #888; margin-bottom: 12px; }
.p-stats { display: flex; gap: 24px; font-size: 12px; color: #444; }

.view-more-btn { width: 100%; padding: 16px; background: transparent; border: 1px solid #111; color: #444; border-radius: 12px; font-weight: 600; cursor: pointer; }

/* Sidebar */
.sidebar-col { display: flex; flex-direction: column; gap: 24px; }
.sidebar-card.premium { background: linear-gradient(135deg, rgba(223,255,0,0.05) 0%, transparent 100%); }
.card-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.c-lbl { font-size: 12px; font-weight: 700; color: #444; text-transform: uppercase; }
.c-badge { font-size: 10px; font-weight: 800; color: #000; background: var(--primary); padding: 2px 8px; border-radius: 4px; }

.voter-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px; }
.v-box { padding: 12px; border-radius: 12px; background: rgba(255,255,255,0.03); display: flex; flex-direction: column; gap: 4px; }
.v-ic { font-size: 20px; }
.v-num { font-size: 11px; font-weight: 600; color: #666; }

.v-track { height: 6px; background: #111; border-radius: 3px; overflow: hidden; }
.v-fill { height: 100%; background: var(--primary); box-shadow: 0 0 10px var(--primary); }

.stat-boxes { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.mini-card { display: flex; gap: 16px; align-items: center; padding: 16px !important; }
.m-vals { display: flex; flex-direction: column; }
.m-val { font-size: 16px; font-weight: 700; }
.m-lbl { font-size: 10px; color: #444; text-transform: uppercase; }

.cta-block { text-align: center; }
.primary-btn-glow { width: 100%; padding: 18px; background: var(--primary); color: #000; border: none; border-radius: 16px; font-weight: 800; font-size: 15px; cursor: pointer; margin-bottom: 12px; box-shadow: 0 10px 30px rgba(223,255,0,0.2); }
.sec-btns { display: flex; gap: 12px; }
.s-btn { flex: 1; height: 44px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; }

.box-title { font-size: 14px; margin-bottom: 20px; color: #fff; }
.accordion-stack { display: flex; flex-direction: column; gap: 12px; }
.acc-row { cursor: pointer; padding: 14px; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px solid rgba(255,255,255,0.03); }
.acc-head { display: flex; justify-content: space-between; align-items: center; font-size: 13px; font-weight: 600; color: #888; }
.acc-content { padding-top: 12px; color: #444; font-size: 12px; line-height: 1.5; border-top: 1px solid rgba(255,255,255,0.03); margin-top: 12px; }

/* Footer */
.p-footer { padding: 80px 20px; border-top: 1px solid rgba(255,255,255,0.05); }
.f-wrap { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
.f-info { display: flex; gap: 16px; align-items: center; }
.f-texts { display: flex; flex-direction: column; }
.f-brand { font-weight: 800; font-size: 18px; color: #fff; }
.f-texts p { font-size: 12px; color: #444; }
.f-links { display: flex; gap: 32px; font-size: 13px; font-weight: 600; color: #444; }
.f-links a { text-decoration: none; color: inherit; }

@media (max-width: 768px) {
    .hero-header-info { flex-direction: column; align-items: flex-start; gap: 20px; }
    .f-wrap { flex-direction: column; gap: 40px; text-align: center; }
    .f-info { flex-direction: column; }
}
</style>
