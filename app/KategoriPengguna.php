<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPengguna extends Model
{
	public $timestamps = false;
    protected $table = "tb_kat_pengguna";

    public function pengguna()
    {
    	return $this->belongsTo('App\Pengguna', 'KTPNG_ID', 'KTPNG_ID');
    }
}
