<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_employe extends Model
{
    use HasFactory;
    protected $table = 'tb_employe';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['nama', 'kontak', 'alamat', 'jabatan', 'departemen'];
    public $timestamps = false;
}
