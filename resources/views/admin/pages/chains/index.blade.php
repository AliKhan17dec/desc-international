@extends('admin.layout.app')
@section('sidebar')
    @include('admin.layout.partials.sidebar')
@endsection
@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold">Chains</h3>
        <a class="px-4 py-2 bg-crypto-primary text-crypto-accent rounded-lg hover:bg-crypto-primary/80 transition" href="{{ route('admin.chains.create') }}">Add Chain</a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="bg-crypto-card rounded-lg shadow border border-crypto-border">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-crypto-border bg-crypto-dark">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Icon</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Symbol</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300">Active</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($chains as $ch)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">
                            @if($ch->icon)
                                <img src="{{ asset('storage/'.$ch->icon) }}" width="32" height="32" class="rounded-full">
                            @else
                                <div class="rounded-full bg-gray-300" style="width:32px;height:32px;"></div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-300">{{ $ch->name }}</td>
                        <td class="px-6 py-4"><code class="bg-gray-100 px-2 py-1 rounded text-sm">{{ $ch->symbol }}</code></td>
                        <td class="px-6 py-4 text-gray-300">{{ $ch->is_active ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 text-right">
                            <a class="inline-block px-3 py-1 bg-amber-500 text-white text-sm rounded hover:bg-amber-600 transition mr-2" href="{{ route('admin.chains.edit',$ch) }}">Edit</a>
                            <form class="inline-block" method="POST" action="{{ route('admin.chains.destroy',$ch) }}"
                                  onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $chains->links() }}
        </div>
    </div>
</div>
@endsection

