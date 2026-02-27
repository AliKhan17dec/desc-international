<script setup>
import { 
  ArrowLeft, ChevronDown, Eye, FileText, Atom, FlaskConical, Dna 
} from 'lucide-vue-next';
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const goBack = () => router.back();

const activeTab = ref('Ongoing');
const tabs = ['Ongoing (0)', 'Closed (0)', 'Mock (0)'];

</script>

<template>
  <div class="my-portfolio-screen desci-theme">
    <TopHeader />

    <div class="scroll-content">
        <!-- Nav -->
        <div class="nav-header">
             <div class="left" @click="goBack">
                <ArrowLeft class="icon-btn" />
                <span class="nav-title">Portfolios List</span>
            </div>
        </div>

        <!-- Filter / Tabs -->
        <div class="filters-section">
            <div class="spot-filter">
                <Dna size="16" color="#DFFF00" /> <!-- Scientific element -->
                <span>Spot Copy</span> 
                <ChevronDown size="12" />
            </div>
            <div class="tabs-row">
                <span 
                    v-for="tab in tabs" 
                    :key="tab" 
                    class="tab" 
                    :class="{ active: activeTab === tab.split(' ')[0] }"
                    @click="activeTab = tab.split(' ')[0]"
                >
                    {{ tab }}
                </span>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-list">
            <div class="stat-item">
                <div class="stat-label-row">
                    <span class="lbl-underline">Total Copying Balance (USDT)</span>
                    <Eye size="12" class="eye-icon" />
                </div>
                <div class="stat-value text-neon">0.0000</div>
            </div>

            <div class="stat-item">
                <div class="stat-label-row">
                    <span class="lbl-underline">Total Realized PNL (USDT)</span>
                </div>
                <div class="stat-value">0.0000</div>
            </div>

            <div class="stat-item">
                <div class="stat-label-row">
                    <span class="lbl-underline">Total Unrealized PnL (USDT)</span>
                </div>
                <div class="stat-value">0.0000</div>
            </div>

             <div class="stat-item">
                <div class="stat-label-row">
                    <span class="lbl-underline">Net Profit (USDT)</span>
                </div>
                <div class="stat-value">0.0000</div>
            </div>
        </div>

        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon-wrapper">
                <!-- Scientific Element: Flask or Atom instead of FileText -->
                <FlaskConical size="64" stroke-width="1.5" color="#fff" /> 
            </div>
            <p class="empty-text">No records</p>
            <button class="cta-btn" @click="$router.push('/copy-trading')">View Portfolio List</button>
        </div>


        <!-- Footer (Scientific/Desci style links) -->
        <div class="footer-links">
             <!-- Placeholder for footer links mentioned in screenshot (About Us, etc) -->
        </div>
    </div>
  </div>
</template>

<style scoped>
.my-portfolio-screen {
  background-color: var(--bg-color);
  min-height: 100vh;
  padding-bottom: 80px;
  color: white;
  overflow-x: hidden;
  /* Scientific Grid Background */
  background-image: 
    linear-gradient(rgba(223, 255, 0, 0.05) 1px, transparent 1px),
    linear-gradient(90deg, rgba(223, 255, 0, 0.05) 1px, transparent 1px);
  background-size: 30px 30px;
}

.nav-header {
    display: flex;
    align-items: center;
    padding: 16px;
    background: transparent;
}
.left { display: flex; align-items: center; gap: 8px; cursor:pointer; color:#fff; font-size:16px;}
.nav-title { color: #fff; font-weight: 500; }
.icon-btn { color: #fff; }

.filters-section {
    padding: 0 20px;
    display: flex;
    flex-direction: column; 
    gap: 20px;
    margin-bottom: 32px;
}
.spot-filter {
    font-size: 16px;
    font-weight: 600;
    color: white;
    display: flex;
    align-items: center;
    gap: 8px;
}
.tabs-row {
    display: flex;
    gap: 24px;
    font-size: 14px;
    color: #fff;
    border-bottom: 1px solid #fff;
    padding-bottom: 12px;
}
.tab { cursor: pointer; position: relative; }
.tab.active { color: white; font-weight: 600; }
.tab.active::after {
    content: '';
    position: absolute;
    bottom: -13px; /* Align with border-bottom */
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--primary);
    box-shadow: 0 0 10px var(--primary);
}

/* Stats */
.stats-list {
    padding: 0 20px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    margin-bottom: 60px;
}
.stat-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.stat-label-row {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #fff;
    font-size: 13px;
}
.lbl-underline { 
    border-bottom: 1px dashed #fff; 
    padding-bottom: 2px; 
}
.eye-icon { color: #fff; }
.stat-value {
    font-size: 24px;
    font-weight: 600;
    font-family: 'IBM Plex Sans', sans-serif; 
    letter-spacing: 0.5px;
}
.text-neon {
    color: white; 
}

/* Empty State */
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
}
.empty-icon-wrapper {
    color: #222;
    margin-bottom: 16px;
    position: relative;
    filter: drop-shadow(0 0 5px rgba(223, 255, 0, 0.2));
}
.empty-text {
    color: #fff;
    font-size: 14px;
    margin-bottom: 24px;
}
.cta-btn {
    background: var(--primary);
    color: black;
    border: none;
    padding: 12px 32px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    box-shadow: 0 0 15px rgba(223, 255, 0, 0.3); /* Neon glow */
    transition: all 0.2s;
}
.cta-btn:active {
    transform: scale(0.98);
}

.footer-links { padding: 40px 20px; text-align: center; color: #fff; font-size: 12px; margin-top: auto; }
</style>
