<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SukaProduk extends Model
{
	public $timestamps = false;
    protected $table = "tb_suka_produk";
  
    public function produk()
    {
    	return $this->belongsTo('App\Produk', 'PRDK_ID', 'PRDK_ID');
    }

    public static function getSukaProduk()
    {
    	$data = DB::table('tb_suka_produk')
    			->select(
    				DB::raw("ROUND(COALESCE(SUM(LK_STATUS),0),0) AS jumlahLike")
    			)->first();
    	return $data;
    }

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'PNG_ID');
    }

    public static function getDetailLike($idProduk)
    {
        $data = DB::table('tb_suka_produk')
                ->leftjoin('users', 'users.id', '=', 'tb_suka_produk.PNG_ID')
                ->leftjoin('tb_images', 'tb_images.ID', '=', 'users.id')
                ->leftjoin('tb_pengguna', 'tb_pengguna.USER_ID', '=', 'users.id')
                ->select(
                    DB::raw("users.id, users.email, tb_pengguna.PNG_NIK, tb_images.IMG_NAMA, users.name")
                )->where('PRDK_ID', $idProduk)->get();

        return $data;
    }
}

