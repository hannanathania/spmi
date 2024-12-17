<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class ModelPtFaswil extends Model
{
    //
    protected $table ='akademik.faswil';
    public $timestamps = false;
    protected $primaryKey = 'kode_faswil';
    protected $fillable = [
        'kode_faswil',
        'nama_faswil',
        'kode_pt',
        'nik',
    ];
}
