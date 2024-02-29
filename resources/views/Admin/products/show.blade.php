<!-- resources/views/Admin/products/show.blade.php -->

@extends('Admin.inc.admin_layout')

@section('content')
    @include('errors')
    @include('success')

    <div>
        <h1>{{ $product->title }}</h1>
        <p>Description: {{ $product->desc }}</p>
        <p>Price: {{ $product->price }}</p>
        <p>Quantity: {{ $product->quantity }}</p>
        <img src="{{ asset("storage/$product->image") }}" width="100px" alt="{{ $product->title }}" srcset="">

        {{-- Add more details as needed --}}

        {{-- Update and Delete buttons --}}
        <div class="mt-4">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Update</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>
        </div>

        {{-- Back button to the index page --}}
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-2">Back to Products</a>
    </div>
@endsection
