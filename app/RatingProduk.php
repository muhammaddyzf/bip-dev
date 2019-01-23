<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RatingProduk extends Model
{
	public $timestamps = false;
    protected $table = "tb_rating_produk";

    public function produk()
    {
    	return $this->belongsTo('App\Produk', 'PRDK_ID', 'PRDK_ID');
    }

    public static function getRatingProduk()
    {
    	$data = DB::table('tb_rating_produk')
    			->select(
    				DB::raw("ROUND(COALESCE(AVG(RAT_BOBOT),0),0) AS jumlahRating")
    			)->first();
    	return $data;
    }
}
 