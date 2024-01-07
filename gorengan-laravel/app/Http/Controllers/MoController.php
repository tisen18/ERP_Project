<?php

namespace App\Http\Controllers;

use App\Models\tb_bom;
use App\Models\tb_bomlist;
use App\Models\tb_produk;
use App\Models\tb_bahan;
use App\Models\tb_mo;
use App\Models\temp_produce;
use Illuminate\Http\Request;
use File;
use Image;
use PDF;

class MoController extends Controller
{
    public function manufacture()
    {
        $moDatas = tb_mo::join('tb_bom', 'tb_mo.kode_bom', '=', 'tb_bom.kode_bom')
            ->join('tb_produk', 'tb_bom.kode_produk', '=', 'tb_produk.id')
            ->get(['tb_mo.*', 'tb_produk.nama']);
        $boms = tb_bom::join('tb_produk', 'tb_bom.kode_produk', '=', 'tb_produk.id')
            ->get(['tb_bom.*', 'tb_produk.nama']);
        // return view('tb_mo.mo', ['moDatas' => $moDatas, 'tb_bom' => $bom]);
        return view('mo.mo', ['moDatas' => $moDatas, 'tb_bom' => $boms]);

    }

    public function manufactureOrder()
    {
        // $moDatas = MO::join('bom', 'mo.kode_bom', '=', 'bom.kode_bom')
        //     ->join('produk', 'bom.kode_produk', '=', 'produk.id')
        //     ->get(['mo.*', 'produk.nama']);
        $boms = tb_bom::join('tb_produk', 'tb_bom.kode_produk', '=', 'tb_produk.id')
            ->get(['tb_bom.*', 'tb_produk.nama']);
        return view('mo.mo-input', ['tb_bom' => $boms]);
    }
    
    public function moUpload(Request $request)
    {
        $tanggal = date("Y/m/d");
        tb_mo::create([
            'kode_mo' => $request->kode_mo,
            'kode_bom' => $request->kode_bom,
            'kuantitas' => $request->kuantitas,
            'tanggal'=> $tanggal,
            'status' => 1,
        ]);
        // $moDatas = MO::join('bom', 'mo.kode_bom', '=', 'bom.kode_bom')
        //     ->join('produk', 'bom.kode_produk', '=', 'produk.id')
        //     ->get(['mo.*', 'produk.nama']);
        // $boms = BOM::join('produk', 'bom.kode_produk', '=', 'produk.id')
        //     ->get(['bom.*', 'produk.nama']);
        return redirect('Manufacture/mo');
    }

    public function moUpdate($kode_mo, Request $request)
    {
        $mo = tb_mo::find($kode_mo);
        $mo->status = $mo->status + 1;
        $mo->kode_bom =  $mo->kode_bom;
        $mo->kuantitas =  $mo->kuantitas;
        $mo->tanggal =  $mo->tanggal;
        $mo->save();
        // $moDatas = MO::join('bom', 'mo.kode_bom', '=', 'bom.kode_bom')
        //     ->join('produk', 'bom.kode_produk', '=', 'produk.id')
        //     ->get(['mo.*', 'produk.nama']);
        // $boms = BOM::join('produk', 'bom.kode_produk', '=', 'produk.id')
        //     ->get(['bom.*', 'produk.nama']);
        return redirect('Manufacture/mo');
    }

    public function getAvailability($tb_bomlist, $tb_mo)
    {
        $avail = true;
        foreach ($tb_bomlist as $item) {
            if ($item->kuantitas < ($item->kuantitas * $tb_mo->kuantitas)) {
                $avail = false;
            } else {
                $avail = true;
            }
        }
        return $avail;
    }

    public function caItems($kode_mo)
    {
        $mo = tb_bom::find($kode_mo);
        $kode_bom = $mo->kode_bom;
        $bom = tb_bom::join('tb_produk', 'tb_bom.kode_produk', '=', 'tb_produk.id')
            ->where('tb_bom.kode_bom', $kode_bom)
            ->first(['tb_bom.*', 'tb_produk.nama', 'tb_produk.harga']);
        $bomList = tb_bomlist::join('tb_bahan', 'tb_bomlist.kode_bahan', '=', 'tb_bahan.id')
            ->where('tb_bomlist.kode_bom', $kode_bom)
            ->get(['tb_bomlist.*', 'tb_bahan.nama', 'tb_bahan.harga', 'tb_bahan.stok']);
        $produk = tb_bahan::get();
        $avail = $this->getAvailability($bomList, $mo);
        return view('tb_mo.mo-ca', ['tb_bom' => $bom, 'materials' => $produk, 'tb_mo' => $mo, 'list' => $bomList, 'avail' => $avail]);
    }

    public function moProduce($kode_mo)
    {
        $mo = tb_mo::find($kode_mo);
        $kode_bom = $mo->kode_bom;
        $bomList = tb_bomlist::join('tb_bahan', 'tb_bomlist.kode_bahan', '=', 'tb_bahan.id')
            ->where('tb_bomlist.kode_bom', $kode_bom)
            ->get(['tb_bomlist.*', 'tb_bahan.nama', 'tb_bahan.harga', 'tb_bahan.stok']);
        foreach ($bomList as $list) {
            temp_produce::create([
                'kode_bomlist' => $list->kode_bomlist,
                'quantity_order' => $list->kuantitas * $mo->kuantitas,
            ]);
        }
        $mo->status = $mo->status + 1;
        $mo->save();
        return redirect('Manufacture/mo');
    }

    public function moProsesProduce($kode_mo)
    {
        $mo = tb_mo::find($kode_mo);
        $kode_bom = $mo->kode_bom;
        $bomList = tb_bomlist::join('tb_bahan', 'tb_bomlist.kode_bahan', '=', 'tb_bahan.id')
            ->where('tb_bomlist.kode_bom', $kode_bom)
            ->get(['tb_bomlist.*', 'tb_bahan.nama', 'tb_bahan.harga', 'tb_bahan.stok']);
        $bom = tb_bom::find($kode_bom);
        $produk = tb_produk::find($bom->kode_produk);
        $produk->stok = $produk->stok + ($mo->kuantitas * $bom->kuantitas);
        $produk->save();
        foreach ($bomList as $list) {
            $temp = temp_produce::where('kode_bomlist', $list->kode_bomlist)->get()->first();
            $bahan = tb_bahan::find($list->kode_bahan);
            $bahan->stok = $bahan->stok - $temp->quantity_order;
            $bahan->save();
            $tempDelete = temp_produce::find($temp->id);
            $tempDelete->delete();
        }
        $mo->status = 5;
        $mo->save();
        return redirect('Manufacture/mo');
    }

    public function deleteMo($kode_mo){
        $mo = tb_mo::find($kode_mo);

        $mo->delete();
       return redirect('Manufacture/mo');
    }

    public function cetakMo()
    {
        $moDatas = tb_mo::join('tb_bom', 'tb_mo.kode_bom', '=', 'tb_bom.kode_bom')
            ->join('tb_produk', 'tb_bom.kode_produk', '=', 'tb_produk.id')
            ->get(['tb_mo.*', 'tb_produk.nama']);
        $boms = tb_bom::join('tb_produk', 'tb_bom.kode_produk', '=', 'tb_produk.id')
            ->get(['tb_bom.*', 'tb_produk.nama']);
        return view('tb_mo.mo-cetak', ['moDatas' => $moDatas, 'boms' => $boms]);
    }

    public function moConfirm($kode_mo, Request $request)
    {
        $bomList = tb_bomlist::Where('kode_bom', $request->kode_bom)->get();
        foreach ($bomList as $item) {
            $product = tb_produk::find($item->kode_produk);
            $product->stok = $product->stok + $item->kuantitas;
            $product->save();
        }
        $mo = tb_mo::find($kode_mo);
        $mo->status = $mo->status + 1;
        $mo->kode_bom =  $mo->kode_bom;
        $mo->kuantitas =  $mo->kuantitas;
        $mo->tanggal =  $mo->tanggal;
        $mo->save();
        return redirect('Manufacture/mo');
    }
}
