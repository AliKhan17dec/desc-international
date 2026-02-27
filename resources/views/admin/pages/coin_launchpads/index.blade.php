@extends('admin.layout.app')

@section('sidebar')
    @include('admin.layout.partials.sidebar')
@endsection

@section('content')
    <div class="w-full overflow-x-hidden custom-scrollbar">
        <div class="content-area page-transition m-4 md:m-6">
            <div class="p-4 md:p-6 bg-crypto-accent rounded-xl text-white">
                <div class="flex items-center justify-between gap-3 mb-4">
                    <h2 class="text-2xl font-semibold text-crypto-primary">Coin Launchpads</h2>

                    <a href="{{ route('admin.coin-launchpads.create') }}"
                        class="bg-crypto-primary text-black font-medium py-2 px-4 rounded hover:brightness-110 transition">
                        + Create Launchpad
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-3 rounded bg-green-600/20 border border-green-600 text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-200">
                        <thead class="text-xs uppercase bg-zinc-900/60 text-gray-300">
                            <tr>
                                <th class="px-4 py-3">Coin</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Slug</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($launchpads as $lp)
                                <tr class="border-b border-zinc-700/50">
                                    <td class="px-4 py-3">
                                        {{ $lp->coin->name ?? $lp->coin->symbol ?? ('Coin #' . $lp->coin_id) }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $lp->category->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-gray-300">{{ $lp->slug }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $badge = $lp->status === 'live'
                                                ? 'bg-green-600/20 border-green-600 text-green-200'
                                                : 'bg-yellow-600/20 border-yellow-600 text-yellow-200';
                                        @endphp
                                        <span class="px-2 py-1 rounded border {{ $badge }}">
                                            {{ ucfirst($lp->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('admin.coin-launchpads.edit', $lp->id) }}"
                                            class="inline-flex items-center px-3 py-1 rounded bg-zinc-800 border border-zinc-600 hover:border-crypto-primary transition">
                                            Edit
                                        </a>

                                        <form class="inline-block"
                                            action="{{ route('admin.coin-launchpads.destroy', $lp->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this launchpad?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="inline-flex items-center px-3 py-1 rounded bg-red-600/20 border border-red-600 text-red-200 hover:brightness-110 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-4 py-4 text-gray-400" colspan="5">No launchpads yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $launchpads->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection