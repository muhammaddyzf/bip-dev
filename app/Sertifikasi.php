<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sertifikasi extends Model
{
	public $timestamps = false;
    protected $table = "tb_sertifikasi";

    public function ikmToSertifikasi()
    {
    	return $this->hasMany('App\IkmToSertifikasi', 'SRT_ID', 'SRT_ID');
    }

    public function kategoriSertifikasi()
    {
    	return $this->hasOne('App\KategoriSertifikasi', 'KTSRT_ID', 'KTSRT_ID');
    }

    public function images()
    {
        return $this->hasOne('App\Images', 'ID', 'SRT_ID');
    }
}
