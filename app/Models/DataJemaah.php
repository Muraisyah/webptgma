<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataJemaah extends Model
{
    protected $table = 'data_jemaah';
    protected $primaryKey = 'id_jemaah';
    public $timestamps = true;
    protected $fillable = ['id_user','nama_jemaah','tempat_lahir','tgl_lahir','nik','jenis_kelamin','alamat','nama_ayah','status_pernikahan','kewarganegaraan','foto_ktp','foto_kk','foto_akte','foto_buku_nikah','foto_ktp_ayah','foto_ktp_ibu','id_passport','id_visa','id_vaksin'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function passport()
    {
        return $this->belongsTo(DataPassport::class, 'id_passport', 'id_passport');
    }

    public function visa()
    {
        return $this->belongsTo(DataVisa::class, 'id_visa', 'id_visa');
    }

    public function vaksin()
    {
        return $this->belongsTo(DataVaksin::class, 'id_vaksin', 'id_vaksin');
    }
}
