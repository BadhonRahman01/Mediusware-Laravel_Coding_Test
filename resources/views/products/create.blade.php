@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
    </div>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
    </form>
    <div id="app">
        <create-product :variants="{{ $variants }}">Loading</create-product>
    </div>
@endsection
