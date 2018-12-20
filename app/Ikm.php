<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ikm extends Model
{
    public $timestamps = false;
    protected $table = "tb_ikm";

    public function produk()
    {
    	return $this->hasMany('App\Produk', 'IKM_ID', 'IKM_ID');
    }

    public function ikmToSertifikasi()
    {
    	return $this->hasMany('App\IkmToSertifikasi', 'IKM_ID', 'IKM_ID');
    }

    public function images()
    {
    	return $this->hasOne('App\Images', 'ID', 'IKM_ID');
    }

    public function provinsi()
    {
    	return $this->hasOne('App\Provinsi', 'id', 'IKM_PROV');
    }

    public function kabkot()
    {
    	return $this->hasOne('App\Kabkot', 'id', 'IKM_KABKOT');
    }

    public function kecamatan()
    {
    	return $this->hasOne('App\Kecamatan', 'id', 'IKM_KEC');
    }

    public function desa()
    {
    	return $this->hasOne('App\Desa', 'id', 'IKM_DESA');
    }
}
