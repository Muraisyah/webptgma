<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel';
    protected $primaryKey = 'id_hotel';
    public $timestamps = true;
    protected $fillable = ['nama_hotel', 'kota', 'kategori_hotel'];
}
