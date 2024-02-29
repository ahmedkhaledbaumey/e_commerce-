@extends('Admin.inc.admin_layout')

@section('content')
    @include('errors')
    @include('success')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Desc</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->desc }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td><img src="{{ asset("storage/$product->image") }}" width="100px" alt="" srcset=""></td>
                    <td>
                        {{-- You can uncomment and modify the following lines based on your needs --}}
                        {{-- <form action="{{ url("deleteProduct/$product->id") }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form> --}}
                        {{-- <h1>
                            <a class="btn btn-success" href="{{ url("editProduct/$product->id") }}">Edit</a>
                        </h1> --}}
                        <h1>
                            <a class="btn btn-success" href="{{ route('admin.products.show', $product->id) }}">Show</a>

                            {{-- <a class="btn btn-success" href="{{ route('products.show', $product->id) }}">Show</a> --}}
                        </h1>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
