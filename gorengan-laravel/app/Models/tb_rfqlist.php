<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_rfqlist extends Model
{
    use HasFactory;
    protected $table = "tb_rfqlist";
    protected $primaryKey = 'kode_rfqlist';
    public $incrementing = false;
    protected $fillable = ['kode_rfqlist', 'kode_rfq','kode_bahan','kuantitas'];
    public $timestamps = false;
}
