<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriSertifikasi extends Model
{
	public $timestamps = false;
    protected $table = "tb_kat_sertifikasi";

    public function tb_kat_sertifikasi()
    {
    	return $this->belongsToOne('App\Sertifikasi', 'KTSRT_ID', 'KTSRT_ID');
    }
}
