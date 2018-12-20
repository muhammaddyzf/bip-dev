<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
	public $timestamps = false;
    protected $table = "tb_kat_produk";

    public function ProdukToKategoriProduk()
    {
    	return $this->hasMany('App\ProdukToKategoriProduk', 'KTPRDK_ID', 'KTPRDK_ID');
    }
}
