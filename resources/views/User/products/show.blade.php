
@extends('User.inc.user_layout')
@section('content')
    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>


          <div class="col-md-4">
            <div class="product-item">
                <a><img src="{{ asset("storage/$product->image") }}" alt=""></a>
                                <h4>{{ $product->title }}</h4>
                <h6>{{ $product->price }}</h6>
                <p>{{ $product->desc }}</p>

              </div>
            </div>
          </div>


            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection 

