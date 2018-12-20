<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produk::with('produkToKategoriProduk.kategoriProduk', 'ratingProduk', 'sukaProduk', 'ikm', 'images')->get();

        
        foreach($data as $row)
        {
            $dataJson[] = array(
                'id_produk'      => $row->PRDK_ID, 
                'thumbnail'      => $row->images['IMG_NAMA'],
                'nama'           => $row->PRDK_NAMA,
                'rating'         => $row->ratingProduk->sum('RAT_BOBOT'),
                'suka'           => $row->sukaProduk->sum('LK_STATUS')
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Produk::with('produkToKategoriProduk.kategoriProduk', 'ratingProduk', 'sukaProduk', 'ikm', 'images', 'ikm.ikmToSertifikasi.sertifikasi')
                ->where('PRDK_ID', $id)
                ->first();  

        if($data){
            foreach($data->produkToKategoriProduk as $dptkp){
                $kategoriProduk[] = array(
                    'id_kategori' => $dptkp->kategoriProduk['KTPRDK_ID'],
                    'name'        => $dptkp->kategoriProduk['KTPRDK_NAMA']
                );
                
            }
            
            $dataJson = array(
                'thumbnail'  => $data->images['IMG_NAMA'],
                'id_produk'  => $data->PRDK_ID,
                'kode'       => $data->PRDK_KODE,
                'nama'       => $data->PRDK_NAMA,
                'komposisi'  => $data->PRDK_KOMPOSISI,
                'keterangan' => $data->PRDK_KET,
                "kbli"       => $data->PRDK_KBLI,
                "rating"     => $data->ratingProduk->sum('RAT_BOBOT'),
                "suka"       => $data->sukaProduk->sum('LK_STATUS'),
                "kategori"   => $kategoriProduk,
                "sertifikat" => $data->ikmToSertifikasi,
                "ikm"        => array(
                                    'id_ikm'    => $data->ikm['IKM_ID'], 
                                    'nama'      => $data->ikm['IKM_NAMA'],
                                    'latitude'  => $data->ikm['IKM_LATI'],
                                    'longitude' => $data->ikm['IKM_LONGI']
                                ),
                    

            );
            $res['is_ok']   = true;
            $res['message'] = 'Success';
            $res['data']    = $dataJson;
        }else{
            $res['is_ok']   = false;
            $res['message'] = 'No Result Data';
        }

        return response($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSearchResult(Request $request)
    {
        $cari = $request->get('data');

        $data = Produk::with('produkToKategoriProduk.kategoriProduk', 'ratingProduk', 'sukaProduk', 'ikm', 'images')
                ->where('PRDK_NAMA', 'LIKE', '%'.$cari.'%')
                ->get();

        foreach($data as $row)
        {
            $dataJson[] = array(
                'id_produk'      => $row->PRDK_ID, 
                'thumbnail'      => $row->images['IMG_NAMA'],
                'nama'           => $row->PRDK_NAMA,
                'rating'         => $row->ratingProduk->sum('RAT_BOBOT'),
                'suka'           => $row->sukaProduk->sum('LK_STATUS')
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
}
