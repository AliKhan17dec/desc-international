<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  Bell, 
  Megaphone, 
  Calendar, 
  ChevronRight, 
  Search,
  Filter,
  Globe,
  FlaskConical,
  Zap,
  ArrowRight
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const announcements = [
  { id: 1, title: 'Genomics Phase 8 Funding Round is Now Live', date: '2026-02-05', category: 'Launchpad', summary: 'Apply for the latest CRISPR cellular rejuvenation grants starting today.' },
  { id: 2, title: 'Neuro Grid Bot V2.0 System Upgrade', date: '2026-02-04', category: 'Software', summary: 'Improved neural pathway detection for highly volatile research assets.' },
  { id: 3, title: 'New Institutional Node: Stanford OSISLabs', date: '2026-02-01', category: 'Ecosystem', summary: 'Welcoming the world\'s leading genetics lab to the OSIS Network.' },
];

const navigate = (id) => router.push(`/announcement/${id}`);
</script>

<template>
  <div class="announcements-page">
    <TopHeader />
    
    <div class="container">
      <div class="page-header">
        <h1 class="title">OSIS <span class="accent">Bulletin</span></h1>
        <p class="subtitle">Latest transmissions from the global scientific nodes and network updates.</p>
      </div>

      <!-- Hero Feed -->
      <section class="announcements-feed">
        <div v-for="ann in announcements" :key="ann.id" class="ann-card" @click="navigate(ann.id)">
            <div class="ann-meta">
                <span class="category">{{ ann.category }}</span>
                <span class="date">{{ ann.date }}</span>
            </div>
            <div class="ann-body">
                <h2>{{ ann.title }}</h2>
                <p>{{ ann.summary }}</p>
            </div>
            <div class="ann-footer">
                <span class="read-more">Read Full Transmission <ArrowRight size="14" /></span>
            </div>
        </div>
      </section>
    </div>
  </div>
</template>

<style scoped>
.announcements-page {
  background: #000;
  min-height: 100vh;
  color: white;
  padding-bottom: 80px;
}

.container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 40px 20px;
}

.page-header { margin-bottom: 60px; text-align: center; }
.title { font-size: 36px; font-weight: 800; text-transform: uppercase; }
.accent { color: var(--primary); }
.subtitle { color: #fff; font-size: 18px; margin-top: 12px; }

.announcements-feed {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.ann-card {
    background: #0d0d0d;
    border: 1px solid #1a1a1a;
    padding: 32px;
    border-radius: 24px;
    cursor: pointer;
    transition: all 0.3s;
}

.ann-card:hover {
    border-color: var(--primary);
    transform: translateX(8px);
    background: #111;
}

.ann-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 16px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.category { color: var(--primary); background: rgba(223, 255, 0, 0.05); padding: 4px 10px; border-radius: 6px; }
.date { color: #fff; }

.ann-body h2 { font-size: 24px; font-weight: 800; margin-bottom: 12px; line-height: 1.3; }
.ann-body p { color: #fff; line-height: 1.6; margin-bottom: 24px; }

.ann-footer {
    border-top: 1px solid #1a1a1a;
    padding-top: 20px;
}

.read-more {
    font-size: 14px;
    font-weight: 700;
    color: white;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: color 0.3s;
}

.ann-card:hover .read-more { color: var(--primary); }
</style>
