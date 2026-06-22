<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservasi;
use App\Models\Rekening;
use App\Models\User;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = true;
    protected $fillable = ['id_reservasi','kode_transaksi','tgl_transaksi','jenis_pembayaran','id_rekening','nominal_bayar','bukti_transfer','status_verifikasi','tgl_verifikasi','id_admin','keterangan'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'id_rekening', 'id_rekening');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }
}
