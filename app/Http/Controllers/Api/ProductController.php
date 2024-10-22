<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{

    //menampilkan semua produk
    public function index(){
        $products = Product::all();
        return view('products.index', compact('products'));

// Cek apakah images berupa string JSON dan decode
if (is_string($product->images)) {
    $product->images = json_decode($product->images, true);
}

// Jika images berupa string dengan URL yang dipisah koma
if (is_string($product->images)) {
    $product->images = explode(',', $product->images);
}

// Trim setiap URL jika ada spasi
$product->images = array_map('trim', $product->images);

// Debugging: Cek hasil dari images setelah diubah
dd($product->images);
    }

    //
    public function show($id){
        $products = Product::find($id);
        return response()->json($products);
    }


    //menampilkan form untuk menambah produk
    public function create(){
        
    }
}
