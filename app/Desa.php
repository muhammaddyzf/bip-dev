<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = "tb_desa";

    public function ikm()
    {
        return $this->belongsTo('App\Ikm', 'IKM_DESA', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\kecamatan','id', 'kec_id');
    }

}
