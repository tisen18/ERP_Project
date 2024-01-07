<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_customer extends Model
{
    use HasFactory;
    protected $table = 'tb_customer';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['nama', 'kontak', 'alamat'];
    public $timestamps = false;
}
