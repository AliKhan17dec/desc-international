import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Market from '../views/Market.vue'
import Launchpad from '../views/Launchpad.vue'
import CoinDetails from '../views/CoinDetails.vue'
import ComingSoon from '../views/ComingSoon.vue'
import UserDashboard from '../views/UserDashboard.vue'
import CollectionDetails from '../views/CollectionDetails.vue'


const routes = [
  { path: '/', name: 'Home', component: () => import('../views/HomeView.vue') },
  { path: '/login', name: 'LoginForm', component: Login },
  { path: '/forgot-password', name: 'ForgotPassword', component: () => import('../views/ComingSoon.vue') },
  { path: '/reset-password/:token', name: 'ResetPassword', component: () => import('../views/ComingSoon.vue') },
  { path: '/verify-email', name: 'VerifyEmail', component: () => import('../views/ComingSoon.vue') },
  { path: '/confirm-password', name: 'ConfirmPassword', component: () => import('../views/ComingSoon.vue') },
  { path: '/market', name: 'Market', component: Market },
  { path: '/asset/:id', name: 'CoinDetails', component: CoinDetails },
  { path: '/launchpad', name: 'Launchpad', component: Launchpad },
  { path: '/project/:id', name: 'ProjectDetails', component: () => import('../views/ProjectDetails.vue') },
  { path: '/token-swap', name: 'TokenSwap', component: () => import('../views/TokenSwap.vue') },
  { path: '/nft', name: 'NftMarket', component: () => import('../views/NftMarket.vue') },
  { path: '/nft/:id', name: 'NFTDetails', component: () => import('../views/NFTDetails.vue') },
  { path: '/bridge', name: 'Bridge', component: () => import('../views/Bridge.vue') },
  { path: '/arbitrage-bot', name: 'ArbitrageBot', component: () => import('../views/ArbitrageBot.vue') },
  { path: '/arbitrage-bot-chart', name: 'ArbitrageBotChart', component: () => import('../views/ArbitrageBotChart.vue') },
  { path: '/spot-grid-bots', name: 'SpotGridBots', component: () => import('../views/SpotGridBots.vue') },
  { path: '/copy-trading', name: 'CopyTrading', component: () => import('../views/CopyTrading.vue') },
  { path: '/copy-trading/:id', name: 'CopyTradingDetail', component: () => import('../views/CopyTradingDetail.vue') },
  { path: '/trader/:id', name: 'TraderDetails', component: () => import('../views/TraderDetails.vue') },
  { path: '/referral', name: 'ReferralProgram', component: () => import('../views/ReferralProgram.vue') },
  { path: '/leaderboard', name: 'Leaderboard', component: () => import('../views/Leaderboard.vue') },
  { path: '/contest', name: 'Contest', component: () => import('../views/Contest.vue') },
  { path: '/ecosystem', name: 'Ecosystem', component: () => import('../views/Ecosystem.vue') },
  { path: '/proof-of-reserves', name: 'ProofOfReserves', component: () => import('../views/ProofOfReserves.vue') },
  { path: '/governance', name: 'Governance', component: ComingSoon },
  { path: '/announcements', name: 'AnnouncementCenter', component: () => import('../views/AnnouncementCenter.vue') },
  { path: '/announcement/:id', name: 'AnnouncementDetail', component: () => import('../views/AnnouncementDetail.vue') },
  { path: '/dashboard', name: 'UserDashboard', component: UserDashboard, meta: { requiresAuth: true } },
  { path: '/portfolio', name: 'Portfolio', component: () => import('../views/UserAsset.vue'), meta: { requiresAuth: true } },
  { path: '/asset-history', name: 'AssetHistory', component: () => import('../views/UserAsset.vue'), props: { tab: 'history' }, meta: { requiresAuth: true } },
  { path: '/convert-history', name: 'ConvertHistory', component: () => import('../views/UserAsset.vue'), props: { tab: 'convert' }, meta: { requiresAuth: true } },
  { path: '/transaction-history', name: 'TransactionHistory', component: () => import('../views/UserAsset.vue'), props: { tab: 'transactions' }, meta: { requiresAuth: true } },
  { path: '/order-history', name: 'OrderHistory', component: () => import('../views/UserAsset.vue'), props: { tab: 'orders' }, meta: { requiresAuth: true } },
  { path: '/deposit', name: 'Deposit', component: () => import('../views/UserAsset.vue'), props: { tab: 'assets' }, meta: { requiresAuth: true } },
  { path: '/dashboard/withdrawls', name: 'Withdraw', component: () => import('../views/Withdraw.vue'), meta: { requiresAuth: true } },
  { path: '/identification', name: 'Identification', component: () => import('../views/Identification.vue'), meta: { requiresAuth: true } },
  { path: '/spot-copy-settings', name: 'SpotCopySettings', component: () => import('../views/SpotCopySettings.vue'), meta: { requiresAuth: true } },
  { path: '/copy-trading-settings', name: 'CopyTradingSettings', component: () => import('../views/CopySettings.vue'), meta: { requiresAuth: true } },
  { path: '/my-copy-portfolio', name: 'MyCopyPortfolio', component: () => import('../views/MyCopyPortfolio.vue'), meta: { requiresAuth: true } },
  { path: '/portfolios', name: 'UserPortfolios', component: () => import('../views/UserPortfolios.vue'), meta: { requiresAuth: true } },
  { path: '/trading-bots', name: 'TradingBots', component: () => import('../views/TradingBots.vue') },
  { path: '/spot-grid-create', name: 'SpotGridCreate', component: () => import('../views/SpotGridCreate.vue'), meta: { requiresAuth: true } },
  { path: '/collection-details', name: 'CollectionDetails', component: CollectionDetails },
  { path: '/mlm', name: 'MLMProgram', component: () => import('../views/MLMProgram.vue') },
  { path: '/funding-rate-history', name: 'FundingRateHistory', component: () => import('../views/FundingRateHistory.vue') },
  { path: '/coming-soon', name: 'ComingSoon', component: () => import('../views/ComingSoon.vue') },
  // Compatibility redirects
  { path: '/auth', redirect: (to) => ({ path: '/login', query: to.query }) },
  { path: '/register', redirect: '/login?mode=signup' },
  { path: '/home', redirect: '/' },
  // Catch-all route for Coming Soon
  { path: '/:pathMatch(.*)*', name: 'NotFound', component: () => import('../views/ComingSoon.vue') },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { top: 0 }
    }
  }
})

router.beforeEach((to, from, next) => {
  const user = localStorage.getItem('user')

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!user) {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else {
    next()
  }
})

export default router
