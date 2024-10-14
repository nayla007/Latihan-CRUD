<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function cleanDuplicates()
    {
        // Ambil semua supplier yang duplikat
        $duplicates = Supplier::select('nama', 'alamat', 'email', 'nomor_telepon')
            ->groupBy('nama', 'alamat', 'email', 'nomor_telepon')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        // Loop untuk menghapus duplikat
        foreach ($duplicates as $duplicate) {
            $idsToDelete = Supplier::where('nama', $duplicate->nama)
                ->where('alamat', $duplicate->alamat)
                ->where('email', $duplicate->email)
                ->where('nomor_telepon', $duplicate->nomor_telepon)
                ->where('id', '!=', $duplicate->id) // Menghindari penghapusan data yang ingin dipertahankan
                ->pluck('id');

            Supplier::destroy($idsToDelete);
        }

        return response()->json(['message' => 'Duplikat telah dihapus']);
    }

    public function deleteSuppliers()
    {
        // Hapus supplier dengan ID antara 20 sampai 29
        Supplier::whereBetween('id', [10, 19])->delete();

        // Reset sequence ID di PostgreSQL (menyesuaikan dengan nama sequence)
        DB::statement("SELECT setval('suppliers_id_seq', 1, false)");

        // Kembali ke halaman daftar supplier dengan pesan sukses
        return redirect()->route('master-data.supplier')->with('success', 'Suppliers deleted and IDs reset.');
    }
    // Menyimpan data supplier baru
    public function store(Request $request)
    {
        Supplier::create($request->all());
        return redirect()->route('master-data.supplier')->with('success', 'Supplier berhasil ditambahkan');
    }
    // Menghapus supplier
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('master-data.supplier')->with('success', 'Supplier berhasil dihapus');
    }
    // Menampilkan form edit supplier
    // Menampilkan form edit supplier
    public function edit($id)
{
    $supplier = Supplier::findOrFail($id);

    // Debug dengan dd untuk memeriksa apakah data supplier benar-benar diteruskan
    

    return view('masterdata.edit_supplier', compact('supplier'));
}
}
