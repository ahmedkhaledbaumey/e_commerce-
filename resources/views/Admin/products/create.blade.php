@extends('Admin.inc.admin_layout')

@section('content')
@include('errors')
@include('success')

<form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">product title</label>
      <input type="text" name="title" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">product desc</label>
        <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter desc"></textarea>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">product quantity</label>
        <input type="number" name="quantity" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">product Price</label>
        <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">category name</label>
        <select name="category_id" id="">

            @foreach ($categories as  $category )

            <option value="{{$category->id}}">{{ $category['title'] }}</option>

            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">product image</label>
        <input type="file" name="image" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
