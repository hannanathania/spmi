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
        'kodept',
    ];

    public function faswil()
    {
        return $this->belongsTo(ModelFaswil::class, 'kode_faswil', 'kode_faswil');
    }

    public function pt()
    {
        return $this->belongsTo(ModelSPMI::class, 'kodept', 'kodept');
    }


}
