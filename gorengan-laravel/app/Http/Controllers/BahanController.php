<?php

namespace App\Http\Controllers;

use App\Models\tb_bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class BahanController extends Controller
{
    public function index()
    {
        $bahan = tb_bahan::latest()->get();
        return view ('Manufacture.bahan', compact('bahan'));
    }

    public function cetakBahan()
    {
        $dtBahan = tb_bahan::get();
        return view ('Manufacture.cetak-bahan', compact('dtBahan'));
    }

    public function create()
    {
        return view ('Manufacture.input-bahan');
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
        $simpan_gambar = 'img_bahan';
        $gambar->move($simpan_gambar, $nama_gambar);

        tb_bahan::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' =>  $nama_gambar
        ]);
        return redirect('Manufacture/bahan');
    }

    public function edit($id)
    {
        $bahan = tb_bahan::findorfail($id);
        return view ('Manufacture.edit-bahan', compact('bahan'));
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

        $bahan = tb_bahan::find($id);
        $bahan->nama = $request->nama;
        $bahan->kode = $request->kode;
        $bahan->harga = $request->harga;
        $bahan->stok = $request->stok;

        if($request->hasfile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time()."_".$gambar->getClientOriginalName();
            $simpan_gambar = 'img_bahan';
            $gambar->move($simpan_gambar, $nama_gambar);
        
            // Hapus gambar lama
            File::delete('img_bahan/'.$produk->gambar);
        
            // Simpan gambar baru
            $produk->gambar = $nama_gambar;
        }

        $bahan->save();
        return redirect('Manufacture/bahan');
    }

    public function destroy($id)
    {
        // hapus file
        $bahan = tb_bahan::find($id);
        File::delete('img_bahan/'.$bahan->gambar);
        // hapus data
        $bahan->delete();
        return back();
    }
}
