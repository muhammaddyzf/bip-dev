<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'tb_kecamatan';

    public function pasarTradisional()
    {
        return $this->belongsToOne('App\PasarTradisional', 'id_kecamatan', 'id');
    }

    public function pasarModern()
    {
        return $this->belongsToOne('App\PasarModern', 'id_kecamatan', 'id');
    }

    public function kabkot()
    {
        return $this->belongsTo('App\Kabkot','id', 'kabkot_id');
    }

    public function sentra()
    {
        return $this->belongsTo('App\Sentra','id', 'kabkot_id');
    }

    public function ikm()
    {
        return $this->belongsTo('App\Ikm', 'IKM_KEC', 'id');
    }

    public function desa()
    {
        return $this->hasMany('App\Desa', 'kec_id', 'id');
    }
}
