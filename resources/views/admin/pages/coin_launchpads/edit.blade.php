@extends('admin.layout.app')

@section('sidebar')
    @include('admin.layout.partials.sidebar')
@endsection

@section('content')
    <div class="w-full overflow-x-hidden custom-scrollbar">
        <div class="content-area page-transition m-4 md:m-6">
            <div class="p-4 md:p-6 bg-crypto-accent rounded-xl text-white">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-semibold text-crypto-primary">Edit Coin Launchpad</h2>

                    <a href="{{ route('admin.coin-launchpads.index') }}"
                        class="px-3 py-2 rounded bg-zinc-800 border border-zinc-600 hover:border-crypto-primary transition">
                        Back
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-3 rounded bg-green-600/20 border border-green-600 text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.coin-launchpads.update', $launchpad->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.pages.coin_launchpads._form', ['mode' => 'edit'])
                </form>
            </div>
        </div>
    </div>
@endsection