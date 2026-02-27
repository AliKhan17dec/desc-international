<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'
import {
    ArrowRight,
    Twitter,
    MessageSquare,
    TrendingUp,
    Dna,
    Zap,
    Cpu,
    ChevronRight,
    Globe2,
    Github,
    FlaskConical,
    ShieldCheck,
    Send,
    Linkedin,
    Youtube,
    Cloud,
    FileText,
    Layers,
    Rocket,
} from 'lucide-vue-next'
import TopHeader from '../components/TopHeader.vue'

const router = useRouter()
const navigate = (path) => router.push(path)
const visibleSections = ref(new Set())
const isVisible = (id) => visibleSections.value.has(id)

const animatedWord = ref('')
const fullWord = 'Discovery'
const isTyping = ref(true)
const userData = ref(null)
const checkLogin = () => {
    const user = localStorage.getItem('user')
    if (user) {
        try {
            userData.value = JSON.parse(user)
        } catch (e) {
            console.error('Data corruption detected, resetting user session', e)
            localStorage.removeItem('user') // Auto-fix corruption
            userData.value = null
        }
    } else {
        userData.value = null
    }
}


onMounted(() => {
    // Typewriter effect for "Decentralized"
    let i = 0
    typewriterInterval = setInterval(() => {
        animatedWord.value += fullWord[i]
        i++
        if (i >= fullWord.length) {
            clearInterval(typewriterInterval)
            isTyping.value = false
        }
    }, 150)

    // Section observer for broad logic
    const sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) visibleSections.value.add(entry.target.id)
            })
        },
        { threshold: 0.1 },
    )
    document.querySelectorAll('section[id]').forEach((s) => sectionObserver.observe(s))

    // Individual reveal observer for precise animations
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed')
                    revealObserver.unobserve(entry.target)
                }
            })
        },
        { threshold: 0.15, rootMargin: '0px 0px -50px 0px' },
    )

    document
        .querySelectorAll('.reveal-up, .reveal-right, .reveal-left')
        .forEach((el) => revealObserver.observe(el))

    checkLogin()
    window.addEventListener('user-logged-in', checkLogin)
})

onUnmounted(() => {
    window.removeEventListener('user-logged-in', checkLogin)
    if (typewriterInterval) clearInterval(typewriterInterval)
})

let typewriterInterval = null;

const ecosystemItems = [
    { name: 'VitaDAO', desc: 'Funding and supporting early stage longevity research.' },
    { name: 'AthenaDAO', desc: 'Transformative women\'s health research funding, education, and access.' },
    { name: 'PsyDAO', desc: 'Promoting progress in tokenized psychedelic science and art.' },
    { name: 'ValleyDAO', desc: 'Funding synthetic biology research to save the planet.' },
    { name: 'HairDAO', desc: 'The Network State solving hair loss.' },
    { name: 'CryoDAO', desc: 'Funding high-impact research in the field of cryopreservation.' },
    { name: 'cerebrum dao', desc: 'Advancing brain health and preventing neurodegeneration.' },
    { name: 'curetopia', desc: 'Tackling the $1T+ rare disease space by uniting families and patient communities.' },
    { name: 'LONG COVID LABS', desc: 'Accelerating a cure for 100M+ Long COVID patients.' },
    { name: 'QUANTUM OSIS DAO', desc: 'Building a quantum microscope to advance OSIS research.' },
]

const timeline = [
    { date: 'JULY 2021', event: 'VitaDAO initiated', desc: '' },
    {
        date: 'AUGUST 2021',
        event: 'First science funded onchain',
        desc: 'In partnership with the University of Copenhagen',
    },
    {
        date: 'DECEMBER 2022',
        event: 'Pfizer Ventures backs VitaDAO',
        desc: 'In $4.1 million round',
    },
    { date: 'JULY 2023', event: 'First IP-Token launches', desc: 'Out of Newcastle University' },
    {
        date: 'NOVEMBER 2023',
        event: 'Aggregate market cap crosses $200M',
        desc: 'Aggregate market cap of OSISDAO tokens',
    },
    {
        date: 'DECEMBER 2023',
        event: 'HairDAO files scientific patent',
        desc: 'HairDAO becomes the first DAO to file a scientific patent',
    },
    {
        date: 'NOVEMBER 2024',
        event: 'Binance Labs investment',
        desc: 'Binance Labs makes first OSIS investment in OSIS Protocol',
    },
    { date: 'NOVEMBER 2024', event: 'OSIS Genesis raises over $33 million', desc: '' },
    { date: 'Q1 2025', event: 'OSIS V1 goes live', desc: '(Launchpad & Liquidity Engine)' },
    { date: 'Q2 2025', event: 'New OSISDAOs Launch', desc: '' },
    {
        date: 'Q3 2025',
        event: 'OSIS V2 goes live',
        desc: 'OSISAgent Launchpad, OSISXP & Liquidity Engine',
    },
    {
        date: 'FULL ROLLOUT',
        event: 'OSIS Protocol brings dozens of OSISAgents',
        desc: '& tech communities onchain',
        isFinal: true,
    },
]

const videoPlaying = ref(false)
const togglePlay = (e) => {
    const video = e.target.parentElement.querySelector('iframe')
    videoPlaying.value = !videoPlaying.value
    const currentSrc = video.src
    video.src = videoPlaying.value
        ? currentSrc.replace('autoplay=0', 'autoplay=1')
        : currentSrc.replace('autoplay=1', 'autoplay=0')
}


/* NEW: category marquee after "Explore Projects" (per screen recording) */
const categoryMarquee = ['NEUROSCIENCE', 'REPRODUCTIVE HEALTH', 'LONGEVITY', 'SYNBIO']

const blogUpdates = [
    {
        date: 'FEBRUARY 9, 2026',
        title: 'Every Bathroom Mirror Is a Laboratory: How DermaLabs Is Rebuilding Skincare Science From the Ground Up',
        image: '/up3.png',
    },
    {
        date: 'FEBRUARY 2, 2026',
        title: 'What Happens When AI Agents Are Applied to Science: OSIS Ecosystem Update January 2026',
        image: '/up1.png',
    },
    {
        date: 'JANUARY 28, 2026',
        title: 'OSIS: The AI Scientist Accelerating the Path from Research to Product',
        image: '/up2.png',
    },
]

const handleSubscribe = () => {
    alert('Thank you for subscribing!')
}
</script>

<template>
    <div class="home-page">
        <TopHeader />

        <main class="content">
            <!-- HERO -->
            <section id="hero" class="hero-section" :class="{ 'v-visible': isVisible('hero') }">
                <div class="hero-bg">
                    <img src="/home.png" alt="Molecule" class="floating-molecule" />
                    <div class="hero-gradient-overlay"></div>
                </div>

                <div class="container hero-container">
                    <div class="hero-text-content">
                        <h1 class="hero-title">
                            THE GATEWAY TO OPEN <span class="accent-text">{{ animatedWord }}</span>
                        </h1>
                        <p class="hero-description">
                            The OSIS-Open Science InfraStructure is DeSci’s new financial layer, engineered to
                            commercialize the best science, faster.
                        </p>
                        <div class="hero-btns">
                            <button v-if="!userData" class="btn-pill btn-lime" @click="navigate('/login?mode=signup')">
                                Launch App
                            </button>
                            <button class="btn-pill btn-outline" @click="navigate('/coming-soon')">Documentations</button>
                        </div>
                    </div>
                </div>

                <div class="logo-marquee">
                    <div class="marquee-content">
                        <span class="f-style-1"><Dna size="20" /> VitaDAO</span>
                        <span class="f-style-2"><Zap size="20" /> Molecule</span>
                        <span class="f-style-3"><FlaskConical size="20" /> LabDAO</span>
                        <span class="f-style-4"><Globe2 size="20" /> AthenaDAO</span>
                        <span class="f-style-5"><TrendingUp size="20" /> ValleyDAO</span>
                        <span class="f-style-6"><ShieldCheck size="20" /> HairDAO</span>
                        <span class="f-style-7"><Dna size="20" /> CryoDAO</span>
                        <!-- Duplicate for seamless loop -->
                        <span class="f-style-1"><Dna size="20" /> VitaDAO</span>
                        <span class="f-style-2"><Zap size="20" /> Molecule</span>
                        <span class="f-style-3"><FlaskConical size="20" /> LabDAO</span>
                        <span class="f-style-4"><Globe2 size="20" /> AthenaDAO</span>
                        <span class="f-style-5"><TrendingUp size="20" /> ValleyDAO</span>
                        <span class="f-style-6"><ShieldCheck size="20" /> HairDAO</span>
                        <span class="f-style-7"><Dna size="20" /> CryoDAO</span>
                    </div>
                </div>
            </section>

            <!-- BIOTECH INNOVATION & PLATFORM (Exact Screenshot Design) -->
            <section id="innovation" class="innovation-section" :class="{ 'v-visible': isVisible('innovation') }">
                <div class="container overflow-hidden">
                    <!-- Part 1: Hero-like Split -->
                    <div class="innovation-split">
                        <div class="innovation-content reveal-up">
                            <h2 class="innovation-title">
                                Driving biotech innovation <br />
                                through decentralized funding and <br />
                                coordination.
                            </h2>
                            <p class="innovation-p text-dim">
                                OSIS Protocol lets anyone fund, develop and govern tokenized scientific
                                innovations from universities, companies and researchers worldwide.
                            </p>
                            <a href="#" class="docs-link">
                                <div class="docs-icon-box">
                                    <FileText size="14" stroke-width="3" />
                                </div>
                                <span>Read OSIS Docs</span>
                            </a>
                        </div>
                        <div class="video-container reveal-right">
                            <div class="v-rect">
                                <iframe
                                    width="100%"
                                    height="100%"
                                    src="https://www.youtube.com/embed/Bn7ghyovK-4?autoplay=1&mute=1&start=5&modestbranding=1&rel=0&iv_load_policy=3"
                                    title="OSIS Protocol"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    class="v-iframe"
                                ></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Part 2: Platform Heading & Cards -->
                    <div class="platform-section mt-100">
                        <div class="platform-header reveal-up">
                            <h2 class="platform-title">
                                A platform for directing capital and talent to the most promising
                                early-stage science.
                            </h2>
                        </div>
                        
                        <div class="platform-cards-list reveal-up">
                            <div class="p-card-h">
                                <div class="p-card-icon">
                                    <Layers size="32" stroke-width="1.5" />
                                </div>
                                <div class="p-card-text">
                                    <h3>Ignition Sales</h3>
                                    <p>Back promising research through low-cap fundraises that grow with community traction & scientific progress.</p>
                                </div>
                            </div>

                            <div class="p-card-h">
                                <div class="p-card-icon">
                                    <Rocket size="32" stroke-width="1.5" />
                                </div>
                                <div class="p-card-text">
                                    <h3>OSISXP</h3>
                                    <p>Earn loyalty points (OSISXP) through OSIS and ecosystem staking to get first access to Ignition Sales.</p>
                                </div>
                            </div>

                            <div class="p-card-h">
                                <div class="p-card-icon">
                                    <Cpu size="32" stroke-width="1.5" />
                                </div>
                                <div class="p-card-text">
                                    <h3>Build on OSISAgents</h3>
                                    <p>Build on OSIS's Scientific AI Agent platform and launch decentralized scientific agents.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- NEWSLETTER SECTION (Matches Screenshot) -->
            <section id="newsletter" class="newsletter-section" :class="{ 'v-visible': isVisible('newsletter') }">
                <div class="container newsletter-grid">
                    <div class="newsletter-content reveal-left">
                        <h2 class="newsletter-title">Get the latest updates from the OSIS ecosystem</h2>
                    </div>
                    <div class="newsletter-form-container reveal-right">
                        <form @submit.prevent="handleSubscribe" class="newsletter-card">
                            <div class="form-group">
                                <input type="text" placeholder="Name*" required class="form-input">
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="Email*" required class="form-input">
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Where did you hear about OSIS?*" required class="form-textarea"></textarea>
                            </div>
                            
                            <div class="privacy-notice">
                                <p>We value your privacy and will only use your details to provide the services you've requested. If you'd like to receive news, updates, and product information from OSIS Protocol, please tick below.</p>
                                
                                <label class="checkbox-container">
                                    <input type="checkbox" required>
                                    <span class="checkbox-label">
                                        I agree to receive communications from OSIS Protocol.<span class="text-orange">*</span>
                                    </span>
                                </label>

                                <p class="unsubscribe-text">You can unsubscribe at any time. Read our Privacy Policy to learn how we protect your data.</p>
                                
                                <p class="consent-text">By clicking submit below, you consent to allow OSIS Protocol to store and process the personal information submitted above to provide you the content requested.</p>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-subscribe-new">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <!-- ECOSYSTEM -->
            <section
                id="ecosystem"
                class="ecosystem-section"
                :class="{ 'v-visible': isVisible('ecosystem') }"
            >
                <div class="container container-wide">
                    <div class="eco-head text-center">
                        <h2 class="eco-main-title reveal-up">
                            Explore the OSIS Ecosystem
                        </h2>
                        <p class="eco-subtitle reveal-up">
                            The OSIS Protocol is built atop a growing ecosystem of decentralized science (DeSci) <br />
                            projects driving innovation in specialized therapeutic areas.
                        </p>
                    </div>

                    <div class="eco-grid-new mt-80">
                        <div
                            v-for="(item, i) in ecosystemItems"
                            :key="item.name"
                            class="eco-item-minimal reveal-up"
                            :style="`transition-delay: ${i * 0.05}s`"
                        >
                            <div class="eco-logo-box">
                                <!-- Placeholders for logos matching screenshot -->
                                <div class="eco-logo-flex">
                                    <div class="eco-logo-icon">
                                        <Dna v-if="i==0 || i==4 || i==8" size="24" />
                                        <Globe2 v-else-if="i==1 || i==5 || i==9" size="24" />
                                        <Zap v-else-if="i==2 || i==6" size="24" />
                                        <FlaskConical v-else size="24" />
                                    </div>
                                    <span class="eco-logo-name">{{ item.name }}</span>
                                </div>
                            </div>
                            <p class="eco-tagline">{{ item.desc }}</p>
                            <div class="eco-socials">
                                <a href="#" class="eco-soc-link"><Twitter size="14" /></a>
                                <a href="#" class="eco-soc-link"><Globe2 size="14" /></a>
                            </div>
                        </div>

                        <!-- Special Dashed Card -->
                        <div class="eco-item-minimal is-dashed reveal-up">
                            <div class="dashed-content">
                                <p>New Ignition Sales coming soon! <br /> Stay tuned for updates...</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-80 reveal-up">
                        <button class="btn-eco-primary">Explore Projects</button>
                    </div>
                </div>

                <!-- NEW: scrolling category ribbon (matches screen recording) -->
                <div class="category-ribbon" aria-label="Bio categories marquee">
                    <div class="category-ribbon__track">
                        <span
                            v-for="(c, idx) in categoryMarquee"
                            :key="`a-${idx}`"
                            class="cat-pill"
                            >{{ c }}</span
                        >
                        <span
                            v-for="(c, idx) in categoryMarquee"
                            :key="`b-${idx}`"
                            class="cat-pill"
                            >{{ c }}</span
                        >
                        <span
                            v-for="(c, idx) in categoryMarquee"
                            :key="`c-${idx}`"
                            class="cat-pill"
                            >{{ c }}</span
                        >
                    </div>
                </div>
            </section>

            <!-- PARTNERS SECTION -->
            <section
                id="building"
                class="partners-section"
                :class="{ 'v-visible': isVisible('building') }"
            >
                <div class="container text-center">
                    <h2 class="partners-title reveal-up">Building with the best</h2>
                    <p class="partners-subtitle reveal-up">
                        Top crypto and biotech players are backing projects in the OSIS ecosystem.
                    </p>

                    <div class="partners-grid reveal-up">
                        <!-- 1k(x) Logo -->
                        <div class="partner-logo">
                            <span class="logo-1kx">1k(x)</span>
                        </div>

                        <!-- 50Y Logo -->
                        <div class="partner-logo">
                            <div class="logo-50y">
                                <span class="y-top">Y</span>
                                <span class="num-50">50</span>
                            </div>
                        </div>

                        <!-- YZiLabs Logo -->
                        <div class="partner-logo">
                            <div class="logo-yzi">
                                <div class="yzi-ic">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        width="24"
                                        height="24"
                                    >
                                        <path
                                            d="M12 2L2 7v10l10 5 10-5V7l-10-5zM4 8.5l8-4 8 4L12 12.5l-8-4z"
                                        />
                                    </svg>
                                </div>
                                <span>YZiLabs</span>
                            </div>
                        </div>

                        <!-- Northpond Ventures Logo -->
                        <div class="partner-logo">
                            <div class="logo-northpond">
                                <div class="np-wave">
                                    <svg
                                        viewBox="0 0 100 40"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            d="M10 30 Q 30 5, 50 20 T 90 10"
                                            stroke-linecap="round"
                                        />
                                    </svg>
                                </div>
                                <div class="np-text">
                                    <span class="main-np">Northpond</span>
                                    <span class="sub-np">Ventures</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- HISTORY TIMELINE -->
            <section
                id="history"
                class="history-timeline-section"
                :class="{ 'v-visible': isVisible('history') }"
            >
                <div class="container history-grid">
                    <div class="history-info reveal-up">
                        <h2 class="title-md">A history of accelerating science onchain</h2>
                        <p class="p-md text-dim mt-20">
                            From partnerships with preeminent universities to clinical
                            breakthroughs, OSIS Protocol is catalyzing the next generation of open,
                            community-led science.
                        </p>
                    </div>

                    <div class="timeline-track">
                        <div
                            v-for="(item, idx) in timeline"
                            :key="idx"
                            class="timeline-node reveal-up"
                            :class="{ 'is-final': item.isFinal }"
                            :style="`--delay: ${idx}`"
                        >
                            <div class="node-marker">
                                <div class="node-dot"></div>
                                <div class="node-line" v-if="!item.isFinal"></div>
                            </div>
                            <div class="node-content">
                                <div class="node-date">{{ item.date }}</div>
                                <h4 class="node-event">{{ item.event }}</h4>
                                <p class="node-desc" v-if="item.desc">{{ item.desc }}</p>

                                <div class="node-footer" v-if="item.isFinal && !userData">
                                    <button class="btn-pill btn-lime sm" @click="navigate('/login?mode=signup')">
                                        Launch App
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- LATEST UPDATES (Screenshot Design Match) -->
            <section
                id="updates"
                class="blog-section"
                :class="{ 'v-visible': isVisible('updates') }"
            >
                <div class="container">
                    <h2 class="blog-main-title text-center reveal-up">Latest Updates</h2>

                    <div class="blog-grid mt-60">
                        <div
                            v-for="(post, idx) in blogUpdates"
                            :key="idx"
                            class="blog-card-new reveal-up"
                            :style="`transition-delay: ${idx * 0.1}s`"
                        >
                            <div class="blog-img-box">
                                <img :src="post.image" :alt="post.title" class="blog-img" />
                            </div>
                            <div class="blog-content-box">
                                <div class="post-date">{{ post.date }}</div>
                                <h4 class="post-title">{{ post.title }}</h4>
                                <div class="read-more-link" @click="navigate('/announcements')">Read More</div>
                                <div class="card-divider"></div>
                            </div>
                        </div>
                    </div>

                    <div class="blog-footer text-center mt-80 reveal-up">
                        <button class="btn-blog" @click="navigate('/announcements')">
                            OSIS Blog
                        </button>
                    </div>
                </div>
            </section>


            <!-- JOIN THE ECOSYSTEM (Final CTA) -->
            <section id="join" class="join-ecosystem-section" :class="{ 'v-visible': isVisible('join') }">
                <div class="container">
                    <h2 class="join-main-title text-center reveal-up">Join the OSIS Ecosystem</h2>
                    
                    <div class="join-cards-container mt-60">
                        <!-- LARGE CARD -->
                        <div class="join-card-large reveal-up">
                            <div class="card-large-content">
                                <h3>Explore DeSci Projects</h3>
                                <p>Fund groundbreaking research designed to compress drug development from decades to months.</p>
                                <button class="btn-pill btn-lime btn-lg" @click="navigate('/login?mode=signup')">Launch App</button>
                            </div>
                            <div class="card-large-image">
                                <img src="/home2.png" alt="Bio Structure" />
                            </div>
                        </div>

                        <!-- SMALL CARDS ROW -->
                        <div class="join-cards-small-row mt-30">

                            <div class="join-card-small reveal-up" style="transition-delay: 0.2s">
                                <div class="card-small-text">
                                    <h3>Join the community</h3>
                                    <p>We are scientists, patients, crypto natives, founders and engineers dedicated to accelerating science.</p>
                                    <button class="btn-outline-glow" @click="navigate('/coming-soon')">Join our Telegram</button>
                                </div>
                                <Send class="card-small-icon icon-lime" size="60" stroke-width="1" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

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
/* GLOBAL & THEME */
.home-page {
    background: #000;
    color: #fff;
    font-family: 'IBM Plex Sans', sans-serif;
    overflow-x: hidden;
    width: 100%;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
    position: relative;
}
.container.narrow {
    max-width: 900px;
}
.accent-text {
    color: var(--primary);
}
.text-dim {
    color: #888;
}
.text-center {
    text-align: center;
}
.mt-20 {
    margin-top: 20px;
}
.mt-30 {
    margin-top: 30px;
}
.mt-50 {
    margin-top: 50px;
}
.mt-60 {
    margin-top: 60px;
}
.mt-80 {
    margin-top: 80px;
}
.mt-100 {
    margin-top: 100px;
}
.mb-60 {
    margin-bottom: 60px;
}
.relative {
    position: relative;
}
.z-10 {
    z-index: 10;
}
.flex-between {
    display: flex;
    justify-content: space-between;
}
.flex-center {
    display: flex;
    justify-content: center;
    align-items: center;
}
.align-end {
    align-items: flex-end;
}
.align-top {
    align-items: flex-start;
}
.gap-40 {
    gap: 40px;
}

/* TYPOGRAPHY */
.title-xl {
    font-size: clamp(32px, 5vw, 64px);
    font-weight: 800;
    line-height: 1.05;
    letter-spacing: -0.04em;
    text-transform: uppercase;
}
.title-lg {
    font-size: clamp(24px, 3.5vw, 48px);
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.02em;
}
.p-lg {
    font-size: clamp(18px, 2vw, 24px);
    line-height: 1.5;
    color: #aaa;
}
.p-md {
    font-size: 18px;
    line-height: 1.7;
}

/* BUTTONS */
.btn-pill {
    padding: 16px 42px;
    border-radius: 100px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: none;
}
.btn-lime {
    background: var(--primary);
    color: #000;
}
.btn-lime:hover {
    transform: translateY(-4px);
}
.btn-outline {
    background: transparent;
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.2);
}
.btn-outline:hover {
    border-color: var(--primary);
    background: rgba(223, 255, 0, 0.05);
}
.btn-pill.lg {
    padding: 20px 60px;
    font-size: 18px;
}

/* REVEAL ANIMATIONS */
.reveal-up {
    opacity: 0;
    transform: translateY(30px);
    transition:
        opacity 0.8s ease-out,
        transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    will-change: transform, opacity;
}
.reveal-right {
    opacity: 0;
    transform: translateX(-30px);
    transition:
        opacity 0.8s ease-out,
        transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    will-change: transform, opacity;
}
.reveal-left {
    opacity: 0;
    transform: translateX(30px);
    transition:
        opacity 0.8s ease-out,
        transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    will-change: transform, opacity;
}

.is-revealed {
    opacity: 1;
    transform: translate(0, 0);
}

/* Staggered Reveals */
.timeline-node.is-revealed {
    transition-delay: calc(var(--delay, 0) * 0.1s);
}
.blog-card-new.is-revealed {
    transition-delay: calc(var(--delay, 0) * 0.1s);
}
.prop-card.is-revealed {
    transition-delay: calc(var(--delay, 0) * 0.1s);
}

/* HERO */
.hero-section {
    height: 100vh;
    min-height: 800px;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}
.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}
.floating-molecule {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.9;
    filter: none;
    animation: slow-glide 25s ease-in-out infinite;
}
@keyframes slow-glide {
    0%,
    100% {
        transform: scale(1.1) translate(0, 0);
    }
    50% {
        transform: scale(1.15) translate(40px, 20px) rotate(1deg);
    }
}
@media (max-width: 768px) {
    .floating-molecule {
        animation: none;
        transform: scale(1.1);
    }
}
.hero-gradient-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background:
        radial-gradient(circle at 10% 50%, rgba(0, 0, 0, 0.4) 0%, transparent 80%),
        linear-gradient(to bottom, transparent 0%, #000 100%);
}
.hero-container {
    z-index: 2;
}
.hero-text-content {
    max-width: 900px;
}
.hero-title {
    font-size: clamp(40px, 8vw, 92px);
    font-weight: 800;
    line-height: 1;
    color: #fff;
    opacity: 0;
    transform: translateY(30px);
    animation: hero-fade 1s forwards ease 0.5s;
}
.hero-cursor {
    color: var(--primary);
    animation: blink 0.8s infinite;
    font-weight: 200;
    margin-left: 4px;
}
@keyframes blink {
    0%,
    100% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
}
.hero-description {
    opacity: 0;
    margin-top: 30px;
    margin-bottom: 50px;
    font-size: 24px;
    color: #888;
    max-width: 650px;
    animation: hero-fade 1s forwards ease 0.7s;
}
.hero-btns {
    display: flex;
    gap: 20px;
    opacity: 0;
    animation: hero-fade 1s forwards ease 0.9s;
}
@keyframes hero-fade {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* LOGO MARQUEE */
.logo-marquee {
    position: absolute;
    bottom: 80px;
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
    z-index: 20;
}

.marquee-content {
    display: inline-flex;
    align-items: center;
    gap: 80px;
    animation: scroll-marquee 20s linear infinite;
}
.marquee-content span {
    font-size: 28px;
    font-weight: 800;
    color: #fff;
    text-transform: uppercase;
    display: inline-flex;
    align-items: center;
    gap: 12px;
}

.f-style-1 {
    font-family: 'serif';
    font-style: italic;
    color: var(--primary);
}
.f-style-2 {
    font-family: 'monospace';
    font-weight: 400;
    opacity: 0.7 !important;
}
.f-style-3 {
    font-family: 'sans-serif';
    font-weight: 900;
    letter-spacing: -1px;
}
.f-style-4 {
    -webkit-text-stroke: 1px white;
    color: transparent !important;
}
.f-style-5 {
    font-family: 'serif';
    text-decoration: underline;
    text-underline-offset: 4px;
}
.f-style-6 {
    font-weight: 200;
    letter-spacing: 4px;
}
.f-style-7 {
    font-family: 'monospace';
    font-style: italic;
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 4px 12px;
    border-radius: 4px;
}
@keyframes scroll-marquee {
    from {
        transform: translateX(-50%);
    }
    to {
        transform: translateX(0);
    }
}

/* SECTIONS COMMON */
.innovation-section,
.props-section,
.ecosystem-section,
.building-section,
.history-section,
.blog-section,
.join-section {
    padding: 140px 0;
}
.grid-split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 100px;
    align-items: center;
}

/* INNOVATION & PLATFORM (Pure Black Design) */
.innovation-section {
    background: #000; /* As requested: Background is black */
    padding: 160px 0;
    color: #fff;
}
.innovation-split {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 100px;
    align-items: center;
}
.innovation-title {
    font-size: 38px;
    font-weight: 800;
    line-height: 1.15;
    margin-bottom: 28px;
    letter-spacing: -0.02em;
}
.innovation-p {
    font-size: 16px;
    line-height: 1.6;
    color: #d1d1d1;
    margin-bottom: 36px;
    max-width: 480px;
}
.docs-link {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    color: #fff;
    font-size: 15px;
    font-weight: 800;
    text-decoration: underline;
    text-underline-offset: 4px;
    transition: opacity 0.3s;
}
.docs-icon-box {
    width: 28px;
    height: 28px;
    border: 2px solid #fff;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.docs-link:hover { opacity: 0.7; }

.video-container {
    width: 100%;
}
.timeline-track {
    position: relative;
    padding-left: 40px;
    max-width: 100%;
    overflow-x: hidden;
}
.v-rect {
    position: relative;
    width: 100%;
    aspect-ratio: 16/9;
    background: #000;
    border-radius: 48px; /* Extremely rounded as in screenshot */
    overflow: hidden;
    box-shadow: 0 0 40px rgba(223, 255, 0, 0.05);
}
.v-iframe {
    position: absolute;
    inset: 0;
    border: none;
    filter: contrast(1.1) brightness(0.9);
}

/* Platform Part */
.platform-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 100px;
    align-items: flex-start;
}
.platform-title {
    font-size: 40px;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.02em;
    max-width: 500px;
}

.platform-cards-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.p-card-h {
    display: flex;
    gap: 28px;
    padding: 34px;
    background: #080808;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    transition: all 0.4s;
}
.p-card-h:hover {
    border-color: var(--primary);
    background: #0c0c0c;
    transform: translateX(10px);
}
.p-card-icon {
    color: var(--primary);
    flex-shrink: 0;
    padding-top: 4px;
}
.p-card-text h3 {
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 10px;
    letter-spacing: -0.01em;
}
.p-card-text p {
    font-size: 16px;
    color: #b0b0b0;
    line-height: 1.5;
}


/* JOIN ECOSYSTEM SECTION (Black & Compact) */
.join-ecosystem-section {
    padding: 80px 0 100px;
    background: #000; /* As requested: Background is black */
}
.join-main-title {
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 40px;
}
.join-cards-container {
    max-width: 900px; /* Decreased width */
    margin: 0 auto;
}
.join-card-large {
    background: #080a08;
    border-radius: 24px;
    display: flex;
    overflow: hidden;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.05);
}
.card-large-content {
    flex: 1.2;
    padding: 40px; /* Decreased padding */
    z-index: 2;
}
.card-large-content h3 {
    font-size: 28px; /* Decreased font size */
    font-weight: 800;
    margin-bottom: 16px;
}
.card-large-content p {
    font-size: 15px; /* Decreased font size */
    color: #888;
    line-height: 1.5;
    margin-bottom: 30px;
    max-width: 350px;
}
.card-large-image {
    flex: 0.8;
    position: relative;
}
.card-large-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.8;
}

.join-cards-small-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px; /* Decreased gap */
}
.join-card-small {
    background: #080a08;
    border-radius: 24px;
    padding: 30px; /* Decreased padding */
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s;
}
.join-card-small:hover {
    border-color: var(--primary);
}
.card-small-text {
    max-width: 75%;
}
.card-small-text h3 {
    font-size: 20px; /* Decreased font size */
    font-weight: 700;
    margin-bottom: 10px;
}
.card-small-text p {
    font-size: 14px; /* Decreased font size */
    color: #888;
    line-height: 1.5;
    margin-bottom: 20px;
}
.card-small-icon {
    opacity: 0.2;
    flex-shrink: 0;
}
.btn-outline-glow {
    background: transparent;
    color: #fff;
    border: 1.5px solid #fff;
    padding: 10px 24px;
    border-radius: 100px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-outline-glow:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

@media (max-width: 900px) {
    .join-card-large {
        flex-direction: column;
    }
    .join-cards-small-row {
        grid-template-columns: 1fr;
    }
}

/* ECOSYSTEM SECTION (Dark Green Theme) */
.ecosystem-section {
    background: #000; /* Black background as requested */
    padding: 120px 0;
}
.container-wide {
    max-width: 1200px;
}
.eco-main-title {
    font-size: 32px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 20px;
}
.eco-subtitle {
    font-size: 16px;
    line-height: 1.6;
    color: #a3e635; /* Lighter green */
    opacity: 0.8;
}

.eco-grid-new {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px 20px;
}
.eco-item-minimal {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}
.eco-logo-box {
    margin-bottom: 20px;
}
.eco-logo-flex {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff;
}
.eco-logo-name {
    font-size: 18px;
    font-weight: 700;
    letter-spacing: -0.01em;
}
.eco-logo-icon {
    color: #a3e635;
}
.eco-tagline {
    font-size: 13px;
    color: #d1d5db;
    line-height: 1.5;
    margin-bottom: 16px;
    max-width: 220px;
}
.eco-socials {
    display: flex;
    gap: 12px;
    justify-content: center;
    opacity: 0.6;
}
.eco-soc-link {
    color: #fff;
    transition: opacity 0.2s;
}
.eco-soc-link:hover {
    opacity: 1;
    color: #a3e635;
}

/* Dashed Box */
.eco-item-minimal.is-dashed {
    justify-content: center;
}
.dashed-content {
    border: 1px dashed rgba(163, 230, 53, 0.4);
    border-radius: 16px;
    padding: 30px 20px;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(163, 230, 53, 0.05);
}
.dashed-content p {
    font-size: 13px;
    color: #a3e635;
    line-height: 1.5;
}

.btn-eco-primary {
    background: #a3e635;
    color: #1a2411;
    padding: 14px 40px;
    border-radius: 100px;
    font-weight: 800;
    font-size: 15px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-eco-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(163, 230, 53, 0.3);
}

@media (max-width: 1024px) {
    .eco-grid-new {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 640px) {
    .eco-grid-new {
        grid-template-columns: 1fr;
    }
}

/* NEW: CATEGORY RIBBON (screen recording) */
.category-ribbon {
    margin-top: 90px;
    overflow: hidden;
    white-space: nowrap;
}
.category-ribbon__track {
    display: inline-flex;
    align-items: center;
    gap: 0;
    padding: 40px 0;
    animation: category-scroll 26s linear infinite;
    will-change: transform;
}
.cat-pill {
    font-size: 84px;
    font-weight: 900;
    letter-spacing: -0.02em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.05);
    padding: 0 60px;
    position: relative;
    line-height: 1;
    transition: color 0.3s;
}
.cat-pill:hover {
    color: rgba(223, 255, 0, 0.2);
}
.cat-pill:last-child::after {
    opacity: 0;
    margin-left: 0;
    width: 0;
    height: 0;
}

@keyframes category-scroll {
    from {
        transform: translateX(-35%);
    }
    to {
        transform: translateX(0%);
    }
}

/* PARTNERS SECTION */
.partners-section {
    background: #000;
    padding: 120px 0;
}
.partners-title {
    font-size: 32px;
    font-weight: 800;
    color: var(--primary);
    margin-bottom: 20px;
    text-transform: none;
}
.partners-subtitle {
    font-size: 18px;
    color: #888;
    margin-bottom: 80px;
}
.partners-grid {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 80px;
    flex-wrap: wrap;
}
.partner-logo {
    color: #fff;
    opacity: 0.8;
    transition: opacity 0.3s;
}
.partner-logo:hover {
    opacity: 1;
}

.logo-1kx {
    font-size: 48px;
    font-weight: 300;
    font-family: serif;
}
.logo-50y {
    width: 50px;
    height: 50px;
    background: #d4f8d4;
    color: #151e15;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
}
.y-top {
    font-size: 10px;
    font-weight: 900;
    line-height: 1;
}
.num-50 {
    font-size: 24px;
    font-weight: 800;
    line-height: 1;
}

.logo-yzi {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 28px;
    font-weight: 800;
}
.yzi-ic {
    color: #fff;
}

.logo-northpond {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.np-wave {
    width: 80px;
    height: 24px;
    color: #fff;
    margin-bottom: -5px;
}
.np-text {
    display: flex;
    flex-direction: column;
    line-height: 1;
}
.main-np {
    font-size: 20px;
    font-weight: 700;
}
.sub-np {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* HISTORY TIMELINE */
.history-timeline-section {
    background: #000;
    padding: 140px 0;
}
.history-grid {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 100px;
    align-items: start;
}
.history-info {
    position: sticky;
    top: 140px;
}
.title-md {
    font-size: 32px;
    font-weight: 800;
    line-height: 1.2;
    text-transform: none;
}

.timeline-track {
    display: flex;
    flex-direction: column;
}
.timeline-node {
    display: flex;
    gap: 40px;
    padding-bottom: 50px;
}
.node-marker {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-shrink: 0;
    width: 20px;
}
.node-dot {
    width: 14px;
    height: 14px;
    background: var(--primary);
    border-radius: 4px;
    box-shadow: 0 0 15px rgba(223, 255, 0, 0.4);
}
.node-line {
    width: 1px;
    flex: 1;
    background: rgba(255, 255, 255, 0.1);
    margin-top: 12px;
}
.node-content {
    padding-top: 0px;
}
.node-date {
    font-size: 11px;
    font-weight: 900;
    color: var(--primary);
    margin-bottom: 10px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}
.node-event {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #fff;
}
.node-desc {
    font-size: 16px;
    color: #666;
    line-height: 1.6;
}

/* Final node card styling per screenshot */
.timeline-node.is-final {
    background: rgba(223, 255, 0, 0.03);
    border: 1px solid rgba(223, 255, 0, 0.3);
    border-radius: 20px;
    padding: 40px;
    margin-left: -60px;
    margin-top: 10px;
    width: calc(100% + 60px);
    display: block;
}
.timeline-node.is-final .node-marker {
    display: none;
}
.timeline-node.is-final .node-date {
    font-size: 13px;
    color: #fff;
    opacity: 0.5;
}
.timeline-node.is-final .node-event {
    font-size: 22px;
    margin-top: 12px;
}
.timeline-node.is-final .node-desc {
    color: #888;
    margin-bottom: 24px;
}

.btn-pill.sm {
    padding: 12px 32px;
    font-size: 14px;
    text-transform: none;
}

/* BLOG UPDATE STYLES (Screenshot Design Match) */
.blog-section {
    padding: 80px 0 100px;
    background: #000; /* Back to black as requested */
}
.blog-main-title {
    font-size: 32px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 60px;
    letter-spacing: -0.01em;
}
.blog-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}
.blog-card-new {
    display: flex;
    flex-direction: column;
    text-align: left;
}
.blog-img-box {
    width: 100%;
    aspect-ratio: 1.6 / 1;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 20px;
}
.blog-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.post-date {
    font-size: 11px;
    font-weight: 800;
    color: #a3e635; /* Lime green date */
    margin-bottom: 12px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.post-title {
    font-size: 19px;
    font-weight: 800;
    line-height: 1.3;
    color: #fff;
    margin-bottom: 20px;
    min-height: 3.9em;
}
.read-more-link {
    font-size: 12px;
    font-weight: 800;
    color: #fff;
    text-decoration: underline;
    text-underline-offset: 3px;
    margin-bottom: 12px;
    display: inline-block;
    cursor: pointer;
}
.card-divider {
    width: 100%;
    height: 1px;
    background: rgba(255, 255, 255, 0.15);
}
.btn-blog {
    background: transparent;
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.5);
    padding: 12px 36px;
    border-radius: 100px;
    font-weight: 800;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-blog:hover {
    border-color: #fff;
    background: rgba(255, 255, 255, 0.05);
}

/* FOOTER */
.main-footer {
    background: #000;
    padding: 80px 0;
    color: var(--primary);
    border-top: 1px solid #111;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 40px;
}

.f-logo {
    display: flex;
    align-items: center;
    gap: 15px;
    color: #fff;
}
.f-logo img {
    height: 40px;
}
.f-logo span {
    font-weight: 900;
    font-size: 20px;
    letter-spacing: 2px;
}

.footer-nav-grid {
    display: flex;
    gap: 80px;
    flex: 1;
    justify-content: center;
}

.footer-column {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.f-link {
    color: var(--primary);
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    transition: opacity 0.2s;
    cursor: pointer;
}

.f-link:hover {
    opacity: 0.7;
}

.footer-socials {
    display: flex;
    gap: 20px;
    align-items: center;
}

.footer-socials a {
    color: var(--primary);
    opacity: 0.9;
    transition:
        transform 0.2s,
        opacity 0.2s;
}

.footer-socials a:hover {
    transform: translateY(-2px);
    opacity: 1;
}

/* RESPONSIVENESS */
@media (max-width: 1200px) {
    .grid-split,
    .props-grid {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    .f-grid {
        grid-template-columns: 1fr;
    }

    .subscribe-grid {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    .sub-actions {
        justify-content: flex-start;
    }

    .cat-pill {
        font-size: 38px;
    }
    .footer-nav-grid {
        gap: 40px;
        justify-content: flex-start;
    }
}

@media (max-width: 768px) {
    .hero-btns {
        flex-direction: column;
        width: 100%;
        gap: 12px;
    }
    .btn-pill {
        width: 100%;
    }
    .container {
        padding: 0 24px;
    }
    .f-nav {
        grid-template-columns: 1fr 1fr;
    }
    .home-page {
        padding-bottom: 80px;
    }

    .title-xl {
        font-size: 32px;
    }
    .hero-title {
        font-size: 38px;
        line-height: 1.1;
        margin-bottom: 24px;
    }
    .hero-description {
        font-size: 18px;
        margin-bottom: 32px;
    }

    .parallax-img {
        height: 100%;
        transform: none !important;
        transition: none !important;
    }
    .history-section {
        height: auto;
        padding: 100px 0;
    }

    .subscribe-grid {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    .subscribe-card {
        padding: 32px;
        border-radius: 20px;
    }
    .subscribe-title {
        font-size: 26px;
        text-align: center;
    }
    .sub-actions {
        justify-content: stretch;
    }
    .btn-subscribe {
        width: 100%;
        padding: 14px;
        font-size: 15px;
    }

    .category-ribbon {
        margin-top: 60px;
    }
    .cat-pill {
        font-size: 28px;
        padding: 0 22px;
    }
    .cat-pill::after {
        width: 14px;
        height: 14px;
        margin-left: 22px;
        transform: translateY(-4px) rotate(45deg);
    }

    @media (max-width: 480px) {
        .cat-pill {
            font-size: 20px;
            padding: 0 16px;
        }
        .cat-pill::after {
            width: 10px;
            height: 10px;
            margin-left: 16px;
        }
    }
    /* Hero Mobile */
    .hero-section {
        height: auto;
        min-height: auto;
        padding: 120px 0 100px;
    }
    .hero-title {
        font-size: 36px;
        line-height: 1.1;
        margin-bottom: 24px;
    }
    .hero-description {
        font-size: 16px;
        margin-bottom: 32px;
        max-width: 100%;
    }
    .logo-marquee {
        position: absolute;
        bottom: 0;
        margin-top: 0;
        padding: 20px 0;
    }
    .marquee-content {
        gap: 40px;
    }
    
    .footer-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 40px;
    }
    .footer-nav-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        text-align: left;
    }
    .footer-socials {
        justify-content: center;
    }

    /* Innovation Section Mobile */
    .innovation-split, .platform-section {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .p-card-h {
        flex-direction: column;
        gap: 16px;
        padding: 24px;
        text-align: center;
        align-items: center;
    }
    .innovation-title, .platform-title {
        font-size: 28px;
    }

    /* History Timeline Mobile */
    .history-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .history-info {
        position: static;
        margin-bottom: 40px;
    }
    .history-timeline-section {
        padding: 80px 0;
    }
    .timeline-node {
        gap: 20px;
    }
    .timeline-node.is-final {
        margin-left: 0;
        width: 100%;
        padding: 30px 20px;
    }

    /* Additional Home Responsiveness */
    .blog-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .post-title {
        min-height: auto;
        font-size: 22px;
    }
    .partners-grid {
        gap: 40px;
    }
    .timeline-track {
        padding-left: 0;
    }
    .partners-subtitle {
        margin-bottom: 40px;
    }
}

/* NEWSLETTER SECTION STYLES */
.newsletter-section {
    padding: 120px 0;
    background: #000;
}
.newsletter-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 100px;
    align-items: center;
}
.newsletter-title {
    font-size: 48px;
    font-weight: 600;
    line-height: 1.1;
    color: #fff;
    max-width: 450px;
}
.newsletter-card {
    background: #090e06;
    border: 1px solid rgba(223, 255, 0, 0.15);
    padding: 48px;
    border-radius: 20px;
    position: relative;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
}
.form-group {
    margin-bottom: 24px;
}
.form-input, .form-textarea {
    width: 100%;
    background: transparent;
    border: 1.5px solid rgba(223, 255, 0, 0.3);
    border-radius: 12px;
    padding: 18px 24px;
    color: #fff;
    font-size: 16px;
    font-family: inherit;
    transition: all 0.3s ease;
}
.form-input::placeholder, .form-textarea::placeholder {
    color: rgba(223, 255, 0, 0.5);
}
.form-input:focus, .form-textarea:focus {
    border-color: var(--primary);
    outline: none;
    background: rgba(223, 255, 0, 0.05);
}
.form-textarea {
    height: 110px;
    resize: none;
}
.privacy-notice {
    font-size: 13px;
    color: #888;
    line-height: 1.6;
    margin-top: 30px;
}
.privacy-notice p {
    margin-bottom: 12px;
}
.checkbox-container {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin: 16px 0;
    cursor: pointer;
}
.checkbox-container input {
    margin-top: 3px;
    accent-color: var(--primary);
    width: 16px;
    height: 16px;
}
.checkbox-label {
    color: #999;
}
.text-orange {
    color: #ff4d00;
}
.unsubscribe-text, .consent-text {
    font-size: 12.5px;
    color: #777;
    margin-top: 8px;
}
.form-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 30px;
}
.btn-subscribe-new {
    background: var(--primary);
    color: #000;
    border: none;
    padding: 14px 44px;
    border-radius: 100px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.btn-subscribe-new:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(223, 255, 0, 0.4);
}

@media (max-width: 1100px) {
    .newsletter-grid {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    .newsletter-title {
        text-align: center;
        max-width: none;
        font-size: 38px;
    }
}
@media (max-width: 600px) {
    .newsletter-card {
        padding: 30px 20px;
    }
    .newsletter-title {
        font-size: 32px;
    }
    .btn-subscribe-new {
        width: 100%;
        text-align: center;
    }
}
</style>
