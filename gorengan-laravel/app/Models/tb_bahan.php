<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_bahan extends Model
{
    use HasFactory;
    protected $table = 'tb_bahan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['nama', 'kode', 'harga', 'stok', 'gambar'];
}
