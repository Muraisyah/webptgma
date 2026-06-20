<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataVaksin extends Model
{
    protected $table = 'data_vaksin';
    protected $primaryKey = 'id_vaksin';
    public $timestamps = true;
    protected $fillable = ['nama_vaksin','foto_vaksin'];
}
