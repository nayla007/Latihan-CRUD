<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
   // Menampilkan daftar Purchase Order
   public function index()
   {
    $purchaseOrders = PurchaseOrder::with(['material', 'supplier'])->get();
    return view('masterdata.purchase_orders', compact('purchaseOrders'));  // pastikan view ini ada
   }

   // Menampilkan form untuk menambah Purchase Order
   
}
