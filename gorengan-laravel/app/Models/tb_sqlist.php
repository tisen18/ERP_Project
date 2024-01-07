<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_sqlist extends Model
{
    use HasFactory;
    protected $table = "tb_sqlist";
    protected $primaryKey = 'kode_sqlist';
    public $incrementing = false;
    protected $fillable = ['kode_sqlist', 'kode_sq','kode_produk','kuantitas'];
    public $timestamps = false;
}
