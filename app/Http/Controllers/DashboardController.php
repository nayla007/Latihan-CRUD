<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $userCount = User::count();
    $supplierCount = Supplier::count();
    $materialCount = Material::count();
    $purchaseOrderCount = PurchaseOrder::count();

    // Mengirim data ke view
    return view('dashboard.index', compact(
        'userCount',
        'supplierCount',
        'materialCount',
        'purchaseOrderCount'
    ));
}
}
