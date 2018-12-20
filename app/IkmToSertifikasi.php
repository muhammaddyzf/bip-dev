<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IkmToSertifikasi extends Model
{
    protected $table = "tb_ikm_to_sertifikasi";

	public function ikm()
    {
    	return $this->belongsTo('App\Ikm', 'IKM_ID', 'IKM_ID');
    }

    public function sertifikasi()
    {
    	return $this->belongsTo('App\Sertifikasi', 'SRT_ID', 'SRT_ID');
    }
}
