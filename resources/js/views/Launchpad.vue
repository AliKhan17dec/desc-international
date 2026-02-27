<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  Search,
  ChevronRight,
  ChevronLeft,
  LayoutGrid,
  Filter,
  ArrowUpRight,
  Globe,
  Twitter,
  MessageCircle,
  Hash,
  Database,
  Users,
  TrendingUp,
  FlaskConical,
  Zap,
  MousePointer2,
  ListFilter
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const carouselProjects = [
    {
        id: 'dermalabs',
        title: 'DermaLabs',
        subtitle: 'Dermatologist-led science with community-powered research',
        desc: 'DermaLabs blends dermatologist-led science with community-powered research. Using decentralized trials, AI imaging, and SKIN token incentives, we turn everyday skincare into measurable evidence. Together, we build transparent, inclusive, and accountable pathways for...',
        tags: ['DAO', 'UPCOMING', 'AGING', 'Convert', 'Copy', 'Bots', 'Buy/Sell','P2p', 'Spot'],
        image: '/ipnft.png',
        logo: '/ipnft.png'
    },
     {
        id: 'gocart',
        title: 'GoCART',
        subtitle: 'Next generation of safer, smarter cell therapies',
        desc: 'GoCART Therapeutics is building a new generation of safer, smarter cell therapies for cancer. Our technology uses a biological "AND-gate" - a two-key safety system...',
        tags: ['DAO', 'UPCOMING', 'IPT'],
        image: '/ipnft2.png',
        logo: '/ipnft2.png'
    }
];

const activeIndex = ref(0);

const upcomingProjects = [
    {
        id: 'dermalabs',
        title: 'DermaLabs',
        token: '$SKIN',
        desc: 'DermaLabs blends dermatologist-led science with community-powered research. Using decentralized trials, AI imaging, and SKIN token incentives...',
        tags: ['DAO', 'Aging'],
        status: 'UPCOMING',
        image: '/ipnft.png',
        type: 'DAO'
    },
    {
        id: 'gocart',
        title: 'GoCART',
        token: '$GCART',
        desc: 'GoCART Therapeutics is building a new generation of safer, smarter cell therapies for cancer. Our technology uses a biological "AND-gate" - a two-key safety system...',
        tags: ['IPT'],
        status: 'UPCOMING',
        image: '/ipnft2.png',
        type: 'IPT'
    },
    {
        id: 'dogyears',
        title: 'DogYears - Follistatin',
        token: '$DFST',
        desc: 'We are developing a new gene therapy to help our canine companions stay stronger, move more comfortably, and enjoy healthier lives as they age...',
        tags: ['IPT'],
        status: 'UPCOMING',
        image: '/ipnft3.png',
        type: 'IPT'
    },
    {
        id: 'vitaseno',
        title: 'VitaSeno by Aubral',
        token: '$VITASENO',
        desc: 'As we age, our bodies accumulate senescent, or "zombie", cells which are highly damaged, yet refuse to die. They disrupt tissue homeostasis...',
        tags: ['IPT'],
        status: 'UPCOMING',
        image: '/ipnft4.png',
        type: 'IPT'
    },
    {
        id: 'ibonova',
        title: 'Ibonova',
        token: '$IBNFT',
        desc: 'We\'re building a safe, affordable, and ethically sourced Ibogaine therapy for PTSD - using synthetic production, personalized protocols...',
        tags: ['IPT'],
        status: 'UPCOMING',
        image: '/ipnft5.png',
        type: 'IPT'
    },
    {
        id: 'nootropics',
        title: 'NootropicsDAO',
        token: '$NOOTROPICS',
        desc: 'Nootropics DAO is building the world\'s most effective global infrastructure for decentralized research, discovery, and commercialization of powerful solution...',
        tags: ['DAO', 'Nootropics'],
        status: 'UPCOMING',
        image: '/ipnft2.png',
        type: 'DAO'
    }
];

const launchedProjects = [
    {
        id: 'holl',
        title: 'Hail',
        desc: 'The first human trial that will tell you - with blood - which training actually grows your brain. 100 Berlin...',
        tags: ['IPT'],
        status: 'LIVE',
        image: '/ipnft.png',
        type: 'IPT'
    },
    {
        id: 'foxo3',
        title: 'Foxo3',
        desc: 'This project will design a new RNA therapeutic that nudges the longevity-linked FOXO3 gene into its...',
        tags: ['IPT'],
        status: 'LIVE',
        image: '/ipnft2.png',
        type: 'IPT'
    },
    {
        id: 'relleva',
        title: 'Relleva',
        desc: 'Relleva is redefining therapeutic innovation through the world\'s first proprietary cannabis and hemp pre-roll...',
        tags: ['IPT'],
        status: 'LIVE',
        image: '/ipnft3.png',
        type: 'IPT'
    },
    {
        id: 'neuron-gale',
        title: 'Neuron-Gale',
        desc: 'The galectin-3 inhibitors project tests a small molecule under development for peripheral indications for treating neuroinflammation...',
        tags: ['IPT'],
        status: 'LIVE',
        image: '/ipnft4.png',
        type: 'IPT'
    },
    {
        id: 'vitastem',
        title: 'VitaStem by Aubral',
        desc: 'VitaSTEM — The first AI-enabled longevity project and inaugural IP-Token launched by Aubral, VitaDAO\'s decentralized scientific agent.',
        tags: ['IPT'],
        status: 'LIVE',
        image: '/ipnft5.png',
        type: 'IPT'
    },
    {
        id: 'd1ckgpt',
        title: 'D1ckGPT',
        desc: 'D1ckGPT is an OSISAgent that makes you stronger by assessing its age and guiding you on how to reverse it. Trained on 800+ clinician-curated studies.',
        tags: ['AGENT'],
        status: 'LIVE',
        image: '/ipnft2.png',
        type: 'AGENT'
    }
];

const categories = ['All', 'DAO', 'Agent', 'IPT'];
const activeCategory = ref('All');

const navigate = (id) => {
    router.push(`/project/${id}`);
};

const nextSlide = () => {
    activeIndex.value = (activeIndex.value + 1) % carouselProjects.length;
};

const prevSlide = () => {
    activeIndex.value = (activeIndex.value - 1 + carouselProjects.length) % carouselProjects.length;
};
</script>

<template>
  <div class="launchpad-page">
    <TopHeader />
    
    <div class="launchpad-container">
      
      <!-- HERO CAROUSEL -->
      <div class="hero-carousel">
        <button class="nav-btn prev" @click="prevSlide"><ChevronLeft size="24" /></button>
        <button class="nav-btn next" @click="nextSlide"><ChevronRight size="24" /></button>

        <div class="carousel-track" :style="{ transform: `translateX(-${activeIndex * 100}%)` }">
            <div v-for="item in carouselProjects" :key="item.id" class="carousel-item" @click="navigate(item.id)">
                <div class="item-bg">
                    <img :src="item.image" alt="Project Image" />
                    <div class="grad-overlay"></div>
                </div>
                <div class="item-content">
                    <!-- ✅ UPDATED: HERO TAGS NOW SHOW ALL item.tags -->
                    <div class="badge-row">
                        <span
                          v-for="tag in item.tags"
                          :key="tag"
                          class="p-badge"
                          :class="[
                            tag.toLowerCase() === 'dao' ? 'dao' : '',
                            tag.toLowerCase() === 'upcoming' ? 'upcoming' : '',
                            tag.toLowerCase() === 'aging' ? 'aging' : ''
                          ]"
                        >
                          {{ tag }}
                        </span>
                    </div>
                    
                    <div class="logo-title">
                        <h1>{{ item.title }}</h1>
                        <div class="mini-logo">
                           <img :src="item.logo" alt="Logo" />
                        </div>
                    </div>

                    <div class="item-details">
                        <div class="project-identity">
                            <div class="avatar-sm">
                                <img :src="item.logo" alt="Avatar" />
                            </div>
                            <span class="name">{{ item.title }}</span>
                        </div>
                        <p class="description">{{ item.desc }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-dots">
            <span v-for="(_, i) in carouselProjects" :key="i" class="dot" :class="{ active: i === activeIndex }"></span>
        </div>
      </div>

      <!-- FILTER BAR -->
      <div class="filter-bar">
          <div class="filter-left">
              <div v-for="cat in categories" 
                   :key="cat" 
                   class="filter-pill" 
                   :class="{ active: activeCategory === cat }"
                   @click="activeCategory = cat"
              >
                  <component :is="cat === 'DAO' ? Database : cat === 'Agent' ? MousePointer2 : cat === 'IPT' ? FlaskConical : LayoutGrid" size="14" />
                  {{ cat }}
              </div>
          </div>
          <div class="filter-right">
              <div class="icon-tool"><LayoutGrid size="16" /></div>
              <div class="icon-tool"><ListFilter size="16" /></div>
              <div class="icon-tool"><Users size="16" /></div>
              <div class="icon-tool"><TrendingUp size="16" /></div>
              <div class="icon-tool"><Zap size="16" /></div>
              <div class="search-tool">
                  <Search size="18" />
              </div>
          </div>
      </div>

      <!-- UPCOMING SECTION -->
      <section class="projects-section">
          <div class="section-title-group">
              <h2 class="main-title">Upcoming</h2>
              <p class="sub-title">Preview upcoming DAO, IPT and agent launches</p>
          </div>

          <div class="projects-grid">
              <div v-for="proj in upcomingProjects" :key="proj.id" class="p-card" @click="navigate(proj.id)">
                  <div class="p-card-header">
                      <img :src="proj.image" alt="Image" class="p-main-img" />
                      <div class="p-card-overlay">
                          <span class="u-badge">UPCOMING</span>
                          <div class="p-type-icon">
                              <component :is="proj.type === 'DAO' ? Database : FlaskConical" size="14" />
                          </div>
                      </div>
                      <div class="p-card-info-bottom">
                         <div class="p-logo-sm">
                             <img :src="proj.image" alt="Logo" />
                         </div>
                         <h3 class="p-title">{{ proj.title }}</h3>
                      </div>
                  </div>
                  <div class="p-card-body">
                      <div class="p-tags">
                        <span v-for="tag in proj.tags" :key="tag" class="p-tag-pill">
                             <component :is="tag === 'DAO' ? Database : FlaskConical" size="12" />
                             {{ tag }}
                        </span>
                      </div>
                      <p class="p-desc">{{ proj.desc }}</p>
                      <div class="p-token">{{ proj.token }}</div>
                  </div>
              </div>
          </div>
          <div class="view-more-row">
              <span class="showing-text">Showing 6 of 6 projects</span>
          </div>
      </section>

      <!-- LAUNCHED SECTION -->
      <section class="projects-section">
          <div class="section-title-group">
              <h2 class="main-title">Launched</h2>
              <p class="sub-title">Explore launched projects and agents</p>
          </div>

          <div class="projects-grid">
              <div v-for="proj in launchedProjects" :key="proj.id" class="p-card live" @click="navigate(proj.id)">
                   <div class="p-card-header">
                      <img :src="proj.image" alt="Image" class="p-main-img" />
                      <div class="p-card-overlay">
                          <span class="u-badge live">LIVE</span>
                          <div class="p-type-icon">
                              <component :is="proj.type === 'AGENT' ? MousePointer2 : FlaskConical" size="14" />
                          </div>
                      </div>
                      <div class="p-card-info-bottom">
                         <div class="p-logo-sm">
                             <img :src="proj.image" alt="Logo" />
                         </div>
                         <h3 class="p-title">{{ proj.title }}</h3>
                      </div>
                  </div>
                  <div class="p-card-body">
                      <div class="p-tags">
                        <span v-for="tag in proj.tags" :key="tag" class="p-tag-pill">
                             <component :is="tag === 'AGENT' ? MousePointer2 : FlaskConical" size="12" />
                             {{ tag }}
                        </span>
                      </div>
                      <p class="p-desc">{{ proj.desc }}</p>
                  </div>
              </div>
          </div>

          <div class="view-more-row column">
              <button class="view-more-main">View More (14 remaining)</button>
              <span class="showing-text mt-4">Showing 6 of 20 projects</span>
          </div>
      </section>

      <!-- BIO FOOTER -->
      <footer class="bio-footer">
          <div class="footer-wrap">
              <div class="footer-brand-col">
                  <div class="desci-logo">
                      <span class="x-mark">✖</span>
                      <span class="desci-text">OSIS</span>
                  </div>
              </div>
              <div class="footer-links-grid">
                  <div class="f-link-group">
                      <a href="/market">Markets</a>
                      <a href="/portfolio">Portfolio</a>
                      <a href="/launchpad">Launchpad</a>
                      <a href="/bridge">Bridge</a>
                      <a href="/auctions">Auctions</a>
                  </div>
                  <div class="f-link-group">
                      <a href="#">About OSIS Protocol</a>
                      <a href="#">About OSIS Token</a>
                      <a href="#">OSIS Docs</a>
                      <a href="#">OSIS Blog</a>
                      <a href="#">Shop</a>
                  </div>
                  <div class="f-link-group">
                      <a href="#">Discord Support</a>
                      <a href="#">Email Support</a>
                      <a href="#">Terms of Use</a>
                  </div>
              </div>
              <div class="footer-social-col">
                  <div class="f-socials">
                      <Twitter size="18" />
                      <Database size="18" />
                      <Globe size="18" />
                      <MessageCircle size="18" />
                  </div>
              </div>
          </div>
      </footer>
      
    </div>
  </div>
</template>

<style scoped>
.launchpad-page {
  background-color: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'IBM Plex Sans', sans-serif;
  padding-bottom: 100px;
}

.launchpad-container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 40px;
}

/* Hero Carousel */
.hero-carousel {
  position: relative;
  width: 100%;
  height: 480px;
  border-radius: 20px;
  overflow: hidden;
  margin-bottom: 40px;
}

.carousel-track {
  display: flex;
  height: 100%;
  transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.carousel-item {
  min-width: 100%;
  height: 100%;
  position: relative;
  cursor: pointer;
}

.item-bg {
  width: 100%;
  height: 100%;
  position: relative;
}

.item-bg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0.8;
}

.grad-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(0,0,0,0.9), transparent);
}

.item-content {
  position: absolute;
  inset: 0;
  padding: 60px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  z-index: 2;
}

.badge-row {
  display: flex;
  gap: 12px;
  margin-bottom: 32px;
}

.p-badge {
  padding: 4px 10px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  background: rgba(255,255,255,0.1);
}

.p-badge.dao { color: #a3e635; }
.p-badge.upcoming { color: #fff; background: rgba(163, 230, 53, 0.2); }
.p-badge.aging { color: #fe0000; }

.logo-title {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 40px;
}

.logo-title h1 {
  font-size: 84px;
  font-weight: 700;
  color: #fff;
  opacity: 0.8;
  margin: 0;
}

.mini-logo {
  width: 64px;
  height: 64px;
  background: rgba(255,255,255,0.1);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(10px);
}
.mini-logo img { width: 40px; }

.item-details {
    max-width: 600px;
}

.project-identity {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.avatar-sm {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  overflow: hidden;
}
.avatar-sm img { width: 100%; }

.project-identity .name {
  font-size: 16px;
  font-weight: 700;
  color: #a3e635;
}

.description {
  font-size: 15px;
  line-height: 1.6;
  color: #ccc;
  margin: 0;
}

.nav-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 10;
  transition: all 0.3s;
}

.nav-btn:hover { background: rgba(255,255,255,0.15); }
.nav-btn.prev { left: 20px; }
.nav-btn.next { right: 20px; }

.carousel-dots {
  position: absolute;
  bottom: 24px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 12px;
  z-index: 10;
}

.dot {
  width: 32px;
  height: 3px;
  background: rgba(255,255,255,0.2);
  border-radius: 2px;
  transition: all 0.3s;
}

.dot.active {
  background: #a3e635;
}

/* Filter Bar */
.filter-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 60px;
}

.filter-left {
  display: flex;
  gap: 12px;
}

.filter-pill {
  padding: 8px 16px;
  background: #121212;
  border-radius: 100px;
  font-size: 13px;
  font-weight: 600;
  color: #888;
  display: flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  transition: all 0.2s;
  border: 1px solid transparent;
}

.filter-pill:hover { background: #1a1a1a; }
.filter-pill.active {
  background: rgba(163, 230, 53, 0.1);
  color: #a3e635;
  border-color: rgba(163, 230, 53, 0.3);
}

.filter-right {
  display: flex;
  align-items: center;
  gap: 16px;
}

.icon-tool {
  color: #555;
  cursor: pointer;
  transition: color 0.2s;
}
.icon-tool:hover { color: #fff; }

.search-tool {
  width: 44px;
  height: 44px;
  background: #121212;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  cursor: pointer;
}

/* Projects Grid */
.projects-section {
  margin-bottom: 80px;
}

.section-title-group {
    margin-bottom: 32px;
}

.main-title {
  font-size: 36px;
  font-weight: 700;
  margin-bottom: 8px;
}

.sub-title {
  font-size: 16px;
  color: #555;
}

.projects-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.p-card {
  background: #111;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid #1a1a1a;
  cursor: pointer;
  transition: transform 0.3s cubic-bezier(0.23, 1, 0.32, 1);
}

.p-card:hover { transform: translateY(-8px); border-color: #333; }

.p-card-header {
  height: 200px;
  position: relative;
}

.p-main-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0.6;
}

.p-card-overlay {
  position: absolute;
  top: 16px;
  left: 16px;
  right: 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.u-badge {
    padding: 2px 8px;
    background: rgba(0,0,0,0.6);
    border-radius: 4px;
    font-size: 10px;
    font-weight: 800;
    color: #ffd700;
}
.u-badge.live { color: #a3e635; }

.p-type-icon {
  width: 28px;
  height: 28px;
  background: rgba(0,0,0,0.6);
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
}

.p-card-info-bottom {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 16px;
  background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
  display: flex;
  align-items: center;
  gap: 12px;
}

.p-logo-sm {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #000;
  padding: 4px;
}
.p-logo-sm img { width: 100%; border-radius: 50%; }

.p-title {
  font-size: 18px;
  font-weight: 700;
  color: #fff;
  margin: 0;
}

.p-card-body {
  padding: 24px;
}

.p-tags {
  display: flex;
  gap: 8px;
  margin-bottom: 16px;
}

.p-tag-pill {
  padding: 4px 10px;
  background: rgba(163, 230, 53, 0.1);
  color: #a3e635;
  border-radius: 4px;
  font-size: 11px;
  display: flex;
  align-items: center;
  gap: 6px;
  font-weight: 700;
}

.p-desc {
  font-size: 14px;
  line-height: 1.5;
  color: #888;
  margin-bottom: 16px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.p-token {
  font-size: 13px;
  font-weight: 700;
  color: #444;
}

.view-more-row {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 40px;
}
.view-more-row.column { flex-direction: column; }

.view-more-main {
    padding: 12px 24px;
    background: #121212;
    border: 1px solid #333;
    border-radius: 100px;
    color: #a3e635;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
}
.view-more-main:hover { background: #1a1a1a; border-color: #a3e635; }

.mt-4 { margin-top: 16px; }

.showing-text {
  font-size: 14px;
  color: #555;
  font-weight: 600;
}

/* Bio Footer */
.bio-footer {
    margin-top: 120px;
    padding: 60px 0;
    border-top: 1px solid #1a1a1a;
}
.footer-wrap {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 40px;
}
.bio-logo {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 900;
    font-size: 32px;
}
.x-mark { color: #fff; }
.bio-text { color: #fff; }

.footer-links-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 80px;
}
.f-link-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.f-link-group a {
    color: #a3e635;
    font-size: 15px;
    text-decoration: none;
    font-weight: 500;
}
.f-link-group a:hover { color: #fff; }

.f-socials {
    display: flex;
    gap: 20px;
    color: #fff;
}

@media (max-width: 1200px) {
    .projects-grid { grid-template-columns: repeat(2, 1fr); }
    .hero-carousel { height: 400px; }
    .logo-title h1 { font-size: 60px; }
    .footer-links-grid { gap: 40px; }
}

@media (max-width: 768px) {
    .launchpad-container { padding: 20px; }
    .item-content { padding: 40px 30px; }
    .logo-title h1 { font-size: 48px; }
    .projects-grid { grid-template-columns: 1fr; }
    .filter-bar { flex-direction: column; gap: 24px; align-items: flex-start; }
    .hero-carousel { height: auto; min-height: 500px; }
    .item-bg img { height: 100%; }
    .footer-wrap { flex-direction: column; align-items: center; text-align: center; }
    .footer-links-grid { grid-template-columns: 1fr; gap: 32px; }
}
</style>
