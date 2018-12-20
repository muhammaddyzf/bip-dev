<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabkot extends Model
{
    protected $table = "tb_kabkot";

    public function pasarTradisional()
    {
        return $this->belongsToOne('App\PasarTradisional', 'id_kabkot', 'id');
    }

    public function pasarModern()
    {
        return $this->belongsToOne('App\PasarModern', 'id_kabkot', 'id');
    }

    public function sentra()
    {
        return $this->belongsToOne('App\Sentra', 'id_kabkot', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Provinsi','id', 'province_id');
    }

    public function kecamatan()
    {
        return $this->hasMany('App\Kecamatan', 'kabkot_id', 'id');
    }

    public function ikm()
    {
        return $this->belongsTo('App\Ikm', 'IKM_KABKOT', 'id');
    }
}
