@extends('admin.layout.app')
@section('sidebar')
    @include('admin.layout.partials.sidebar')
@endsection
@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold text-white">Coin Types</h3>
        <a class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" href="{{ route('admin.coin-types.create') }}">Add Type</a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-900 text-green-200 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="bg-crypto-card rounded-lg shadow border border-crypto-border">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-crypto-border bg-crypto-dark">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Icon</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Active</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($types as $t)
                    <tr class="border-b border-crypto-border hover:bg-crypto-dark transition">
                        <td class="px-6 py-4 text-white">{{ $t->name }}</td>
                        <td class="px-6 py-4 text-white">{!!   $t->icon !!} <small class="text-gray-500"><code>({{ $t->icon }})</code></small></td>
                        <td class="px-6 py-4 text-gray-300">{{ $t->is_active ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 text-right">
                            <a class="inline-block px-3 py-1 bg-amber-600 text-white text-sm rounded hover:bg-amber-700 transition mr-2" href="{{ route('admin.coin-types.edit',$t) }}">Edit</a>
                            <form class="inline-block" method="POST" action="{{ route('admin.coin-types.destroy',$t) }}"
                                  onsubmit="return confirm('Delete?')">
                                @csrf 
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-crypto-border">
            {{ $types->links() }}
        </div>
    </div>
</div>
@endsection

