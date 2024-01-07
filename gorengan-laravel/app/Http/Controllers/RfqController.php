<?php

namespace App\Http\Controllers;

use App\Models\tb_bom;
use App\Models\tb_bomlist;
use App\Models\tb_produk;
use App\Models\tb_bahan;
use App\Models\tb_mo;
use App\Models\tb_rfq;
use App\Models\tb_rfqlist;
use App\Models\tb_vendor;
use Illuminate\Http\Request;

class RfqController extends Controller
{
    public function rfq()
    {
        $rfq = tb_rfq::join('tb_vendor', 'tb_rfq.kode_vendor', '=', 'tb_vendor.id')
            ->get(['tb_rfq.*', 'tb_vendor.nama']);
        return view('rfq.rfq', ['rfqs' => $rfq]);
    }

    public function po()
    {
        $rfq = tb_rfq::join('tb_vendor', 'tb_rfq.kode_vendor', '=', 'tb_vendor.id')
            ->get(['tb_rfq.*', 'tb_vendor.nama']);
        return view('rfq.po', ['rfqs' => $rfq]);
    }

    public function rfqInput()
    {
        $vendor = tb_vendor::get();
        return view('rfq.rfq-input', ['vendors' => $vendor]);
    }

    public function upload(Request $request)
    {
        $tanggal = date("Y-m-d");
        tb_rfq::create([
            'kode_rfq' => $request->kode_rfq,
            'kode_vendor' => $request->kode_vendor,
            'tanggal_order'=> $tanggal,
            'status' => 1,
            'total_harga' => 0,
            'metode_pembayaran' => 0
        ]);
        return redirect('rfq-input-item/' . $request->kode_rfq);
    }

    public function rfqInputItems($kode_rfq)
    {
        $rfq = tb_rfq::join('tb_vendor', 'tb_rfq.kode_vendor', '=', 'tb_vendor.id')
            ->where('tb_rfq.kode_rfq', $kode_rfq)
            ->first(['tb_rfq.*', 'tb_vendor.nama']);
        $rfqList = tb_rfqlist::join('tb_bahan', 'tb_rfqlist.kode_bahan', '=', 'tb_bahan.id')
            ->where('tb_rfqlist.kode_rfq', $kode_rfq)
            ->get(['tb_rfqlist.*', 'tb_bahan.nama', 'tb_bahan.harga']);
        $produk = tb_bahan::all();
        return view('rfq.rfq-input-item', ['rfq' => $rfq, 'rfqList' => $rfqList, 'products' => $produk]);
    }

    public function rfqUploadItems(Request $request)
    {
        tb_rfqlist::create([
            'kode_rfq' => $request->kode_rfq,
            'kode_bahan' => $request->kode_bahan,
            'kuantitas' => $request->kuantitas
        ]);
        $product = tb_bahan::find($request->kode_bahan);
        $harga = $product->harga;
        $rfq = tb_rfq::find($request->kode_rfq);
        $harga_lama = $rfq->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->kuantitas);

        $rfq->total_harga = $harga_baru;
        $rfq->save();

        return redirect('rfq-input-item/' . $request->kode_rfq);
    }

    public function poInputItems($kode_rfq)
    {
        $rfq = tb_rfq::join('tb_vendor', 'tb_rfq.kode_vendor', '=', 'tb_vendor.id')
            ->where('tb_rfq.kode_rfq', $kode_rfq)
            ->first(['tb_rfq.*', 'tb_vendor.nama']);
        $rfqList = tb_rfqlist::join('tb_bahan', 'tb_rfqlist.kode_bahan', '=', 'tb_bahan.id')
            ->where('tb_rfqlist.kode_rfq', $kode_rfq)
            ->get(['tb_rfqlist.*', 'tb_bahan.nama', 'tb_bahan.harga']);
        $produk = tb_bahan::all();
        return view('rfq.po-input-item', ['rfq' => $rfq, 'rfqList' => $rfqList, 'products' => $produk]);
    }

    public function deleteList($kode_rfqlist){
        $rfq_list = tb_rfqlist::find($kode_rfqlist);
        $product = tb_bahan::find($rfq_list->kode_bahan);
        $harga = $product->harga;
        $rfq = tb_rfq::find($rfq_list->kode_rfq);
        $harga_lama = $rfq->total_harga;
        $harga_baru = $harga_lama - ($harga * $rfq_list->kuantitas);

        $rfq->total_harga = $harga_baru;
        $rfq->save();

        $rfq_list->delete();
       return redirect('rfq-input-item/' . $rfq_list->kode_rfq);
    }

    public function rfqSaveItems(Request $request)
    {
        $rfq = tb_rfq::find($request->kode_rfq);
        $rfq->status = $rfq->status + 1;
        $rfq->save();

        return redirect('rfq-input-item/' . $request->kode_rfq);
    }

    public function poSaveItems(Request $request)
    {
        $rfq = tb_rfq::find($request->kode_rfq);
        $rfq->status = $rfq->status + 1;
        $rfq->save();

        return redirect('po-input-item/' . $request->kode_rfq);
    }

    public function poCreateBill(Request $request)
    {
        $rfqlist = tb_rfqlist::Where('kode_rfq', $request->kode_rfq)->get();
        foreach ($rfqlist as $item) {
            $product = tb_bahan::find($item->kode_bahan);
            $product->stok = $product->stok + $item->kuantitas;
            $product->save();
        }

        $rfq = tb_rfq::find($request->kode_rfq);
        $rfq->metode_pembayaran = $request->payment;
        $rfq->status = $rfq->status + 1;
        $rfq->save();

        return redirect('po');
    }

    public function deleteRfq($kode_rfq){
        $rfq_list = tb_rfqlist::where('kode_rfq', $kode_rfq);
        $rfq_list->delete();

        $rfq = tb_rfq::find($kode_rfq);
        $rfq->delete();
       return redirect('rfq/');
    }

    public function deletePo($kode_rfq){
        $rfq_list = tb_rfqlist::where('kode_rfq', $kode_rfq);
        $rfq_list->delete();

        $rfq = tb_rfq::find($kode_rfq);
        $rfq->delete();
       return redirect('po/');
    }

    public function getPDF($kode_rfq){
        $rfqList = tb_rfqlist::join('tb_bahan', 'tb_rfqlist.kode_bahan', '=', 'tb_bahan.id')
            ->where('tb_rfqlist.kode_rfq', $kode_rfq)
            ->get(['tb_rfqlist.*', 'tb_bahan.nama', 'tb_bahan.harga']);
        $rfq = tb_rfq::join('tb_vendor', 'tb_rfq.kode_vendor', '=', 'tb_vendor.id')
            ->where('tb_rfq.kode_rfq', $kode_rfq)
            ->get(['tb_rfq.*', 'tb_vendor.nama', 'tb_vendor.alamat']);
        
        return view('rfq.po-invoice', ['rfqlist' => $rfqList, 'rfq' => $rfq]);

        // $pdf = app('dompdf.wrapper')->loadView('rfq.po-invoice', ['rfqlist' => $rfqList, 'rfq' => $rfq]);
        // return $pdf->stream('invoice-po.pdf');
    }
}
