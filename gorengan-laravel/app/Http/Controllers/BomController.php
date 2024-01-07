<?php

namespace App\Http\Controllers;


use App\Models\tb_bom;
use App\Models\tb_bomlist;
use App\Models\tb_produk;
use App\Models\tb_bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BomController extends Controller
{
    public function material()
    {
        $bom = tb_bom::join('tb_produk', 'tb_bom.kode_produk', '=', 'tb_produk.id')->get(['tb_bom.*', 'tb_produk.nama']);
        return view('bom.bom', ['tb_bom' => $bom]);
    }

    public function materialInput()
    {
        $produk = tb_produk::get();
        return view('bom.input-bom', ['products' => $produk]);
    }

    public function materialInputItems($kode_bom)
    {
        $bom = tb_bom::join('tb_produk', 'tb_bom.kode_produk', '=', 'tb_produk.id')->where('tb_bom.kode_bom', $kode_bom)->first(['tb_bom.*', 'tb_produk.nama','tb_produk.harga']);
        $bomList = tb_bomlist::join('tb_bahan', 'tb_bomlist.kode_bahan', '=', 'tb_bahan.id')->where('tb_bomlist.kode_bom', $kode_bom)->get(['tb_bomlist.*', 'tb_bahan.nama', 'tb_bahan.harga']);
        $produk = tb_bahan::get();
        return view('bom.input-item-bom', ['bom' => $bom, 'materials' => $produk, 'list' => $bomList]);
    }

    public function upload(Request $request)
    {
        tb_bom::create([
            'kode_bom' => $request->kode_bom,
            'kode_produk' => $request->kode_produk,
            'kuantitas' => $request->kuantitas,
            'total_harga' => 0,
        ]);
        return redirect('bom/input-item-bom/' . $request->kode_bom);
    }

    public function uploadList(Request $request)
    {
        tb_bomlist::create([
            'kode_bom' => $request->kode_bom,
            'kode_bahan' => $request->kode_bahan,
            'kuantitas' => $request->kuantitas,
            'satuan' => $request->satuan
        ]);
        $product = tb_bahan::find($request->kode_bahan);
        $harga = $product->harga;
        $bom = tb_bom::find($request->kode_bom);
        $harga_lama = $bom->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->kuantitas);

        $bom->total_harga = $harga_baru;
        $bom->save();

        return redirect('bom/input-item-bom/' . $request->kode_bom);
    }

    public function deleteList($kode_bom_list){
        $bom_list = tb_bomlist::where('kode_bom_list',$kode_bom_list);
        $product = tb_bahan::find($bom_list->kode_bahan);
        $harga = $product->harga;
        $bom = tb_bom::find($bom_list->kode_bom);
        $harga_lama = $bom->total_harga;
        $harga_baru = $harga_lama - ($harga * $bom_list->kuantitas);

        $bom->total_harga = $harga_baru;
        $bom_list->delete();
       return redirect('bom/input-item-bom/' .$bom_list->kode_bom);
    }

    public function deleteBom($kode_bom){
        $bom_list = tb_bomlist::where('kode_bom', $kode_bom);
        $bom_list->delete();

        $bom = tb_bom::find($kode_bom);
        $bom->delete();
       return redirect('bom/bom/');
    }

    public function cetakBom()
    {
        $bom = tb_bom::join('tb_produk', 'tb_bom.kode_produk', '=', 'tb_produk.id')
            ->get(['tb_bom.*', 'tb_produk.nama']);
        return view ('bom.cetak-bom', compact('bom'));
    }


}