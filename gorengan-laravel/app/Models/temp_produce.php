<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_produce extends Model
{
    use HasFactory;
    protected $table = "temp_produce";
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'kode_bomlist', 'quantity_order'];
    public $timestamps = false;
}
