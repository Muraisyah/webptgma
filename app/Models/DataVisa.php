<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataVisa extends Model
{
    protected $table = 'data_visa';
    protected $primaryKey = 'id_visa';
    public $timestamps = true;
    protected $fillable = ['nama_visa','nomor_visa','tgl_berlaku_visa','tgl_exp_visa','foto_visa'];
}
