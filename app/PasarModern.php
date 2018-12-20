<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasarModern extends Model
{
	protected $table = 'pasar_modern';

	public function kecamatan()
	{
	   return $this->hasOne('App\Kecamatan', 'id', 'id_kecamatan');
	}

	public function provinsi()
	{
	   return $this->hasOne('App\Provinsi', 'id', 'id_provinsi');
	}

	public function kabkot()
	{
	   return $this->hasOne('App\Kabkot', 'id', 'id_kabkot');
	}
}
