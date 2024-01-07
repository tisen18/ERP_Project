<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_produk extends Model
{
    use HasFactory;
    protected $table = 'tb_produk';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id', 'nama', 'kode', 'harga', 'stok', 'gambar'];
    public $timestamps = false;
}
