<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriProduk;
use App\Ikm;
use App\Produk;
use App\Images;
use App\ProdukToKategoriProduk;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use File;
use QrCode;

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
        return view('admin.produk.index');
    }

    public function getData()
    {
        $produk = Produk::with('images')->get();
        $data = Datatables::of($produk)
                ->addColumn('produk', function($row){
                     return $html = '<a href="#" data-href="'.url('admin/produk/edit/').'" data-id="'.$row->PRDK_ID.'" onclick="actionButton(this)">'.$row->PRDK_NAMA.'</a>'; 
                })
                ->addColumn('image', function($row){
                    if($row->images['IMG_NAMA'] == ""){
                        $images = Images::imageDefault();
                    }else{
                        $images = url($row->images['IMG_NAMA']);
                    }
                    return $html = '<img src="'.$images.'" style="width:100px;">';
                })
                ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" style="display:none" onclick="confirmLink(this)" data-href="'.url('admin/produk/hapus/'.$row->PRDK_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete" disabled><i class="fa fa-trash"></i>
                                </a>
                                <a href="'.url('admin/produk/generate-qr/'.$row->PRDK_ID).'" target="blank" type="button" class="btn btn-default btn-sm" title="Generate QR Code"><i class="fa fa-qrcode"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['produk','image','action','confirmed'])
                  ->make(true);

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $ikm            = Ikm::all();
        $kategoriProduk = KategoriProduk::all();

        return view('admin.produk.add', compact('kategoriProduk', 'ikm'));
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
            'ikmId'          => 'required',
            'prdkNama'       => 'required',
            'prdkKomposisi'  => 'required',
            'prdkKeterangan' => 'required',
            'prdkPemasaran' => 'required',
            'prdkBbbp' => 'required',
            'prdkNilaiProduksi' => 'required',
            'prdkSatuanKapasitas' => 'required',
            'prdkJumlahKapasitasProduksi' => 'required',
            'prdkNilaiInvestasi' => 'required',
            'prdkTenagaKerja' => 'required',
            'prdkKbli'       => 'required',
        ]);

        $data = new Produk;
        $data->PRDK_ID        = $this->id;
        $data->IKM_ID         = $request->ikmId;
        $data->PRDK_KODE      = $this->kode;
        $data->PRDK_NAMA      = $request->prdkNama;
        $data->PRDK_KOMPOSISI = $request->prdkKomposisi;
        $data->PRDK_KET       = $request->prdkKeterangan;
        $data->PRDK_KBLI      = $request->prdkKbli;
        $data->PRDK_TAMPIL    = 1;
        $data->PRDK_DTINS     = $this->dateInsert;
        $data->PRDK_DTUPDT    = $this->dateUpdate;
        $data->PRDK_USERINS   = $idUser;
        $data->PRDK_USERUPDT  = $idUser;
        $data->PRDK_PEMASARAN = $request->prdkPemasaran;
        $data->PRDK_BBBP = $request->prdkBbbp;
        $data->PRDK_NILAIPRODUKSI = $request->prdkNilaiProduksi;
        $data->PRDK_SATUANKAPASITASPRODUKSI = $request->prdkSatuanKapasitas;
        $data->PRDK_JUMLAHKAPASITASPRODUKSI = $request->prdkJumlahKapasitasProduksi;
        $data->PRDK_NILAIINVESTASI = $request->prdkNilaiInvestasi;
        $data->PRDK_TENAGAKERJA = $request->prdkTenagaKerja;

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
        $foto         = "";
        $originalName = "";
        if($request->hasFile('prdkImage')){
            $originalName    = $request->file('prdkImage')->getClientOriginalName();
        
            $imageName = time().'.'.$request->prdkImage->getClientOriginalExtension();
            $foto      = 'images/produk/'.$imageName;

            $request->prdkImage->move(public_path('/images/produk/'), $imageName);   
        }

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

        return redirect('admin/produk/list')->with('message','Transaction Success');
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
        $produk         = Produk::where('PRDK_ID', $id)->first();
        $ptkproduk      = ProdukToKategoriProduk::where('PRDK_ID', $id)->get();
        $image          = Images::where('ID', $id)->first();
        $ikm            = Ikm::all();
        $kategoriProduk = KategoriProduk::all();

        return view('admin.produk.edit', compact('kategoriProduk', 'ikm', 'produk', 'ptkproduk', 'image'));
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
        $idUser = Auth::id();
        $request->validate([
            'ktprdkId'       => 'required',
            'ikmId'          => 'required',
            'prdkNama'       => 'required',
            'prdkKomposisi'  => 'required',
            'prdkKeterangan' => 'required',
            'prdkKbli'       => 'required',

            'prdkPemasaran' => 'required',
            'prdkBbbp' => 'required',
            'prdkNilaiProduksi' => 'required',
            'prdkSatuanKapasitas' => 'required',
            'prdkJumlahKapasitasProduksi' => 'required',
            'prdkNilaiInvestasi' => 'required',
            'prdkTenagaKerja' => 'required',
        ]);

        $data = Produk::where('PRDK_ID', $id)->update([
            'IKM_ID'         => $request->ikmId,
            'PRDK_KODE'      => $this->kode,
            'PRDK_NAMA'      => $request->prdkNama,
            'PRDK_KOMPOSISI' => $request->prdkKomposisi,
            'PRDK_KET'       => $request->prdkKeterangan,
            'PRDK_KBLI'      => $request->prdkKbli,
            'PRDK_TAMPIL'    => 1,
            'PRDK_DTUPDT'    => $this->dateUpdate,
            'PRDK_USERUPDT'  => $idUser,

            'PRDK_PEMASARAN' => $request->prdkPemasaran,
            'PRDK_BBBP' => $request->prdkBbbp,
            'PRDK_NILAIPRODUKSI' => $request->prdkNilaiProduksi,
            'PRDK_SATUANKAPASITASPRODUKSI' => $request->prdkSatuanKapasitas,
            'PRDK_JUMLAHKAPASITASPRODUKSI' => $request->prdkJumlahKapasitasProduksi,
            'PRDK_NILAIINVESTASI' => $request->prdkNilaiInvestasi,
            'PRDK_TENAGAKERJA' => $request->prdkTenagaKerja,
        ]);
        

        $deletePtkprdk = ProdukToKategoriProduk::where('PRDK_ID', $id)->delete();

        foreach($request->ktprdkId AS $kategoriProduk){
            $rand = rand(1000, 9000);
            $produkToKategoriProduk = new ProdukToKategoriProduk;
            $produkToKategoriProduk->PTK_ID        = 'PTK'.$rand.date('His');
            $produkToKategoriProduk->KTPRDK_ID     = $kategoriProduk; 
            $produkToKategoriProduk->PRDK_ID       = $id; 
            $produkToKategoriProduk->PTK_KET       = ''; 
            $produkToKategoriProduk->PTK_DTINS     = $this->dateInsert;
            $produkToKategoriProduk->PTK_DTUPDT    = $this->dateUpdate;
            $produkToKategoriProduk->PTK_USERINS   = $idUser;
            $produkToKategoriProduk->PTK_USERUPDT  = $idUser;

            $produkToKategoriProduk->save();
        } 

        //update images
        
        
        if($request->hasFile('prdkImage')){

            $originalName    = $request->file('prdkImage')->getClientOriginalName();
        
            $imageName = time().'.'.$request->prdkImage->getClientOriginalExtension();
            $foto      = 'images/produk/'.$imageName;

            $getImage = Images::where('ID', $id)->first();

            File::delete(public_path($getImage->IMG_NAMA));

            $request->prdkImage->move(public_path('/images/produk/'), $imageName);   
        }else{

            if($request->oldPrdkImage == ""){
              $foto         = "";
              $originalName = "";
            }else{
              $foto         = $request->oldPrdkImage;
              $originalName = $request->oldPrdkImage;
            }
        }

        $rand = rand(1000, 9000);
        $images = Images::where('ID', $id)->update([

          'IMG_NAMA'      => $foto, 
          'IMG_KET'       => $originalName, 
          'IMG_DTUPDT'    => $this->dateUpdate,
          'IMG_USERUPDT'  => $idUser,

        ]);   
        

        return redirect('admin/produk/list')->with('message','Transaction Success');
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

    public function generateQr(Request $request, $id)
    {
        return QrCode::size(500)->generate($id);
    }
}
