<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';
    protected $primaryKey = 'id_paket';
    public $timestamps = true;
    protected $fillable = ['nama_paket','durasi_perjalanan','tgl_keberangkatan','tgl_kepulangan','kuota_paket','seat_tersedia','harga_paket','maskapai','id_hotel','deskripsi','foto_paket','status_paket'];
    protected $casts = [
        'tgl_keberangkatan' => 'date',
        'tgl_kepulangan' => 'date',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'paket_hotel', 'id_paket', 'id_hotel');
    }
}
