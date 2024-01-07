<?php

namespace App\Http\Controllers;

use App\Models\tb_bom;
use App\Models\tb_bomlist;
use App\Models\tb_produk;
use App\Models\tb_bahan;
use App\Models\tb_mo;
use App\Models\tb_rfq;
use App\Models\tb_rfqlist;
use App\Models\tb_customer;
use App\Models\tb_sq;
use App\Models\tb_sqlist;
use PDF;
use Illuminate\Http\Request;

class SqController extends Controller
{
    public function sq()
    {
        $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
            ->get(['tb_sq.*', 'tb_customer.nama']);
        return view('sq.sq', ['sqs' => $sq]);
    }

    public function so()
    {
        $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
            ->get(['tb_sq.*', 'tb_customer.nama']);
        return view('sq.so', ['sqs' => $sq]);
    }

    public function sqInput()
    {
        $customer = tb_customer::get();
        return view('sq.sq-input', ['customers' => $customer]);
    }

    public function upload(Request $request)
    {
        $tanggal = date("Y-m-d");
        tb_sq::create([
            'kode_sq' => $request->kode_sq,
            'kode_customer' => $request->kode_customer,
            'tanggal_order'=> $tanggal,
            'status' => 1,
            'total_harga' => 0,
            'metode_pembayaran' => 0
        ]);
        return redirect('sq-input-item/' . $request->kode_sq);
    }

    public function sqInputItems($kode_sq)
    {
        $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
            ->where('tb_sq.kode_sq', $kode_sq)
            ->first(['tb_sq.*', 'tb_customer.nama']);
        $sqList = tb_sqlist::join('tb_produk', 'tb_sqlist.kode_produk', '=', 'tb_produk.id')
            ->where('tb_sqlist.kode_sq', $kode_sq)
            ->get(['tb_sqlist.*', 'tb_produk.nama', 'tb_produk.harga']);
        $produk = tb_produk::all();
        return view('sq.sq-input-item', ['sq' => $sq, 'sqList' => $sqList, 'products' => $produk]);
    }

    public function sqUploadItems(Request $request)
    {
        tb_sqlist::create([
            'kode_sq' => $request->kode_sq,
            'kode_produk' => $request->kode_produk,
            'kuantitas' => $request->kuantitas
        ]);
        $product = tb_produk::find($request->kode_produk);
        $harga = $product->harga;
        $sq = tb_sq::find($request->kode_sq);
        $harga_lama = $sq->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->kuantitas);

        $sq->total_harga = $harga_baru;
        $sq->save();

        return redirect('sq-input-item/' . $request->kode_sq);
    }
    
    public function soInputItems($kode_sq)
    {
        $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
            ->where('tb_sq.kode_sq', $kode_sq)
            ->first(['tb_sq.*', 'tb_customer.nama']);
        $sqList = tb_sqlist::join('tb_produk', 'tb_sqlist.kode_produk', '=', 'tb_produk.id')
            ->where('tb_sqlist.kode_sq', $kode_sq)
            ->get(['tb_sqlist.*', 'tb_produk.nama', 'tb_produk.harga']);
        $produk = tb_produk::all();
        return view('sq.so-input-item', ['sq' => $sq, 'sqList' => $sqList, 'products' => $produk]);
    }

    public function soUploadItems(Request $request)
    {
        tb_sqlist::create([
            'kode_sq' => $request->kode_sq,
            'kode_produk' => $request->kode_produk,
            'kuantitas' => $request->kuantitas
        ]);
        $product = tb_produk::find($request->kode_produk);
        $harga = $product->harga;
        $sq = tb_sq::find($request->kode_sq);
        $harga_lama = $sq->total_harga;
        $harga_baru = $harga_lama + ($harga * $request->kuantitas);

        $sq->total_harga = $harga_baru;
        $sq->save();

        return redirect('so-input-item/' . $request->kode_sq);
    }

    public function sqSave(Request $request)
    {
        $sq = tb_sq::find($request->kode_sq);
        $sq->status = $sq->status + 1;
        $sq->save();

        return redirect('sq-input-item/' . $request->kode_sq);
    }

    public function sqSaveSo(Request $request)
    {
        $sq = tb_sq::find($request->kode_sq);
        $sq->status = $sq->status + 1;
        $sq->save();

        return redirect('so-input-item/' . $request->kode_sq);
    }

    public function sqCreateInvoice(Request $request)
    {
        $sq = tb_sq::find($request->kode_sq);
        $sq->metode_pembayaran = $request->payment;
        $sq->status = $sq->status + 1;
        $sq->save();

        return redirect('so-input-item/' . $request->kode_sq);
    }

    public function sqDelivery(Request $request)
    {
        $sqlist = tb_sqlist::Where('kode_sq', $request->kode_sq)->get();
        foreach ($sqlist as $item) {
            $product = tb_produk::find($item->kode_produk);
            $product->stok = $product->stok - $item->kuantitas;
            $product->save();
        }
        $sq = tb_sq::find($request->kode_sq);
        // $sq->metode_pembayaran = $request->payment;
        $sq->status = $sq->status + 1;
        $sq->save();
        return redirect('so');
    }

    public function deleteSQ($kode_sq){
        $sq_list = tb_sqlist::where('kode_sq', $kode_sq);
        $sq_list->delete();

        $sq = tb_sq::find($kode_sq);
        $sq->delete();
       return redirect('sq/');
    }

    public function deleteListSQ($kode_sq_list){
        $sq_list = tb_sqlist::find($kode_sq_list);
        $product = tb_produk::find($sq_list->kode_produk);
        $harga = $product->harga;
        $sq = tb_sq::find($sq_list->kode_sq);
        $harga_lama = $sq->total_harga;
        $harga_baru = $harga_lama - ($harga * $sq_list->kuantitas);

        $sq->total_harga = $harga_baru;
        $sq->save();

        $sq_list->delete();
       return redirect('sq-input-item/' . $sq_list->kode_sq);
    }

    public function getPDF($kode_sq){
        $sqList = tb_sqlist::join('tb_produk', 'tb_sqlist.kode_produk', '=', 'tb_produk.id')
            ->where('tb_sqlist.kode_sq', $kode_sq)
            ->get(['tb_sqlist.*', 'tb_produk.nama', 'tb_produk.harga']);
    
        $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
            ->where('tb_sq.kode_sq', $kode_sq)
            ->get(['tb_sq.*', 'tb_customer.nama', 'tb_customer.alamat']);
    
        return view('sq.so-invoice', ['sqlist' => $sqList, 'sq' => $sq]);
    }
    

    // public function getPDF($kode_sq){
    //     $sqList = tb_sqlist::join('tb_produk', 'tb_sqlist.kode_produk', '=', 'tb_produk.id')
    //         ->where('tb_sqlist.kode_sq', $kode_sq)
    //         ->get(['tb_sqlist.*', 'tb_produk.nama', 'tb_produk.harga']);
    //     $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
    //         ->where('tb_sq.kode_sq', $kode_sq)
    //         ->get(['tb_sq.*', 'tb_customer.nama', 'tb_customer.alamat']);

    //     return view('sq.so-invoice', ['sqlist' => $sqList, 'sq' => $sq]);
    // }
}
