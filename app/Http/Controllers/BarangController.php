<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with('kategori');

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Filter kategori dengan opsi "semua" dan "tanpa"
        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            if ($request->kategori === 'tanpa') {
                $query->whereNull('kategori_id');
            } else {
                $query->where('kategori_id', $request->kategori);
            }
        }
        // if ($request->filled('kategori') && $request->kategori !== 'semua') {
        //     $query->where('kategori_id', $request->kategori);
        // }

        $barangs = $query->paginate(10)->withQueryString();

        $totalBarang    = Barang::count();
        $totalKategori  = Kategori::count();
        $stokMenipis    = Barang::where('jumlah_stok', '>', 0)->where('jumlah_stok', '<', 20)->count();
        $stokHabis      = Barang::where('jumlah_stok', 0)->count();
        $kategoris      = Kategori::all();
        $adaTanpaKategori = Barang::whereNull('kategori_id')->exists();

        return view('dashboard.index', compact(
            'barangs', 'totalBarang', 'totalKategori',
            'stokMenipis', 'stokHabis', 'kategoris', 'adaTanpaKategori'
        ));
    }

    public function show($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang'   => 'required|string|max:255',
            'kategori_id'   => 'required|exists:kategoris,id',
            'jumlah_stok'   => 'required|integer|min:0',
            'satuan'        => 'required|string|max:50',
            'stok_minimum'  => 'required|integer|min:0',
            'harga_jual'    => 'required|numeric|min:0',
            'harga_beli'    => 'required|numeric|min:0',
            'berat_ukuran'  => 'nullable|string|max:100',
            'lokasi_simpan' => 'nullable|string|max:100',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);
        
        $validated['stok_minimum'] = 20; 

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/foto'), $filename);
            $validated['foto'] = $filename;
        }

        Barang::create($validated);

        return redirect()->route('dashboard')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang    = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'nama_barang'   => 'required|string|max:255',
            'kategori_id'   => 'required|exists:kategoris,id',
            'jumlah_stok'   => 'required|integer|min:0',
            'satuan'        => 'required|string|max:50',
            'stok_minimum'  => 'required|integer|min:0',
            'harga_jual'    => 'required|numeric|min:0',
            'harga_beli'    => 'required|numeric|min:0',
            'berat_ukuran'  => 'nullable|string|max:100',
            'lokasi_simpan' => 'nullable|string|max:100',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $validated['stok_minimum'] = 20;

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($barang->foto && file_exists(public_path('storage/foto/' . $barang->foto))) {
                unlink(public_path('storage/foto/' . $barang->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/foto'), $filename);
            $validated['foto'] = $filename;
        }

        $barang->update($validated);

        return redirect()->route('barang.show', $barang->id)->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->foto && file_exists(public_path('storage/foto/' . $barang->foto))) {
            unlink(public_path('storage/foto/' . $barang->foto));
        }

        $barang->delete();

        return redirect()->route('dashboard')->with('success', 'Barang berhasil dihapus!');
    }
}
