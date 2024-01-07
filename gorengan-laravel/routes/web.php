<?php

use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\MoController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RfqController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SQController;
use App\Http\Controllers\AccountingController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});


Route::get('Manufacture/produk', [ProdukController::class, 'index']);
Route::get('Manufacture/input-produk', [ProdukController::class, 'create']);
Route::post('/home/produk/simpan', [ProdukController::class, 'store'])->name('produk-simpan');
Route::get('/home/produk/edit/{id}', [ProdukController::class, 'edit']);
Route::put('/home/produk/update/{id}', [ProdukController::class, 'update'])->name('produk-update');
Route::get('/home/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk-delete');
Route::get('Manufacture/cetak-produk', [ProdukController::class, 'cetakProduk'])->name('cetak-produk');


Route::get('Manufacture/bahan', [BahanController::class, 'index']);
Route::get('Manufacture/input-bahan', [BahanController::class, 'create']);
Route::post('/home/bahan/simpan', [BahanController::class, 'store'])->name('bahan-simpan');
Route::get('/home/bahan/edit/{id}', [BahanController::class, 'edit']);
Route::put('/home/bahan/update/{id}', [BahanController::class, 'update'])->name('bahan-update');
Route::get('/home/bahan/delete/{id}', [BahanController::class, 'destroy'])->name('bahan-delete');
Route::get('Manufacture/cetak-bahan', [BahanController::class, 'cetakBahan'])->name('cetak-bahan');


Route::get('bom/bom', [BomController::class,'material']);
Route::get('bom/input-bom', [BomController::class,'materialInput']);
Route::post('bom/input-bom', [BomController::class,'upload']);
Route::get('bom/input-item-bom/{kode_bom}', [BomController::class,'materialInputItems']);
Route::post('bom/input-item-bom', [BomController::class,'uploadList']);
Route::get('bom/bom-delete-item/{kode_bom_list}', [BomController::class,'deleteList']);
Route::get('bom/bom-delete/{kode_bom}', [BOMController::class,'deleteBom']);
Route::get('bom/cetak-bom', [BomController::class, 'cetakBom'])->name('cetakBom');


Route::get('Manufacture/mo', [MoController::class,'manufacture']);
Route::get('Manufacture/mo-input', [MoController::class,'manufactureOrder']);
Route::post('Manufacture/mo-input', [MoController::class,'moUpload']);
Route::put('Manufacture/mo/update/{kode_mo}', [MoController::class,'moUpdate']);
// Route::put('/home/mo/confirm/{kode_mo}', [MoController::class,'moConfirm']);
Route::get('Manufacture/mo-ca/{kode_bom}', [MoController::class,'caItems']);
Route::post('Manufacture/mo-produce/{kode_mo}', [MoController::class,'moProduce']);
Route::post('Manufacture/mo-done/{kode_mo}', [MoController::class,'moProsesProduce']);
Route::get('Manufacture/mo-delete/{kode_mo}', [MoController::class,'deleteMo']);
Route::get('Manufacture/mo/cetak', [MoController::class, 'cetakMo'])->name('Mo-cetak');


Route::get('vendor', [VendorController::class, 'index']);
Route::get('vendor/tambah', [VendorController::class, 'create']);
Route::post('vendor/simpan', [VendorController::class, 'store'])->name('vendor-simpan');
Route::get('vendor/edit/{id}', [VendorController::class, 'edit']);
Route::put('vendor/update/{id}', [VendorController::class, 'update'])->name('vendor-update');
Route::get('vendor/delete/{id}', [VendorController::class, 'destroy'])->name('vendor-delete');


Route::get('rfq', [RfqController::class,'rfq']);
Route::get('po', [RfqController::class,'po']);
Route::get('rfq-input', [RfqController::class,'rfqInput']);
Route::post('rfq-input', [RfqController::class,'upload']);
Route::get('rfq-input-item/{kode_rfq}', [RfqController::class,'rfqInputItems']);
Route::post('rfq-input-item', [RfqController::class,'rfqUploadItems']);
Route::get('po-input-item/{kode_rfq}', [RfqController::class,'poInputItems']);
Route::post('rfq/save', [RfqController::class,'rfqSaveItems']);
Route::post('po/savePo', [RfqController::class,'poSaveItems']);
Route::post('po/create-bill', [RfqController::class,'poCreateBill']);
Route::get('po-invoice/{kode_rfq}', [RfqController::class,'getPDF']);
Route::get('rfq-delete-item/{kode_rfq_list}', [RfqController::class,'deleteList']);
Route::get('rfq-delete/{kode_rfq}', [RfqController::class,'deleteRfq']);


Route::get('customer', [CustomerController::class, 'index']);
Route::get('customer/tambah', [CustomerController::class, 'create']);
Route::post('customer/simpan', [CustomerController::class, 'store'])->name('customer-simpan');
Route::get('customer/edit/{id}', [CustomerController::class, 'edit']);
Route::put('customer/update/{id}', [CustomerController::class, 'update'])->name('customer-update');
Route::get('customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer-delete');


Route::get('sq', [SQController::class,'sq']);
Route::get('so', [SQController::class,'so']);
Route::get('sq-input', [SQController::class,'sqInput']);
Route::post('sq-input', [SQController::class,'upload']);
Route::get('sq-input-item/{kode_sq}', [SQController::class,'sqInputItems']);
Route::post('sq-input-item', [SQController::class,'sqUploadItems']);
Route::get('so-input-item/{kode_sq}', [SQController::class,'soInputItems']);
Route::post('so-input-item', [SQController::class,'soUploadItems']);
Route::post('sq/save', [SQController::class,'sqSave']);
Route::post('sq/saveSo', [SQController::class,'sqSaveSo']);
Route::post('sq/invoice', [SQController::class,'sqCreateInvoice']);
Route::post('sq/delivery', [SQController::class,'sqDelivery']);
Route::get('so-invoice/{kode_sq}', [SQController::class,'getPDF']);
Route::get('sq-delete-item/{kode_sq_list}', [SQController::class,'deleteListSQ']);
Route::get('sq-delete/{kode_sq}', [SQController::class,'deleteSQ']);


// Route::get('/accounting', [AccountingController::class,'index']);
Route::get('/accounting', [AccountingController::class,'invoicing']);
Route::get('/accounting-invoicing', [AccountingController::class,'invoicing']);
Route::get('/accounting-invoicing/tampil-pertanggal/{tglawal}/{tglakhir}', [AccountingController::class,'tampilInvoicePertanggal']);
Route::get('/accounting-invoicing/cetak/', [AccountingController::class,'cetakLaporan']);
Route::get('/accounting-invoicing/cetak-pertanggal/{tglawal}/{tglakhir}', [AccountingController::class,'cetakLaporanPertanggal']);
Route::get('/accounting-bill', [AccountingController::class,'bill']);
Route::get('/accounting-bill/tampil-pertanggal/{tglawal}/{tglakhir}', [AccountingController::class,'tampilBillPertanggal']);
Route::get('/accounting-bill/cetak/', [AccountingController::class,'cetakLaporanBill']);
Route::get('/accounting-bill/cetak-pertanggal/{tglawal}/{tglakhir}', [AccountingController::class,'cetakLaporanBillPertanggal']);


Route::get('employe', [EmployeController::class, 'index']);
Route::get('employe/tambah', [EmployeController::class, 'create']);
Route::post('employe/simpan', [EmployeController::class, 'store'])->name('employe-simpan');
Route::get('employe/edit/{id}', [EmployeController::class, 'edit']);
Route::put('employe/update/{id}', [EmployeController::class, 'update'])->name('employe-update');
Route::get('employe/delete/{id}', [EmployeController::class, 'destroy'])->name('employe-delete');