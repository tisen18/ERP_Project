<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_sq extends Model
{
    use HasFactory;
    protected $table = "tb_sq";
    protected $primaryKey = 'kode_sq';
    public $incrementing = false;
    protected $fillable = ['kode_sq', 'kode_customer', 'tanggal_order', 'status', 'total_harga', 'metode_pembayaran'];
    public $timestamps = false;
}
