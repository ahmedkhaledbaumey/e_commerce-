@extends('Admin.inc.admin_layout')

@section('content')
@include('errors')
@include('success')

<form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="exampleInputEmail1">Product Title</label>
        <input type="text" name="title" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" value="{{ $product->title }}">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Product Desc</label>
        <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter desc">{{ $product->desc }}</textarea>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Product Quantity</label>
        <input type="number" name="quantity" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter quantity" value="{{ $product->quantity }}">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Product Price</label>
        <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price" value="{{ $product->price }}">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Category Name</label>
        <select name="category_id" id="">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Product Image</label>
        <input type="file" name="image" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
