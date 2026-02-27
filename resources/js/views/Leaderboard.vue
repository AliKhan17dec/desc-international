<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { 
  Trophy, 
  TrendingUp, 
  Users, 
  Activity,
  ChevronRight,
  Search,
  ArrowUpRight,
  Flame,
  Award
} from 'lucide-vue-next';
import TopHeader from '../components/TopHeader.vue';

const router = useRouter();

const stats = [
  { label: 'Total Volume', value: '$1.2B', icon: Activity },
  { label: 'Active Institutions', value: '420', icon: Users },
  { label: 'Research Nodes', value: '1,337', icon: TrendingUp },
];

const topPlayers = [
  { rank: 1, name: 'VitaDAO', score: '98,242', change: '+12.4%', avatar: 'V' },
  { rank: 2, name: 'AthenaDAO', score: '85,120', change: '+4.5%', avatar: 'A' },
  { rank: 3, name: 'HairDAO', score: '72,400', change: '-2.1%', avatar: 'H' },
  { rank: 4, name: 'ValleyDAO', score: '64,800', change: '+1.2%', avatar: 'V' },
  { rank: 5, name: 'CryoDAO', score: '58,200', change: '+8.9%', avatar: 'C' },
];

const activeTab = ref('Institutional');
const tabs = ['Institutional', 'Individual', 'Nodes'];

const navigate = (path) => {
  if (path) router.push(path);
};
</script>

<template>
  <div class="leaderboard-page">
    <TopHeader />

    <main class="main-wrapper">
      <!-- Hero Section -->
      <section class="hero-section">
          <div class="hero-content">
              <div class="hero-icon"><Trophy size="48" class="gold-icon" /></div>
              <h1>Protocol Leaderboard</h1>
              <p>Top performing research nodes and institutional investors in the DeSci ecosystem.</p>
          </div>
      </section>

      <!-- Stats Grid -->
      <section class="stats-grid">
          <div v-for="s in stats" :key="s.label" class="stat-card">
              <div class="stat-icon-box"><component :is="s.icon" size="20" class="gold-icon" /></div>
              <div class="stat-info">
                  <span class="stat-val">{{ s.value }}</span>
                  <span class="stat-lbl">{{ s.label }}</span>
              </div>
          </div>
      </section>

      <!-- Tabs & Search -->
      <section class="board-header">
          <div class="tabs">
              <button v-for="t in tabs" :key="t" 
                      :class="{ active: activeTab === t }"
                      @click="activeTab = t">{{ t }}</button>
          </div>
          <div class="search-wrap">
              <Search size="16" />
              <input placeholder="Search node IDs..." />
          </div>
      </section>

      <!-- Table -->
      <div class="table-container">
          <table class="leaderboard-table">
              <thead>
                  <tr>
                      <th width="80">Rank</th>
                      <th>Researcher / Entity</th>
                      <th class="text-right">OSIS Score</th>
                      <th class="text-right hide-mobile">Activity (30D)</th>
                      <th width="100"></th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="p in topPlayers" :key="p.rank" @click="navigate('/trader-details')">
                      <td class="rank-cell">
                          <span v-if="p.rank <= 3" class="trophy-badge" :class="'rank-' + p.rank">
                              {{ p.rank }}
                          </span>
                          <span v-else>{{ p.rank }}</span>
                      </td>
                      <td>
                          <div class="user-cell">
                              <div class="avatar">{{ p.avatar }}</div>
                              <span class="name">{{ p.name }}</span>
                          </div>
                      </td>
                      <td class="text-right fw-bold">{{ p.score }}</td>
                      <td class="text-right hide-mobile" :class="{ up: !p.change.includes('-'), down: p.change.includes('-') }">
                          {{ p.change }}
                      </td>
                      <td class="text-right">
                          <button class="view-btn"><ChevronRight size="16" /></button>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
    </main>

    <footer class="footer">
        <div class="footer-inner">
            <div class="brand">
                <Award size="20" class="gold-icon" />
                <span>DeSci Leaderboard</span>
            </div>
            <p>© 2026 Institutional Ranking System</p>
        </div>
    </footer>
  </div>
</template>

<style scoped>
.leaderboard-page {
  background: #000;
  min-height: 100vh;
  color: #fff;
  font-family: 'Inter', sans-serif;
}

.main-wrapper {
  max-width: 1000px;
  margin: 0 auto;
  padding: 40px 20px;
}

.gold-icon { color: #dfff00; }
.up { color: #dfff00; }
.down { color: #FF00D6; }
.text-right { text-align: right; }
.fw-bold { font-weight: 700; }

/* Hero */
.hero-section { text-align: center; margin-bottom: 60px; }
.hero-icon { margin-bottom: 20px; }
.hero-section h1 { font-size: 36px; font-weight: 800; margin-bottom: 12px; }
.hero-section p { font-size: 16px; color: #666; max-width: 500px; margin: 0 auto; }

/* Stats Grid */
.stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px; }
.stat-card { background: #111; border: 1px solid #222; border-radius: 16px; padding: 20px; display: flex; align-items: center; gap: 16px; }
.stat-icon-box { width: 44px; height: 44px; background: #0a0a0a; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
.stat-val { font-size: 20px; font-weight: 800; display: block; }
.stat-lbl { font-size: 12px; color: #444; }

/* Header */
.board-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.tabs { display: flex; gap: 8px; background: #111; padding: 6px; border-radius: 12px; border: 1px solid #222; }
.tabs button { background: transparent; border: none; color: #666; font-size: 13px; font-weight: 700; padding: 8px 16px; border-radius: 8px; cursor: pointer; }
.tabs button.active { background: #222; color: #fff; }

.search-wrap { background: #111; border: 1px solid #222; border-radius: 8px; padding: 0 12px; display: flex; align-items: center; gap: 8px; }
.search-wrap input { background: transparent; border: none; color: #fff; height: 36px; outline: none; font-size: 13px; width: 180px; }

/* Table */
.table-container { background: #111; border: 1px solid #222; border-radius: 16px; overflow: hidden; }
.leaderboard-table { width: 100%; border-collapse: collapse; }
.leaderboard-table th { text-align: left; padding: 16px 20px; background: #1a1a1a; font-size: 11px; color: #444; text-transform: uppercase; letter-spacing: 1px; }
.leaderboard-table td { padding: 16px 20px; border-bottom: 1px solid #222; font-size: 14px; }
.leaderboard-table tr { cursor: pointer; }
.leaderboard-table tr:hover { background: #161616; }

.rank-cell { font-weight: 800; color: #333; }
.trophy-badge { width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 12px; color: #000; }
.rank-1 { background: #dfff00; }
.rank-2 { background: #c0c0c0; }
.rank-3 { background: #cd7f32; }

.user-cell { display: flex; align-items: center; gap: 12px; }
.avatar { width: 32px; height: 32px; background: #0a0a0a; border-radius: 80px; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #666; font-size: 12px; }
.name { font-weight: 700; }

.view-btn { background: transparent; border: none; color: #444; cursor: pointer; }

/* Footer */
.footer { padding: 40px 20px; border-top: 1px solid #111; margin-top: 60px; }
.footer-inner { max-width: 1000px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #444; font-weight: 600; }
.brand { display: flex; align-items: center; gap: 10px; }

@media (max-width: 768px) {
    .stats-grid { grid-template-columns: 1fr; }
    .board-header { flex-direction: column; gap: 20px; align-items: stretch; }
    .search-wrap { width: 100%; }
    .search-wrap input { width: 100%; }
    .hide-mobile { display: none; }
}
</style>
