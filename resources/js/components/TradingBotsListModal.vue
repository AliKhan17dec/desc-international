<script setup>
import { useRouter } from 'vue-router';
import { X, Grid3x3, ArrowLeftRight } from 'lucide-vue-next';

const router = useRouter();
const emit = defineEmits(['close', 'select-bot']);

const botTypes = [
    {
        id: 'spot-grid',
        name: 'Spot Grid',
        icon: 'grid',
        description: 'Buy low and sell high. 24/7 availability',
        available: true
    },
    {
        id: 'arbitrage-bot',
        name: 'Arbitrage Bot',
        icon: 'arbitrage',
        description: 'Delta neutral strategy to earn Funding Fee effortlessly',
        available: true,
        stats: {
            label: 'XYZ3',
            pnl: 'PNL (USD)'
        }
    }
];

const selectBot = (bot) => {
    emit('select-bot', bot);
    if (bot.id === 'arbitrage-bot') {
        router.push('/arbitrage-bot');
    } else if (bot.id === 'spot-grid') {
        router.push('/spot-grid-bots');
    }
    emit('close');
};

const closeModal = () => {
    emit('close');
};
</script>

<template>
    <div class="modal-overlay" @click.self="closeModal">
        <div class="bots-list-modal">
            <!-- Header -->
            <div class="modal-header">
                <h3>Trading Bots List</h3>
                <X size="20" class="close-btn" @click="closeModal" />
            </div>

            <!-- Bots List -->
            <div class="bots-content">
                <div 
                    v-for="bot in botTypes" 
                    :key="bot.id"
                    class="bot-item"
                    :class="{ disabled: !bot.available }"
                    @click="bot.available && selectBot(bot)"
                >
                    <!-- Left: Icon -->
                    <div class="bot-icon">
                        <Grid3x3 v-if="bot.icon === 'grid'" size="24" />
                        <ArrowLeftRight v-if="bot.icon === 'arbitrage'" size="24" />
                    </div>

                    <!-- Center: Info -->
                    <div class="bot-info">
                        <div class="bot-name">{{ bot.name }}</div>
                        <div class="bot-description">{{ bot.description }}</div>
                    </div>

                    <!-- Right: Additional Stats (for Arbitrage Bot) -->
                    <div v-if="bot.stats" class="bot-stats">
                        <div class="stat-label">{{ bot.stats.label }}</div>
                        <div class="stat-pnl">{{ bot.stats.pnl }}</div>
                        <!-- Mini chart placeholder -->
                        <div class="mini-chart">
                            <svg width="60" height="30" viewBox="0 0 60 30">
                                <path 
                                    d="M 0 25 Q 10 20, 20 22 T 40 15 L 60 10" 
                                    stroke="#DFFF00" 
                                    stroke-width="2" 
                                    fill="none"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    backdrop-filter: blur(6px);
}

.bots-list-modal {
    background: #1a1a1a;
    width: 90%;
    max-width: 480px;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #2a2a2a;
}

/* Header */
.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid #2a2a2a;
    background: #111;
}

.modal-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: white;
}

.close-btn {
    color: #888;
    cursor: pointer;
    transition: color 0.2s;
}

.close-btn:hover {
    color: white;
}

/* Bots Content */
.bots-content {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.bot-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #0a0a0a;
    border: 1px solid #2a2a2a;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s;
}

.bot-item:hover {
    background: #1a1a1a;
    border-color: var(--primary);
    box-shadow: 0 0 20px rgba(223, 255, 0, 0.1);
}

.bot-item.disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.bot-item.disabled:hover {
    background: #0a0a0a;
    border-color: #2a2a2a;
    box-shadow: none;
}

/* Bot Icon */
.bot-icon {
    width: 48px;
    height: 48px;
    background: rgba(223, 255, 0, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    flex-shrink: 0;
}

/* Bot Info */
.bot-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.bot-name {
    font-size: 16px;
    font-weight: 600;
    color: white;
}

.bot-description {
    font-size: 13px;
    color: #888;
    line-height: 1.4;
}

/* Bot Stats */
.bot-stats {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 4px;
    flex-shrink: 0;
}

.stat-label {
    font-size: 11px;
    color: #666;
    font-weight: 500;
}

.stat-pnl {
    font-size: 11px;
    color: #888;
}

.mini-chart {
    margin-top: 4px;
}

/* Responsive */
@media (max-width: 480px) {
    .bots-list-modal {
        width: 95%;
    }

    .bot-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .bot-stats {
        width: 100%;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
}
</style>
