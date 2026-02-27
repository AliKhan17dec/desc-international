<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { X, Trophy, ShieldCheck, Link as LinkIcon, Chrome, Apple, Send } from 'lucide-vue-next'

const router = useRouter()
const route = useRoute()
const identifier = ref('')
const name = ref('')
const password = ref('')
const password_confirmation = ref('')
const termsAccepted = ref(false)
const isSignup = ref(true) // Toggle between Login/Signup
const isLoading = ref(false)
const errorMessage = ref('')
const errors = ref({})

onMounted(() => {
    if (route.query.mode === 'login') {
        isSignup.value = false
    } else if (route.query.mode === 'signup') {
        isSignup.value = true
    }
})

const handleAuth = async () => {
    isLoading.value = true
    errorMessage.value = ''
    errors.value = {}

    try {
        await window.axios.get('/csrf-cookie');
        if (isSignup.value) {
            const response = await window.axios.post('register', {
                name: name.value,
                email: identifier.value,
                password: password.value,
                password_confirmation: password_confirmation.value,
            })
            if (response.data.user) {
                localStorage.setItem('user', JSON.stringify(response.data.user))
                window.dispatchEvent(new Event('user-logged-in'))
            } else {
                try {
                    const userRes = await window.axios.get('/auth/user');
                    if (userRes.data) {
                        localStorage.setItem('user', JSON.stringify(userRes.data));
                        window.dispatchEvent(new Event('user-logged-in'));
                    }
                } catch (e) {
                    // ignore if not auth
                }
            }
            router.push('/dashboard')
        } else {
            const response = await window.axios.post('login', {
                email: identifier.value,
                password: password.value,
            })
            if (response.status === 200 || response.status === 204) {
                if (response.data.user) {
                    localStorage.setItem('user', JSON.stringify(response.data.user))
                    window.dispatchEvent(new Event('user-logged-in'))
                } else {
                    // Fallback: fetch user if already authenticated
                    try {
                        const userRes = await window.axios.get('/auth/user');
                        if (userRes.data) {
                            localStorage.setItem('user', JSON.stringify(userRes.data));
                            window.dispatchEvent(new Event('user-logged-in'));
                        }
                    } catch (e) {
                        console.error('Failed to fetch user:', e);
                    }
                }
                router.push('/dashboard')
            }
        }
    } catch (error) {
        console.error('Auth error:', error)
        if (error.response && error.response.data) {
            errorMessage.value = error.response.data.message || 'Something went wrong.'
            if (error.response.data.errors) {
                errors.value = error.response.data.errors
            }
        } else {
            errorMessage.value = 'Network error or server is down.'
        }
    } finally {
        isLoading.value = false
    }
}

const toggleAuthMode = () => {
    isSignup.value = !isSignup.value
    termsAccepted.value = false
    errorMessage.value = ''
    errors.value = {}
}

const title = computed(() => (isSignup.value ? 'Welcome to Desci International' : 'Log In'))
const promoTitle = computed(() =>
    isSignup.value ? 'Join me on DeSci International' : 'Unlock the Future of Science',
)
</script>

<template>
    <div class="auth-wrapper">
        <!-- Left Section: Promo -->
        <div class="left-section">
            <div class="header-logo mobile-only">
                <img src="/logo.png" alt="Logo" class="mini-logo" />
                <span class="brand-text">Desci International</span>
            </div>

            <div class="promo-content">
                <h1 class="promo-title">{{ promoTitle }}</h1>

                <div class="promo-graphic">
                    <div class="orbital-container">
                        <div class="orbital-path outer">
                            <div class="orbiting-arrow arrow-1"></div>
                        </div>
                        <div class="orbital-path inner">
                            <div class="orbiting-arrow arrow-2"></div>
                        </div>
                        <div class="logo-center">
                            <img src="/logo.png" alt="Desci Logo" class="main-logo-img" />
                        </div>
                    </div>
                </div>

                <div class="stats-list">
                    <div class="stat-item">
                        <div class="stat-icon"><Trophy size="20" /></div>
                        <div class="stat-info">
                            <span class="stat-text"
                                >307,352,725 Users Trust Desci International</span
                            >
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><ShieldCheck size="20" /></div>
                        <div class="stat-info">
                            <span class="stat-text">No.1 In Trading Volume & Customer Asset</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><LinkIcon size="20" /></div>
                        <div class="stat-info">
                            <span class="stat-text highlight">1,000,000,000 USDC Safety Fund</span>
                            <div class="wallet-addr">
                                <span>Safety Wallet:</span>
                                <a href="#" class="addr-link"
                                    >0x420ef1f25563593aF5FE3f9b9d3bC56a8bd8c104</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section: Form -->
        <div class="right-section">
            <div class="auth-card">
                <button class="close-btn" @click="router.push('/')">
                    <X size="20" />
                </button>

                <div class="card-header">
                    <img src="/logo.png" alt="Desci Logo" class="card-logo" />
                    <span class="card-brand">DESCI INTERNATIONAL</span>
                </div>

                <h2 class="welcome-text">{{ title }}</h2>

                <div class="form-body">
                    <div v-if="errorMessage" class="error-banner">
                        {{ errorMessage }}
                    </div>

                    <div v-if="isSignup" class="input-group">
                        <label>Name</label>
                        <div class="input-wrapper">
                            <input
                                type="text"
                                v-model="name"
                                placeholder="Full Name"
                                :class="{ 'input-error': errors.name }"
                            />
                        </div>
                        <span v-if="errors.name" class="field-error">{{ errors.name[0] }}</span>
                    </div>

                    <div class="input-group">
                        <label>Email Address</label>
                        <div class="input-wrapper">
                            <input
                                type="email"
                                v-model="identifier"
                                placeholder="Enter your email"
                                :class="{ 'input-error': errors.email }"
                            />
                        </div>
                        <span v-if="errors.email" class="field-error">{{ errors.email[0] }}</span>
                    </div>

                    <div class="input-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <input
                                type="password"
                                v-model="password"
                                placeholder="Enter password"
                                :class="{ 'input-error': errors.password }"
                            />
                        </div>
                        <span v-if="errors.password" class="field-error"
                            >{{ errors.password[0] }}</span
                        >
                    </div>

                    <div v-if="isSignup" class="input-group">
                        <label>Confirm Password</label>
                        <div class="input-wrapper">
                            <input
                                type="password"
                                v-model="password_confirmation"
                                placeholder="Confirm password"
                            />
                        </div>
                    </div>

                    <div v-if="isSignup" class="terms-row">
                        <div class="checkbox-container">
                            <input type="checkbox" id="terms" v-model="termsAccepted" />
                            <label for="terms">
                                By creating an account, I agree to Desci International's
                                <a href="#">Terms of Service</a> and
                                <a href="#">Privacy Notice</a>.
                            </label>
                        </div>
                    </div>

                    <button
                        class="continue-btn"
                        :disabled="isLoading || !identifier || !password || (isSignup && (!termsAccepted || !name || !password_confirmation))"
                        @click="handleAuth"
                    >
                        <span v-if="isLoading">Loading...</span>
                        <span v-else>{{ isSignup ? 'Register' : 'Log In' }}</span>
                    </button>

                    <div class="divider">
                        <span class="divider-text">or</span>
                    </div>

                    <div class="social-login-grid">
                        <button class="social-auth-btn" @click="handleAuth">
                            <div class="social-icon">
                                <svg width="20" height="20" viewBox="0 0 48 48">
                                    <path
                                        fill="#EA4335"
                                        d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"
                                    ></path>
                                    <path
                                        fill="#4285F4"
                                        d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6.01c4.51-4.18 7.09-10.36 7.09-17.65z"
                                    ></path>
                                    <path
                                        fill="#FBBC05"
                                        d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24s.92 7.54 2.56 10.78l7.97-6.19z"
                                    ></path>
                                    <path
                                        fill="#34A853"
                                        d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"
                                    ></path>
                                </svg>
                            </div>
                            <span>Continue with Google</span>
                        </button>
                    </div>

                    <div class="auth-toggle-footer">
                        <span v-if="isSignup">
                            Already have an account?
                            <a href="#" class="login-link" @click.prevent="toggleAuthMode"
                                >Log in</a
                            >
                        </span>
                        <span v-else>
                            New to Desci?
                            <a href="#" class="login-link" @click.prevent="toggleAuthMode"
                                >Register Now</a
                            >
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.auth-wrapper {
    display: flex;
    min-height: 100vh;
    background: #000;
    color: #fff;
    font-family: 'IBM Plex Sans', sans-serif;
}

/* Left Section */
.left-section {
    flex: 1.2;
    background: #000;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 40px 80px;
    border-right: 1px solid #1a1a1a;
    position: relative;
    overflow: hidden;
}

@media (max-width: 1024px) {
    .left-section {
        display: none;
    }
    .right-section {
        padding: 20px !important;
    }
}

.promo-title {
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 60px;
    text-align: center;
}

.promo-graphic {
    height: 380px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 60px;
}

.orbital-container {
    position: relative;
    width: 300px;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.logo-center {
    width: 120px;
    height: 120px;
    background: #1e2329;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 5;
    box-shadow: 0 0 40px rgba(252, 213, 53, 0.2);
}

.main-logo-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
}

.mini-logo {
    width: 32px;
    height: 32px;
    object-fit: cover;
    border-radius: 50%;
}

.orbital-path {
    position: absolute;
    top: 50%;
    left: 50%;
    border: 2px solid var(--primary);
    border-radius: 50%;
    opacity: 0.6;
}

.orbital-path.outer {
    width: 280px;
    height: 180px;
    transform: translate(-50%, -50%) rotateX(65deg) rotateY(-15deg);
}

.orbital-path.inner {
    width: 210px;
    height: 140px;
    transform: translate(-50%, -50%) rotateX(65deg) rotateY(20deg);
}

.orbiting-arrow {
    position: absolute;
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-bottom: 10px solid var(--primary);
    filter: drop-shadow(0 0 5px var(--primary));
}

.arrow-1 {
    top: 50%;
    right: -6px;
    transform: rotate(90deg);
    animation: orbit-arr1 5s infinite linear;
}

.arrow-2 {
    bottom: 50%;
    left: -6px;
    transform: rotate(-90deg);
    animation: orbit-arr2 7s infinite linear;
}

@keyframes orbit-arr1 {
    from {
        transform: translateY(-50%) rotate(0deg) translateX(140px) rotate(-90deg);
    }
    to {
        transform: translateY(-50%) rotate(360deg) translateX(140px) rotate(-90deg);
    }
}

@keyframes orbit-arr2 {
    from {
        transform: translateY(-50%) rotate(0deg) translateX(105px) rotate(90deg);
    }
    to {
        transform: translateY(-50%) rotate(-360deg) translateX(105px) rotate(90deg);
    }
}

.stats-list {
    display: flex;
    flex-direction: column;
    gap: 32px;
}

.stat-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
}

.stat-icon {
    width: 40px;
    height: 40px;
    background: #1e2329;
    border-radius: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
}

.stat-text {
    font-size: 16px;
    font-weight: 500;
    color: #eaecef;
}

.stat-text.highlight {
    font-weight: 700;
}

.wallet-addr {
    margin-top: 4px;
    font-size: 13px;
    color: var(--primary);
    display: flex;
    flex-direction: column;
}

.addr-link {
    color: #fff;
    text-decoration: underline;
    word-break: break-all;
}

/* Right Section */
.right-section {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
    background: #0b0e11;
}

.auth-card {
    width: 100%;
    max-width: 450px;
    background: #0d0d0d;
    border-radius: 24px;
    padding: 32px;
    position: relative;
    border: 1px solid #1a1a1a;
}

.close-btn {
    position: absolute;
    top: 16px;
    left: 16px;
    background: #2b3139;
    border: none;
    color: #fff;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: background 0.2s;
}

.close-btn:hover {
    background: #363f4a;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 32px;
    justify-content: center;
}

.card-logo {
    width: 24px;
    height: 24px;
    object-fit: cover;
    border-radius: 50%;
}

.card-brand {
    font-size: 18px;
    font-weight: 700;
    color: var(--primary);
    letter-spacing: 1px;
}

.welcome-text {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 32px;
}

.input-group {
    margin-bottom: 24px;
}

.input-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    color: #eaecef;
}

.input-wrapper {
    position: relative;
}

.input-wrapper input {
    width: 100%;
    padding: 14px 16px;
    background: transparent;
    border: 1px solid #fff;
    border-radius: 8px;
    color: #eaecef;
    font-size: 16px;
    transition: border-color 0.2s;
}

.input-wrapper input:focus {
    outline: none;
    border-color: var(--primary);
}

.terms-row {
    margin-bottom: 32px;
}

.checkbox-container {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.checkbox-container input[type='checkbox'] {
    width: 18px;
    height: 18px;
    margin-top: 2px;
    accent-color: var(--primary);
}

.checkbox-container label {
    font-size: 13px;
    color: #fff;
    line-height: 1.5;
}

.checkbox-container label a {
    color: #eaecef;
    text-decoration: underline;
}

.continue-btn {
    width: 100%;
    padding: 16px;
    background: var(--primary);
    border: none;
    border-radius: 12px;
    color: #0b0e11;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition:
        transform 0.1s,
        opacity 0.2s;
}

.continue-btn:hover {
    opacity: 0.9;
}

.continue-btn:active {
    transform: scale(0.98);
}

.continue-btn:disabled {
    background: #2b3139;
    color: #fff;
    cursor: not-allowed;
}

.divider {
    display: flex;
    align-items: center;
    margin: 24px 0;
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #2b3139;
}

.divider-text {
    padding: 0 16px;
    color: #fff;
    font-size: 14px;
}

.social-login-grid {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.social-auth-btn {
    width: 100%;
    padding: 12px;
    background: #2b3139;
    border: none;
    border-radius: 8px;
    color: #eaecef;
    font-weight: 600;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
    padding-left: 16px;
    cursor: pointer;
    transition: background 0.2s;
}

.social-auth-btn:hover {
    background: #363f4a;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

.social-icon.google {
    color: #ea4335;
}
.social-icon.apple {
    color: white;
}
.social-icon.telegram {
    color: #0088cc;
}

.auth-toggle-footer {
    padding: 0 16px;
    color: #fff;
}

.login-link,
.entity-link {
    color: #fffd00;
    font-weight: 600;
}

.login-link:hover {
    text-decoration: underline;
}

/* New Auth Styles */
.error-banner {
    background: rgba(234, 67, 53, 0.1);
    border: 1px solid #ea4335;
    color: #ea4335;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 24px;
    font-size: 14px;
    text-align: center;
}

.input-error {
    border-color: #ea4335 !important;
}

.field-error {
    color: #ea4335;
    font-size: 12px;
    margin-top: 4px;
    display: block;
}

.continue-btn:disabled {
    background: #2b3139;
    color: #fff;
    opacity: 0.6;
    cursor: not-allowed;
}

@media (max-width: 640px) {
    .auth-wrapper {
        align-items: flex-start; /* Allow scroll if needed but try to center */
        background: #0b0e11;
    }
    .right-section {
        padding: 20px 16px !important;
        align-items: flex-start;
        padding-top: 40px !important;
    }
    .auth-card {
        padding: 24px 20px;
        background: transparent;
        border: none;
        box-shadow: none;
    }
    .card-header {
        margin-bottom: 24px;
    }
    .welcome-text {
        font-size: 24px;
        margin-bottom: 24px;
        text-align: center;
    }
    .input-group {
        margin-bottom: 16px;
    }
    .input-wrapper input {
        padding: 12px;
        font-size: 14px;
    }
    .promo-title {
        font-size: 28px;
    }
    .continue-btn {
        padding: 14px;
    }
    .divider {
        margin: 20px 0;
    }
}
</style>
