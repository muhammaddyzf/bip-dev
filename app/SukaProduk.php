<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SukaProduk extends Model
{
    protected $table = "tb_suka_produk";
  
    public function produk()
    {
    	return $this->belongsTo('App\Produk', 'PRDK_ID', 'PRDK_ID');
    }
}
