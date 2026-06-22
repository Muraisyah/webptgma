<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPassport extends Model
{
    protected $table = 'data_passport';
    protected $primaryKey = 'id_passport';
    public $timestamps = true;
    protected $fillable = ['nama_passport','nama_tambahan','nomor_passport','tempat_lahir_pass','tgl_lahir_pass','tempat_pembuatan','tgl_pembuatan','exp_passport','foto_identitas_pass','foto_nama_tambahan','status_passport'];
}
