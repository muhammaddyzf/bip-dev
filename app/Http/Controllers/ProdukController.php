<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriProduk;
use App\Ikm;
use App\Produk;
use App\Images;
use App\ProdukToKategoriProduk;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{

    public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'PRDKID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id = "")
    {   
        $ikm            = Ikm::where('IKM_ID', $id)->first();
        $kategoriProduk = KategoriProduk::all();

        return view('user.produk.add', compact('kategoriProduk', 'ikm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUser = Auth::id();
        $request->validate([
            'ktprdkId'       => 'required',
            'ikmNama'        => 'required',
            'prdkNama'       => 'required',
            'prdkKomposisi'  => 'required',
            'prdkKeterangan' => 'required',
            'prdkKbli'       => 'required|alpha_dash|max:10',
            'prdkImage'      => 'required',
        ]);

        $data = new Produk;
        $data->PRDK_ID        = $this->id;
        $data->IKM_ID         = $request->idIkm;
        $data->PRDK_KODE      = $this->kode;
        $data->PRDK_NAMA      = $request->prdkNama;
        $data->PRDK_KOMPOSISI = $request->prdkKomposisi;
        $data->PRDK_KET       = $request->prdkKeterangan;
        $data->PRDK_KBLI      = $request->prdkKbli;
        $data->PRDK_TAMPIL    = 0;
        $data->PRDK_DTINS     = $this->dateInsert;
        $data->PRDK_DTUPDT    = $this->dateUpdate;
        $data->PRDK_USERINS   = $idUser;
        $data->PRDK_USERUPDT  = $idUser;
        $data->save();

        
        foreach($request->ktprdkId AS $kategoriProduk){
            $rand = rand(1000, 9000);
            $produkToKategoriProduk = new ProdukToKategoriProduk;
            $produkToKategoriProduk->PTK_ID        = 'PTK'.$rand.date('His');
            $produkToKategoriProduk->KTPRDK_ID     = $kategoriProduk; 
            $produkToKategoriProduk->PRDK_ID       = $this->id; 
            $produkToKategoriProduk->PTK_KET       = ''; 
            $produkToKategoriProduk->PTK_DTINS     = $this->dateInsert;
            $produkToKategoriProduk->PTK_DTUPDT    = $this->dateUpdate;
            $produkToKategoriProduk->PTK_USERINS   = $idUser;
            $produkToKategoriProduk->PTK_USERUPDT  = $idUser;

            $produkToKategoriProduk->save();
        } 

        //update images
        $foto = "";
        if($request->hasFile('prdkImage')){
            // $getImages       = Images::where('ID', $id)->first();
            $originalName    = $request->file('prdkImage');
            // $sizeFile        = getimagesize($originalName);
            
            $imageName = time().'.'.$request->prdkImage->getClientOriginalExtension();
            $foto      = 'images/produk/'.$imageName;

            // if(substr($getImages->IMG_NAMA, 0, 11) != 'default-images-produk.png'){

            //     File::delete(public_path($getImages->IMG_NAMA));

            //     $request->prdkImage->move(public_path('/images/produk/'), $imageName);
            // }

            $request->prdkImage->move(public_path('/images/produk/'), $imageName);
            $rand = rand(1000, 9000);
            $images = new Images;   
            $images->IMG_ID        = 'IMG'.$rand.date('His'); 
            $images->ID            = $this->id; 
            $images->IMG_GROUP     = 'PRODUK'; 
            $images->IMG_NAMA      = $foto; 
            $images->IMG_KET       = $originalName; 
            $images->IMG_DTINS     = $this->dateInsert;
            $images->IMG_DTUPDT    = $this->dateUpdate;
            $images->IMG_USERINS   = $idUser;
            $images->IMG_USERUPDT  = $idUser;
            $images->save();

            // $images = Images::where('ID', $id)
            //           ->update([
            //                 'IMG_NAMA'      => $foto,
            //                 'IMG_DTUPDT'    => $this->dateUpdate,
            //                 'IMG_USERUPDT'  => $idUser,
            //           ]);
        }

        return back()->with('message','Transaction Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
