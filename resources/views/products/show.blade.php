@extends('adminlte::page')

@section('title', 'Product Details')

@section('content_header')
    <h1>Product Details</h1>
@endsection

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $product['id'] }}</td>
        </tr>
        <tr>
            <th>Title</th>
            <td>{{ $product['title'] }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $product['description'] }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>{{ $product['price'] }}</td>
        </tr>
        <tr>
            <th>Discount Percentage</th>
            <td>{{ $product['discountPercentage'] }}</td>
        </tr>
        <tr>
            <th>Rating</th>
            <td>{{ $product['rating'] }}</td>
        </tr>
        <tr>
            <th>Stock</th>
            <td>{{ $product['stock'] }}</td>
        </tr>
        <tr>
            <th>Brand</th>
            <td>{{ $product['brand'] }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $product['category'] }}</td>
        </tr>
        <tr>
            <th>Thumbnail</th>
            <td><img src="{{ $product['thumbnail'] }}" alt="Thumbnail" class="img-fluid"></td>
        </tr>
        <tr>
            <th>Images</th>
            <td>
                @foreach($product['images'] as $image)
                    <img src="{{ $image }}" alt="Image" class="img-fluid">
                @endforeach
            </td>
        </tr>
    </table>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
@endsection