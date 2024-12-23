<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class ModelPtFaswil extends Model
{
    //
    protected $table ='akademik.pt_faswil';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $fillable = [
        'kode_faswil',
        'nama_faswil',
        'kodept',
        'nik',
        'gelar_depan',
        'gelar_blk'
    ];

    public function faswil()
    {
        return $this->belongsTo(ModelFaswil::class, 'kode_faswil', 'kode_faswil');
    }

    public function pt()
    {
        return $this->belongsTo(ModelSPMI::class, 'kodept', 'kodept');
    }

    public function pts()
    {
        return $this->hasMany(ModelSPMI::class, 'kodept', 'kodept'); // Asumsikan 'kode_faswil' sebagai kunci
    }

}
