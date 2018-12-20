<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukToKategoriProduk extends Model
{
	public $timestamps = false;
    protected $table = "tb_produk_to_kategori";

    public function produk()
    {
    	return $this->belongsTo('App\Produk', 'PRDK_ID', 'PRDK_ID');
    }

    public function kategoriProduk()
    {
    	return $this->belongsTo('App\KategoriProduk', 'KTPRDK_ID', 'KTPRDK_ID');
    }
}
