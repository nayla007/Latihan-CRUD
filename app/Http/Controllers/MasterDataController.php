<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    // Menampilkan data user
    public function showUsers()
    {
        $users = User::all();
        return view('masterdata.users', compact('users'));
    }

    // Menampilkan form untuk menambah user
    public function createUser()
    {
        return view('masterdata.create_user');
        $maxId = User::max('id');
        $newId = $maxId + 1;

        // Simpan data baru dengan ID manual
    User::create([
        'id' => $newId,
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'email' => $request->email,
        'nomor_handphone' => $request->nomor_handphone,
    ]);
    }

    public function editUser($id)   
{
    $user = User::findOrFail($id);

    // Debug dengan dd untuk memeriksa apakah data supplier benar-benar diteruskan
    
    return view('masterdata.edit_user', compact('user'));
}

    // Menyimpan data user baru
    public function storeUser(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'nomor_handphone' => 'required'
        ]);

        User::create($request->all());

        return redirect()->route('master-data.user');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('master-data.user')->with('success', 'User berhasil dihapus');
    }

    // Fungsi untuk mengupdate data user
public function updateUser(Request $request, $id)
{
    // Validasi inputan
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'nomor_handphone' => 'nullable|string|max:15',
        'alamat' => 'required|string',
    ]);

    // Debug untuk memastikan data yang diterima
    dd($validated);

    // Cari user berdasarkan ID
    $user = User::findOrFail($id);

    // Update data user
    $user->nama = $validated['nama'];
    $user->alamat = $validated['alamat'];
    $user->email = $validated['email'];
    $user->nomor_handphone = $validated['nomor_handphone'];

    // Simpan perubahan
    $user->save();

    // Redirect dengan pesan sukses
    return redirect()->route('master-data.user')->with('success', 'User updated successfully!');
}

    // Menampilkan data supplier
    public function showSuppliers()
    {
        $suppliers = Supplier::all();
        return view('masterdata.suppliers', compact('suppliers'));
    }

    // Menampilkan form untuk menambah supplier
    public function createSupplier()
    {
        return view('masterdata.create_supplier');

        $newId = $maxId + 1;

        // Simpan data baru dengan ID manual
    Supplier::create([
        'id' => $newId,
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'email' => $request->email,
        'nomor_handphone' => $request->nomor_handphone,
    ]);
    }

    // Menyimpan data supplier baru
    public function storeSupplier(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'nomor_handphone' => 'required|string',
        ]);

        // Simpan data supplier 
        Supplier::create([ 
            'nama' => $request->nama, 
            'alamat' => $request->alamat, 
            'email' => $request->email, 
            'nomor_handphone' => $request->nomor_handphone, 
            'created_at' => now(), 
            'updated_at' => now(), 
        ]);

        return redirect()->route('master-data.supplier')->with('success', 'Supplier created successfully.');
    }

    // Menampilkan data material
    public function showMaterials()
    {
        $materials = Material::all();
        return view('masterdata.materials', compact('materials'));
    }

    // Menampilkan form untuk menambah material
    public function createMaterial()
    {
        return view('masterdata.create_material');

        $newId = $maxId + 1;

        // Simpan data baru dengan ID manual
    Material::create([
        'id' => $newId,
        'nama_material' => $request->nama_material,
        'unit' => $request->unit,
        'harga' => $request->harga,
        'brand' => $request->brand,
        'part_number' => $request->part_number,
        'deskripsi' => $request->deskripsi,
    ]);
    }

    // Menyimpan data material baru
    public function storeMaterial(Request $request)
    {
        $request->validate([
            'nama_material' => 'required',
            'unit' => 'required',
            'harga' => 'required|integer',
            'brand' => 'required',
            'part_number' => 'required',
            'deskripsi' => 'required|string'
        ]);

        Material::create($request->all());

        return redirect()->route('master-data.material')->with('success', 'Material created successfully.');
    }

    // Menampilkan data purchase order
    public function showPurchaseOrders()
    {
        // Pastikan untuk menggunakan eager loading dengan benar
    $purchaseOrders = PurchaseOrder::with('material', 'supplier')->get();
        return view('masterdata.purchase_orders', compact('purchaseOrders'));
    }

    // Menampilkan form untuk menambah purchase order
    public function createPurchaseOrder()
    {
        $materials = Material::all();
        $suppliers = Supplier::all();
        return view('masterdata.create_purchase_orders', compact('materials', 'suppliers'));

        // Reset Auto-Increment ke 1
        DB::statement('ALTER TABLE purchase_orders AUTO_INCREMENT = 1');

        // Buat purchase order baru
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->nama_pembelian = 'New Order';
        $purchaseOrder->jumlah_pembelian = 1000;
        $purchaseOrder->tanggal = now();
        $purchaseOrder->material_id = 1;
        $purchaseOrder->supplier_id = 1;
        $purchaseOrder->deskripsi = 'Deskripsi Baru';
        $purchaseOrder->save();

        $newId = $maxId + 1;

        // Simpan data baru dengan ID manual
    PurchaseOrder::create([
        'id' => $newId,
        'nama_pembelian' => $request->nama_pembelian,
        'jumlah_pembelian' => $request->jumlah_pembelian,
        'tanggal' => $request->tanggal,
        'material_id' => $request->material_id,
        'supplier_id' => $request->supplier_id,
        'deskripsi' => $request->deskripsi,
    ]);

        return redirect()->route('master-data.purchase_order')->with('success', 'Purchase Order berhasil dibuat dan ID dimulai dari 1.');
    }

    // Menyimpan data purchase order baru
    public function storePurchaseOrder(Request $request)
    {
        $request->validate([
            'nama_pembelian' => 'required',
            'jumlah_pembelian' => 'required|integer',
            'tanggal' => 'required|date',
            'material_id' => 'required|exists:materials,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'deskripsi' => 'required'
        ]);

        PurchaseOrder::create($request->all());

        return redirect()->route('master-data.purchase_order')->with('success', 'Purchase Order created successfully.');
    }
    public function destroyPurchaseOrder($id)
    {
        // Temukan Purchase Order berdasarkan ID
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        // Hapus Purchase Order
        $purchaseOrder->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('master-data.purchase_order')
            ->with('success', 'Purchase Order berhasil dihapus');
    }

    // Fungsi untuk reset dan menghapus semua purchase order
    public function resetPurchaseOrders()
    {
        // Menghapus seluruh data di tabel purchase_orders
        DB::table('purchase_orders')->truncate();

        // Mengatur ulang auto-increment ke 1
        DB::statement('ALTER TABLE purchase_orders AUTO_INCREMENT = 1');

        // Buat purchase order baru setelah reset
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->nama_pembelian = 'New Order';
        $purchaseOrder->jumlah_pembelian = 1000;
        $purchaseOrder->tanggal = now();
        $purchaseOrder->material_id = 1;
        $purchaseOrder->supplier_id = 1;
        $purchaseOrder->deskripsi = 'Deskripsi Baru';
        $purchaseOrder->save();

        return redirect()->route('master-data.purchase-order')->with('success', 'All Purchase Orders have been reset and a new one has been created.');
    }

    public function editPurchaseOrder($id)   
{
    $purchaseOrder = PurchaseOrder::findOrFail($id);

    // Ambil semua material dan supplier untuk dropdown
    $materials = Material::all();
    $suppliers = Supplier::all();
    

    return view('masterdata.edit_order', compact('purchaseOrder', 'materials', 'suppliers'));
}
}
