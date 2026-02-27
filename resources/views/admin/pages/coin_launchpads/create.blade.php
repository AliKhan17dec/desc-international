@extends('admin.layout.app')

@section('sidebar')
    @include('admin.layout.partials.sidebar')
@endsection

@section('content')
    <div class="w-full overflow-x-hidden custom-scrollbar">
        <div class="content-area page-transition m-4 md:m-6">
            <div class="p-4 md:p-6 bg-crypto-accent rounded-xl text-white">
                <h2 class="text-2xl font-semibold mb-4 text-crypto-primary">Create Coin Launchpad</h2>

                <form action="{{ route('admin.coin-launchpads.store') }}" method="POST">
                    @csrf
                    @include('admin.pages.coin_launchpads._form', ['mode' => 'create'])
                </form>
            </div>
        </div>
    </div>
@endsection