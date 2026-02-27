@extends('admin.layout.app')
@section('sidebar')
    @include('admin.layout.partials.sidebar')
@endsection
@section('content')
<div class="px-6 py-8 max-w-7xl mx-auto">
    <h3 class="text-3xl font-bold mb-6 text-white">Add Coin</h3>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-900 text-red-200 rounded-lg">Please fix the errors below.</div>
    @endif

    <div class="bg-crypto-card rounded-lg shadow border border-crypto-border p-6">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.coins.store') }}">
            @include('admin.pages.coins._form', ['coin' => null])
        </form>
    </div>
</div>
@endsection

