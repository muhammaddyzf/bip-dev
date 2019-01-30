<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KatIkm extends Model
{
    public $timestamps = false;
    protected $table = "tb_kat_ikm";

    public function ikm()
    {
    	return $this->belongsToOne('App\Ikm', 'KAT_IKM_ID', 'KAT_IKM_ID');
    }
}
