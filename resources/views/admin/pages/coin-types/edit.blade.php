@extends('admin.layout.app')
@section('sidebar')
    @include('admin.layout.partials.sidebar')
@endsection
@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">
    <h3 class="text-3xl font-bold mb-6 text-white">Edit Type</h3>
    <div class="bg-crypto-card rounded-lg shadow border border-crypto-border p-6">
        <form method="POST" action="{{ route('admin.coin-types.update',$type) }}">
            @csrf @method('PUT')
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-2">Name</label>
                <input name="name" class="w-full px-4 py-2 bg-crypto-dark border border-crypto-border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name',$type->name) }}" required>
                @error('name')<small class="text-red-400">{{ $message }}</small>@enderror
            </div>
            <div class="flex items-center mb-6">
                <input class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" type="checkbox" name="is_active" value="1" @checked($type->is_active)>
                <label class="ml-2 text-sm font-medium text-gray-300">Active</label>
            </div>
            <div class="flex gap-3">
                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">Update</button>
                <a href="{{ route('admin.coin-types.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

