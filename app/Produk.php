<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = false;
    protected $table = "tb_produk";

    public function ikm()
    {
    	return $this->belongsTo('App\Ikm', 'IKM_ID', 'IKM_ID');
    }

    public function ProdukToKategoriProduk()
    {
    	return $this->hasMany('App\ProdukToKategoriProduk', 'PRDK_ID', 'PRDK_ID');
    }

    public function ratingProduk()
    {
    	return $this->hasMany('App\RatingProduk', 'PRDK_ID', 'PRDK_ID');
    }

    public function sukaProduk()
    {
    	return $this->hasMany('App\SukaProduk', 'PRDK_ID', 'PRDK_ID');
    }

    public function images()
    {
    	return $this->hasOne('App\Images', 'ID', 'PRDK_ID');
    }
}
