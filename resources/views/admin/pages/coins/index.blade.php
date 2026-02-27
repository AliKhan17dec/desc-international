@extends('admin.layout.app')
@section('sidebar')
    @include('admin.layout.partials.sidebar')
@endsection
@section('content')
    <div class="px-6 py-8 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-3xl font-bold text-white">Coins</h3>
            <a class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                href="{{ route('admin.coins.create') }}">Add Coin</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-900 text-green-200 rounded-lg">{{ session('success') }}</div>
        @endif

        <form class="mb-6" method="GET">
            <input name="search"
                class="w-full px-4 py-2 bg-crypto-card border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Search name or symbol..." value="{{ request('search') }}">
        </form>

        <div class="bg-crypto-card rounded-lg shadow border border-crypto-border">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-crypto-border bg-crypto-dark">
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Logo</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Symbol</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Type</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Category</th>
                            {{-- <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Chains</th> --}}
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Price</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Market Cap</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">24h %</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Trending</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Active</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($coins as $coin)
                            <tr class="border-b border-crypto-border hover:bg-crypto-dark transition">
                                <td class="px-6 py-4">
                                    @if($coin->logo)
                                        <img src="{{ asset('storage/' . $coin->logo) }}" width="32" height="32"
                                            class="rounded-full">
                                    @else
                                        <div class="rounded-full bg-gray-600" style="width:32px;height:32px;"></div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-white">{{ $coin->name }}</td>
                                <td class="px-6 py-4"><code
                                        class="bg-crypto-dark px-2 py-1 rounded text-sm text-gray-300">{{ $coin->symbol }}</code>
                                </td>
                                <td class="px-6 py-4 text-gray-300">{{ $coin->type?->name }}</td>
                                <td class="px-6 py-4 text-gray-300">{{ $coin->category?->name ?? '-' }}</td>
                                {{-- <td class="px-6 py-4">
                                    @foreach($coin->chains as $ch)
                                        <span
                                            class="inline-block mr-1 mb-1 px-3 py-1 bg-blue-900 text-blue-200 text-xs rounded-full">{{ $ch->name }}</span>
                                    @endforeach
                                </td> --}}
                                <td class="px-6 py-4">${{ number_format($coin->price, 6) }}</td>
                                <td class="px-6 py-4">${{ number_format($coin->marketcap) }}</td>

                                <td class="{{ $coin->price_change >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $coin->price_change }}%
                                </td>

                                <td class="px-6 py-4">
                                    @if($coin->show_in_trending)
                                        <span
                                            class="inline-block px-3 py-1 bg-green-900 text-green-200 text-xs rounded-full font-semibold">Yes</span>
                                    @else
                                        <span
                                            class="inline-block px-3 py-1 bg-gray-700 text-gray-300 text-xs rounded-full font-semibold">No</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($coin->is_active)
                                        <span
                                            class="inline-block px-3 py-1 bg-green-900 text-green-200 text-xs rounded-full font-semibold">Yes</span>
                                    @else
                                        <span
                                            class="inline-block px-3 py-1 bg-red-900 text-red-200 text-xs rounded-full font-semibold">No</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a class="inline-block px-3 py-1 bg-amber-600 text-white text-sm rounded hover:bg-amber-700 transition mr-2"
                                        href="{{ route('admin.coins.edit', $coin) }}">Edit</a>

                                    <form action="{{ route('admin.coins.destroy', $coin) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Delete this coin?')">
                                        @csrf @method('DELETE')
                                        <button
                                            class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-6 py-8 text-center text-gray-400">No coins found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-crypto-border">
                {{ $coins->links() }}
            </div>
        </div>
    </div>
@endsection