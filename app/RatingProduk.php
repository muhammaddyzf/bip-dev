<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingProduk extends Model
{
    protected $table = "tb_rating_produk";

    public function produk()
    {
    	return $this->belongsTo('App\Produk', 'PRDK_ID', 'PRDK_ID');
    }
}
 