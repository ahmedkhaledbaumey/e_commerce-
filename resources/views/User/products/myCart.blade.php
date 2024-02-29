@extends('User.inc.user_layout')

@section('content')

<div class="latest-products">
    @auth
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Latest Products</h2>
                    <a href="{{ route('user') }}">View All Products <i class="fa fa-angle-right"></i></a>
                </div>
            </div>

                {{-- Check if $products is not null --}}
                @if($products)
                    @forelse ($products as $product)
                        <div class="col-md-4">
                            <div class="product-item">
                                <a><img src="{{ asset("storage/{$product['image']}") }}" alt=""></a>
                                <h4>{{ $product['title'] }}</h4>
                                <h6>{{ $product['price'] }}</h6>
                                <p>{{ $product['qyt'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <h1>Nothing to Confirm. Choose Products</h1>
                        </div>
                    @endforelse

                    <div class="col-md-12">
                        <form action="{{ route('makeOrder') }}" method="POST">
                            @csrf
                            <input type="date" name="day">
                            <button type="submit" class="btn btn-success m-3">Add To Cart</button>
                        </form>
                    </div>
                @else
                    <div class="col-md-12">
                        <h1>Nothing to Confirm. Choose Products</h1>
                    </div>
                @endif
            </div>
        </div>
        @endauth
        <div class="col-md-12">
            <h1 style="text-align: center;">Pleas Login To Can Buy </h1>
        </div>

</div>
</div>
    </div>

@endsection
