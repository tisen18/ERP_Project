<?php

namespace App\Http\Controllers;

use App\Models\tb_produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = tb_produk::latest()->get();
        return view ('Manufacture.produk', compact('produk'));
    }

    public function cetakProduk()
    {
        $dtProduk = tb_produk::get();
        return view ('Manufacture.cetak-produk', compact('dtProduk'));
    }

    public function create()
    {
        return view ('Manufacture.input-produk');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kode' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg:max:2048'
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = time()."_".$gambar->getClientOriginalName();
        $simpan_gambar = 'img_produk';
        $gambar->move($simpan_gambar, $nama_gambar);

        tb_produk::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' =>  $nama_gambar
        ]);
        return redirect('Manufacture/produk');
    }

    public function edit($id)
    {
        $produk = tb_produk::findorfail($id);
        return view ('Manufacture.edit-produk', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'kode' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg:max:2048'
        ]);

        $produk = tb_produk::find($id);
        $produk->nama = $request->nama;
        $produk->kode = $request->kode;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        if($request->hasfile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time()."_".$gambar->getClientOriginalName();
            $simpan_gambar = 'img_produk';
            $gambar->move($simpan_gambar, $nama_gambar);
        
            // Hapus gambar lama
            File::delete('img_produk/'.$produk->gambar);
        
            // Simpan gambar baru
            $produk->gambar = $nama_gambar;
        }
        

        $produk->save();
        return redirect('Manufacture/produk');
    }

    public function destroy($id)
    {
        // hapus file
        $produk = tb_produk::find($id);
        File::delete('img_produk/'.$produk->gambar);
      
        // hapus data
        $produk->delete();
        return back();  
    }
}



