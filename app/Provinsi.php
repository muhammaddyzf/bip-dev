<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = "tb_provinsi";

    public function pasarTradisional()
    {
        return $this->belongsToOne('App\PasarTradisional', 'id_provinsi', 'id');
    }

    public function pasarModern()
    {
        return $this->belongsToOne('App\PasarModern', 'id_provinsi', 'id');
    }

    public function sentra()
    {
        return $this->belongsToOne('App\Sentra', 'id_provinsi', 'id');
    }

    public function kabkot()
    {
        return $this->hasMany('App\Kabkot', 'province_id', 'id');
    }

    public function ikm()
    {
        return $this->belongsTo('App\Ikm', 'IKM_PROV', 'id');
    }

    public function event()
    {
        return $this->belongsTo('App\Event', 'EVT_PROV', 'id');
    }
}
