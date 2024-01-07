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
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function index()
    {
        return view ('accounting.accounting');
    }

    public function invoicing()
    {
        $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
            ->get(['tb_sq.*', 'tb_customer.nama']);
        return view('accounting.accounting-invoicing', ['sqs' => $sq]);
    }

    public function tampilInvoicePertanggal($tglawal, $tglakhir){
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
            ->whereBetween('tanggal_order', [$tglawal, $tglakhir]) ->get();
        return view('accounting.accounting-invoicing', ['sqs' => $sq]);
    }

    public function cetakLaporan(){
        $sqList = tb_sqlist::join('tb_produk', 'tb_sqlist.kode_produk', '=', 'tb_produk.id')
            ->get(['tb_sqlist.*', 'tb_produk.nama', 'tb_produk.harga']);
        $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
            ->get(['tb_sq.*', 'tb_customer.nama', 'tb_customer.alamat']);
        return view('accounting.accounting-invoicing-cetak', ['sqlist' => $sqList, 'sq' => $sq]);
    }

    public function cetakLaporanPertanggal($tglawal, $tglakhir){
        $sq = tb_sq::join('tb_customer', 'tb_sq.kode_customer', '=', 'tb_customer.id')
            ->whereBetween('tanggal_order', [$tglawal, $tglakhir]) ->get();
        return view('accounting.accounting-invoicing-cetakPertanggal', ['sq' => $sq]);
    }

    public function bill()
    {
        $rfq = tb_rfq::join('tb_vendor', 'tb_rfq.kode_vendor', '=', 'tb_vendor.id')
            ->get(['tb_rfq.*', 'tb_vendor.nama']);
        return view('accounting.accounting-bill', ['rfqs' => $rfq]);
    }

    public function tampilBillPertanggal($tglawal, $tglakhir){
        $rfq = tb_rfq::join('tb_vendor', 'tb_rfq.kode_vendor', '=', 'tb_vendor.id')
            ->whereBetween('tanggal_order', [$tglawal, $tglakhir]) ->get();
        return view('accounting.accounting-bill', ['rfqs' => $rfq]);
    }

    public function cetakLaporanBill(){
        $rfqList = tb_rfqlist::join('tb_bahan', 'tb_rfqlist.kode_bahan', '=', 'tb_bahan.id')
            ->get(['tb_rfqlist.*', 'tb_bahan.nama', 'tb_bahan.harga']);
        $rfq = tb_rfq::join('tb_vendor', 'tb_rfq.kode_vendor', '=', 'tb_vendor.id')
            ->get(['tb_rfq.*', 'tb_vendor.nama', 'tb_vendor.alamat']);
        return view('accounting.accounting-bill-cetak', ['rfqlist' => $rfqList, 'rfq' => $rfq]);
    }

    public function cetakLaporanBillPertanggal($tglawal, $tglakhir){
        $rfq = tb_rfq::join('tb_vendor', 'tb_rfq.kode_vendor', '=', 'tb_vendor.id')
            ->whereBetween('tanggal_order', [$tglawal, $tglakhir]) ->get();
        return view('accounting.accounting-bill-cetakPertanggal', ['rfq' => $rfq]);
    }
}
