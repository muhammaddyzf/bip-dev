<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ikm;

class IkmController extends Controller
{
	public function index()
	{
		$data = Ikm::with('images', 'provinsi', 'kabkot', 'kecamatan', 'desa')->get();

		foreach($data as $row){
			$dataJson[] = array(
				'id_ikm'		=> $row->IKM_ID,
				'thumbnail' 	=> $row->images['IMG_NAMA'],
				'kode'			=> $row->IKM_KODE,
				'nama'			=> $row->IKM_NAMA,
				'nik_pemilik'	=> $row->IKM_NIKPEMILIK,
				'npwp'			=> $row->IKM_NPWP,
				'nama_pemilik'	=> $row->IKM_PEMILIK,
				'no_pendirian'	=> $row->IKM_NOPENDIRIAN,
				'jenis_usaha'	=> $row->IKM_JENISUSAHA,
				'email'			=> $row->IKM_EMAIL,
				'telpon'		=> $row->IKM_TLP,
				'tgl_berdiri'	=> $row->IKM_DTBERDIRI,
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
			foreach($data->produk as $p){
				$produk[] = array(
					'id_produk' => $p->PRDK_ID,
					'thumbnail' => $p->images['IMG_NAMA'],
					'nama'		=> $p->PRDK_NAMA, 
					'rating'    => $p->ratingProduk->sum('RAT_BOBOT'),
					'suka'      => $p->sukaProduk->sum('LK_STATUS'),
				);
			}
			
			$dataJson = array(
				'id_ikm'		=> $data->IKM_ID,
				'thumbnail' 	=> $data->images['IMG_NAMA'],
				'kode'			=> $data->IKM_KODE,
				'nama'			=> $data->IKM_NAMA,
				'nik_pemilik'	=> $data->IKM_NIKPEMILIK,
				'npwp'			=> $data->IKM_NPWP,
				'nama_pemilik'	=> $data->IKM_PEMILIK,
				'no_pendirian'	=> $data->IKM_NOPENDIRIAN,
				'jenis_usaha'	=> $data->IKM_JENISUSAHA,
				'email'			=> $data->IKM_EMAIL,
				'telpon'		=> $data->IKM_TLP,
				'tgl_berdiri'	=> $data->IKM_DTBERDIRI,
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
				->get();

		if($data){
			foreach($data as $row){
				$dataJson[] = array(
					'id_ikm'		=> $row->IKM_ID,
					'thumbnail' 	=> $row->images['IMG_NAMA'],
					'kode'			=> $row->IKM_KODE,
					'nama'			=> $row->IKM_NAMA,
					'nik_pemilik'	=> $row->IKM_NIKPEMILIK,
					'npwp'			=> $row->IKM_NPWP,
					'nama_pemilik'	=> $row->IKM_PEMILIK,
					'no_pendirian'	=> $row->IKM_NOPENDIRIAN,
					'jenis_usaha'	=> $row->IKM_JENISUSAHA,
					'email'			=> $row->IKM_EMAIL,
					'telpon'		=> $row->IKM_TLP,
					'tgl_berdiri'	=> $row->IKM_DTBERDIRI,
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
			
			$res['is_ok']   = true;
			$res['message'] = "Success";
			$res['data']	= $dataJson;
		}else{
			$res['is_ok']   = false;
			$res['message'] = "No Result Data";
		}

	
		return response($res);
	}	
}
