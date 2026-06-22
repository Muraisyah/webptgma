<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogReservasi extends Model
{
    protected $table = 'log_reservasi';
    protected $primaryKey = 'id_log';
    public $timestamps = true;
    protected $fillable = ['id_reservasi','status_lama','status_baru','id_admin','waktu_update'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }
}
