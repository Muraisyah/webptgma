<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    public $timestamps = true;
    protected $fillable = ['kode_reservasi','id_user','id_paket','tgl_reservasi','jumlah_jemaah','total_biaya','status_reservasi','status_keberangkatan','catatan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
    }
}
