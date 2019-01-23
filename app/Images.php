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

    public function ikm()
    {
    	return $this->belongsTo('App\Ikm', 'IKM_ID', 'ID');
    }

    public function sertifikasi()
    {
        return $this->belongsTo('App\Sertifikasi', 'SRT_ID', 'ID');
    }

    public static function imageDefault()
    {
        return $image = "http://www.pinnacleeducations.in/wp-content/uploads/2017/05/no-image.jpg";
    }
}
