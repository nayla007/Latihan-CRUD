@extends('adminlte::page')

@section('title', 'Product CRUD')

@section('content_header')
    <h1>Product CRUD</h1>
@stop

@section('css')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <style>
        .img-small {
            width: 70px !important;
            height: 70px !important;
            object-fit: cover;
        }
        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
            object-fit: cover;
        }
        .card{
           width: 1500px;
        }
    </style>
@stop

@section('content')
<button class="btn btn-primary mb-3" id="addProductBtn">
    <i class="fas fa-plus"></i> Add Product</button>
<div class="col-md-12">
    
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Products</h3>
    </div>
    <div class="card-body">
                <table id="productsTable" class="table DataTable table-hovered table-bordered">
                    
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
                                <td><img src="{{ $product->thumbnail }}" class="img-thumbnail" onerror="this.src='https://via.placeholder.com/50?text=No+Image'" /></td> 
                                <td>
                                    @php
                                        $images = json_decode($product->images);
                                        $thumbnail = $images[0]; // Ambil gambar pertama sebagai thumbnail
                                    @endphp
                                    <img src="{{ $thumbnail }}" onerror="this.src='https://via.placeholder.com/50?text=No+Image'" />
                                    <br />
                                    @foreach(array_slice($images, 1) as $image) <!-- Gambar selain thumbnail -->
                                    <img src="{{ $image }}" class="img-small" onerror="this.src='https://via.placeholder.com/50?text=No+Image'" /> 
                                    @endforeach
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>
    </div>
            </div>
</div>
@stop

@section('js')
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>

$(document).ready(function() {
    let table = new DataTable('#productsTable', {
        "pageLength": 10,
        "lengthMenu":[10, 25, 50, 100],
        createdRow: function(row, data, dataIndex) {
            // Adjust thumbnail image size
            $('td:eq(9) img', row).addClass('img-thumbnail').css({ width: '50px', height: '50px', objectFit: 'cover' });
            // Adjust images size in the images column
            $('td:eq(10) img', row).addClass('img-small').css({ width: '70px', height: '70px', objectFit: 'cover' });
        }
        

    });
});


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
                    <td><img src="${product.thumbnail}" class="img-thumbnail" /></td>
                    <td>
                        ${product.images.map(image => {
                            return `<img src="${image}" class="img-small" onerror="this.src='https://via.placeholder.com/50?text=No+Image'" />`;
                        }).join('')}
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
