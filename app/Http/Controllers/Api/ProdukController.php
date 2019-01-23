<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Produk;
use App\Images;
use App\SukaProduk;
use App\RatingProduk;
use App\User;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->idLike    = 'LKID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

    public function index()
    {
        $data = Produk::with('produkToKategoriProduk.kategoriProduk', 'ratingProduk', 'sukaProduk', 'ikm', 'images')->paginate(30);
            
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
            if($data->produkToKategoriProduk->count() > 0){
                foreach($data->produkToKategoriProduk as $dptkp){
                    $kategoriProduk[] = array(
                        'id_kategori' => $dptkp->kategoriProduk['KTPRDK_ID'],
                        'name'        => $dptkp->kategoriProduk['KTPRDK_NAMA']
                    );
                    
                }
            }else{
                $kategoriProduk = "";
            }

            if($data->ikm->ikmToSertifikasi->count() > 0){
                foreach($data->ikm->ikmToSertifikasi as $itemSertifikasi){
                    $sertifikasi[] = array(
                        'id_sertifikat' => $itemSertifikasi->sertifikasi['SRT_ID'],
                        'no_sertifikat' => '',
                        'name'          => $itemSertifikasi->sertifikasi['SRT_NAMA'],
                        'register'      => strtotime($itemSertifikasi['ITS_DTDAFTAR']),
                    );
                }
            }else{
                $sertifikasi = "";
            }

            if($data->images['IMG_NAMA'] == ""){
                $images = Images::imageDefault();
            }else{
                $images = url($data->images['IMG_NAMA']);
            }

            $ratingProduk = 0;
            if($data->ratingProduk->count() > 0){
                $ratingProduk = $data->ratingProduk->sum('RAT_BOBOT');
            }

            $sukaProduk = 0;
            if($data->sukaProduk->count() > 0){
                $sukaProduk = $data->sukaProduk->sum('LK_STATUS');
            }
            
            $dataJson = array(
                'thumbnail'  => $images,
                'id_produk'  => $data->PRDK_ID,
                'kode'       => $data->PRDK_KODE,
                'nama'       => $data->PRDK_NAMA,
                'komposisi'  => $data->PRDK_KOMPOSISI,
                'keterangan' => $data->PRDK_KET,
                "kbli"       => $data->PRDK_KBLI,
                "rating"     => $ratingProduk,
                "suka"       => $sukaProduk,
                "kategori"   => $kategoriProduk,
                "sertifikat" => $sertifikasi,
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
                ->paginate(30);

        foreach($data as $row)
        {
            if($row->images['IMG_NAMA'] == ""){
                $images = Images::imageDefault();
            }else{
                $images = url($row->images['IMG_NAMA']);
            }

            $ratingProduk = 0;
            if($row->ratingProduk->count() > 0){
                $ratingProduk = $row->ratingProduk->sum('RAT_BOBOT');
            }

            $sukaProduk = 0;
            if($row->sukaProduk->count() > 0){
                $sukaProduk = $row->sukaProduk->sum('LK_STATUS');
            }

            $dataJson[] = array(
                'id_produk'      => $row->PRDK_ID, 
                'thumbnail'      => $images,
                'nama'           => $row->PRDK_NAMA,
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

    public function likeProduk($idProduk, $idUser)
    {
        $cek = SukaProduk::where('PRDK_ID', $idProduk)->where('PNG_ID', $idUser)->get();

        if($cek->count() > 0){
            SukaProduk::where('PRDK_ID', $idProduk)->where('PNG_ID', $idUser)->delete();
            $message = "Anda batal menyukai produk ini";
        }else{
            $sukaProduk = new SukaProduk;
            $sukaProduk->LK_ID         = $this->idLike;
            $sukaProduk->PRDK_ID       = $idProduk;
            $sukaProduk->PNG_ID        = $idUser;
            $sukaProduk->LK_STATUS     = 1;
            $sukaProduk->LK_LONGI      = '';
            $sukaProduk->LK_LATI       = '';
            $sukaProduk->LK_DTINS     = $this->dateInsert;
            $sukaProduk->LK_DTUPDT    = $this->dateUpdate;
            $sukaProduk->LK_USERINS   = $idUser;
            $sukaProduk->LK_USERUPDT  = $idUser;

            $sukaProduk->save();

            $message = "Anda telah menyukai produk ini";
        }

        $dataSukaProduk = SukaProduk::getSukaProduk();
        $data = array(
            'jumlah_like' => $dataSukaProduk->jumlahLike
        );

        $res['is_ok']  = true;
        $res['message']= $message;
        $res['data']   = $data;

        return response($res);
    }

    public function ratingProduk($idProduk, $idUser, $rating)
    {
        $cek = RatingProduk::where('PRDK_ID', $idProduk)->where('PNG_ID', $idUser)->get();

        if($cek->count() > 0){
            RatingProduk::where('PRDK_ID', $idProduk)->where('PNG_ID', $idUser)->delete();
            $message = "Anda batal memberikan rating produk ini";
        }else{
            $ratingProduk = new RatingProduk;
            $ratingProduk->RAT_ID        = $this->idLike;
            $ratingProduk->PRDK_ID       = $idProduk;
            $ratingProduk->PNG_ID        = $idUser;
            $ratingProduk->RAT_BOBOT     = $rating;
            $ratingProduk->RAT_LONGI      = '';
            $ratingProduk->RAT_LATI       = '';
            $ratingProduk->RAT_DTINS     = $this->dateInsert;
            $ratingProduk->RAT_DTUPDT    = $this->dateUpdate;
            $ratingProduk->RAT_USERINS   = $idUser;
            $ratingProduk->RAT_USERUPDT  = $idUser;

            $ratingProduk->save();

            $message = "Anda telah memberikan rating produk ini";
        }
        
        $dataRatingProduk = RatingProduk::getRatingProduk();
        $data = array(
            'rating' => $dataRatingProduk->jumlahRating
        );

        $res['is_ok']  = true;
        $res['message']= $message;
        $res['data']   = $data;

        return response($res);
    }

    public function detailLike($idProduk)
    {
        //$likes = SukaProduk::with('user', 'user.images')->where('PRDK_ID', $idProduk)->get();
        $likes = SukaProduk::getDetailLike($idProduk);
        if($likes->count() > 0){
            foreach($likes as $item){
                if($item->IMG_NAMA == "" || $item->IMG_NAMA == NULL){
                    $images = Images::imageDefault();
                }else{
                    $images = $item->IMG_NAMA;
                }
                $data[] = array(
                    'id_user'   => $item->PNG_ID,
                    'thumbnail' => $images,
                    'nama'      => $item->name,
                );
            }

            $res['is_ok']  = true;
            $res['message']= "Get Detail Like berhasil";
            $res['data']   = $data;
        }else{
            $res['is_ok']  = false;
            $res['message']= "No Result Data";
        }

        return response($res);
    }
}
