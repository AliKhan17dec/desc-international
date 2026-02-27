@extends('admin.layout.app')
@section('sidebar')
    @include('admin.layout.partials.sidebar')
@endsection
@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">
    <h3 class="text-3xl font-bold mb-6 text-white">Edit Chain</h3>
    <div class="bg-crypto-card rounded-lg shadow border border-crypto-border p-6">
        <form method="POST" action="{{ route('admin.chains.update',$chain) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-2">Name</label>
                <input name="name" class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name',$chain->name) }}" required>
                @error('name')<small class="text-red-400">{{ $message }}</small>@enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-2">Symbol</label>
                <input name="symbol" class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('symbol',$chain->symbol) }}" required>
                @error('symbol')<small class="text-red-400">{{ $message }}</small>@enderror
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-2">Icon</label>
                <input type="file" name="icon" class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if($chain->icon)
                    <div class="mt-3">
                        <img src="{{ asset('storage/'.$chain->icon) }}" width="60" class="rounded">
                    </div>
                @endif
                @error('icon')<small class="text-red-400">{{ $message }}</small>@enderror
            </div>
            <div class="flex items-center mb-6">
                <input class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" type="checkbox" name="is_active" value="1" @checked($chain->is_active)>
                <label class="ml-2 text-sm font-medium text-gray-300">Active</label>
            </div>
            <div class="flex gap-3">
                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">Update</button>
                <a href="{{ route('admin.chains.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

