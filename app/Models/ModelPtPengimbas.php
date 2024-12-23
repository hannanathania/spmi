<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPtPengimbas extends Model
{
    protected $table = 'akademik.pt_pengimbas';
    public $timestamps = false;
    protected $primaryKey = 'kode';

    protected $fillable = [
        'kodept',
        'ptspmi'
    ];
}
