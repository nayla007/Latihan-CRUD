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
    /// Menampilkan data supplier
    public function index()
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

        return redirect()->route('master-data.suppliers')->with('success', 'Supplier created successfully.');
    }
    // Menghapus supplier
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('master-data.supplier')->with('success', 'Supplier berhasil dihapus');
    }
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('masterdata.edit_supplier', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        // Validasi inputan
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'nomor_handphone' => 'nullable|string|max:15',
        'alamat' => 'required|string',
    ]);

    // Cari user berdasarkan ID
    $supplier = Supplier::findOrFail($id);

    // Update data user
    $supplier->nama = $validated['nama'];
    $supplier->alamat = $validated['alamat'];
    $supplier->email = $validated['email'];
    $supplier->nomor_handphone = $validated['nomor_handphone'];

    // Simpan perubahan
    $supplier->save();

    // Redirect dengan pesan sukses
    return redirect()->route('master-data.supplier')->with('success', 'Supplier updated successfully!');
    }

    // Menampilkan data supplier
    public function showSuppliers()
    {
        $suppliers = Supplier::all();
        return view('masterdata.suppliers', compact('suppliers'));
    }
}
