<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'tb_event';
    public $timestamps = false;

    public function ikmToEvent()
    {
    	return $this->hasMany('App\IkmToEvent', 'EVT_ID', 'EVT_ID');
    }

    public function provinsi()
    {
    	return $this->hasOne('App\Provinsi', 'id', 'EVT_PROV');
    }

    public function kabkot()
    {
    	return $this->hasOne('App\Kabkot', 'id', 'EVT_KABKOT');
    }

    public function kecamatan()
    {
    	return $this->hasOne('App\Kecamatan', 'id', 'EVT_KEC');
    }

    public function desa()
    {
    	return $this->hasOne('App\Desa', 'id', 'EVT_DESA');
    }

}
