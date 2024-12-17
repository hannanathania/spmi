<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPtPengimbas extends Model
{
    protected $table = 'akademik.pt_pengimbas';
    protected $primaryKey = 'kode';
    public $timestamps = false;
    protected $fillable = [
        'kode_pt_peng',
        'kode_pt'
    ];
}
