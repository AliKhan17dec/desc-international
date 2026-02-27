<script setup>
import { ref } from 'vue';
import { Lightbulb, Users, Globe, ExternalLink, ArrowRight, ArrowLeft, Instagram, Linkedin, Send, Github, MessageCircle, Youtube } from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const beliefs = [
  {
    title: 'NEUTRALITY',
    desc: 'Being an open-source, decentralized system, based on open global standards, neutrality is crucial for the OSIS ecosystem as it prevents vendor lock-ins, ensures integrity, and effectively breaks data silos.',
    type: 'purple'
  },
  {
    title: 'INCLUSIVENESS',
    desc: 'In order to ensure smooth onboarding of users, enterprises and developers to Web3 fundamental technologies, the focus should be on usability and a better user experience for all, regardless of industry, area or background.',
    type: 'white'
  },
  {
    title: 'USABILITY',
    desc: 'We are always on the lookout for building more solutions and continuing to form partnerships with technological and business global leaders that can employ the OSIS ecosystem for their communities.',
    type: 'outline'
  }
];

// Helper to check for media type
const isVideo = (path) => path && path.toLowerCase().endsWith('.mp4');
const isYoutube = (path) => path && path.includes('youtube.com/embed');

// Local Asset Mappings (Images & Videos)
const historyImages1 = [
    'https://www.youtube.com/embed/gpxHT_3o6T0', 
    '/how-it-all-started-2.webp', 
    '/how-it-all-started-3.webp'
];

const historyImages2 = [
    'https://www.youtube.com/embed/OWjCUMR8URk', 
    'https://www.youtube.com/embed/dxKGSW3If7Y', 
    '/assets/images/evolving-section-5.mp4'
];

const historyImages3 = [
    'https://www.youtube.com/embed/UPI986_IMuM', 
    'https://www.youtube.com/embed/q8vicyQ4Cyg'
];

const historyImages4 = [
    'https://www.youtube.com/embed/gkm_DAbpyRc', 
    '/assets/images/videoendcard12.mp4', 
    '/assets/images/videoendcard3.mp4'
];

// Founders Data
const founders = [
    { name: 'Tomaž Levak', image: '/founder1_1.webp', role: 'Founder' },
    { name: 'Žiga Drev', image: '/founder1_2.webp', role: 'Founder' },
    { name: 'Branimir Rakić', image: '/founder1_3.webp', role: 'Founder' }
];

// Advisors Data
const advisors = [
    { name: 'Dr. Bob Metcalfe', image: '/ecoend-card.webp', title: 'Turing laureate & Ethernet Inventor' },
    { name: 'Toni Piëch', image: '/ecoend-card2.webp', title: 'Founder & Chair of Board at Toni Piëch Foundation & Piëch Automotive' },
    { name: 'Chris Rynning', image: '/ecoend-card3.webp', title: 'Managing Partner at AMYP Ventures' },
    { name: 'Ken Lyon', image: '/ecoend-card4.webp', title: 'Global expert on logistics and transportation' }
];

const ecoMapPlaceholder = '/ecoend.webp'; 

import { onMounted } from 'vue';

onMounted(() => {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    const animatedElements = document.querySelectorAll('.reveal-left, .reveal-right, .reveal-up');
    animatedElements.forEach(el => observer.observe(el));
});

</script>

<template>
  <div class="ecosystem-page">
    <TopHeader />

    <main class="eco-container">
        
        <!-- Top Hero Grid -->
        <div class="hero-grid">
            <!-- Left Card -->
            <div class="hero-left-card">
                <h1 class="hero-title">WHERE IDEAS AND INNOVATORS COME TOGETHER</h1>
                <div class="hero-separator"></div>
                <p class="hero-desc">
                    Enhancing global industries through trust and transparency—where businesses and innovators unite.
                </p>
            </div>

            <!-- Right Visual -->
            <div class="hero-visual-card">
                <div class="visual-content">
                    <div class="bulb-halo">
                        <Lightbulb size="80" stroke-width="1.5" class="bulb-icon" />
                    </div>
                    <!-- Orbiting Users -->
                    <div class="orb-user u1"><Users size="24" /></div>
                    <div class="orb-user u2"><Users size="24" /></div>
                    <div class="orb-user u3"><Users size="24" /></div>
                    <div class="orb-user u4"><Users size="24" /></div>
                </div>
            </div>
        </div>

        <!-- Beliefs Section -->
        <div class="beliefs-section">
            <h2 class="section-heading">WHAT WE BELIEVE IN</h2>
            <div class="beliefs-grid">
                <div v-for="(belief, idx) in beliefs" :key="idx" class="belief-card" :class="belief.type">
                    <h3>{{ belief.title }}</h3>
                    <p>{{ belief.desc }}</p>
                </div>
            </div>
        </div>

        <!-- Quote Section -->
        <div class="quote-section">
            <blockquote>
                “To know your origin is to understand your duty; the root of wisdom lies in honoring what came before.” - Confucius
            </blockquote>
        </div>

        <!-- History Section 1: HOW IT ALL STARTED -->
        <div class="history-section">
            <div class="history-header">
                <h2>HOW IT ALL STARTED</h2>
                <span class="badg">2013 - 2018</span>
            </div>
            
            <ul class="history-list">
                <li>Founded in 2013 by Tomaž Levak, Žiga Drev, and Branimir Rakić, initially to drive supply chain transparency and trust.</li>
                <li>Mentored by Dr. Bob Metcalfe, Ethernet inventor and Internet pioneer, the founders conceptualized the OSIS decentralized network.</li>
            </ul>

            <div class="history-images grid-3">
                <div class="h-img-wrap reveal-left" v-for="(item, i) in historyImages1" :key="i" :style="{ transitionDelay: (i * 0.1) + 's' }">
                    <!-- Media Check -->
                    <iframe v-if="isYoutube(item)" :src="item + '?autoplay=1&mute=1&start=5&modestbranding=1&rel=0'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="media-fit"></iframe>
                    <video v-else-if="isVideo(item)" :src="item" autoplay muted loop playsinline class="media-fit"></video>
                    <img v-else :src="item" class="media-fit" />
                </div>
            </div>
        </div>

        <!-- History Section 2: EVOLVING -->
        <div class="history-section">
            <div class="history-header">
                <h2>EVOLVING FROM A CENTRALIZED SOLUTION TO THE OPEN SOURCE AND DECENTRALIZED OSIS PROTOCOL</h2>
                <span class="badg">2017 - 2022</span>
            </div>
            
            <ul class="history-list">
                <li>Developed the Decentralized Knowledge Graph (DKG)—driving transparency and trust in a spectrum of industries.</li>
            </ul>

            <div class="history-images grid-3">
                <div class="h-img-wrap reveal-right" v-for="(item, i) in historyImages2" :key="i" :style="{ transitionDelay: ((2-i) * 0.1) + 's' }">
                    <iframe v-if="isYoutube(item)" :src="item + '?autoplay=1&mute=1&start=5&modestbranding=1&rel=0'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="media-fit"></iframe>
                    <video v-else-if="isVideo(item)" :src="item" autoplay muted loop playsinline class="media-fit"></video>
                    <img v-else :src="item" class="media-fit" />
                    
                    <div v-if="i===2" class="img-overlay-text">
                        So public health procurers can <span class="blueish">move quickly</span> and <span class="blueish">decisively</span> in moments of crisis
                    </div>
                </div>
            </div>
        </div>

        <!-- History Section 3: DRIVING TRUST IN AI -->
        <div class="history-section">
            <div class="history-header">
                <h2>DRIVING TRUST AND TRANSPARENCY IN AI</h2>
            </div>
            <p class="history-sub">OSIS expanding beyond supply chains—now powering trusted Artificial Intelligence</p>

            <div class="history-images grid-2">
                <div class="h-img-wrap large-img reveal-left" v-for="(item, i) in historyImages3" :key="i" :style="{ transitionDelay: (i * 0.2) + 's' }">
                     <iframe v-if="isYoutube(item)" :src="item + '?modestbranding=1&rel=0'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="media-fit"></iframe>
                     <video v-else-if="isVideo(item)" :src="item" autoplay muted loop playsinline class="media-fit"></video>
                     <img v-else :src="item" class="media-fit" />
                     
                     <!-- Center overlay only for the second item (index 1) which was the globe/new world -->
                     <div v-if="i===1" class="center-overlay">A NEW WORLD</div>
                </div>
            </div>
        </div>

        <!-- History Section 4: INTERNET-SCALE -->
        <div class="history-section">
            <div class="history-header">
                <h2>INTERNET-SCALE OSIS</h2>
                <span class="badg">2022 -</span>
            </div>
            <p class="history-sub">Powering trust at Internet scale for human-centric AI.</p>

            <div class="history-images grid-3">
                <div class="h-img-wrap reveal-right" v-for="(item, i) in historyImages4" :key="i" :style="{ transitionDelay: (i * 0.1) + 's' }">
                    <iframe v-if="isYoutube(item)" :src="item + '?autoplay=1&mute=1&start=5&modestbranding=1&rel=0'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="media-fit"></iframe>
                    <video v-if="isVideo(item)" :src="item" autoplay muted loop playsinline class="media-fit"></video>
                    <img v-else-if="!isYoutube(item)" :src="item" class="media-fit" />
                    
                     <div v-if="i===0" class="img-overlay-bottom">
                        to build on top of the Decentralized Knowledge Graph.
                    </div>
                </div>
            </div>
        </div>

        <!-- Founders Section -->
        <div class="team-section">
            <h2 class="section-heading">OSIS FOUNDERS</h2>
            <div class="founders-grid">
                <div v-for="(founder, i) in founders" :key="founder.name" class="person-card reveal-up" :style="{ transitionDelay: (i * 0.15) + 's' }">
                    <img :src="founder.image" class="person-img">
                    <div class="person-name-bar">
                        <span class="x-icon">✖</span> {{ founder.name }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Advisory Board Section -->
        <div class="team-section">
            <h2 class="section-heading">OSIS'S ADVISORY BOARD</h2>
            <div class="advisors-grid">
                <div v-for="(adv, i) in advisors" :key="adv.name" class="person-card advisor reveal-up" :style="{ transitionDelay: (i * 0.15) + 's' }">
                    <img :src="adv.image" class="person-img">
                    <div class="person-info-bar">
                        <div class="adv-name"><span class="x-icon">✖</span> {{ adv.name }}</div>
                        <div class="adv-title">{{ adv.title }}</div>
                    </div>
                </div>
            </div>
            <div class="carousel-nav">
                <button class="nav-cir-btn"><ArrowLeft size="16"/></button>
                <button class="nav-cir-btn"><ArrowRight size="16"/></button>
            </div>
        </div>

        <!-- Ecosystem Map Diagram -->
        <div class="ecosystem-map-section">
            <div class="map-container reveal-up">
                 <img :src="ecoMapPlaceholder" class="eco-map-img" />
            </div>
        </div>

        <!-- Follow Us Footer Section -->
        <div class="follow-us-section">
            <h2 class="section-heading">FOLLOW US</h2>
            <div class="follow-grid">
                <!-- Stay Update Box -->
                <div class="stay-update-box reveal-left">
                    <div class="update-text">
                        Stay up to date with all things OSIS and join the community of like-minded individuals.
                    </div>
                    <div class="social-icons-row">
                        <a href="#"><span class="x-icon">✖</span></a>
                        <a href="#"><Linkedin size="18"/></a>
                        <a href="#"><Send size="18"/></a>
                        <a href="#"><Github size="18"/></a>
                        <a href="#"><MessageCircle size="18"/></a>
                        <a href="#"><Instagram size="18"/></a>
                    </div>
                </div>
                
                <!-- Logo Box -->
                <div class="logo-box reveal-right">
                     <div class="big-logo-c">
                        <!-- Simple visual rep of logo C shape -->
                         <div class="c-shape"></div>
                         <div class="c-dot"></div>
                     </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Simple Bottom Copyright (Modified to be minimal as per screenshot implied) -->
    <div class="simple-copyright">
         <!-- Can be empty or minimal copyright if footer is replaced by Follow Us -->
    </div>
  </div>
</template>

<style scoped>
.ecosystem-page {
    background: #000;
    min-height: 100vh;
    color: #fff;
    font-family: 'Inter', sans-serif;
    overflow-x: hidden;
}

.ecosystem-page *, .ecosystem-page *::before, .ecosystem-page *::after {
    box-sizing: border-box;
}

/* Scroll Animations */
.reveal-left, .reveal-right, .reveal-up {
    opacity: 0;
    transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.reveal-left { transform: translateX(-60px); }
.reveal-right { transform: translateX(60px); }
.reveal-up { transform: translateY(40px); }

.reveal-left.active, .reveal-right.active, .reveal-up.active {
    opacity: 1;
    transform: translate(0);
}

.eco-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 20px;
}

/* Media Fit Helper */
.media-fit {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Hero Grid */
.hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 80px;
}

.hero-left-card {
    background: #fff;
    color: #000;
    padding: 60px;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.hero-title {
    font-size: 48px;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 40px;
    letter-spacing: -1px;
    word-wrap: break-word;
}

.hero-separator {
    height: 1px;
    background: #000;
    width: 100%;
    margin-bottom: 30px;
}

.hero-desc {
    font-size: 16px;
    line-height: 1.6;
    font-weight: 500;
}

.hero-visual-card {
    background: #0f0f0f; 
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    min-height: 400px;
    border: 1px solid #333;
    width: 100%;
}

.visual-content {
    position: relative;
    width: 300px;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bulb-halo {
    width: 140px;
    height: 140px;
    background: transparent;
    border: 4px solid #fffd00; 
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 60px rgba(223, 255, 0, 0.4);
    z-index: 2;
}

.bulb-icon {
    color: #fff;
}

.orb-user {
    position: absolute;
    width: 48px;
    height: 48px;
    background: rgba(223, 255, 0, 0.1);
    border: 2px solid #fffd00;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.u1 { top: 10%; left: 50%; transform: translateX(-50%); }
.u2 { bottom: 10%; left: 20%; }
.u3 { bottom: 10%; right: 20%; }
.u4 { top: 40%; right: 5%; }

/* Beliefs */
.section-heading {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #fffd00;
}

.beliefs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 100px;
}

.belief-card {
    border-radius: 16px;
    padding: 32px;
    display: flex;
    flex-direction: column;
}

.belief-card h3 {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 16px;
    text-transform: uppercase;
}

.belief-card p {
    font-size: 13px;
    line-height: 1.6;
}

/* Card Types */
.belief-card.purple {
    background: #fffd00; 
    color: #000;
}

.belief-card.white {
    background: #fff;
    color: #000;
}

.belief-card.outline {
    background: #000;
    border: 1px solid #fff;
    color: #fff;
}

/* Quote */
.quote-section {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 100px;
}

.quote-section blockquote {
    font-size: 18px;
    font-weight: 600;
    line-height: 1.6;
    color: #fffd00;
}

/* History */
.history-section {
    margin-bottom: 80px;
}

.history-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.history-header h2 {
    font-size: 24px;
    font-weight: 700;
    text-transform: uppercase;
    line-height: 1.3;
    word-wrap: break-word;
}

.history-sub {
    font-size: 14px;
    color: #ccc;
    margin-bottom: 24px;
    margin-top: -10px;
}

.badg {
    border: 1px solid #fffd00;
    color: #fffd00;
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

.history-list {
    list-style: none;
    padding: 0;
    margin-bottom: 40px;
}

.history-list li {
    font-size: 14px;
    color: #ccc;
    margin-bottom: 8px;
    padding-left: 16px;
    position: relative;
    max-width: 800px;
}

.history-list li::before {
    content: "•";
    position: absolute;
    left: 0;
    color: #fff;
}

.history-images {
    display: grid;
    gap: 24px;
}
.grid-3 { grid-template-columns: repeat(3, 1fr); }
.grid-2 { grid-template-columns: 1fr 1fr; }

.h-img-wrap {
    aspect-ratio: 4/3;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #333;
    position: relative;
    background: #111;
}
.large-img {
    aspect-ratio: 16/9;
}

.img-overlay-text {
    position: absolute;
    bottom: 20px;
    left: 20px;
    right: 20px;
    background: #fff;
    color: #000;
    padding: 12px;
    font-size: 14px;
    font-weight: 700;
    border-radius: 4px;
    z-index: 10;
}
.blueish { color: #000; background: #fffd00; padding: 0 4px; } /* Highlight style for contrast on white */

.center-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 24px;
    font-weight: 800;
    text-shadow: 0 4px 10px rgba(0,0,0,0.8);
    letter-spacing: 1px;
    color: #fffd00;
    z-index: 10;
}

.img-overlay-bottom {
    position: absolute;
    bottom: 20px;
    left: 20px;
    right: 20px;
    font-size: 14px;
    font-weight: 700;
    text-shadow: 0 2px 5px rgba(0,0,0,0.8);
    z-index: 10;
}


/* TEAM SECTIONS */
.team-section {
    margin-bottom: 80px;
}

.founders-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 40px;
}

.person-card {
    border: 1px solid #333;
    border-radius: 12px;
    overflow: hidden;
    background: #0f0f0f;
    position: relative;
    transition: border-color 0.2s;
}
.person-card:hover { border-color: #fffd00; }

.person-img {
    width: 100%;
    aspect-ratio: 3/4;
    object-fit: cover;
    display: block;
}

.person-name-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.85);
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 700;
    border-top: 1px solid #333;
}

.x-icon {
    font-size: 10px;
    color: #fffd00;
}

/* Advisor specific */
.advisors-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-bottom: 20px;
}

.person-info-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.9);
    padding: 12px;
    border-top: 1px solid #333;
}

.adv-name {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 4px;
    display: flex;
    gap: 6px;
    align-items: center;
}

.adv-title {
    font-size: 10px;
    color: #aaa;
    line-height: 1.3;
}

.carousel-nav {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 24px;
}
.nav-cir-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #333;
    border: none;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
.nav-cir-btn:hover { background: #fffd00; color: #000; }


/* Ecosystem Map */
.ecosystem-map-section {
    display: flex;
    justify-content: center;
    margin-bottom: 100px;
    padding: 40px 0;
    width: 100%;
    overflow: hidden;
}

.map-container {
    max-width: 1000px;
    width: 100%;
    opacity: 0.9;
}

.eco-map-img {
    width: 100%;
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    display: block;
}

/* Follow Us */
.follow-us-section {
    margin-bottom: 60px;
}

.follow-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    width: 100%;
}

.stay-update-box {
    border: 1px solid #333;
    border-radius: 12px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 140px;
}

.update-text {
    font-size: 14px;
    color: #ccc;
    line-height: 1.5;
}

.social-icons-row {
    display: flex;
    gap: 16px;
}

.social-icons-row a {
    color: #aaa;
    transition: color 0.2s;
}
.social-icons-row a:hover { color: #fffd00; }

.logo-box {
    background: #0f0f0f;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 140px;
    border: 1px solid #333;
}

.big-logo-c {
    position: relative;
    width: 60px;
    height: 60px;
}

.c-shape {
    width: 100%;
    height: 100%;
    border: 8px solid #fffd00;
    border-radius: 50%;
    border-right-color: transparent;
    transform: rotate(-45deg);
}

.c-dot {
    position: absolute;
    top: -2px;
    right: 4px;
    width: 12px;
    height: 12px;
    background: #fffd00;
    border-radius: 50%;
}

@media (max-width: 1024px) {
    .eco-container { padding: 40px 16px; }
    .hero-grid { grid-template-columns: 1fr; gap: 40px; }
    .hero-left-card { padding: 40px 24px; text-align: center; }
    .hero-title { font-size: 32px; margin-bottom: 24px; }
    .hero-separator { width: 60px; margin: 0 auto 24px; }
    .hero-desc { font-size: 14px; }
    
    .beliefs-grid { grid-template-columns: 1fr; }
    .history-images { grid-template-columns: 1fr !important; }
    .grid-2 { grid-template-columns: 1fr !important; }
    .founders-grid { grid-template-columns: repeat(2, 1fr); }
    .advisors-grid { grid-template-columns: repeat(2, 1fr); }
    .follow-grid { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
    .section-heading { font-size: 20px; margin-bottom: 24px; }
    .belief-card { padding: 24px; }
    .belief-card h3 { font-size: 16px; }
    
    .history-header { flex-direction: column; align-items: flex-start; gap: 8px; }
    .history-header h2 { font-size: 18px; }
    .badg { font-size: 10px; }
    
    .founders-grid, .advisors-grid { grid-template-columns: 1fr; }
    .person-name-bar { font-size: 12px; padding: 10px 12px; }
    
    .visual-content { width: 200px; height: 200px; }
    .bulb-halo { width: 80px; height: 80px; }
    .bulb-icon { width: 32px; height: 32px; }
    .orb-user { width: 32px; height: 32px; }
    .u4 { right: -10px; }
    
    .quote-section blockquote { font-size: 16px; }
    
    .stay-update-box, .logo-box { height: auto; min-height: 120px; }
    .social-icons-row { flex-wrap: wrap; justify-content: center; }
}

@media (max-width: 480px) {
    .hero-title { font-size: 26px; }
    .hero-left-card { padding: 32px 16px; }
    .beliefs-section { margin-bottom: 60px; }
    .history-section { margin-bottom: 60px; }
    .visual-content { width: 180px; height: 180px; }
}
</style>
