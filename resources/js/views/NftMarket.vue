<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import { 
  Search, 
  ArrowRight,
  MoreHorizontal,
  Zap,
  Award,
  TrendingUp,
  Filter,
  ArrowUpRight,
  ShieldCheck,
  Star,
  CheckCircle,
  Heart,
  Eye,
  ChevronDown,
  Flame,
  Sparkles,
  Crown,
  Rocket,
  Grid3x3,
  LayoutGrid,
  SlidersHorizontal,
  X,
  ChevronUp,
  Send
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const navigateToNft = (id) => {
  router.push(`/nft/${id}`);
};

const goToNftDetail = (id) => {
  navigateToNft(id);
};

const goToCollection = () => {
  router.push('/collection-details');
};

// Sidebar and filters state
const showFilters = ref(true);
const showMobileFilters = ref(false);

// Status filters
const statusFilters = ref({
  buyNow: false,
  auction: false,
  hasOffers: false
});

// Price range
const priceRange = ref({
  min: '',
  max: '',
  currency: 'ETH'
});

// Sort options
const sortBy = ref('recent');
const sortOptions = [
  { value: 'recent', label: 'Recently Listed' },
  { value: 'price-low', label: 'Price: Low to High' },
  { value: 'price-high', label: 'Price: High to Low' },
  { value: 'most-liked', label: 'Most Liked' },
  { value: 'ending-soon', label: 'Ending Soon' }
];

// View mode
const viewMode = ref('large'); // 'large' or 'small'

// Chain filters
const chains = [
  { id: 'all', name: 'All Chains', icon: '🌐', active: true },
  { id: 'ethereum', name: 'Ethereum', icon: '⟠', active: false },
  { id: 'polygon', name: 'Polygon', icon: '⬡', active: false },
  { id: 'base', name: 'Base', icon: '🔵', active: false },
  { id: 'arbitrum', name: 'Arbitrum', icon: '🔷', active: false },
  { id: 'optimism', name: 'Optimism', icon: '🔴', active: false },
];

// Trending Collections
const trendingCollections = [
  { 
    id: 1, 
    name: 'Bored Ape Yacht Club', 
    floor: '25.5', 
    volume: '2,345', 
    change: '+12.5%',
    image: 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=300&auto=format&fit=crop',
    verified: true
  },
  { 
    id: 2, 
    name: 'CryptoPunks', 
    floor: '45.2', 
    volume: '3,567', 
    change: '+8.3%',
    image: 'https://images.unsplash.com/photo-1633167606207-d840b5070fc2?q=80&w=300&auto=format&fit=crop',
    verified: true
  },
  { 
    id: 3, 
    name: 'Azuki', 
    floor: '12.8', 
    volume: '1,890', 
    change: '+15.7%',
    image: 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=300&auto=format&fit=crop',
    verified: true
  },
  { 
    id: 4, 
    name: 'Doodles', 
    floor: '8.4', 
    volume: '1,234', 
    change: '+5.2%',
    image: 'https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?q=80&w=300&auto=format&fit=crop',
    verified: true
  },
  { 
    id: 5, 
    name: 'Pudgy Penguins', 
    floor: '15.2', 
    volume: '1,567', 
    change: '+9.8%',
    image: 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?q=80&w=300&auto=format&fit=crop',
    verified: true
  },
];

// Hero scrolling NFTs
const heroScrollNfts = [
  { id: 1, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_1.jpeg', title: 'Cosmic Voyager #882', collection: 'Cosmic Collection' },
  { id: 2, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_2.jpeg', title: 'Neural Network Art', collection: 'AI Genesis' },
  { id: 3, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM.jpeg', title: 'Quantum Genesis', collection: 'Quantum Series' },
  { id: 4, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.47_PM_1.jpeg', title: 'BioSphere Protocol', collection: 'BioArt' },
  { id: 5, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.47_PM_2.jpeg', title: 'Crypto Sanctuary', collection: 'Digital Realms' },
  { id: 6, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.47_PM_3.jpeg', title: 'Digital Dreams', collection: 'Dreamscape' },
];

// NFT Grid items with enhanced data
const allNftItems = [
  { id: 'nft-1', title: 'Ethereal Cat #1234', collection: 'Feline Fantasy', creator: 'CryptoArtist', creatorAvatar: '👨‍🎨', price: '2.5', lastSale: '2.2', likes: 342, views: 1205, verified: true, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_1.jpeg' },
  { id: 'nft-2', title: 'Abstract Dimensions', collection: 'Modern Art', creator: 'DigitalDreamer', creatorAvatar: '🎨', price: '3.8', lastSale: '3.5', likes: 567, views: 2103, verified: true, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_2.jpeg' },
  { id: 'nft-3', title: 'Neon Symphony #45', collection: 'Synthwave Series', creator: 'NeonMaster', creatorAvatar: '✨', price: '1.9', lastSale: '1.7', likes: 423, views: 1876, verified: false, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM.jpeg' },
  { id: 4, title: 'Bored Ape #8817', collection: 'Bored Ape Yacht Club', creator: 'Yuga Labs', creatorAvatar: '🦧', price: '320.5', lastSale: '290.0', likes: 1205, views: 5600, verified: true, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_1.jpeg' },
  { id: 5, title: 'Cosmic Perspective', collection: 'Space Art', creator: 'StarGazer', creatorAvatar: '🔭', price: '5.2', lastSale: '4.8', likes: 445, views: 1890, verified: true, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_2.jpeg' },
  { id: 6, title: 'Neon District', collection: 'Cyberpunk City', creator: 'NeoArtist', creatorAvatar: '🤖', price: '7.8', lastSale: '7.2', likes: 678, views: 2450, verified: false, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM.jpeg' },
  { id: 'nft-8', title: 'Fire & Ice', collection: 'Elemental Forces', creator: 'ElementalPro', creatorAvatar: '🔥', price: '6.5', lastSale: '6.0', likes: 1023, views: 4567, verified: true, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_1.jpeg' },
  { id: 'nft-9', title: 'Digital Renaissance', collection: 'Classic Reborn', creator: 'ArtHistorian', creatorAvatar: '🎭', price: '7.2', lastSale: '6.8', likes: 1234, views: 5678, verified: true, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_2.jpeg' },
  { id: 'nft-10', title: 'Neon Nights #202', collection: 'City Lights', creator: 'UrbanExplorer', creatorAvatar: '🌃', price: '2.1', lastSale: '1.9', likes: 387, views: 1543, verified: false, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM.jpeg' },
  { id: 'nft-11', title: 'Crystal Dreams', collection: 'Mineral Kingdom', creator: 'GemCrafter', creatorAvatar: '💎', price: '4.9', lastSale: '4.5', likes: 765, views: 2987, verified: true, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_1.jpeg' },
  { id: 'nft-12', title: 'Mechanical Soul', collection: 'Steampunk Collection', creator: 'GearMaster', creatorAvatar: '⚙️', price: '3.6', lastSale: '3.3', likes: 589, views: 2234, verified: true, image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_2.jpeg' },
];

// News Data
const newsItems = [
  {
    id: 1,
    title: 'The Future of NFT Gaming: What to Expect in 2026',
    category: 'Gaming',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.49_PM_2.jpeg',
    url: '#'
  },
  {
    id: 2,
    title: 'Top 10 Collections to Watch This Month',
    category: 'Market',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.50_PM_1.jpeg',
    url: '#'
  },
  {
    id: 3,
    title: 'Artist Spotlight: The Rise of Digital Surrealism',
    category: 'Art',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.51_PM_1.jpeg',
    url: '#'
  }
];

// Trending Table Data
const trendingTableData = [
    { rank: 1, name: 'Pudgy Penguins', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.40_PM_2.jpeg', verified: true, floor: '15.2', floorChange: '+4.5%', volume: '1,567', items: '8.8k', owners: '4.5k', listed: '1.2%', vol7d: '$1.2M', chartColor: '#dfff00' },
    { rank: 2, name: 'Moonbirds', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.38_PM.jpeg', verified: true, floor: '4.2', floorChange: '-2.1%', volume: '845', items: '10k', owners: '6.2k', listed: '4.5%', vol7d: '$890k', chartColor: '#FF00D6' },
    { rank: 3, name: 'Bored Ape Yacht Club', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.39_PM_1.jpeg', verified: true, floor: '25.5', floorChange: '+1.2%', volume: '2,345', items: '10k', owners: '5.8k', listed: '2.5%', vol7d: '$3.5M', chartColor: '#dfff00' },
    { rank: 4, name: 'Lil Pudgys', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.39_PM_2.jpeg', verified: true, floor: '1.8', floorChange: '+8.3%', volume: '456', items: '22k', owners: '8.1k', listed: '0.8%', vol7d: '$420k', chartColor: '#dfff00' },
    { rank: 5, name: 'Winds of Yawanawa', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.39_PM.jpeg', verified: true, floor: '6.4', floorChange: '0%', volume: '123', items: '1k', owners: '3,333', listed: '2.5%', vol7d: '$120k', chartColor: '#888' },
    { rank: 6, name: 'Doodles', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.40_PM_1.jpeg', verified: true, floor: '3.8', floorChange: '+12.5%', volume: '890', items: '10k', owners: '5.4k', listed: '3.6%', vol7d: '$950k', chartColor: '#dfff00' },
    { rank: 20, name: 'Mutant Ape Yacht Club', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.40_PM_2.jpeg', verified: true, floor: '5.2', floorChange: '-1.5%', volume: '678', items: '20k', owners: '12k', listed: '4.2%', vol7d: '$780k', chartColor: '#FF00D6' },
    { rank: 8, name: 'Meebits', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.38_PM.jpeg', verified: true, floor: '1.4', floorChange: '+3.2%', volume: '234', items: '20k', owners: '7.8k', listed: '1.5%', vol7d: '$340k', chartColor: '#dfff00' },
    { rank: 9, name: 'Memeland', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.39_PM_1.jpeg', verified: false, floor: '0.5', floorChange: '+22.4%', volume: '1,234', items: '5k', owners: '15k', listed: '8.5%', vol7d: '$1.5M', chartColor: '#dfff00' },
    { rank: 10, name: 'Kanpai Pandas', image: '/images/WhatsApp_Image_2026-02-16_at_9.35.39_PM_2.jpeg', verified: true, floor: '2.1', floorChange: '-0.8%', volume: '156', items: '10k', owners: '4.2k', listed: '2.1%', vol7d: '$180k', chartColor: '#FF00D6' },
];



// Highlight Data
const highlightItems = [
  {
    id: 1,
    title: 'VeeFriends',
    floor: '2.590',
    change: '+3.2%',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.40_PM_1.jpeg'
  },
  {
    id: 2,
    title: 'Pudgy Penguins',
    floor: '0.765',
    change: '+2.1%',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.40_PM_2.jpeg'
  },
  {
    id: 3,
    title: 'Chromie Squiggle by Snowfro',
    floor: '5.537',
    change: '-1.2%',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.40_PM.jpeg'
  },
  {
    id: 4,
    title: '[Return To Form] - Burrito DAO Drop',
    floor: '155.0',
    change: '0%',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.41_PM_1.jpeg'
  },
  {
    id: 5,
    title: 'Mutant Ape Yacht Club',
    floor: '1.700',
    change: '-1.1%',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.41_PM_2.jpeg'
  },
  {
    id: 6,
    title: 'VeeFriends Series 2',
    floor: '156.3',
    change: '+3.2%',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.41_PM.jpeg'
  },
];

// Card Items Data
const cardItems = [
  {
    id: 1,
    title: '1986 Fleer #57 Michael Jordan (PSA 10 GEM MINT)',
    price: '$150,000',
    image: '/card1.png'
  },
  {
    id: 2,
    title: '1979 Topps #18 Wayne Gretzky (PSA 9 MINT)',
    price: '$75,000',
    image: '/card2.png'
  },
  {
    id: 3,
    title: '2003 Exquisite Collection LeBron James (BGS 9.5)',
    price: '$1,200,000',
    image: '/card3.png'
  },
  {
    id: 4,
    title: '1952 Topps #311 Mickey Mantle (PSA 8 NM-MT)',
    price: '$2,500,000',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.43_PM_1.jpeg'
  },
  {
    id: 5,
    title: '1999 Pokémon 1st Edition Charizard (PSA 10)',
    price: '$350,000',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.43_PM_2.jpeg'
  },
  {
    id: 6,
    title: '2000 Playoff Contenders Tom Brady (PSA 10)',
    price: '$850,000',
    image: '/images/WhatsApp_Image_2026-02-16_at_9.35.43_PM.jpeg'
  }
];

const trendingTimeFilter = ref('24h');

const nftItems = ref(allNftItems.slice(0, 8));
const isLoading = ref(false);

const activeTab = ref('All Items');
const tabs = ['All Items', 'Art', 'Music', 'Photography', 'Video', 'Collectibles', 'Gaming'];

// Featured NFT with timer & Auto-play
const currentFeaturedIndex = ref(0);
const timeRemaining = ref(8);

// Trending collections carousel
const trendingScrollContainer = ref(null);
const collectionScrollInterval = ref(null);

// Auto-scroll functionality
let heroInterval;

// Computed current featured NFT
const currentFeaturedNft = computed(() => heroScrollNfts[currentFeaturedIndex.value]);

// Auto-change hero image every 5 seconds
const startHeroAutoPlay = () => {
  heroInterval = setInterval(() => {
    // Move to next image
    currentFeaturedIndex.value = (currentFeaturedIndex.value + 1) % heroScrollNfts.length;
  }, 5000);
};

// Computed grid class based on view mode
const gridClass = computed(() => {
  return viewMode.value === 'small' ? 'nft-grid-small' : 'nft-grid';
});

onMounted(() => {
  startHeroAutoPlay();

  // Trending collections auto-scroll
  collectionScrollInterval.value = setInterval(() => {
    if (trendingScrollContainer.value) {
      const container = trendingScrollContainer.value;
      container.scrollLeft += 1;
      
      if (container.scrollLeft >= container.scrollWidth / 2) {
        container.scrollLeft = 0;
      }
    }
  }, 40);

  // Scroll animations
  observeElements();

  // Infinite scroll
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  clearInterval(heroInterval);
  if (collectionScrollInterval.value) {
    clearInterval(collectionScrollInterval.value);
  }
  window.removeEventListener('scroll', handleScroll);
});

const selectFeaturedNft = (index) => {
  currentFeaturedIndex.value = index;
  // Reset interval on manual click
  clearInterval(heroInterval);
  startHeroAutoPlay();
};

// Intersection Observer for scroll animations
const observeElements = () => {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-in');
        }
      });
    },
    { threshold: 0.1 }
  );

  document.querySelectorAll('.nft-card, .trending-card').forEach((el) => {
    observer.observe(el);
  });
};

const selectChain = (chainId) => {
  chains.forEach(chain => {
    chain.active = chain.id === chainId;
  });
};

// Toggle sidebar
const toggleFilters = () => {
  showFilters.value = !showFilters.value;
};

const toggleMobileFilters = () => {
  showMobileFilters.value = !showMobileFilters.value;
};

// Update sort
const updateSort = (value) => {
  sortBy.value = value;
  // In a real app, this would trigger API call with new sort
  sortItems();
};

// Sort items
const sortItems = () => {
  let sorted = [...nftItems.value];
  
  switch(sortBy.value) {
    case 'price-low':
      sorted.sort((a, b) => parseFloat(a.price) - parseFloat(b.price));
      break;
    case 'price-high':
      sorted.sort((a, b) => parseFloat(b.price) - parseFloat(a.price));
      break;
    case 'most-liked':
      sorted.sort((a, b) => b.likes - a.likes);
      break;
    // 'recent' and 'ending-soon' would need backend support
  }
  
  nftItems.value = sorted;
};

// Toggle view mode
const toggleViewMode = (mode) => {
  viewMode.value = mode;
};

// Clear all filters
const clearFilters = () => {
  statusFilters.value = {
    buyNow: false,
    auction: false,
    hasOffers: false
  };
  priceRange.value = {
    min: '',
    max: '',
    currency: 'ETH'
  };
};

// Check if any filters are active
const hasActiveFilters = computed(() => {
  return statusFilters.value.buyNow || 
         statusFilters.value.auction || 
         statusFilters.value.hasOffers ||
         priceRange.value.min !== '' ||
         priceRange.value.max !== '';
});

// Infinite scroll handler
const handleScroll = () => {
  const scrollPosition = window.innerHeight + window.scrollY;
  const documentHeight = document.documentElement.scrollHeight;
  
  if (scrollPosition >= documentHeight - 500 && !isLoading.value && nftItems.value.length < allNftItems.length) {
    loadMoreItems();
  }
};

// Load more items
const loadMoreItems = () => {
  isLoading.value = true;
  
  setTimeout(() => {
    const currentLength = nftItems.value.length;
    const nextItems = allNftItems.slice(currentLength, currentLength + 4);
    nftItems.value = [...nftItems.value, ...nextItems];
    isLoading.value = false;
    
    // Re-observe new items
    setTimeout(() => observeElements(), 100);
  }, 800); // Simulate network delay
};
</script>

<template>
  <div class="nft-market-page">
    <TopHeader />
    
    <main class="main-wrapper">
      <!-- Chain Filter Header - Centered -->
      <section class="chain-filter-header">
        <div class="chain-filters">
          <button 
            v-for="chain in chains" 
            :key="chain.id" 
            class="chain-btn"
            :class="{ active: chain.active }"
            @click="selectChain(chain.id)"
          >
            <span class="chain-icon">{{ chain.icon }}</span>
            {{ chain.name }}
          </button>
          <button class="chain-btn more-btn">
            More <ChevronDown size="16" />
          </button>
        </div>
      </section>

      <!-- Hero Section - Auto-Scrolling Background -->
      <section class="hero-banner-section">
        <!-- Background Image Slideshow -->
        <div class="hero-bg-container">
           <transition-group name="hero-fade" tag="div" class="hero-bg-wrapper">
             <div 
               v-for="(nft, index) in heroScrollNfts" 
               :key="nft.id"
               class="hero-bg-image"
               :class="{ active: index === currentFeaturedIndex }"
               :style="{ backgroundImage: `url('${nft.image}')` }"
               v-show="index === currentFeaturedIndex"
             ></div>
           </transition-group>
        </div>

        <!-- Content Overlay -->
        <div class="hero-content-overlay">
           <!-- Thumbnails Bottom Right -->
           <div class="hero-thumbnails-container">
             <div 
               v-for="(nft, index) in heroScrollNfts" 
               :key="nft.id"
               class="hero-thumbnail"
               :class="{ active: index === currentFeaturedIndex }"
               @click="selectFeaturedNft(index)"
             >
               <img :src="nft.image" :alt="nft.title" />
               <div class="thumbnail-border" v-if="index === currentFeaturedIndex"></div>
             </div>
           </div>

           <!-- Info Bottom Left -->
            <div class="hero-info-left" @click="goToCollection" style="cursor: pointer">
              <span class="pill-badge"><span class="badge-dot"></span> New brand</span>
              <h1>{{ currentFeaturedNft.title }}</h1>
              <p class="hero-description">{{ currentFeaturedNft.collection }} is an entertainment company blending stories, games, events, collectibles, and tech to build a community of kindness and accountability.</p>
              <button class="hero-cta-btn">Explore {{ currentFeaturedNft.title }}</button>
            </div>
        </div>
      </section>

      <!-- Highlight Collection Section -->
      <section class="highlight-section">
        <div class="highlight-carousel">
          <div class="highlight-track">
            <div 
              v-for="item in highlightItems" 
              :key="item.id" 
              class="highlight-card"
              @click="goToCollection"
            >
              <img :src="item.image" :alt="item.title" class="highlight-bg" />
              <div class="highlight-overlay"></div>
              <div class="highlight-content">
                <h4 class="highlight-title">{{ item.title }}</h4>
                <div class="highlight-stats">
                  <span class="highlight-floor">${{ item.floor }}</span>
                  <span class="highlight-change" :class="item.change.includes('-') ? 'text-red' : 'text-green'">{{ item.change }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Cards Section -->
      <section class="cards-section">
        <div class="cards-header">
          <h3>Cards</h3>
          <a href="#" class="view-all-cards">View all <ArrowRight size="14" /></a>
        </div>
        
        <div class="cards-carousel">
          <div class="cards-track">
            <div 
              v-for="card in cardItems" 
              :key="card.id" 
              class="trading-card-item"
              @click="goToNftDetail(card.id)"
            >
              <div class="card-image-container">
                <img :src="card.image" :alt="card.title" />
                <div class="card-stand"></div>
              </div>
              <div class="card-details">
                <h4 class="card-title">{{ card.title }}</h4>
                <div class="card-price">{{ card.price }}</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Trending List Section -->
      <section class="trending-list-section">
        <div class="trending-list-header">
          <h3>Trending</h3>
          <div class="trending-header-controls">
            <button class="list-collection-btn">List collection</button>
            <div class="time-filters">
              <button 
                v-for="time in ['1h', '6h', '24h', '7d', '30d']" 
                :key="time"
                class="time-btn"
                :class="{ active: trendingTimeFilter === time }"
                @click="trendingTimeFilter = time"
              >
                {{ time }}
              </button>
            </div>
          </div>
        </div>

        <div class="trending-table-container">
          <table class="trending-table">
            <thead>
              <tr>
                <th class="col-collection">Collection</th>
                <th class="col-right">Floor</th>
                <th class="col-right">Floor 24h</th>
                <th class="col-right">Vol (24h)</th>
                <th class="col-right mobile-hide">Items</th>
                <th class="col-right mobile-hide">Owners</th>
                <th class="col-right mobile-hide">Listed</th>
                <th class="col-right mobile-hide">Vol (7d)</th>
                <th class="col-right mobile-hide">Last 7d</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in trendingTableData" :key="item.rank" @click="goToCollection" style="cursor: pointer">
                <td class="col-collection">
                   <div class="collection-cell">
                     <span class="rank">{{ item.rank }}</span>
                     <div class="collection-img-wrapper">
                       <img :src="item.image" :alt="item.name" />
                       <div class="verified-tick" v-if="item.verified">✓</div>
                     </div>
                     <span class="collection-name">{{ item.name }}</span>
                     <span class="collection-verified-star" v-if="item.verified">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="#dfff00"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                     </span>
                   </div>
                </td>
                <td class="col-right">{{ item.floor }} ETH</td>
                <td class="col-right" :class="item.floorChange.includes('-') ? 'text-red' : 'text-green'">{{ item.floorChange }}</td>
                <td class="col-right">{{ item.volume }} ETH</td>
                <td class="col-right mobile-hide">{{ item.items }}</td>
                <td class="col-right mobile-hide">{{ item.owners }}</td>
                <td class="col-right mobile-hide">{{ item.listed }}</td>
                <td class="col-right mobile-hide">{{ item.vol7d }}</td>
                <td class="col-right mobile-hide">
                  <div class="sparkline">
                    <svg width="80" height="20" viewBox="0 0 80 20">
                      <path d="M0 10 Q 20 5 40 10 T 80 10" fill="none" :stroke="item.chartColor" stroke-width="2" />
                    </svg>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>



      <!-- Trusted Brands Section -->
      <section class="trusted-section">
        <h3 class="trusted-title">Trusted by</h3>
        <div class="trusted-grid">
          <div class="brand-item">
            <span class="brand-logo base">
              <span class="base-icon"></span>
              base
            </span>
          </div>
          <div class="brand-item">
            <span class="brand-logo barbie">Barbie</span>
          </div>
          <div class="brand-item">
             <div class="brand-logo psg">
               <div class="psg-circle">PARIS</div>
             </div>
          </div>
          <div class="brand-item">
            <span class="brand-logo ubisoft">
              <span class="swirl">◎</span> UBISOFT
            </span>
          </div>
          <div class="brand-item">
            <span class="brand-logo fox">
              FOX <span class="deportes">DEPORTES</span>
            </span>
          </div>
          <div class="brand-item">
            <span class="brand-logo rekt">rekt</span>
          </div>
          <div class="brand-item">
            <span class="brand-logo ufc">UFC</span>
          </div>
          <div class="brand-item">
             <span class="brand-logo universal">
               <span class="globe">🌍</span> UNIVERSAL
             </span>
          </div>
           <div class="brand-item">
            <span class="brand-logo hotwheels">
              HotWheels
            </span>
          </div>
          <div class="brand-item">
            <span class="brand-logo ledger">
              [ LEDGER ]
            </span>
          </div>
        </div>
      </section>

      <!-- News Section -->
      <section class="news-section">
        <div class="news-header">
          <h3>News</h3>
          <a href="#" class="view-all-news">View all news <ArrowRight size="14" /></a>
        </div>
        
        <div class="news-grid">
          <!-- Featured News Item (Left) -->
          <div class="news-featured-card" @click="goToNftDetail('news-featured')" style="cursor: pointer">
            <div class="featured-content">
              <span class="starting-with">starting with</span>
              <div class="brand-title">
                 <span><svg viewBox="0 0 24 24" width="40" height="40" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg></span>
                 VeeFriends
              </div>
            </div>
            <img class="featured-bg-image" src="/images/WhatsApp_Image_2026-02-16_at_9.35.48_PM_1.jpeg" alt="VeeFriends" />
            <div class="featured-overlay"></div>
            <div class="featured-news-footer">
              <span class="news-tag">PRESS RELEASE</span>
              <h4>OSIS Launches Branded On-chain Storefronts With VeeFriends</h4>
            </div>
          </div>

          <!-- News List (Right) -->
          <div class="news-list">
            <a href="javascript:void(0)" class="news-item" v-for="news in newsItems" :key="news.id" @click="goToNftDetail('news-' + news.id)">
              <div class="news-item-content">
                <span class="news-category">{{ news.category }}</span>
                <h4 class="news-title">{{ news.title }}</h4>
              </div>
              <div class="news-item-image">
                <img :src="news.image" :alt="news.title" />
              </div>
            </a>
          </div>
        </div>
      </section>

      <!-- Large Brand Text -->
      <div class="large-brand-text">
        <span>D</span>ESCI
      </div>

      <!-- Footer -->
      <footer class="market-footer">
        <div class="footer-left">
          <span class="copyright">© OSIS, Inc.</span>
          <a href="#" class="footer-link">Terms</a>
          <a href="#" class="footer-link">Privacy</a>
          <a href="#" class="footer-link">API</a>
        </div>
        <div class="footer-right">
          <button class="currency-btn">USD</button>
          <span class="footer-label">Crypto</span>
          <div class="crypto-stat">
            <div class="coin-icon yellow">D</div>
            <span>$0.2</span>
          </div>
          <div class="crypto-stat">
            <div class="coin-icon blue">E</div>
            <span>$2,014</span>
          </div>
          <button class="community-btn">
            <Send :size="16" />
            Community
          </button>
        </div>
      </footer>
    </main>
  </div>
</template>

<style scoped>
.nft-market-page {
  background: linear-gradient(135deg, #0a0a0a 0%, #111 50%, #0a0a0a 100%);
  min-height: 100vh;
  color: #fff;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

.main-wrapper {
  max-width: 1400px;
  margin: 0 auto;
  padding: 20px;
}

/* Chain Filter Header */
.chain-filter-header {
  margin-bottom: 32px;
  padding: 0 10px;
  display: flex;
  justify-content: center;
}

.chain-filters {
  display: flex;
  gap: 12px;
  align-items: center;
  flex-wrap: wrap;
  justify-content: center;
}

.chain-btn {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: #fff;
  padding: 10px 20px;
  border-radius: 24px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.chain-btn.active {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-color: #667eea;
  box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
  transform: translateY(-2px);
}

.chain-btn:hover:not(.active) {
  border-color: rgba(255, 255, 255, 0.3);
  background: rgba(255, 255, 255, 0.08);
  transform: translateY(-2px);
}

.chain-icon {
  font-size: 18px;
}

.more-btn {
  color: #888;
}

/* Hero Section Styles */
.hero-banner-section {
  position: relative;
  height: 400px; /* Reduced height as per screenshot look */
  margin: 20px 0;
  border-radius: 20px;
  overflow: hidden;
  background: #000;
}

.hero-bg-container {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}

.hero-bg-wrapper {
  position: relative;
  width: 100%;
  height: 100%;
}

.hero-bg-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  /* Auto scroll right to left animation */
  animation: bgScroll 20s linear infinite alternate;
  will-change: opacity, background-position;
}

@keyframes bgScroll {
  0% { background-position: 0% 50%; }
  100% { background-position: 100% 50%; }
}

/* Transitions for fading images */
.hero-fade-enter-active,
.hero-fade-leave-active {
  transition: opacity 1s ease;
}

.hero-fade-enter-from,
.hero-fade-leave-to {
  opacity: 0;
}

.hero-content-overlay {
  position: absolute;
  inset: 0;
  z-index: 2;
  /* Darkening edges gradient */
  background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, transparent 20%, transparent 80%, rgba(0,0,0,0.8) 100%);
  pointer-events: none; /* Let clicks pass through to thumbnails if needed, but thumbnails need pointer-events: auto */
}

.hero-thumbnails-container {
  position: absolute;
  bottom: 20px;
  right: 20px;
  display: flex;
  gap: 12px;
  pointer-events: auto;
}

.hero-thumbnail {
  width: 48px;
  height: 48px;
  border-radius: 8px;
  overflow: hidden;
  cursor: pointer;
  position: relative;
  border: 1px solid rgba(255, 255, 255, 0.3);
  transition: transform 0.2s;
}

.hero-thumbnail:hover {
  transform: scale(1.1);
}

.hero-thumbnail.active {
  width: 54px;
  height: 54px;
  border-color: #fff;
  transform: translateY(-4px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.5);
}

.hero-thumbnail img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-info-left {
  position: absolute;
  bottom: 30px;
  left: 30px;
  max-width: 500px;
  color: #fff;
  pointer-events: auto;
}

.pill-badge {
  color: #fffd00;
  font-size: 13px;
  font-weight: 700;
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.badge-dot {
  width: 8px;
  height: 8px;
  background-color: #fffd00;
  border-radius: 50%;
  display: inline-block;
}

.hero-info-left h1 {
  font-size: 36px;
  font-weight: 800;
  margin: 0 0 12px 0;
  line-height: 1;
}

.hero-description {
  font-size: 13px;
  color: #ccc;
  margin-bottom: 20px;
  line-height: 1.5;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.hero-cta-btn {
  background: #fff;
  color: #000;
  border: none;
  padding: 10px 24px;
  border-radius: 24px;
  font-size: 14px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s;
}

.hero-cta-btn:hover {
  transform: scale(1.02);
  background: #f0f0f0;
}

@media (max-width: 768px) {
  .hero-banner-section {
    height: 400px;
  }

  .hero-info-left h1 {
    font-size: 32px;
  }

  .hero-info-left {
    bottom: 60px;
    left: 20px;
    right: 20px;
    max-width: none;
  }

  .hero-thumbnails-container {
    left: 50%;
    right: auto;
    bottom: 20px;
    transform: translateX(-50%);
    gap: 8px;
  }

  .hero-thumbnail {
    width: 40px;
    height: 3px;
    border-radius: 2px;
    background: rgba(255, 255, 255, 0.3);
    border: none;
    padding: 0;
  }

  .hero-thumbnail img {
    display: none;
  }

  .hero-thumbnail.active {
    width: 50px;
    height: 3px;
    background: #fff;
    transform: none;
    box-shadow: none;
  }
}

/* Trending Collections Section */
.trending-section {
  margin: 0 0 56px 0;
  padding: 0 10px;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 28px;
}

.header-left {
  display: flex;
  align-items: center;
  gap: 12px;
}

.section-icon {
  color: #ff6b6b;
  filter: drop-shadow(0 0 10px rgba(255, 107, 107, 0.5));
}

.section-header h2 {
  font-size: 28px;
  font-weight: 800;
  margin: 0;
  background: linear-gradient(135deg, #fff 0%, #a0a0a0 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.view-all-btn {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: #fff;
  padding: 10px 20px;
  border-radius: 12px;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s;
}

.view-all-btn:hover {
  background: rgba(255, 255, 255, 0.1);
  transform: translateX(4px);
}

.trending-carousel {
  overflow-x: auto;
  overflow-y: hidden;
  scrollbar-width: none;
  -ms-overflow-style: none;
}

.trending-carousel::-webkit-scrollbar {
  display: none;
}

.trending-track {
  display: flex;
  gap: 20px;
  padding: 10px 0;
}

.trending-card {
  flex-shrink: 0;
  width: 240px;
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  opacity: 0;
  animation: slideInRight 0.6s forwards;
}

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.trending-card:hover {
  transform: translateY(-8px);
  border-color: rgba(102, 126, 234, 0.4);
  box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
}

.trending-image {
  position: relative;
  height: 180px;
  overflow: hidden;
}

.trending-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s;
}

.trending-card:hover .trending-image img {
  transform: scale(1.1);
}

.trending-rank {
  position: absolute;
  top: 12px;
  left: 12px;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 215, 0, 0.5);
  color: #ffd700;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 4px;
}

.trending-info {
  padding: 20px;
}

.collection-name-row {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 16px;
}

.collection-name-row h4 {
  font-size: 16px;
  font-weight: 700;
  margin: 0;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  flex: 1;
}

.verified-badge {
  color: #667eea;
  flex-shrink: 0;
}

.stats-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-bottom: 12px;
}

.stat-item {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.stat-label {
  font-size: 11px;
  color: #666;
  text-transform: uppercase;
  font-weight: 600;
}

.stat-value {
  font-size: 14px;
  font-weight: 700;
  color: #fff;
}

.collection-change {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  font-weight: 600;
  padding: 6px 12px;
  border-radius: 8px;
  background: rgba(255, 253, 0, 0.1);
  color: #fffd00;
  width: fit-content;
}

.collection-change.positive {
  background: rgba(223, 255, 0, 0.1);
  color: #fffd00;
}

/* Filter Section */
.filter-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
  padding: 0 10px;
  gap: 20px;
  flex-wrap: wrap;
}

.tabs-container {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}

.tab-btn {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  color: #888;
  padding: 10px 20px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
  white-space: nowrap;
}

.tab-btn.active {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: #fff;
  border-color: #667eea;
  box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
}

.tab-btn:hover:not(.active) {
  border-color: rgba(255, 255, 255, 0.2);
  color: #fff;
  background: rgba(255, 255, 255, 0.05);
}

.filter-controls {
  display: flex;
  gap: 12px;
  align-items: center;
  flex-wrap: wrap;
}

.search-box {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  padding: 0 16px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  gap: 10px;
  transition: all 0.3s;
}

.search-box:focus-within {
  border-color: #667eea;
  box-shadow: 0 0 20px rgba(102, 126, 234, 0.2);
}

.search-box input {
  background: transparent;
  border: none;
  color: #fff;
  outline: none;
  font-size: 14px;
  height: 42px;
  width: 220px;
}

.search-box input::placeholder {
  color: #666;
}

.filter-btn {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  color: #fff;
  padding: 10px 20px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s;
}

.filter-btn:hover {
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(255, 255, 255, 0.15);
}

/* NFT Grid with Enhanced Cards */
.nft-grid-section {
  padding: 0 10px;
}

.nft-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 20px;
}

.nft-card {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 20px;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  opacity: 0;
  animation: fadeInUp 0.6s forwards;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.nft-card.animate-in {
  animation: fadeInUp 0.6s forwards;
}

.nft-card:hover {
  transform: translateY(-12px) scale(1.02);
  border-color: rgba(102, 126, 234, 0.3);
  box-shadow: 0 20px 50px rgba(102, 126, 234, 0.2);
}

.nft-image {
  position: relative;
  aspect-ratio: 1;
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
  overflow: hidden;
}

.nft-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.nft-card:hover .nft-image img {
  transform: scale(1.15) rotate(2deg);
}

.like-btn {
  position: absolute;
  top: 12px;
  right: 12px;
  background: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: #fff;
  padding: 8px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s;
  z-index: 5;
}

.like-btn:hover {
  background: rgba(255, 59, 72, 0.8);
  border-color: #ff3b48;
  transform: scale(1.1);
}

.nft-hover-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.9) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.4s;
  z-index: 2;
}

.nft-card:hover .nft-hover-overlay {
  opacity: 1;
}

.quick-view-btn {
  background: rgba(255, 255, 255, 0.95);
  color: #000;
  border: none;
  padding: 12px 28px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 14px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s;
  transform: translateY(20px);
}

.nft-card:hover .quick-view-btn {
  transform: translateY(0);
}

.quick-view-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 20px rgba(255,255,255,0.3);
}

.nft-info {
  padding: 20px;
}

.creator-row {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 12px;
}

.creator-avatar {
  font-size: 20px;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
}

.creator-name {
  font-size: 13px;
  color: #888;
  font-weight: 600;
}

.nft-info h4 {
  font-size: 17px;
  font-weight: 700;
  margin: 0 0 12px 0;
  color: #fff;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.nft-stats {
  display: flex;
  gap: 16px;
  margin-bottom: 16px;
  padding-bottom: 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}

.stat {
  display: flex;
  align-items: center;
  gap: 6px;
  color: #777;
  font-size: 13px;
  font-weight: 600;
}

.stat svg {
  color: #555;
}

.nft-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
}

.price-info {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.price-label {
  font-size: 11px;
  color: #666;
  text-transform: uppercase;
  font-weight: 600;
}

.price {
  font-size: 20px;
  font-weight: 800;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.buy-btn {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 13px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: all 0.3s;
  box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
}

.buy-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(102, 126, 234, 0.5);
}


/* Responsive */
@media (max-width: 1200px) {
  .nft-grid {
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  }
  
  .content-with-sidebar {
    grid-template-columns: 250px 1fr;
    gap: 24px;
  }
  
  .filter-sidebar {
    padding: 20px;
  }
}

@media (max-width: 1024px) {
  .hero-featured-image {
    height: 400px;
  }
  
  .hero-nft-title {
    font-size: 36px;
  }
  
  /* Hide sidebar, show mobile filter button */
  .content-with-sidebar {
    grid-template-columns: 1fr;
  }
  
  .filter-sidebar {
    display: none;
  }
  
  .mobile-filter-btn {
    display: flex;
  }
  
  .filter-controls-section {
    gap: 12px;
  }
  
  .tabs-container {
    order: 2;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    padding-bottom: 8px;
  }
  
  .right-controls {
    order: 3;
    width: 100%;
  }
}

@media (max-width: 768px) {
  .main-wrapper {
    padding: 16px;
  }
  
  .hero-featured-image {
    height: 350px;
  }
  
  .hero-nft-info {
    padding: 24px;
    flex-direction: column;
    align-items: flex-start;
    gap: 20px;
  }
  
  .hero-nft-title {
   font-size: 28px;
  }
  
  .timer-circle-large {
    width: 60px;
    height: 60px;
  }
  
  .timer-text {
    font-size: 18px;
  }
  
  .nft-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
  }
  
  .nft-grid-small {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
  }
  
  .trending-card {
    width: 240px;
  }
  
  .chain-filters {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    flex-wrap: nowrap;
    justify-content: flex-start;
    width: 100%;
  }
  
  .search-box {
    flex: 1;
  }
  
  .search-box input {
    width: 100%;
  }
  
  .filter-controls-section {
    flex-direction: column;
    align-items: stretch;
  }
  
  .right-controls {
    margin-left: 0;
  }
  
  .sort-select {
    flex: 1;
    min-width: auto;
  }
}

@media (max-width: 480px) {
  .hero-featured-image {
    height: 280px;
  }
  
  .hero-nft-info {
    padding: 20px;
  }
  
  .hero-nft-title {
    font-size: 24px;
  }
  
  .section-header h2 {
    font-size: 22px;
  }
  
  .nft-grid {
    grid-template-columns: 1fr;
  }
  
  .nft-grid-small {
    grid-template-columns: 1fr;
  }
  
  .trending-card {
    width: 200px;
  }
  
  .tabs-container {
    flex-wrap: nowrap;
    overflow-x: scroll;
  }
  
  .tab-btn {
    white-space: nowrap;
    flex-shrink: 0;
  }
}

/* Large Brand Text */
.large-brand-text {
  font-size: 15vw;
  font-weight: 900;
  text-align: center;
  line-height: 1;
  margin: 60px 0 20px;
  letter-spacing: -0.05em;
  user-select: none;
  cursor: pointer;
  color: #fff;
  transition: all 0.5s ease;
}

.large-brand-text span {
  color: #764ba2;
  transition: all 0.5s ease;
}

.large-brand-text:hover {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  transform: scale(1.02);
}

.large-brand-text:hover span {
  color: inherit; /* Allows the span to take the gradient from parent if possible, or we force it */
  -webkit-text-fill-color: transparent;
}

/* Trusted Section Styles */
.trusted-section {
  margin: 60px 0;
}

.trusted-title {
  font-size: 13px;
  color: #888;
  margin-bottom: 20px;
  font-weight: 500;
}

.trusted-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  border-left: 1px solid rgba(255, 255, 255, 0.1);
}

.brand-item {
  height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-right: 1px solid rgba(255, 255, 255, 0.1);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  background: rgba(255, 255, 255, 0.01);
  transition: all 0.3s;
  cursor: pointer;
  overflow: hidden;
}

.brand-item:hover {
  background: rgba(255, 255, 255, 0.05);
}

.brand-logo {
  font-size: 24px;
  font-weight: 700;
  color: #fff;
  display: flex;
  align-items: center;
  gap: 10px;
}

/* Base */
.brand-logo.base {
  font-family: 'Inter', sans-serif;
  font-weight: 800;
  letter-spacing: -1px;
}

.base-icon {
  width: 20px;
  height: 20px;
  background: #fff; /* Base blue usually, white in dark mode often */
  display: inline-block;
  border-radius: 50%; /* Or circle */
  position: relative;
}
.base-icon::after {
  content: '';
  position: absolute;
  top: 5px;
  left: 8px; /* rough approximation */
  width: 8px;
  height: 10px;
  background: #000; 
  /* This is just a placeholder shape */
  display: none;
}
/* Just make it a blue circle or white square */
.base-icon {
  border-radius: 0;
  width: 14px;
  height: 14px;
}

/* Barbie */
.brand-logo.barbie {
  font-family: 'Brush Script MT', cursive;
  font-style: italic;
  font-size: 32px;
  letter-spacing: 1px;
}

/* PSG */
.psg-circle {
  width: 48px;
  height: 48px;
  border: 2px solid #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 1px;
}

/* Ubisoft */
.swirl {
  font-size: 28px;
  line-height: 1;
}

/* Fox */
.brand-logo.fox {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  line-height: 0.9;
  font-family: 'Arial Black', sans-serif;
}
.deportes {
  font-size: 10px;
  letter-spacing: 2px;
}

/* Rekt */
.brand-logo.rekt {
  font-family: 'Courier New', monospace; /* Fallback for a sketchy font */
  font-style: italic;
  font-weight: 400;
  letter-spacing: -2px;
  font-size: 28px;
  /* Ideally import a brush font */
}

/* UFC */
.brand-logo.ufc {
  font-family: 'Impact', sans-serif;
  letter-spacing: 2px;
  font-size: 32px;
  font-style: italic;
  color: #fff;
}

/* Universal */
.brand-logo.universal {
  font-size: 16px;
  font-weight: 800;
  letter-spacing: 1px;
}
.globe {
  font-size: 24px;
}

/* Hot Wheels */
.brand-logo.hotwheels {
  font-family: 'Impact', sans-serif;
  font-style: italic;
  text-transform: uppercase;
  color: #fff;
  border-bottom: 3px solid #fff;
  line-height: 0.8;
  padding-bottom: 2px;
}

/* Ledger */
.brand-logo.ledger {
  font-family: monospace;
  letter-spacing: 4px;
  font-weight: 400;
  font-size: 18px;
}

@media (max-width: 1024px) {
  .trusted-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 600px) {
  .trusted-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* Trending List Section */
.trending-list-section {
  margin: 40px 0;
  padding: 0 10px;
}

/* Cards Section Styles */
.cards-section {
  margin: 40px 0;
  padding: 0 10px;
}

.cards-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.cards-header h3 {
  font-size: 24px;
  font-weight: 700;
  margin: 0;
}

.view-all-cards {
  color: #888;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: color 0.2s;
}

.view-all-cards:hover {
  color: #fff;
}

.cards-carousel {
  overflow-x: auto;
  padding-bottom: 20px;
  -ms-overflow-style: none;
  scrollbar-width: none;
  scroll-snap-type: x mandatory;
}

.cards-carousel::-webkit-scrollbar {
  display: none;
}

.cards-track {
  display: flex;
  gap: 20px;
}

.trading-card-item {
  flex-shrink: 0;
  width: 180px;
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  cursor: pointer;
  transition: transform 0.3s;
  scroll-snap-align: start;
}

.trading-card-item:hover {
  transform: translateY(-8px);
}

.card-image-container {
  height: 180px;
  background: #f5f5f5;
  padding: 12px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
}

.card-image-container img {
  max-width: 100%;
  max-height: 140px;
  object-fit: contain;
  filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
  z-index: 2;
  transition: transform 0.3s;
}

.trading-card-item:hover .card-image-container img {
  transform: scale(1.05);
}

.card-stand {
  position: absolute;
  bottom: 20px;
  width: 120px;
  height: 12px;
  background: #e0e0e0;
  border-radius: 50%;
  filter: blur(4px);
  z-index: 1;
}

.card-details {
  padding: 16px;
  background: #fff;
  color: #000;
}

.card-title {
  font-size: 13px;
  font-weight: 500;
  margin: 0 0 8px 0;
  line-height: 1.4;
  height: 36px; /* 2 lines */
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  color: #333;
}

.card-price {
  font-size: 16px;
  font-weight: 700;
  color: #000;
}


.trending-list-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  flex-wrap: wrap;
  gap: 16px;
}

.trending-list-header h3 {
  font-size: 24px;
  font-weight: 700;
  margin: 0;
}

.trending-header-controls {
  display: flex;
  align-items: center;
  gap: 20px;
}

.list-collection-btn {
  background: transparent;
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: #fffd00;
  padding: 8px 16px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 13px;
  cursor: pointer;
  transition: all 0.3s;
}

.list-collection-btn:hover {
  border-color: #feda03;
  background: rgba(254, 218, 3, 0.1);
}

.time-filters {
  display: flex;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 20px;
  padding: 4px;
}

.time-btn {
  background: transparent;
  border: none;
  color: #888;
  padding: 6px 12px;
  border-radius: 16px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
}

.time-btn:hover {
  color: #fff;
}

.time-btn.active {
  background: rgba(255, 255, 255, 0.1);
  color: #fff;
}

.trending-table-container {
  overflow-x: auto;
}

.trending-table {
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  border-collapse: collapse;
}

.trending-table th {
  text-align: left;
  color: #666;
  font-size: 11px;
  text-transform: uppercase;
  font-weight: 600;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.trending-table td {
  padding: 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  font-size: 14px;
  color: #fff;
  font-weight: 600;
}

.trending-table tr:hover td {
  background: rgba(255, 255, 255, 0.02);
}

.col-collection {
  text-align: left;
}

.col-right {
  text-align: right;
}

.collection-cell {
  display: flex;
  align-items: center;
  gap: 12px;
}

.rank {
  color: #666;
  width: 20px;
  text-align: center;
}

.collection-img-wrapper {
  position: relative;
  width: 40px;
  height: 40px;
}

.collection-img-wrapper img {
  width: 100%;
  height: 100%;
  border-radius: 8px;
  object-fit: cover;
}

.verified-tick {
  position: absolute;
  bottom: -4px;
  right: -4px;
  background: #000;
  color: #fffd00;
  width: 14px;
  height: 14px;
  border-radius: 50%;
  font-size: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #000;
}

.collection-name {
  font-weight: 700;
}

.collection-verified-star {
  display: flex;
  align-items: center;
}

.text-red {
  color: #FF00D6 !important; /* Desci Pink */
}

.text-green {
  color: #fffd00 !important; /* Desci Yellow */
}

.sparkline {
  display: flex;
  justify-content: flex-end;
}

@media (max-width: 768px) {
  .mobile-hide {
    display: none;
  }
  
  .trending-header-controls {
    width: 100%;
    justify-content: space-between;
  }

  .trending-table th, 
  .trending-table td {
    padding: 12px 8px;
    font-size: 12px;
  }

  .collection-cell {
    gap: 8px;
  }

  .collection-img-wrapper {
    width: 32px;
    height: 32px;
  }

  .rank {
    width: 15px;
    font-size: 11px;
  }

  .collection-name {
    font-size: 13px;
    max-width: 80px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}

@media (max-width: 480px) {
  .trending-table th, 
  .trending-table td {
    padding: 10px 4px;
    font-size: 11px;
  }
}


.news-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.news-header h3 {
  font-size: 24px;
  font-weight: 700;
  margin: 0;
}

.view-all-news {
  color: #888;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: color 0.2s;
}

.view-all-news:hover {
  color: #fff;
}

.news-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
}

.news-featured-card {
  position: relative;
  background: #ff4081; /* Fallback pink */
  border-radius: 20px;
  overflow: hidden;
  height: 400px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border: 1px solid rgba(255, 255, 255, 0.1);
  cursor: pointer;
  transition: transform 0.3s;
}

.news-featured-card:hover {
  transform: translateY(-4px);
}

/* News with large featured image */
.featured-bg-image {
  position: absolute;
  top: 0;
  right: 0;
  width: 70%;
  height: 100%;
  object-fit: cover;
  mask-image: linear-gradient(to right, transparent, black 10%);
  -webkit-mask-image: linear-gradient(to right, transparent, black 40%);
}

.featured-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, #ff1ebf 0%, #ff9100 100%); /* Vivid gradient similar to screenshot */
  opacity: 0.9;
  z-index: 1;
  mix-blend-mode: multiply;
}

.featured-content {
  position: relative;
  z-index: 2;
  padding: 40px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 70%;
}

.starting-with {
  color: #fff200; /* Yellow */
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 10px;
}

.brand-title {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 48px;
  font-weight: 800;
  color: #fff;
  line-height: 1;
}

.featured-news-footer {
  position: relative;
  z-index: 2;
  padding: 24px 40px;
  background: rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(10px);
}

.news-tag {
  color: #fff200;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 8px;
  display: block;
}

.featured-news-footer h4 {
  font-size: 18px;
  font-weight: 700;
  margin: 0;
  color: #fff;
}

/* News List Styles */
.news-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.news-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 16px;
  text-decoration: none;
  transition: all 0.2s;
  height: 70px;
}

.news-item:hover {
  background: rgba(255, 255, 255, 0.06);
  transform: translateX(4px);
}

.news-item-content {
  display: flex;
  flex-direction: column;
  gap: 4px;
  margin-right: 16px;
}

.news-category {
  color: #fff200;
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
}

.news-title {
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  margin: 0;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.news-item-image {
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  border-radius: 8px;
  overflow: hidden;
  background: #333;
}

.news-item-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

@media (max-width: 900px) {
  .news-grid {
    grid-template-columns: 1fr;
  }
  
  .news-featured-card {
    height: 300px;
  }

  .brand-title {
    font-size: 32px;
  }
}

/* Footer Styles */
.market-footer {
  margin-top: 60px;
  margin-bottom: 20px;
  background: #0f0f0f;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 16px 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
}

.footer-left {
  display: flex;
  align-items: center;
  gap: 24px;
  font-size: 13px;
  font-weight: 600;
  color: #666;
}

.copyright {
  color: #888;
}

.footer-link {
  color: #666;
  text-decoration: none;
  transition: color 0.2s;
}

.footer-link:hover {
  color: #fff;
}

.footer-right {
  display: flex;
  align-items: center;
  gap: 24px;
}

.currency-btn {
  background: rgba(255, 255, 255, 0.05);
  border: none;
  color: #fff;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: background 0.2s;
}

.currency-btn:hover {
  background: rgba(255, 255, 255, 0.1);
}

.footer-label {
  font-size: 13px;
  color: #666;
  font-weight: 600;
}

.crypto-stat {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 700;
  color: #fff;
}

.coin-icon {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 800;
  color: #000;
}

.coin-icon.yellow {
  background: #feda03;
}

.coin-icon.blue {
  background: #627eea;
  color: #fff;
}

.community-btn {
  background: transparent;
  border: 1px solid rgba(255, 255, 255, 0.15);
  color: #fff;
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 13px;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  transition: all 0.2s;
}

.community-btn:hover {
  background: rgba(255, 255, 255, 0.1);
  border-color: #fff;
}

@media (max-width: 768px) {
  .main-wrapper {
    padding: 16px;
  }
  
  .hero-banner-section {
    height: 420px;
  }

  .hero-info-left h1 {
    font-size: 32px;
    margin-bottom: 8px;
  }

  .hero-info-left {
    bottom: 60px;
    left: 20px;
    right: 20px;
    max-width: none;
    padding-right: 0;
  }
  
  .hero-thumbnails-container {
    left: 50%;
    right: auto;
    bottom: 25px;
    transform: translateX(-50%);
    gap: 8px;
    z-index: 10;
  }

  .hero-thumbnail {
    width: 32px;
    height: 4px;
    border-radius: 2px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    padding: 0;
    transition: all 0.3s ease;
  }

  .hero-thumbnail img {
    display: none;
  }

  .hero-thumbnail.active {
    width: 48px;
    height: 4px;
    background: #fff;
    transform: none;
    box-shadow: none;
  }

  .hero-description {
    font-size: 13px;
    margin-bottom: 20px;
    -webkit-line-clamp: 3;
    line-clamp: 3;
  }

  /* Horizontal scrolling for cards and highlights */
  .highlight-carousel, .cards-carousel, .trending-carousel {
    overflow-x: auto !important;
    scrollbar-width: none;
    margin: 0 -16px;
    padding: 0 16px 20px;
  }

  .highlight-carousel::-webkit-scrollbar, 
  .cards-carousel::-webkit-scrollbar, 
  .trending-carousel::-webkit-scrollbar {
    display: none;
  }

  .highlight-track, .cards-track, .trending-track {
    flex-wrap: nowrap;
    gap: 12px;
    justify-content: flex-start;
  }

  .highlight-card {
    width: 260px !important;
    height: 160px !important;
  }

  .trading-card-item {
    width: 160px !important;
  }
  
  .card-image-container {
    height: 160px !important;
  }
  
  .card-image-container img {
    max-height: 120px !important;
  }

  .trending-card {
    width: 240px !important;
  }

  .trending-header-controls {
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
    width: 100%;
  }

  .time-filters {
    overflow-x: auto;
    width: 100%;
    padding-bottom: 4px;
  }

  .trending-table-container {
    overflow-x: auto;
    margin: 0 -16px;
    padding: 0 16px;
  }

  .trending-table th:nth-child(n+5),
  .trending-table td:nth-child(n+5) {
    display: none;
  }

  .nft-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
  }

  .footer-right, .footer-left {
    justify-content: center;
    text-align: center;
  }
}
/* Highlight Section Styles */
.highlight-section {
  display: block;
  margin-top: 40px;
  overflow: hidden;
  padding: 0 10px;
}

.highlight-carousel {
  overflow-x: auto;
  padding-bottom: 20px;
  -ms-overflow-style: none;
  scrollbar-width: none;
  scroll-snap-type: x mandatory;
}

.highlight-carousel::-webkit-scrollbar {
  display: none;
}

.highlight-track {
  display: flex;
  gap: 16px;
}

.highlight-card {
  position: relative;
  flex-shrink: 0;
  width: 240px;
  height: 150px;
  border-radius: 12px;
  overflow: hidden;
  cursor: pointer;
  transition: transform 0.3s;
  background: #111;
  scroll-snap-align: start;
}

.highlight-card:hover {
  transform: translateY(-4px);
}

.highlight-bg {
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0.8;
  transition: transform 0.3s, opacity 0.3s;
}

.highlight-card:hover .highlight-bg {
  transform: scale(1.05);
  opacity: 1;
}

.highlight-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.9), transparent 80%);
  z-index: 1;
}

.highlight-content {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 16px;
  z-index: 2;
  color: #fff;
}

.highlight-title {
  font-size: 14px;
  font-weight: 700;
  margin: 0 0 6px 0;
  text-shadow: 0 2px 4px rgba(0,0,0,0.5);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.highlight-stats {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 12px;
  font-weight: 600;
}

.highlight-floor {
  color: #fff;
}

.highlight-change {
  display: flex;
  align-items: center;
}
</style>
