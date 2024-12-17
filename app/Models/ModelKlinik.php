<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelKlinik extends Model
{
    protected $table ='akademik.klinik_spmi';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $fillable = [
        'kode_faswil',
        'kodept',
        'tahap',
        'progress',
        'deskripsi_progress',
        'tanggal_klinik',
        'tanggal_unggah_doc',
        'hasil_evaluasi',
        'deskripsi_evaluasi',
    ];
    
}
