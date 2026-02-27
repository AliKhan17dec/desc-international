@csrf

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <label class="block text-sm font-semibold text-gray-300 mb-2">Name</label>
        <input name="name"
            class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('name', $coin->name ?? '') }}" required>
        @error('name')<small class="text-red-400">{{ $message }}</small>@enderror
    </div>

    <div class="lg:col-span-1">
        <label class="block text-sm font-semibold text-gray-300 mb-2">Symbol</label>
        <input name="symbol"
            class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('symbol', $coin->symbol ?? '') }}" required>
        <small class="text-gray-400">Will be stored UPPERCASE. Must be unique.</small>
        @error('symbol')<small class="text-red-400">{{ $message }}</small>@enderror
    </div>

    <div class="lg:col-span-1">
        <label class="block text-sm font-semibold text-gray-300 mb-2">Type</label>
        <select name="coin_type_id"
            class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
            <option value="">Select</option>
            @foreach($types as $t)
                <option value="{{ $t->id }}" @selected(old('coin_type_id', $coin->coin_type_id ?? null) == $t->id)>
                    {{ $t->name }}
                </option>
            @endforeach
        </select>
        @error('coin_type_id')<small class="text-red-400">{{ $message }}</small>@enderror
    </div>

    <div class="lg:col-span-1">
        <label class="block text-sm font-semibold text-gray-300 mb-2">Category</label>
        <select name="category_id"
            class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">(Optional)</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id', $coin->category_id ?? null) == $c->id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')<small class="text-red-400">{{ $message }}</small>@enderror
    </div>

    <div class="lg:col-span-2">
        <label class="block text-sm font-semibold text-gray-300 mb-2">Chains</label>
        <select name="chains[]"
            class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            multiple required>
            @foreach($chains as $ch)
                <option value="{{ $ch->id }}" @selected(in_array($ch->id, old('chains', isset($coin) ? $coin->chains->pluck('id')->toArray() : [])))>
                    {{ $ch->name }}
                </option>
            @endforeach
        </select>
        <small class="text-gray-400">Hold Ctrl/Command to select multiple.</small>
        @error('chains')<small class="text-red-400">{{ $message }}</small>@enderror
        @error('chains.*')<small class="text-red-400">{{ $message }}</small>@enderror
    </div>

    <div class="lg:col-span-1">
        <label class="block text-sm font-semibold text-gray-300 mb-2">Logo</label>
        <input type="file" name="logo"
            class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @if(!empty($coin?->logo))
            <div class="mt-3">
                <img src="{{ asset('storage/' . $coin->logo) }}" width="60" class="rounded">
            </div>
        @endif
        @error('logo')<small class="text-red-400">{{ $message }}</small>@enderror
    </div>
    <div class="lg:col-span-1">
        <label class="block text-sm font-semibold text-gray-300 mb-2">Mindshare</label>
    </div>

    <div class="md:col-span-2 lg:col-span-3">
        <label class="block text-sm font-semibold text-gray-300 mb-2">Description</label>
        <textarea name="description"
            class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            rows="3">{{ old('description', $coin->description ?? '') }}</textarea>
        @error('description')<small class="text-red-400">{{ $message }}</small>@enderror
    </div>

    <div class="flex items-center">
        <input class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" type="checkbox" name="is_active"
            value="1" @checked(old('is_active', $coin->is_active ?? true))>
        <label class="ml-2 text-sm font-medium text-gray-300">Active</label>
    </div>

    <div class="flex items-center">
        <input class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" type="checkbox"
            name="show_in_trending" value="1" @checked(old('show_in_trending', $coin->show_in_trending ?? false))>
        <label class="ml-2 text-sm font-medium text-gray-300">Show in Trending</label>
    </div>

    {{-- <div>
        <label class="block text-sm font-semibold text-gray-300 mb-2">Trending Rank</label>
        <input name="trending_rank" type="number"
            class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('trending_rank', $coin->trending_rank ?? '') }}">
        @error('trending_rank')<small class="text-red-400">{{ $message }}</small>@enderror
    </div> --}}

    <div class="flex items-center">
        <input class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" type="checkbox"
            name="show_in_gainers" value="1" @checked(old('show_in_gainers', $coin->show_in_gainers ?? true))>
        <label class="ml-2 text-sm font-medium text-gray-300">Eligible for Top Gainers</label>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
    <div>
        <label>Price</label>
        <input type="number" step="0.00000001" name="price"             class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('price', $coin->price ?? '') }}">
    </div>

    <div>
        <label>Market Cap</label>
        <input type="number" step="0.01" name="marketcap"             class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('marketcap', $coin->marketcap ?? '') }}">
    </div>

    <div>
        <label>24h Volume</label>
        <input type="number" step="0.01" name="volume_24h"             class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('volume_24h', $coin->volume_24h ?? '') }}">
    </div>

    <div>
        <label>Price Change %</label>
        <input type="number" step="0.01" name="price_change"             class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('price_change', $coin->price_change ?? '') }}">
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
    <div>
        <label>Mindshare</label>
        <input type="number" step="0.01" name="mindshare"             class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('mindshare', $coin->mindshare ?? '') }}">
    </div>

    <div>
        <label>24h Volume %</label>
        <input type="number" step="0.01" name="volume_percentage_24h"             class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('volume_percentage_24h', $coin->volume_percentage_24h ?? '') }}">
    </div>

    <div>
        <label>Trending Rank</label>
        <input type="number" name="trending_rank"             class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('trending_rank', $coin->trending_rank ?? '') }}">
    </div>

    <div>
        <label>Holders</label>
        <input type="number" name="holders"             class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('holders', $coin->holders ?? '') }}">
    </div>
</div>


<div class="mt-8 flex gap-3">
    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">Save</button>
    <a href="{{ route('admin.coins.index') }}"
        class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium">Cancel</a>
</div>