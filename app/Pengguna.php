<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
	public $timestamps = false;
    protected $table = "tb_pengguna";

    protected $fillable = [
        'USER_ID', 'KTPNG_ID', 'PNG_NIK', 'PNG_NAMA', 'PNG_DTINS', 'PNG_DTUPDT','PNG_USERINS', 'PNG_USERUPDT', 'PNG_TLP', 'PNG_PEND'
    ];

    public function user()
    {
        return $this->belongsTo('App\USER','id', 'USER_ID');
    }
}
