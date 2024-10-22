@extends('adminlte::page')

@section('title', 'Product CRUD')

@section('content_header')
    <h1>Product CRUD</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary" id="addProductBtn">Add Product</button>
                <table id="productsTable" class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Rating</th>
                            <th>Stock</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Thumbnail</th>
                            <th>Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productsList">
                        @foreach($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>                                                                                                                                               
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discountPercentage }}</td>
                                <td>{{ $product->rating }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{ $product->category }}</td>
                                <td><img src="{{ $product->thumbnail }}" style="width: 150px; height: 150px; object-fit: cover;"/></td>
                                <td>
                                    @php
                                        $images = json_decode($product->images);
                                        $thumbnail = $images[0]; // Ambil gambar pertama sebagai thumbnail
                                    @endphp
                                    <img src="{{ $thumbnail }}" style="width: 150px; height: 150px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/50?text=No+Image'" />
                                    <br />
                                    @foreach(array_slice($images, 1) as $image) <!-- Gambar selain thumbnail -->
                                        <img src="{{ $image }}" width="70" height="70" onerror="this.src='https://via.placeholder.com/50?text=No+Image'" />
                                    @endforeach
                                </td>
                                <td>
                                    <button class="btn btn-warning">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    const apiUrl = 'https://dummyjson.com/products';

    // Fetch products from API
    async function fetchProducts() {
        const res = await fetch(apiUrl);
        const data = await res.json();
        const tableBody = document.getElementById('productsList');
        tableBody.innerHTML = '';

        //INI YAA BIAR URUT
        let newId = 1;

        data.products.forEach(product => {
            const row = `
                <tr>
                    <td>${newId++}</td> <!-- ID berurutan -->
                    <td>${product.title}</td>
                    <td>${product.description}</td>
                    <td>${product.price}</td>
                    <td>${product.discountPercentage}</td>
                    <td>${product.rating}</td>
                    <td>${product.stock}</td>
                    <td>${product.brand}</td>
                    <td>${product.category}</td>
                    <td><img src="${product.thumbnail}" width="50" height="50" /></td>
                    <td>
                        ${product.images.map(image => {
                            return `<img src="${image}" width="70" height="70" onerror="this.src='https://via.placeholder.com/50?text=No+Image'" />`;
                        }).join('')}
                    </td>
                    <td>
                        <button class="btn btn-warning" onclick="editProduct(${product.id})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteProduct(${product.id})">Delete</button>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }

    // Call the fetch function on page load
    fetchProducts();
</script>
@stop
