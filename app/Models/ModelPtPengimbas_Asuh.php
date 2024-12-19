<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPtPengimbas_Asuh extends Model
{
    protected $table = 'akademik.pt_pengimbas_asuh';
    protected $primaryKey = 'kode';
    public $timestamps = false;
    protected $fillable = [
        'kode_pt_peng',
        'kode_pt_asuh'
    ];

    public function pengimbas()
    {
        return $this->belongsTo(ModelPtPengimbas::class, 'kode_pt_peng', 'kodept');
    }

    public function asuh()
    {
        return $this->belongsTo(ModelPtAsuh::class, 'kode_pt_asuh', 'kodept');
    }
}
