<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class LoginController extends Controller
{
    public function index(Request $request)
    {
        $hasher 	= app()->make('hash');
        $email 		= $request->input('email');
        $password 	= $request->input('password');
        $login 		= User::where('email', $email)->first();

        $data = array(
            'id_user'       => $login->id,
            'id_ikm'        => $login->pengguna->IKM_ID,
            'token'         => $login->api_token,
            'password'      => $login->password,
            'session'       => '',
            'email'         => $login->email,
            'nik'           => $login->pengguna->PNG_INK,
            'nama'          => $login->name,
            'pendidikan'    => $login->pengguna->PNG_NAMA,
            'telpon'        => $login->pengguna->PNG_TLP,
            'alamat'        => $login->pengguna->ALMNT,
            'username'      => $login->username,
            'hak_akses'     => $login->pengguna->KTPNG_ID,
            'avatar'        => 'https=>//s-media-cache-ak0.pinimg.com/736x/a1/37/55/a13755ebfcb61591acea2ab2159d55cd.jpg',
            'tanggal_masuk' => $login->created_at,
            'tanggal_daftar'=> $login->updated_at,
        );

        if (!$login) {
            $res['is_ok']   = false;
            $res['message'] = 'Your email or password incorrect!';
            return response($res);
        }else{
            if ($hasher->check($password, $login->password)) {
                $api_token 	  = sha1(time());
                $create_token = User::where('id', $login->id)->update(['api_token' => $api_token]);
                if ($create_token) {
                    $res['is_ok']   = true;
                    // $res['api_token'] 	= $api_token;
                    $res['message'] = "Login Success";
                    $res['data']    = $login;

                    return response($res);
                }
            }else{
                $res['is_ok'] = true;
                $res['message'] = 'You email or password incorrect!';
                return response($res);
            }
        }
    }
}
