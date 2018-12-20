<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
	public $timestamps = false;
    protected $table = "tb_images";

    public function produk()
    {
    	return $this->belongsTo('App\Produk', 'PRDK_ID', 'ID');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'id', 'ID');
    }
}
