<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ikm;
use App\Images;
use App\Pengguna;
use App\Produk;
use App\User;

use File;

class IkmController extends Controller
{
	public function __construct(Request $request)
    {
        $this->dateInsert   = date('Y-m-d H:i:s');
        $this->dateUpdate   = date('Y-m-d H:i:s');
    }

	public function index()
	{
		$data = Ikm::with('images', 'provinsi', 'kabkot', 'kecamatan', 'desa')->paginate(30);
		
		foreach($data as $row){
			if($row->images['IMG_NAMA'] == ""){
                $images = Images::imageDefault();
            }else{
                $images = url($row->images['IMG_NAMA']);
            }
			$dataJson[] = array(
				'id_ikm'		=> $row->IKM_ID,
				'thumbnail' 	=> $images,
				'kode'			=> $row->IKM_KODE,
				'nama'			=> $row->IKM_NAMA,
				'nik_pemilik'	=> $row->IKM_NIKPEMILIK,
				'npwp'			=> $row->IKM_NPWP,
				'nama_pemilik'	=> $row->IKM_PEMILIK,
				'no_pendirian'	=> $row->IKM_NOPENDIRIAN,
				'jenis_usaha'	=> $row->IKM_JENISUSAHA,
				'email'			=> $row->IKM_EMAIL,
				'telpon'		=> $row->IKM_TLP,
				'tgl_berdiri'	=> strtotime($row->IKM_DTBERDIRI),
				'provinsi'		=> $row->provinsi['name'],
				'kabkot'		=> $row->kabkot['name'],
				'kecamatan'		=> $row->kecamatan['name'],
				'desa'			=> $row->desa['name'],
				'alamat_detail' => $row->IKM_ALMTDET,
				'longitude' 	=> $row->IKM_LONGI,
				'latitude' 		=> $row->IKM_LATI,
				'keterangan' 	=> $row->IKM_KET,
			);

		}

		if(isset($dataJson)){
			$res['is_ok']   = true;
			$res['message'] = "Success";
			$res['data']	= $dataJson;
		}else{
			$res['is_ok']   = false;
			$res['message'] = "No Result Data";
		}

		return response($res);
	}


	public function show($id)
	{
		$data = Ikm::with('images', 'provinsi', 'kabkot', 'kecamatan', 'desa', 'produk', 'produk.ratingProduk', 'produk.sukaProduk', 'produk.images')->where('IKM_ID', $id)->first();

		if($data){

			if($data->images['IMG_NAMA'] == ""){
                $imagesIkm = Images::imageDefault();
            }else{
                $imagesIkm = url($data->images['IMG_NAMA']);
            }

            $ratingProduk = 0;
            $sukaProduk   = 0;

            if($data->produk->count() > 0){
				foreach($data->produk as $p){
					if($p->images['IMG_NAMA'] == ""){
		                $imagesProduk = Images::imageDefault();
		            }else{
		                $imagesProduk = url($p->images['IMG_NAMA']);
		            }

		            if($p->ratingProduk->count() > 0){
		            	$ratingProduk = $p->ratingProduk->sum('RAT_BOBOT');
		            }

		            if($p->sukaProduk->count() > 0){
		            	$sukaProduk = $p->sukaProduk->sum('LK_STATUS');
		            }

					$produk[] = array(
						'id_produk' => $p->PRDK_ID,
						'thumbnail' => $imagesProduk,
						'nama'		=> $p->PRDK_NAMA, 
						'rating'    => $ratingProduk,
						'suka'      => $sukaProduk,
					);
				}
			}
			else{
				$produk = "";
			}

			
			$dataJson = array(
				'id_ikm'		=> $data->IKM_ID,
				'thumbnail' 	=> $imagesIkm,
				'kode'			=> $data->IKM_KODE,
				'nama'			=> $data->IKM_NAMA,
				'nik_pemilik'	=> $data->IKM_NIKPEMILIK,
				'npwp'			=> $data->IKM_NPWP,
				'nama_pemilik'	=> $data->IKM_PEMILIK,
				'no_pendirian'	=> $data->IKM_NOPENDIRIAN,
				'jenis_usaha'	=> $data->IKM_JENISUSAHA,
				'email'			=> $data->IKM_EMAIL,
				'telpon'		=> $data->IKM_TLP,
				'tgl_berdiri'	=> strtotime($data->IKM_DTBERDIRI),
				'provinsi'		=> $data->provinsi['name'],
				'kabkot'		=> $data->kabkot['name'],
				'kecamatan'		=> $data->kecamatan['name'],
				'desa'			=> $data->desa['name'],
				'alamat_detail' => $data->IKM_ALMTDET,
				'longitude' 	=> $data->IKM_LONGI,
				'latitude' 		=> $data->IKM_LATI,
				'keterangan' 	=> $data->IKM_KET,
				'kategori'		=> $produk
			);

			$res['is_ok']   = true;
			$res['message'] = "Success";
			$res['data']	= $dataJson;
		}else{
			$res['is_ok']   = false;
			$res['message'] = "No Result Data";
		}

		return response($res);
	}

	public function getSearchResult(Request $request)
	{
		$cari = $request->get('data');

		$data = Ikm::with('images', 'provinsi', 'kabkot', 'kecamatan', 'desa')
				->where('IKM_NAMA', 'LIKE', '%'.$cari.'%')
				->orWhere('IKM_NIKPEMILIK', 'LIKE', '%'.$cari.'%')
				->orWhere('IKM_NPWP', 'LIKE', '%'.$cari.'%')
				->orWhere('IKM_JENISUSAHA', 'LIKE', '%'.$cari.'%')
				->orWhere('IKM_PEMILIK', 'LIKE', '%'.$cari.'%')
				->paginate(30);


		foreach($data as $row){
			if($row->images['IMG_NAMA'] == ""){
                $images = Images::imageDefault();
            }else{
                $images = url($row->images['IMG_NAMA']);
            }
			$dataJson[] = array(
				'id_ikm'		=> $row->IKM_ID,
				'thumbnail' 	=> $images,
				'kode'			=> $row->IKM_KODE,
				'nama'			=> $row->IKM_NAMA,
				'nik_pemilik'	=> $row->IKM_NIKPEMILIK,
				'npwp'			=> $row->IKM_NPWP,
				'nama_pemilik'	=> $row->IKM_PEMILIK,
				'no_pendirian'	=> $row->IKM_NOPENDIRIAN,
				'jenis_usaha'	=> $row->IKM_JENISUSAHA,
				'email'			=> $row->IKM_EMAIL,
				'telpon'		=> $row->IKM_TLP,
				'tgl_berdiri'	=> strtotime($row->IKM_DTBERDIRI),
				'provinsi'		=> $row->provinsi['name'],
				'kabkot'		=> $row->kabkot['name'],
				'kecamatan'		=> $row->kecamatan['name'],
				'desa'			=> $row->desa['name'],
				'alamat_detail' => $row->IKM_ALMTDET,
				'longitude' 	=> $row->IKM_LONGI,
				'latitude' 		=> $row->IKM_LATI,
				'keterangan' 	=> $row->IKM_KET,
			);

		}

		if(isset($dataJson)){
			
			$res['is_ok']   = true;
			$res['message'] = "Success";
			$res['data']	= $dataJson;
		}else{
			$res['is_ok']   = false;
			$res['message'] = "No Result Data";
		}

	
		return response($res);
	}	

	public function listProduk(Request $request, $id)
	{
		$cari = $request->get('cari');
		$data = Produk::with('produkToKategoriProduk.kategoriProduk', 'ratingProduk', 'sukaProduk', 'ikm', 'images')->where('IKM_ID', $id)->where('PRDK_NAMA', 'LIKE', '%'.$cari.'%')->paginate(30);
            
        $ratingProduk = 0;
        $sukaProduk   = 0;
        foreach($data as $row)
        {
            if($row->images['IMG_NAMA'] == ""){
                $images = Images::imageDefault();
            }else{
                $images = url($row->images['IMG_NAMA']);
            }

            if($row->ratingProduk->count() > 0){
                $ratingProduk = $row->ratingProduk->sum('RAT_BOBOT');
            }

            if($row->sukaProduk->count() > 0){
                $sukaProduk = $row->sukaProduk->sum('RAT_BOBOT');
            }

            $dataJson[] = array(
                'id_produk'      => $row->PRDK_ID, 
                'thumbnail'      => $images,
                'nama'           => $row->PRDK_NAMA,
                'ikm'            => $row->ikm['IKM_NAMA'],
                'rating'         => $ratingProduk,
                'suka'           => $sukaProduk
            );
        }

        if(isset($dataJson)){
            $res['is_ok']   = true;
            $res['message'] = 'Success';
            $res['data']    = $dataJson;
        }else{
            $res['is_ok']   = false;
            $res['message'] = 'No Result Data';
        }

        return response($res);
	}

	public function updateUser(Request $request)
    {
        $id          = $request->id_user;
        // $idUser   = Auth::id();
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
        //$user->id       = $id;
        // $user->username = $request->input('username');
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
            //$sizeFile        = getimagesize($originalName);

            $imageName = time().'.'.$request->lampiran->getClientOriginalExtension();
            $foto      = 'images/user/'.$imageName;


            if(isset($getImages)){
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
	        }else{
                $request->lampiran->move(public_path('/images/user/'), $imageName);
                
                $rand = rand(1000, 9000);
                $images = new Images;   
                $images->IMG_ID        = 'IMG'.$rand.date('His'); 
                $images->ID            = $id; 
                $images->IMG_GROUP     = 'User'; 
                $images->IMG_NAMA      = $foto; 
                $images->IMG_KET       = $originalName; 
                $images->IMG_DTINS     = $this->dateInsert;
                $images->IMG_DTUPDT    = $this->dateUpdate;
                $images->IMG_USERINS   = $id;
                $images->IMG_USERUPDT  = $id;

                $images->save();
            }
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
