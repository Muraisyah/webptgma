<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenKeberangkatan extends Model
{
    protected $table = 'dokumen_keberangkatan';
    protected $primaryKey = 'id_dokumen';
    public $timestamps = true;
    protected $fillable = ['id_jemaah','jenis_dokumen','file_dokumen','status_dokumen','tgl_upload'];

    public function jemaah()
    {
        return $this->belongsTo(DataJemaah::class, 'id_jemaah', 'id_jemaah');
    }
}
