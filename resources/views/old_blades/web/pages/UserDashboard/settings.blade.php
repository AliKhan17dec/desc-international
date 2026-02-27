@extends('web.layout.app')
@section('title', 'Security Settings')

@section('sidebar')
    @include('components.user-sidebar')
@endsection

@section('content')
    <div class="overflow-x-hidden custom-scrollbar bg-neutral-900 min-h-screen">
        <div class="content-area page-transition mt-20 md:mt-0">
            <div class="p-4 md:p-6 mt-10">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Security & Settings</h2>
                        <p class="text-gray-400">Manage your password, 2FA, and other preferences.</p>
                    </div>
                </div>

                <div
                    class="border border-neutral-600 rounded-lg p-8 bg-crypto-accent/80 flex flex-col items-center justify-center min-h-[400px]">
                    <div class="mb-6">
                        <i class="fas fa-user-shield text-6xl text-crypto-primary opacity-50"></i>
                    </div>
                    <h3 class="text-xl font-medium text-white mb-2">Security Hub</h3>
                    <p class="text-gray-400 text-center max-w-md">
                        Protect your account! Security settings, including 2FA and password changes, will be available here
                        soon.
                    </p>
                    <button onclick="history.back()"
                        class="mt-8 bg-btn text-black font-medium px-6 py-2 rounded hover:bg-opacity-90 transition-colors">
                        Go Back
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection