<script setup>
import { ref, computed } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { 
  ArrowLeft, 
  Share2, 
  MoreHorizontal,
  RefreshCw,
  Clock,
  ChevronDown,
  ChevronUp,
  CheckCircle,
  ExternalLink,
  Copy,
  Info
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();
const route = useRoute();

// Mock Data Store - Syncing with NftMarket data
const mockData = {
  // Highlight Section Items
  'highlight-1': {
    id: 'highlight-1', collection: 'VeeFriends', name: 'VeeFriends Spotlight',
    owner: '0xGary...Vee', price: '$2,590', cryptoPrice: '1.25 ETH', topOffer: '$1.8K', floor: '2.590',
    expiry: 'Aug 12, 2026', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.40_PM_1.jpeg', chain: 'Ethereum', change: '+3.2%',
    traits: [{ type: 'Series', value: '1', rarity: '5%' }, { type: 'Character', value: 'Alert Ape', rarity: '1%' }],
    details: [{ label: 'Contract', value: '0x12..34', copy: true }, { label: 'Token', value: 'ERC721' }]
  },
  'highlight-2': {
    id: 'highlight-2', collection: 'Pudgy Penguins', name: 'Pudgy Penguin #456',
    owner: '0xIce...Cold', price: '$765', cryptoPrice: '0.4 ETH', topOffer: '$500', floor: '0.765',
    expiry: 'Sep 01, 2026', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.40_PM_2.jpeg', chain: 'Ethereum', change: '+2.1%',
    traits: [{ type: 'Background', value: 'Blue', rarity: '10%' }, { type: 'Body', value: 'Penguin', rarity: '100%' }],
    details: [{ label: 'Contract', value: '0x56..78', copy: true }, { label: 'Token', value: 'ERC721' }]
  },
  'highlight-3': {
    id: 'highlight-3', collection: 'Chromie Squiggle', name: 'Squiggle #820',
    owner: '0xArt...Block', price: '$5,537', cryptoPrice: '2.8 ETH', topOffer: '$4K', floor: '5.537',
    expiry: 'Oct 05, 2026', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.40_PM.jpeg', chain: 'Ethereum', change: '-1.2%',
    traits: [{ type: 'Type', value: 'Ribbed', rarity: '15%' }, { type: 'Color', value: 'Full Spectrum', rarity: '2%' }],
    details: [{ label: 'Contract', value: '0x90..12', copy: true }, { label: 'Token', value: 'ERC721' }]
  },

  // Sports Cards
  '1': {
    id: '1', collection: 'Sports Cards', name: '1986 Fleer #57 Michael Jordan (PSA 10)',
    owner: '0xGoat...23', price: '$150,000', cryptoPrice: '68.5 ETH', topOffer: '$140K', floor: '$145K',
    expiry: 'Jul 20, 2026', image: '/card1.png', chain: 'Polygon', change: '+1.5%',
    traits: [{ type: 'Player', value: 'Michael Jordan', rarity: 'Rare' }, { type: 'Grade', value: 'PSA 10', rarity: 'GEM MINT' }],
    details: [{ label: 'Contract', value: '0xSP..RT', copy: true }, { label: 'Chain', value: 'Polygon' }]
  },
  '2': {
    id: '2', collection: 'Sports Cards', name: '1979 Topps #18 Wayne Gretzky (PSA 9)',
    owner: '0xIce...99', price: '$75,000', cryptoPrice: '34.2 ETH', topOffer: '$70K', floor: '$72K',
    expiry: 'Jul 22, 2026', image: '/card2.png', chain: 'Polygon', change: '-0.8%',
    traits: [{ type: 'Player', value: 'Wayne Gretzky', rarity: 'Rare' }, { type: 'Grade', value: 'PSA 9', rarity: 'MINT' }],
    details: [{ label: 'Contract', value: '0xHO..CK', copy: true }, { label: 'Chain', value: 'Polygon' }]
  },

  // News Items
  'news-1': {
    id: 'news-1', collection: 'Desci News', name: 'NFT Gaming 2026 Report',
    owner: 'Desci...Official', price: 'Free', cryptoPrice: '0 ETH', topOffer: 'N/A', floor: 'N/A',
    expiry: 'Forever', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_2.jpeg', chain: 'Polygon', change: '0%',
    traits: [{ type: 'Topic', value: 'Gaming', rarity: 'Official' }],
    details: [{ label: 'Category', value: 'Research' }]
  },

  // NFT Grid Items
  'nft-1': {
    id: 'nft-1', collection: 'Feline Fantasy', name: 'Ethereal Cat #1234',
    owner: '0xCrypto...Artist', price: '2.5', cryptoPrice: '2.5 ETH', topOffer: '2.1 ETH', floor: '2.2 ETH',
    expiry: 'Dec 31, 2026', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_1.jpeg', chain: 'Ethereum', change: '+5.4%',
    traits: [{ type: 'Eyes', value: 'Laser', rarity: '2%' }, { type: 'Fur', value: 'Cosmic', rarity: '5%' }],
    details: [{ label: 'Contract', value: '0xCA..FE', copy: true }]
  },
  'nft-2': {
    id: 'nft-2', collection: 'Modern Art', name: 'Abstract Dimensions',
    owner: '0xDigital...Dreamer', price: '3.8', cryptoPrice: '3.8 ETH', topOffer: '3.2 ETH', floor: '3.5 ETH',
    expiry: 'Jan 15, 2027', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_2.jpeg', chain: 'Ethereum', change: '+12.1%',
    traits: [{ type: 'Surface', value: 'Matte', rarity: '20%' }],
    details: [{ label: 'Contract', value: '0xAD..42', copy: true }]
  },
  'nft-3': {
    id: 'nft-3', collection: 'Synthwave Series', name: 'Neon Symphony #45',
    owner: '0xNeon...Master', price: '1.9', cryptoPrice: '1.9 ETH', topOffer: '1.5 ETH', floor: '1.7 ETH',
    expiry: 'Feb 20, 2027', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM.jpeg', chain: 'Polygon', change: '-2.5%',
    traits: [{ type: 'Background', value: 'Cyber City', rarity: '8%' }],
    details: [{ label: 'Contract', value: '0xNE..ON', copy: true }]
  },

  'default': {
    id: 'default', collection: 'Courtyard.io', name: '1990 Fleer #389 Michael Irvin (PSA 9 MINT)',
    owner: '0xd7...38d5', price: '$21.71', cryptoPrice: '0.011 ETH', topOffer: '$0.571', floor: '$3.75',
    expiry: 'Mar 10, 2026', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.42_PM_1.jpeg', chain: 'Polygon', change: '-1.5%',
    traits: [
       { type: 'Card Number', value: '389', rarity: '0%' },
      { type: 'Category', value: 'Football Cards', rarity: '0%' },
      { type: 'Grade', value: '9 MINT', rarity: '0%' },
    ],
    details: [
      { label: 'Contract Address', value: '0x25...dcad', copy: true },
      { label: 'Token Standard', value: 'ERC721' },
    ]
  }
};

const nft = computed(() => {
    const id = route.params.id;
    return mockData[id] || mockData['default'];
});

// OSIS Color Logic
const getPriceChangeColor = (change) => {
    return '#dfff00'; // Unified OSIS Neon
};

const activeTab = ref('Overview');
const tabs = ['Overview', 'Activity'];

const showTraits = ref(true);
const showDetails = ref(true);

const goBack = () => router.back();
</script>

<template>
  <div class="nft-details-page">
    <TopHeader />

    <main class="container">
      <div class="main-layout">
        
        <!-- Left Column: Premium Slab Display -->
        <div class="image-col">
          <div class="display-container">
            <div class="slab-stage">
              <div class="pedestal">
                <div class="pedestal-top"></div>
                <div class="pedestal-base"></div>
              </div>
              <div class="slab-overlay">
                <div class="slab-glare"></div>
                <img :src="nft.image" :alt="nft.name" class="nft-card-image" />
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column: Info & Actions -->
        <div class="info-col">
          
          <!-- Collection & Meta -->
          <div class="header-meta">
            <div class="collection-brand">
              <span class="brand-name">{{ nft.collection }}</span>
              <CheckCircle size="14" class="verified-check" fill="#dfff00" color="#000" />
            </div>
            <div class="header-actions">
              <button class="action-btn"><RefreshCw size="18" /></button>
              <button class="action-btn"><Share2 size="18" /></button>
            </div>
          </div>

          <!-- Title -->
          <h1 class="nft-title">{{ nft.name }}</h1>
          
          <!-- Ownership -->
          <div class="ownership-info">
            <span class="label">Owned by</span>
            <span class="address">{{ nft.owner }}</span>
            <span class="label">on</span>
            <div class="chain-tag">
              <span class="chain-icon polygon-icon" :style="{ backgroundColor: getPriceChangeColor(nft.change) }"></span>
              {{ nft.chain }}
            </div>
          </div>

          <!-- Tabs Navigation -->
          <div class="detail-tabs">
            <div 
              v-for="tab in tabs" 
              :key="tab"
              class="tab-btn"
              :class="{ active: activeTab === tab }"
              @click="activeTab = tab"
            >
              {{ tab }}
              <div class="active-indicator" v-if="activeTab === tab"></div>
            </div>
          </div>

          <!-- Price & Listing Box -->
          <div class="listing-card" :style="{ borderColor: getPriceChangeColor(nft.change) }">
            <div class="listing-header">
              <div class="label-group">
                <span class="listed-label">Listed for</span>
              </div>
              <span class="expiry-label">Expires {{ nft.expiry }}</span>
            </div>

            <div class="price-section">
              <div class="primary-price">
                <span class="price-val">{{ nft.price }}</span>
                <span class="crypto-sub">{{ nft.cryptoPrice }}</span>
              </div>
              <div class="price-stats">
                <span class="stat">Top offer: <span class="val">{{ nft.topOffer }}</span></span>
                <span class="stat">Floor: <span class="val">{{ nft.floor }}</span></span>
              </div>
            </div>

            <button class="buy-now-btn" :style="{ backgroundColor: getPriceChangeColor(nft.change) }">Buy Now</button>
          </div>

          <!-- Traits Accordion -->
          <div class="accordion-item" :class="{ open: showTraits }">
            <div class="accordion-trigger" @click="showTraits = !showTraits">
              <div class="trigger-left">
                <span class="trigger-title">Traits</span>
                <span class="count-badge">{{ nft.traits.length }}</span>
              </div>
              <ChevronDown class="chevron" :class="{ rotated: showTraits }" size="20" />
            </div>
            <div class="accordion-body" v-show="showTraits">
              <div class="traits-grid">
                <div v-for="trait in nft.traits" :key="trait.type" class="trait-box">
                  <span class="trait-label">{{ trait.type }}</span>
                  <div class="trait-value-row">
                    <span class="trait-val">{{ trait.value }}</span>
                    <span class="trait-rarity">{{ trait.rarity }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Details Accordion -->
          <div class="accordion-item" :class="{ open: showDetails }">
            <div class="accordion-trigger" @click="showDetails = !showDetails">
              <div class="trigger-left">
                <span class="trigger-title">Details</span>
              </div>
              <ChevronDown class="chevron" :class="{ rotated: showDetails }" size="20" />
            </div>
            <div class="accordion-body" v-show="showDetails">
              <div class="details-list">
                <div v-for="item in nft.details" :key="item.label" class="detail-row">
                  <span class="row-label">{{ item.label }}</span>
                  <div class="row-value-group">
                    <span class="row-val">{{ item.value }}</span>
                    <Copy v-if="item.copy" size="14" class="inline-copy" />
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
.nft-details-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'Inter', -apple-system, system-ui, sans-serif;
}

.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 40px 20px;
}

.main-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: start;
}

/* Left Column: Slab Display */
.display-container {
  background: radial-gradient(circle at center, #1a1a1a 0%, #000 100%);
  border-radius: 24px;
  aspect-ratio: 1/1;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #111;
  position: relative;
  overflow: hidden;
}

.slab-stage {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.pedestal {
  position: absolute;
  bottom: 15%;
  width: 240px;
  height: 40px;
  z-index: 1;
}

.pedestal-top {
  width: 100%;
  height: 20px;
  background: #222;
  border-radius: 50% / 10px;
  box-shadow: inset 0 0 15px rgba(255,255,255,0.1);
  border: 1px solid #333;
}

.pedestal-base {
  width: 100%;
  height: 30px;
  background: linear-gradient(to bottom, #111, #000);
  border-radius: 50% / 15px;
  margin-top: -10px;
  border: 1px solid #222;
}

.slab-overlay {
  width: 280px;
  height: 400px;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(2px);
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 10px;
  position: relative;
  z-index: 2;
  box-shadow: 0 10px 40px rgba(0,0,0,0.8);
  transform: perspective(1000px) rotateY(0deg) translateY(-20px);
}

.slab-glare {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 40%, rgba(255,255,255,0.05) 100%);
  pointer-events: none;
  z-index: 3;
}

.nft-card-image {
  width: 100%;
  height: 100%;
  object-fit: contain;
  border-radius: 4px;
}

/* Right Column */
.header-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.collection-brand {
  display: flex;
  align-items: center;
  gap: 8px;
}

.brand-name {
  color: #dfff00;
  font-weight: 700;
  font-size: 16px;
}

.header-actions {
  display: flex;
  gap: 12px;
}

.action-btn {
  background: transparent;
  border: none;
  color: #666;
  cursor: pointer;
  padding: 4px;
  transition: color 0.2s;
}

.action-btn:hover {
  color: #fff;
}

.nft-title {
  font-size: 32px;
  font-weight: 800;
  line-height: 1.1;
  margin: 0 0 12px 0;
}

.ownership-info {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 14px;
  color: #666;
  margin-bottom: 32px;
}

.address {
  color: #fff;
  font-weight: 600;
}

.chain-tag {
  display: flex;
  align-items: center;
  gap: 4px;
  color: #fff;
  font-weight: 600;
}

.polygon-icon {
  width: 16px;
  height: 16px;
  background: #8247e5;
  border-radius: 50%;
}

/* Tabs */
.detail-tabs {
  display: flex;
  flex-wrap: wrap;
  gap: 24px;
  border-bottom: 1px solid #1a1a1a;
  margin-bottom: 24px;
  min-height: 40px;
}

.tab-btn {
  position: relative;
  font-size: 16px;
  font-weight: 600;
  color: #666;
  cursor: pointer;
  padding-bottom: 12px;
  transition: color 0.2s;
}

.tab-btn:hover {
  color: #fff;
}

.tab-btn.active {
  color: #fff;
}

.active-indicator {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 2px;
  background: #fff;
}

/* Listing Box */
.listing-card {
  background: #090909;
  border: 1px solid #333;
  border-radius: 12px;
  padding: 24px;
  margin-bottom: 24px;
  transition: border-color 0.3s;
}

.listing-card:hover {
  border-color: #dfff00;
}

.listing-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 16px;
}

.listed-label {
  color: #aaa;
  font-size: 13px;
  font-weight: 600;
}

.expiry-label {
  color: #666;
  font-size: 12px;
}

.price-section {
  display: flex;
  flex-direction: column;
  gap: 4px;
  margin-bottom: 24px;
}

.primary-price {
  display: flex;
  align-items: baseline;
  gap: 12px;
}

.price-val {
  font-size: 32px;
  font-weight: 800;
}

.crypto-sub {
  color: #666;
  font-size: 14px;
  font-weight: 600;
}

.price-stats {
  display: flex;
  gap: 16px;
  color: #666;
  font-size: 12px;
}

.stat .val {
  color: #aaa;
  font-weight: 600;
}

.buy-now-btn {
  width: 100%;
  background: #dfff00;
  color: #000;
  border: none;
  padding: 14px;
  border-radius: 30px;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
  transition: transform 0.2s, background 0.2s;
}

.buy-now-btn:hover {
  background: #e6e400;
  transform: translateY(-2px);
}

/* Accordions */
.accordion-item {
  border: 1px solid #1a1a1a;
  border-radius: 12px;
  margin-bottom: 16px;
  overflow: hidden;
}

.accordion-trigger {
  padding: 16px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  background: #050505;
}

.trigger-left {
  display: flex;
  align-items: center;
  gap: 10px;
}

.trigger-title {
  font-weight: 700;
  font-size: 15px;
}

.count-badge {
  background: #1a1a1a;
  color: #888;
  font-size: 11px;
  padding: 2px 8px;
  border-radius: 10px;
}

.chevron {
  color: #666;
  transition: transform 0.3s;
}

.chevron.rotated {
  transform: rotate(180deg);
}

.accordion-body {
  padding: 20px;
  background: #000;
  border-top: 1px solid #1a1a1a;
}

/* Traits Grid */
.traits-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}

.trait-box {
  background: #080808;
  border: 1px solid #1a1a1a;
  border-radius: 8px;
  padding: 12px 16px;
}

.trait-label {
  display: block;
  font-size: 11px;
  color: #666;
  text-transform: uppercase;
  margin-bottom: 6px;
}

.trait-value-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.trait-val {
  font-size: 14px;
  font-weight: 700;
}

.trait-rarity {
  font-size: 11px;
  color: #444;
}

/* Details List */
.details-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.detail-row {
  display: flex;
  justify-content: space-between;
  font-size: 14px;
}

.row-label {
  color: #666;
}

.row-value-group {
  display: flex;
  align-items: center;
  gap: 6px;
}

.row-val {
  font-weight: 600;
}

.inline-copy {
  color: #444;
  cursor: pointer;
}

@media (max-width: 1024px) {
  .main-layout {
    grid-template-columns: 1fr;
    gap: 40px;
  }
}

@media (max-width: 600px) {
  .container {
    padding: 20px 15px;
  }

  .ownership-info {
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 24px;
  }

  .traits-grid {
    grid-template-columns: 1fr;
  }
  
  .primary-price {
    flex-direction: column;
    align-items: flex-start;
    gap: 0;
  }

  .price-stats {
    flex-direction: column;
    gap: 4px;
  }

  .nft-title {
    font-size: 24px;
  }

  .display-container {
    border-radius: 16px;
  }

  .slab-overlay {
    width: 240px;
    height: 340px;
  }

  .pedestal {
    width: 200px;
  }

  .accordion-trigger {
    padding: 12px 15px;
  }
}
</style>
