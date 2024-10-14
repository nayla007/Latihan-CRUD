<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('masterdata.edit_material', compact('material'));
    }

    public function update(Request $request, $id)
    {
        // Validasi dan update material
        $request->validate([
            'nama_material' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'harga' => 'required|integer',
            'brand' => 'nullable|string|max:255',
            'part_number' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $material = Material::findOrFail($id);
        $material->update($request->all());

        return redirect()->route('master-data.material')->with('success', 'Material updated successfully.');
    }

    public function destroyMaterial($id)
    {
        $supplier = Material::findOrFail($id);
        $supplier->delete();
        return redirect()->route('master-data.material')->with('success', 'Supplier berhasil dihapus');
    }
}
