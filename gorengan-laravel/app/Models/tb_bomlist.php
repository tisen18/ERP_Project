<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_bomlist extends Model
{
    use HasFactory;
    protected $table = "tb_bomlist";
    protected $primaryKey = 'kode_bomlist';
    public $incrementing = false;
    protected $fillable = ['kode_bom','kode_bahan','kuantitas', 'satuan'];
    public $timestamps = false;
}
