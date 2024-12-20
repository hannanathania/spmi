<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelFaswil extends Model
{
    protected $table ='akademik.faswil';
    public $timestamps = false;
    protected $primaryKey = 'kode_faswil';

    protected $fillable = [
        'kode_faswil',
        'nama_faswil',
    ];
    public function pts()
    {
        return $this->hasMany(ModelPtFaswil::class, 'kode_faswil', 'kode_faswil');
    }
}
