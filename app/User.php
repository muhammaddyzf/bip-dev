<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens, Notifiable;

    protected $guard   = 'web';
    protected $guarded = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','username', 'api_token', 'name', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pengguna()
    {
        return $this->hasOne('App\Pengguna', 'USER_ID', 'id');
    }

    public static function getUserName($name, $unique){
        $name = str_replace(" ", "", $name).$unique;
        return strtolower($name);
    }

    public function images()
    {
        return $this->hasOne('App\Images', 'ID', 'id');
    }

    public function sukaProduk()
    {
        return $this->belongsTo('App\SukaProduk', 'PNG_ID', 'id');
    }
}
