@extends('web.layout.app')
@section('title', __('Markets'))
@section('content')
    <div class="max-w-7xl mx-auto space-y-6 p-6 mb-10">

        <!-- Top Section: Trending & Top Gainers -->
        <div class="grid grid-cols-1 pt-16 lg:grid-cols-2 gap-6">

            <!-- Trending in DeSci -->
            <div class="bg-crypto-accent border border-crypto-border max-h-[300px] overflow-y-auto rounded-xl p-5">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-6 h-6 rounded-full bg-crypto-primary flex items-center justify-center">
                        <svg class="w-4 h-4 text-crypto-accent" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="text-white font-semibold text-lg">Trending in DeSci</h2>
                </div>

                <div class="space-y-1">
                    <!-- Header -->
                    <div class="flex justify-between text-xs text-gray-500 px-2 py-2">
                        <span>Token</span>
                        <span>Mindshare/24h %Δ</span>
                    </div>
                    @foreach($trendingCoins as $coin)
                        <div
                            class="flex items-center relative justify-between p-2 hover:bg-crypto-card rounded-lg cursor-pointer transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 relative rounded-full bg-gray-700 flex items-center justify-center">
                                    @if($coin->logo)
                                        <img src="{{ asset('storage/' . $coin->logo) }}" class="w-full h-full object-cover rounded-full overflow-hidden">
                                    @else
                                        <span class="text-xs text-gray-400">
                                            {{ strtoupper(substr($coin->symbol, 0, 2)) }}
                                        </span>
                                    @endif
                                    <div class="absolute -right-1 -bottom-1 text-[10px] bg-gray-800 w-5 h-5 rounded-full overflow-hidden text-center flex items-center justify-center">
                                        {!! $coin->type->icon !!}
                                    </div>
                                </div>

                                <div>
                                    <div class="font-medium text-white">{{ $coin->name }}</div>
                                    <span class="text-xs text-crypto-primary">{{ $coin->symbol }}</span>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="font-medium text-white">
                                    {{ number_format($coin->mindshare, 2) }}%
                                </div>
                                <div
                                    class="text-xs {{ $coin->volume_percentage_24h >= 0 ? 'text-crypto-primary' : 'text-red-500' }}">
                                    {{ $coin->volume_percentage_24h }}%
                                </div>
                            </div>
                            <a href="{{ route('web.markets.coin.show', ['slug' => $coin->launchpad?->slug]) }}" class="absolute inset-0"></a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Gainers -->
            <div class="bg-crypto-accent border border-crypto-border max-h-[300px] overflow-y-auto rounded-xl p-5">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-6 h-6 rounded-full bg-crypto-primary flex items-center justify-center">
                        <svg class="w-4 h-4 text-crypto-accent" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="text-white font-semibold text-lg">Top Gainers</h2>
                </div>

                <div class="space-y-1">
                    <!-- Header -->
                    <div class="flex justify-between text-xs text-gray-500 px-2 py-2">
                        <span>Token</span>
                        <span>MCap/24h %Δ</span>
                    </div>
                    @foreach($topGainers as $coin)
                        <div
                            class="flex items-center justify-between relative p-2 hover:bg-crypto-card rounded-lg cursor-pointer transition-colors">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-11 h-11 relative rounded-full bg-gray-700  bg-crypto-primary flex items-center justify-center">
                                    @if($coin->logo)
                                        <img src="{{ asset('storage/' . $coin->logo) }}" class="w-full h-full object-cover rounded-full overflow-hidden">
                                    @else
                                        <span class="text-xs font-bold text-crypto-accent">
                                            {{ strtoupper(substr($coin->symbol, 0, 3)) }}
                                        </span>
                                    @endif
                                    <div class="absolute -right-1 -bottom-1 text-[10px] bg-gray-800 w-5 h-5 rounded-full overflow-hidden text-center flex items-center justify-center">
                                        {!! $coin->type->icon !!}
                                    </div>
                                </div>

                                <div>
                                    <div class="font-medium text-white">{{ $coin->name }}</div>
                                    <span class="text-xs text-crypto-primary">{{ $coin->symbol }}</span>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="font-medium text-white">
                                    {{ number_format($coin->marketcap / 1_000_000, 2) }}M
                                </div>
                                <div class="text-xs {{ $coin->price_change >= 0 ? 'text-crypto-primary' : 'text-red-500' }}">
                                    {{ $coin->price_change }}%
                                </div>
                            </div>
                            <a href="{{ route('web.markets.coin.show', ['slug' => $coin->launchpad?->slug]) }}" class="absolute inset-0"></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Filter Tabs Section -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <!-- Tabs -->
            <div class="inline-flex bg-crypto-accent border border-crypto-border rounded-full p-1">
                <button type="button" data-coin-type="all"
                    class="coin-type-filter inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-crypto-accent bg-crypto-primary rounded-full">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    All Types
                </button>
                @foreach ($coinTypes as $ct)
                    <button type="button" data-coin-type="{{ $ct->slug }}"
                        class="coin-type-filter inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-400 hover:text-white rounded-full transition-colors">
                        {!! $ct->icon !!}
                        {{-- <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg> --}}
                        {{ $ct->name }}
                    </button>
                @endforeach
                {{-- <button type="button"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-400 hover:text-white rounded-full transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd" />
                    </svg>
                    DAO
                </button>
                <button type="button"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-400 hover:text-white rounded-full transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    IPT
                </button> --}}
            </div>

            <!-- Right Controls -->
            <div class="flex items-center gap-3">
                <!-- All Chains Dropdown -->
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-crypto-accent border border-crypto-border rounded-full hover:bg-crypto-card transition-colors"
                    type="button">
                    <svg class="w-4 h-4 text-crypto-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                    </svg>
                    All Chains
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-crypto-card border border-crypto-border divide-y divide-crypto-border rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-200">
                        @foreach ($chains as $ct)
                            <li><a href="{{ $ct->slug }}" class="block px-4 py-2 hover:bg-crypto-accent">{{ $ct->name }}</a></li>
                        @endforeach
                        {{-- <li><a href="#" class="block px-4 py-2 hover:bg-crypto-accent">Base</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-crypto-accent">Solana</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-crypto-accent">Arbitrum</a></li> --}}
                    </ul>
                </div>

                <!-- Search Button -->
                <button
                    class="p-2.5 text-gray-400 hover:text-white bg-crypto-accent border border-crypto-border rounded-full transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Assets Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 border-b border-crypto-border">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                </svg>
                                #
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 font-medium">Asset</th>
                        <th scope="col" class="px-4 py-3 font-medium">Chain</th>
                        <th scope="col" class="px-4 py-3 font-medium">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                </svg>
                                Marketcap
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 font-medium">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                </svg>
                                Price
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 font-medium">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                </svg>
                                24H Volume
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 font-medium">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                                </svg>
                                Holders
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3 font-medium text-right">7d Marketcap</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach($coins as $index => $coin)
                        <tr data-coin-type="{{ $coin->type->slug }}" class="border-b relative border-crypto-border hover:bg-crypto-card transition-colors cursor-pointer">
                            
                            <td class="px-4 py-4 text-gray-400">
                                {{ $coins->firstItem() + $index }}
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3 relative">
                                    <div
                                        class="w-10 h-10 rounded-full relative bg-gray-700 flex items-center justify-center">
                                        @if($coin->logo)
                                            <img src="{{ asset('storage/' . $coin->logo) }}" class="w-full h-full object-cover rounded-full overflow-hidden">
                                        @else
                                            <span class="text-xs text-white">{{ strtoupper(substr($coin->symbol, 0, 2)) }}</span>
                                        @endif
                                        <div class="absolute -right-1 -bottom-1 text-[10px] bg-gray-800 w-5 h-5 rounded-full overflow-hidden text-center flex items-center justify-center">
                                            {!! $coin->type->icon !!}
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-white">{{ $coin->name }}</span>
                                            @if($coin->category)
                                                <span
                                                    class="px-2 py-0.5 text-xs bg-crypto-card border border-crypto-border rounded-full">
                                                    {{ $coin->category->name }}
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $coin->symbol }}</span>
                            <a href="{{ route('web.markets.coin.show', ['slug' => $coin->launchpad?->slug]) }}" class="absolute inset-0"></a>

                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center gap-1">
                                    @foreach($coin->chains as $chain)
                                        <div class="w-6 h-6 rounded-full bg-gray-700 flex items-center justify-center text-xs">
                                            @if ($chain->icon)
                                            <img src="{{ asset('storage/'. $chain->icon) }}" class="w-full h-full object-cover rounded-full" alt="{{ $chain->name }}" title="{{ $chain->name }}">
                                            @else
                                            {{ strtoupper(substr($chain->symbol ?? $chain->name, 0, 1)) }}
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-4 py-4 font-mono text-white">
                                ${{ number_format($coin->marketcap, 2) }}
                            </td>

                            <td class="px-4 py-4">
                                <div class="font-mono text-white">${{ number_format($coin->price, 6) }}</div>
                                <div class="text-xs {{ $coin->price_change >= 0 ? 'text-crypto-primary' : 'text-red-500' }}">
                                    {{ $coin->price_change }}%
                                </div>
                            </td>

                            <td class="px-4 py-4 font-mono text-white">
                                ${{ number_format($coin->volume_24h) }}
                            </td>

                            <td class="px-4 py-4 font-mono text-white">
                                {{ number_format($coin->holders) }}
                            </td>

                            <td class="px-4 py-4 text-right">
                                {{-- Placeholder for future sparkline --}}
                                <span class="text-xs text-gray-500">—</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <!-- Row 1 -->
                {{-- <tr class="border-b border-crypto-border hover:bg-crypto-card transition-colors cursor-pointer">
                    <td class="px-4 py-4 text-gray-400">1</td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-full bg-yellow-500 flex items-center justify-center text-crypto-accent font-bold text-xs">
                                HD
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-white">HairDAO</span>
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium text-gray-300 bg-crypto-card border border-crypto-border rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        DAO
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500">Hair Loss</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-1">
                            <div class="w-6 h-6 rounded-full bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-400 text-xs">◆</span>
                            </div>
                            <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center -ml-2">
                                <span class="text-white text-xs">◎</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 font-mono text-white">$24.22M</td>
                    <td class="px-4 py-4">
                        <div class="font-mono text-white">$34.86</div>
                        <div class="text-xs text-red-500">-1.71%</div>
                    </td>
                    <td class="px-4 py-4 font-mono text-white">$7,256</td>
                    <td class="px-4 py-4 font-mono text-white">742</td>
                    <td class="px-4 py-4">
                        <svg class="w-24 h-10 ml-auto" viewBox="0 0 100 40">
                            <polyline fill="none" stroke="#22c55e" stroke-width="2"
                                points="0,30 10,28 20,25 30,20 40,22 50,18 60,15 70,12 80,10 90,8 100,5" />
                        </svg>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr class="border-b border-crypto-border hover:bg-crypto-card transition-colors cursor-pointer">
                    <td class="px-4 py-4 text-gray-400">2</td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-full bg-gradient-to-br from-purple-600 to-purple-900 flex items-center justify-center">
                                <span class="text-yellow-400">💜</span>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-white">VitaDAO</span>
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium text-gray-300 bg-crypto-card border border-crypto-border rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        DAO
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500">Longevity</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-1">
                            <div class="w-6 h-6 rounded-full bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-400 text-xs">◆</span>
                            </div>
                            <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center -ml-2">
                                <span class="text-white text-xs">◎</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 font-mono text-white">$10.49M</td>
                    <td class="px-4 py-4">
                        <div class="font-mono text-white">$0.405</div>
                        <div class="text-xs text-gray-500">0%</div>
                    </td>
                    <td class="px-4 py-4 font-mono text-white">$610.9K</td>
                    <td class="px-4 py-4 font-mono text-white">8,871</td>
                    <td class="px-4 py-4">
                        <svg class="w-24 h-10 ml-auto" viewBox="0 0 100 40">
                            <polyline fill="none" stroke="#22c55e" stroke-width="2"
                                points="0,20 15,18 25,22 35,15 45,20 55,18 65,25 75,20 85,30 95,25 100,35" />
                            <polyline fill="none" stroke="#ef4444" stroke-width="2" points="85,30 95,25 100,35" />
                        </svg>
                    </td>
                </tr> --}}
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $coins->links() }}
        </div>

    </div>
@endsection
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // convert to simple js no jquery
        const coinTypeFilter = document.querySelectorAll('.coin-type-filter');
        coinTypeFilter.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var selectedType = this.dataset.coinType;
                
                // Reset all buttons
                coinTypeFilter.forEach(function (otherBtn) {
                    otherBtn.classList.remove('text-crypto-accent', 'bg-crypto-primary');
                    otherBtn.classList.add('text-gray-400', 'hover:text-white');
                });
                
                // Set active state for clicked button
                this.classList.remove('text-gray-400', 'hover:text-white');
                this.classList.add('text-crypto-accent', 'bg-crypto-primary');
                
                if (selectedType === 'all') {
                    // Show all rows in the table that have data-coin-type
                    document.querySelectorAll('tbody tr[data-coin-type]').forEach(function (row) {
                        row.style.display = '';
                    });
                } else {
                    // Hide all rows first
                    document.querySelectorAll('tbody tr[data-coin-type]').forEach(function (row) {
                        row.style.display = 'none';
                    });
                    // Show only matching rows
                    document.querySelectorAll('tbody tr[data-coin-type="' + selectedType + '"]').forEach(function (row) {
                        row.style.display = '';
                    });
                }
            });
        });
    });
</script>
@endpush