<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Pengguna; 
use App\Images; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use File;
use App\Notifications;

class UserController extends Controller 
{

public $successStatus = 200;

/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->idPengguna   = 'PNGID'.$rand.date('His');
        $this->kodePengguna = $rand.date('His');
        $this->idImages     = 'IMGID'.$rand.date('His');
        $this->kodeImages   = $rand.date('His');

        $this->dateInsert   = date('Y-m-d H:i:s');
        $this->dateUpdate   = date('Y-m-d H:i:s');
    }

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user 	= Auth::user(); 
            $token 	= $user->createToken('MyApp')-> accessToken; 
            $login 	= User::where('email', request('email'))->first();
            $createToken = User::where('id', $login->id)->update(['token' => $token]);

            if($login->images->IMG_NAMA == ""){
                $images = Images::imageDefault();
            }else{
                $images = url($login->images->IMG_NAMA);
            }

            $data = array(
	            'id_user'       => $login->id,
	            'id_ikm'        => $login->pengguna->IKM_ID,
	            'token'         => $token,
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
	            'avatar'        => $images,
	            'tanggal_masuk' => strtotime($login->created_at),
	            'tanggal_daftar'=> strtotime($login->updated_at),
        	);

        	$res['is_ok']   = true;
            $res['message'] = "Login Success";
            $res['data']    = $data;

            return response($res);

            // return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            // return response()->json(['error'=>'Unauthorised'], 401); 
            $res['is_ok'] = false;
            $res['message'] = 'You email or password incorrect!';
            return response($res);
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' 		 => 'required', 
            'email' 	 => 'required|email', 
            'password'   => 'required', 
        ]);

		if ($validator->fails()) { 
		    return response()->json(['error'=>$validator->errors()], 401);            
		}
		$input 				= $request->all(); 
        $input['password']  = bcrypt($input['password']); 
		$input['username'] 	= User::getUserName($input['name'], date('His')); 
		$user 				= User::create($input); 
		
		// $idPengguna = 'PNG    '.date('His');
		$pengguna = new Pengguna;
        $pengguna->PNG_ID 		= $this->idPengguna;
        $pengguna->IKM_ID		= '';
        $pengguna->PNG_NIK		= '';
        $pengguna->PNG_PEND		= '';
        $pengguna->PNG_TLP		= '';
        $pengguna->PNG_ALMNT	= '';
        $pengguna->PNG_EMAIL	= $input['email'];
        $pengguna->USER_ID 		= $user['id'];
    	$pengguna->KTPNG_ID		= 'KTPNGID4787221610';
    	$pengguna->PNG_NAMA		= $input['name'];
    	$pengguna->PNG_DTINS	= $this->dateInsert;
    	$pengguna->PNG_DTUPDT	= $this->dateUpdate;
    	$pengguna->PNG_USERINS	= $user['id'];
    	$pengguna->PNG_USERUPDT = '';
    	$pengguna->save();


        $imagesDefault = "";
        $images = new Images;
        $images->IMG_ID       = $this->idImages;
        $images->ID           = $user['id'];
        $images->IMG_GROUP    = 'USER';
        $images->IMG_NAMA     = $imagesDefault;
        $images->IMG_KET      = $input['name'];
        $images->IMG_DTINS    = $this->dateInsert;
        $images->IMG_DTUPDT   = $this->dateUpdate;
        $images->IMG_USERINS  = $user['id'];
        $images->IMG_USERUPDT = '';
        $images->save();

    	$token 					= $user->createToken($input['username'])-> accessToken; 
    	$updateToken 			= User::find($user['id']);
    	$updateToken->token 	= $token;
    	$updateToken->save();

        Notifications::mailRegistration($user, $input);

    	$user = User::find($user['id']);
        if($user->images['IMG_NAMA'] == ""){
            $images = Images::imageDefault();
        }else{
            $images = url($user->images['IMG_NAMA']);
        }
        $data = array(
        	'id_user'		=> $user->id,
	        'id_ikm'		=> '',
	        'token'			=> $token,
	        'password'		=> $user->password,
	        'session'		=> '',
	        'email'			=> $user->email,
	        'nik'			=> '',
	        'nama'			=> $user->name,
	        'pendidikan'	=> '',
	        'telpon'		=> '',
	        'alamat'		=> '',
	        'username'		=> $user->username,
	        'hak_akses'		=> $user->pengguna->KTPNG_ID,
	        'avatar'		=> $images,
	        'tanggal_masuk'	=> $user->created_at,
	        'tanggal_daftar'=> $user->updated_at,
        );

    	if ($user) {
            $res['is_ok'] 	= true;
            $res['message'] = 'Register Success';
            $res['data']    = $data;
            return response($res);
        }else{
            $res['is_ok'] = false;
            $res['message'] = 'Register Failed';
            return response($res);
        }

		// $success['token'] 	=  $token
		// $success['name'] 	=  $user->name;
		// return response()->json(['success'=>$success], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 


    public function show($id)
    {
        $user = User::find($id);

        if(isset($user->pengguna->PNG_NIK)){
            $nik = $user->pengguna->PNG_NIK;
        }else{
            $nik = "";
        }

        if(isset($user->pengguna->PNG_ALMNT)){
            $almt = $user->pengguna->PNG_ALMNT;
        }else{
            $almt = "";
        }

        if($user->images['IMG_NAMA'] == ""){
            $images = Images::imageDefault();
        }else{
            $images = url($user->images['IMG_NAMA']);
        }

        $data = array(
            'id_user'       => $user->id,
            'id_ikm'        => $user->pengguna->IKM_ID,
            'token'         => $user->token,
            'password'      => $user->password,
            'session'       => '',
            'email'         => $user->email,
            'nik'           => $nik,
            'nama'          => $user->name,
            'pendidikan'    => $user->pengguna->PNG_PEND,
            'telpon'        => $user->pengguna->PNG_TLP,
            'alamat'        => $almt,
            'username'      => $user->username,
            'hak_akses'     => $user->pengguna->kategoriPengguna->KTPNG_NAMA,
            'avatar'        => $images,
            'tanggal_masuk' => strtotime($user->created_at),
            'tanggal_daftar'=> strtotime($user->updated_at),
        );

        if($data){
            $res['is_ok']   = true;
            $res['message'] = "Get Data User Success";
            $res['data']    = $data;

            return response($res);
        }
    }

    public function update(Request $request)
    {
        $id          = $request->id_user;
    	// $idUser 	 = Auth::id();
        $hasher      = app()->make('hash');
        $oldPassword = "";
        $newPassword = "";
        $password    = "";

        $user = User::find($id);
        if($request->input('password') != ""){
            $newPassword = $hasher->make($request->input('password'));
            $password    = $newPassword;
        }else{
            $oldPassword = $user->password;
            $password    = $oldPassword;
        }

        //update user
        $user->id       = $id;
        $user->username = $request->input('username');
        $user->password = $password;
        $user->name     = $request->input('fullname');
        $user->save();

        //update pengguna
        $pengguna = Pengguna::where('USER_ID', $id)
                    ->update([
                        'PNG_NAMA'      => $request->input('fullname')
                        , 'PNG_TLP'     => $request->input('telpon')
                        , 'PNG_PEND'    => $request->input('pendidikan')
                        , 'PNG_ALMNT'   => $request->input('alamat')
                        , 'PNG_NIK'     => $request->input('nik')
                        , 'PNG_USERUPDT'=> $id

                    ]);


        //update images
        $foto = "";
        if($request->hasFile('lampiran')){
            $getImages       = Images::where('ID', $id)->first();
            $originalName    = $request->file('lampiran')->getClientOriginalName();
            $sizeFile        = getimagesize($originalName);

            $imageName = time().'.'.$request->lampiran->getClientOriginalExtension();
            $foto      = 'images/user/'.$imageName;

            if($getImages->IMG_NAMA == ""){
                $request->lampiran->move(public_path('/images/user/'), $imageName);
            }else{
                File::delete(public_path($getImages->IMG_NAMA));
                $request->lampiran->move(public_path('/images/user/'), $imageName);
            }

            $images = Images::where('ID', $id)
                      ->update([
                            'IMG_NAMA'      => $foto,
                            'IMG_DTUPDT'    => $this->dateUpdate,
                            'IMG_USERUPDT'  => $id,
                      ]);
        }

        if($user->images['IMG_NAMA'] == ""){
            $images = Images::imageDefault();
        }else{
            $images = url($user->images['IMG_NAMA']);
        }

        $data = array(
            'id_user'       => $id,
            'id_ikm'        => $user->pengguna->IKM_ID,
            'token'         => $user->token,
            'password'      => $user->password,
            'session'       => '',
            'email'         => $user->email,
            'nik'           => $user->pengguna->PNG_NIK,
            'nama'          => $user->name,
            'pendidikan'    => $user->pengguna->PNG_PEND,
            'telpon'        => $user->pengguna->PNG_TLP,
            'alamat'        => $user->pengguna->PNG_ALMNT,
            'username'      => $user->username,
            'hak_akses'     => $user->pengguna->KTPNG_ID,
            'avatar'        => $images,
            'tanggal_masuk' => strtotime($user->created_at),
            'tanggal_daftar'=> strtotime($user->updated_at),
        );

        $res['is_ok']   = true;
        $res['message'] = 'Update Data User Success';
        $res['data']    = $data;
        return response($res);
    }
}