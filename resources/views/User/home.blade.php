@extends('User.inc.user_layout')

@section('content')
    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Latest Products</h2>
                        <a href="products.html">View all products <i class="fa fa-angle-right"></i></a>
                        <form action="{{ route("search") }}" method="get">
                            <input type="text" name="key" value="{{ old('key') }}" class="form-control" >
                            <button type="submit" class="btn btn-info mt-2 ">search</button>
                        </form>
                        @include('success')
                    </div>
                </div>

                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="product-item">
                            <a><img src="{{ asset("storage/$product->image") }}" alt=""></a>
                            <div class="down-content">
                                <a class="btn btn-success" href="{{ route('products.show', $product->id) }}">Show</a>
                                    <h4>{{ $product->title }}</h4>
                                </a>
                                <h6>{{ $product->price }}</h6>

                                <p>{{ $product->desc }}</p>
                                <form action="{{ route('add_to_cart', $product->id) }}" method="post">
                                    @csrf
                                <input type="number" name="qyt" >
                                <button type="submit" class="btn btn-success m-3">Add To Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
