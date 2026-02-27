<script setup>
import { 
  ArrowLeft, 
  Search, 
  Grid, 
  List, 
  ChevronDown, 
  Filter, 
  Share2, 
  MoreHorizontal,
  ExternalLink,
  Twitter,
  Globe,
  CheckCircle,
  Database
} from 'lucide-vue-next';
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const goBack = () => router.back();

const nfts = ref([
  { id: 1, name: 'NeuroNode #882', price: '2.45 SOL', image: 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=300&auto=format&fit=crop' },
  { id: 2, name: 'NeuroNode #883', price: '2.10 SOL', image: 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=300&auto=format&fit=crop' },
  { id: 3, name: 'NeuroNode #884', price: '1.99 SOL', image: 'https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?q=80&w=300&auto=format&fit=crop' },
  { id: 4, name: 'NeuroNode #885', price: '3.20 SOL', image: 'https://images.unsplash.com/photo-1633167606207-d840b5070fc2?q=80&w=300&auto=format&fit=crop' },
]);

const navigateToNft = (id) => {
  router.push(`/nft/${id}`);
};
</script>

<template>
  <div class="collection-page">
    <TopHeader />

    <main class="main-wrapper">
      <!-- Collection Hero (Simplified) -->
      <section class="hero-section">
          <div class="hero-bg"></div>
          <div class="hero-profile">
              <div class="profile-meta">
                  <div class="profile-logo">
                      <Database size="32" class="gold" />
                  </div>
                  <div class="profile-titles">
                      <h1>Neuro Nodes <CheckCircle size="20" class="gold" /></h1>
                      <div class="social-row">
                          <a href="#"><Globe size="16" /></a>
                          <a href="#"><Twitter size="16" /></a>
                          <button class="share-btn"><Share2 size="16" /></button>
                      </div>
                  </div>
              </div>
              <div class="hero-stats">
                  <div class="stat-unit">
                      <span class="l">Floor</span>
                      <span class="v">2.45 SOL</span>
                  </div>
                  <div class="stat-unit">
                      <span class="l">Items</span>
                      <span class="v">1,337</span>
                  </div>
                  <div class="stat-unit">
                      <span class="l">Volume</span>
                      <span class="v">12.5K SOL</span>
                  </div>
              </div>
          </div>
      </section>

      <div class="layout-grid">
          <!-- Sidebar Filters -->
          <aside class="sidebar">
              <div class="filter-group">
                  <h3>Filters</h3>
                  <div class="filter-item">
                      <span>Price Range</span>
                      <ChevronDown size="16" />
                  </div>
                  <div class="filter-item">
                      <span>Node Grade</span>
                      <ChevronDown size="16" />
                  </div>
                  <div class="filter-item">
                      <span>Status</span>
                      <ChevronDown size="16" />
                  </div>
              </div>
          </aside>

          <!-- Main Grid -->
          <div class="content-area">
              <div class="controls-bar">
                  <div class="search-box">
                      <Search size="16" />
                      <input placeholder="Search node IDs..." />
                  </div>
                  <div class="view-toggles">
                      <button class="active"><Grid size="18" /></button>
                      <button><List size="18" /></button>
                  </div>
              </div>

              <div class="nft-grid">
                  <div v-for="n in nfts" :key="n.id" class="nft-card" @click="navigateToNft(n.id)">
                      <div class="nft-media"><img :src="n.image" /></div>
                      <div class="nft-body">
                          <h4>{{ n.name }}</h4>
                          <div class="nft-footer">
                              <span class="price">{{ n.price }}</span>
                              <button class="buy-btn">Buy Now</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </main>

    <footer class="footer">
        <div class="footer-inner">
            <div class="brand">
                <Database size="20" class="gold" />
                <span>Neuro Protocols Archive</span>
            </div>
            <p>© 2026 DeSci Collections v2.0</p>
        </div>
    </footer>
  </div>
</template>

<style scoped>
.collection-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'Inter', sans-serif;
}

.main-wrapper {
  max-width: 1300px;
  margin: 0 auto;
  padding: 40px 20px;
}

.gold { color: #dfff00; }

/* Hero Section */
.hero-section { background: #111; border: 1px solid #222; border-radius: 20px; overflow: hidden; margin-bottom: 40px; }
.hero-bg { height: 160px; background: linear-gradient(180deg, #1a1a1a 0%, #111 100%); }
.hero-profile { padding: 0 40px 30px; display: flex; justify-content: space-between; align-items: flex-end; margin-top: -40px; }
.profile-meta { display: flex; align-items: flex-end; gap: 24px; }
.profile-logo { width: 100px; height: 100px; background: #0d0d0d; border: 4px solid #111; border-radius: 20px; display: flex; align-items: center; justify-content: center; }
.profile-titles h1 { font-size: 32px; font-weight: 800; margin-bottom: 12px; display: flex; align-items: center; gap: 12px; }
.social-row { display: flex; gap: 16px; align-items: center; color: #444; }
.social-row a { color: inherit; }
.share-btn { background: transparent; border: none; color: inherit; cursor: pointer; }

.hero-stats { display: flex; gap: 40px; }
.stat-unit { display: flex; flex-direction: column; }
.stat-unit .l { font-size: 11px; text-transform: uppercase; color: #444; margin-bottom: 4px; font-weight: 700; }
.stat-unit .v { font-size: 18px; font-weight: 800; }

/* Layout Grid */
.layout-grid { display: grid; grid-template-columns: 260px 1fr; gap: 40px; }
@media (max-width: 1024px) {
    .layout-grid { grid-template-columns: 1fr; }
}

/* Sidebar */
.sidebar h3 { font-size: 16px; font-weight: 700; margin-bottom: 24px; }
.filter-item { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #111; color: #888; cursor: pointer; font-size: 14px; }

/* Content area */
.controls-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
.search-box { background: #111; border: 1px solid #222; border-radius: 8px; padding: 0 16px; display: flex; align-items: center; gap: 12px; flex: 1; max-width: 400px; }
.search-box input { background: transparent; border: none; color: #fff; height: 40px; outline: none; font-size: 14px; width: 100%; }
.view-toggles { display: flex; gap: 8px; background: #111; padding: 4px; border-radius: 8px; }
.view-toggles button { background: transparent; border: none; color: #444; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; }
.view-toggles button.active { color: #fff; background: #222; border-radius: 6px; }

/* NFT Grid */
.nft-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 24px; }
.nft-card { background: #111; border: 1px solid #222; border-radius: 16px; overflow: hidden; cursor: pointer; }
.nft-card:hover { border-color: #333; }
.nft-media { aspect-ratio: 1; overflow: hidden; }
.nft-media img { width: 100%; height: 100%; object-fit: cover; }
.nft-body { padding: 16px; }
.nft-body h4 { font-size: 14px; color: #888; margin-bottom: 12px; font-weight: 600; }
.nft-footer { display: flex; justify-content: space-between; align-items: center; }
.price { font-size: 15px; font-weight: 700; }
.buy-btn { background: #dfff00; color: #000; border: none; padding: 6px 14px; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer; }

/* Footer */
.footer { padding: 60px 20px 40px; border-top: 1px solid #111; margin-top: 60px; }
.footer-inner { max-width: 1300px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #444; font-weight: 600; }
.brand { display: flex; align-items: center; gap: 10px; }

@media (max-width: 768px) {
    .hero-profile { flex-direction: column; align-items: center; text-align: center; padding-top: 20px; }
    .hero-stats { margin-top: 30px; width: 100%; justify-content: space-around; }
    .nft-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>
