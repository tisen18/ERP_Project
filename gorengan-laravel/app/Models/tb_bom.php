<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_bom extends Model
{
    use HasFactory;
    protected $table = "tb_bom";
    protected $primaryKey = 'kode_bom';
    public $incrementing = false;
    protected $fillable = ['kode_bom','kode_produk','kuantitas','total_harga'];
    public $timestamps = false;
    
}
