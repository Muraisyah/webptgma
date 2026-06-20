<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailReservasi extends Model
{
    protected $table = 'detail_reservasi';
    protected $primaryKey = 'id_detail';
    public $timestamps = true;
    protected $fillable = ['id_reservasi','id_jemaah'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    public function jemaah()
    {
        return $this->belongsTo(DataJemaah::class, 'id_jemaah', 'id_jemaah');
    }
}
