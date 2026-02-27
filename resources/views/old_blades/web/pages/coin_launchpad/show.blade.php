@extends('web.layout.app')

@section('content')
@php
    $coinName = $launchpad->coin->name ?? $launchpad->coin->symbol ?? 'Coin';
    $status = $launchpad->status ?? 'live';
    $categoryName = $launchpad->category->name ?? null;

    // External links helper: find by keyword in label
    $links = $launchpad->externalLinks ?? collect();
    $findLink = function($keywords) use ($links) {
        $keywords = is_array($keywords) ? $keywords : [$keywords];
        foreach ($links as $l) {
            $label = strtolower($l->label ?? '');
            $url = strtolower($l->url ?? '');
            foreach ($keywords as $k) {
                $k = strtolower($k);
                if (str_contains($label, $k) || str_contains($url, $k)) return $l;
            }
        }
        return null;
    };

    $twitter = $findLink(['twitter','x.com','x ']);
    $discord = $findLink(['discord']);
    $website = $findLink(['website','site']);
    $docs = $findLink(['docs','doc']);

    // Hero image fallback: use first research/value block image if available
    $heroImage = null;
    $firstImgBlock = $launchpad->blocks->first(fn($b) => !empty($b->image_path));
    if ($firstImgBlock && !empty($firstImgBlock->image_path)) {
        $heroImage = $firstImgBlock->image_path;
    }

    // If your coins table has logo fields, uncomment and adjust:
    // $heroImage = $launchpad->coin->logo_url ?? $launchpad->coin->image ?? $heroImage;
@endphp

<div class="w-full overflow-x-hidden">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10">

        {{-- HERO --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <div>
                <h1 class="text-3xl md:text-4xl font-semibold text-white">
                    {{ $coinName }}
                </h1>

                <div class="flex items-center gap-2 mt-3">
                    {{-- Status badge --}}
                    @php
                        $statusClasses = $status === 'live'
                            ? 'bg-green-500/15 border-green-500 text-green-200'
                            : 'bg-yellow-500/15 border-yellow-500 text-yellow-200';
                    @endphp
                    <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full border text-xs {{ $statusClasses }}">
                        <span class="h-2 w-2 rounded-full bg-current opacity-80"></span>
                        {{ strtoupper($status) }}
                    </span>

                    {{-- Category badge --}}
                    @if($categoryName)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-crypto-primary/15 text-crypto-primary border border-crypto-primary text-xs">
                            {{ $categoryName }}
                        </span>
                    @endif
                </div>

                {{-- Summary --}}
                @if(!empty($launchpad->summary_text))
                    <p class="mt-4 text-gray-200 leading-relaxed max-w-xl">
                        {{ $launchpad->summary_text }}
                    </p>
                @endif

                {{-- Small links row (icons-like) --}}
                <div class="flex items-center gap-4 mt-5 text-gray-300">
                    @if($website)
                        <a href="{{ $website->url }}" target="_blank" class="hover:text-crypto-primary transition text-sm">
                            Website
                        </a>
                    @endif
                    @if($docs)
                        <a href="{{ $docs->url }}" target="_blank" class="hover:text-crypto-primary transition text-sm">
                            Docs
                        </a>
                    @endif
                    @if($twitter)
                        <a href="{{ $twitter->url }}" target="_blank" class="hover:text-crypto-primary transition text-sm">
                            X
                        </a>
                    @endif
                    @if($discord)
                        <a href="{{ $discord->url }}" target="_blank" class="hover:text-crypto-primary transition text-sm">
                            Discord
                        </a>
                    @endif
                </div>
            </div>

            {{-- Hero image panel --}}
            <div class="flex justify-end">
                <div class="w-full max-w-md rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 overflow-hidden">
                    <div class="aspect-[16/10] w-full bg-black/40">
                        @if($heroImage)
                            <img src="{{ $heroImage }}" alt="{{ $coinName }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm">
                                No image set (add image_path in a block)
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- CHART + SWAP PANEL (like screenshot) --}}
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 overflow-hidden">
                <div class="p-4 border-b border-white/5">
                    <div class="text-white font-medium">Price / Chart</div>
                </div>

                {{-- Placeholder chart area --}}
                <div class="aspect-[16/7] h-[400px]! w-full bg-black/40 flex items-center justify-center text-gray-500 text-sm">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container" style="height:100%;width:100%">
                    <div class="tradingview-widget-container__widget" style="height:calc(100% - 32px);width:100%"></div>
                    {{-- <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/TRACUSDT/?exchange=BINANCEUS" rel="noopener nofollow" target="_blank"><span class="blue-text">TRACUSDT price</span></a><span class="trademark"> by TradingView</span></div> --}}
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                    "allow_symbol_change": false,
                    "calendar": false,
                    "details": false,
                    "hide_side_toolbar": true,
                    "hide_top_toolbar": false,
                    "hide_legend": false,
                    "hide_volume": false,
                    "hotlist": false,
                    "interval": "D",
                    "locale": "en",
                    "save_image": true,
                    "style": "1",
                    "symbol": "BINANCEUS:TRACUSDT",
                    "theme": "dark",
                    "timezone": "Etc/UTC",
                    "backgroundColor": "#0F0F0F",
                    "gridColor": "rgba(242, 242, 242, 0.06)",
                    "watchlist": [],
                    "withdateranges": false,
                    "compareSymbols": [],
                    "studies": [],
                    "autosize": true
                    }
                    </script>
                    </div>
                    <!-- TradingView Widget END -->
                </div>
            </div>

            <div class="rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 p-5 flex flex-col justify-center">
                <div class="flex items-center justify-center">
                    <button class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-crypto-primary/20 text-crypto-primary border border-crypto-primary hover:bg-crypto-primary/30 transition">
                        Login
                    </button>
                </div>
                <p class="text-center text-gray-300 text-sm mt-3">
                    Please login with an Ethereum wallet to use the swap.
                </p>
            </div>
        </div>

        {{-- MARKET HYPOTHESIS --}}
        <div class="mt-12">
            <h2 class="text-2xl md:text-3xl font-semibold text-white">Market Hypothesis</h2>

            {{-- Stats row --}}
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                @php $stats = $launchpad->highlight_stats ?? []; @endphp

                @foreach($stats as $s)
                    <div class="rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 p-5">
                        <div class="text-crypto-primary text-2xl font-semibold">
                            {{ $s['value'] ?? '' }}
                        </div>
                        <div class="text-gray-300 text-sm mt-1">
                            {{ $s['label'] ?? '' }}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Narrative block (optional): use a custom block titled "Market Hypothesis" if you want rich text here --}}
            @php
                $marketBlock = $customBlocks->first(fn($b) => strtolower(trim($b->title ?? '')) === 'market hypothesis');
            @endphp

            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="text-white text-lg font-semibold leading-snug">
                    {{-- If you want a dedicated field later, we can add it.
                        For now: show first line of market block or summary fallback --}}
                    @if($marketBlock && $marketBlock->body_text)
                        {!! \Illuminate\Support\Str::markdown($marketBlock->body_text) !!}
                    @else
                        <p class="text-white/90">
                            {{ \Illuminate\Support\Str::limit($launchpad->summary_text ?? '', 140) }}
                        </p>
                    @endif
                </div>

                <div class="prose prose-invert max-w-none text-gray-200 prose-p:leading-relaxed prose-a:text-crypto-primary">
                    @if($marketBlock && $marketBlock->body_text)
                        {{-- already rendered above; if you prefer split text, tell me --}}
                        <div class="text-gray-300 text-sm">
                            (Tip: Create a Custom block titled “Market Hypothesis” for this section.)
                        </div>
                    @else
                        <p class="text-gray-300">
                            Add a Custom block titled <span class="text-white font-medium">Market Hypothesis</span> to control this narrative text dynamically.
                        </p>
                    @endif
                </div>
            </div>
        </div>

        {{-- RESEARCH FOCUS AREAS --}}
        @if($researchBlocks->count())
            <div class="mt-10">
                <h2 class="text-2xl md:text-3xl font-semibold text-white">Research Focus Areas</h2>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($researchBlocks as $b)
                        <div class="rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 overflow-hidden">
                            <div class="aspect-[16/10] bg-black/40">
                                @if($b->image_path)
                                    <img src="{{ $b->image_path }}" alt="{{ $b->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm">
                                        No image
                                    </div>
                                @endif
                            </div>

                            <div class="p-5">
                                <h3 class="text-white font-semibold text-lg leading-snug">
                                    {{ $b->title }}
                                </h3>

                                @if($b->body_text)
                                    <p class="mt-2 text-gray-300 text-sm leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($b->body_text), 180) }}
                                    </p>
                                @endif

                                <div class="mt-4 flex justify-end">
                                    @if($b->external_link)
                                        <a href="{{ $b->external_link }}" target="_blank"
                                           class="inline-flex items-center justify-center px-4 py-2 rounded-full border border-crypto-primary/40 text-crypto-primary hover:bg-crypto-primary/10 transition text-sm">
                                            Learn more
                                        </a>
                                    @else
                                        <span class="inline-flex items-center justify-center px-4 py-2 rounded-full border border-white/10 text-gray-500 text-sm">
                                            Learn more
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- TEAM & COMMUNITY --}}
        <div class="mt-10">
            <h2 class="text-2xl md:text-3xl font-semibold text-white">Team & Community</h2>

            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Team list --}}
                <div class="rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 p-5">
                    <div class="space-y-4">
                        @forelse($launchpad->teamMembers as $m)
                            <div class="flex items-start gap-3">
                                <div class="h-10 w-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 text-sm">
                                    {{-- Avatar placeholder --}}
                                    {{ strtoupper(mb_substr($m->name ?? 'U', 0, 1)) }}
                                </div>

                                <div class="flex-1">
                                    <div class="text-white font-medium">{{ $m->name }}</div>
                                    @if($m->role)
                                        <div class="text-gray-400 text-sm">{{ $m->role }}</div>
                                    @endif

                                    @if($m->external_url)
                                        <a href="{{ $m->external_url }}" target="_blank" class="text-crypto-primary text-sm hover:underline">
                                            View profile
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-gray-400 text-sm">
                                No team members added yet.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Community buttons (like screenshot right side) --}}
                <div class="space-y-4">
                    @if($twitter)
                        <div class="rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 p-5">
                            <div class="text-gray-300 text-sm mb-3">
                                {{ $twitter->label ?? 'Follow on X' }}
                            </div>
                            <a href="{{ $twitter->url }}" target="_blank"
                               class="inline-flex items-center justify-center w-full px-4 py-3 rounded-full border border-crypto-primary/40 text-crypto-primary hover:bg-crypto-primary/10 transition">
                                Follow on X
                            </a>
                        </div>
                    @endif

                    @if($discord)
                        <div class="rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 p-5">
                            <div class="text-gray-300 text-sm mb-3">
                                Discord community
                            </div>
                            <a href="{{ $discord->url }}" target="_blank"
                               class="inline-flex items-center justify-center w-full px-4 py-3 rounded-full border border-crypto-primary/40 text-crypto-primary hover:bg-crypto-primary/10 transition">
                                Join our Discord
                            </a>
                        </div>
                    @endif

                    @if(!$twitter && !$discord)
                        <div class="rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 p-5 text-gray-400 text-sm">
                            Add External Links (Twitter/X, Discord) in admin to show buttons here.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- VALUE CAPTURE MODEL --}}
        <div class="mt-10">
            <h2 class="text-2xl md:text-3xl font-semibold text-white">Value Capture Model</h2>

            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                <div class="prose prose-invert max-w-none text-gray-200 prose-p:leading-relaxed prose-a:text-crypto-primary">
                    @if($launchpad->value_capture_text)
                        {!! \Illuminate\Support\Str::markdown($launchpad->value_capture_text) !!}
                    @else
                        <p class="text-gray-300">
                            Add <span class="text-white font-medium">value_capture_text</span> from admin to render this section.
                        </p>
                    @endif
                </div>

                <div class="flex justify-end">
                    @php
                        $valueImg = $valueModelBlocks->first(fn($b) => !empty($b->image_path))?->image_path;
                    @endphp

                    <div class="w-full max-w-md rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 overflow-hidden">
                        <div class="aspect-[16/12] bg-black/40">
                            @if($valueImg)
                                <img src="{{ $valueImg }}" alt="Value model" class="w-full h-full object-contain p-6">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-500 text-sm">
                                    (Optional) Add a Value Model block with image_path
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RECOMMENDED READS (optional, based on blocks) --}}
        @if($recommendedReads->count())
            <div class="mt-10">
                <h2 class="text-2xl md:text-3xl font-semibold text-white">Recommended Reads</h2>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($recommendedReads as $b)
                        <a href="{{ $b->external_link ?: '#' }}" target="{{ $b->external_link ? '_blank' : '_self' }}"
                           class="rounded-2xl border border-crypto-primary/20 bg-crypto-accent/80 overflow-hidden hover:border-crypto-primary/50 transition block">
                            <div class="aspect-[16/10] bg-black/40">
                                @if($b->image_path)
                                    <img src="{{ $b->image_path }}" alt="{{ $b->title }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="text-white font-semibold">{{ $b->title }}</div>
                                @if($b->body_text)
                                    <div class="mt-2 text-gray-300 text-sm">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($b->body_text), 120) }}
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
