<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Ikm;
use App\Provinsi;
use App\Kecamatan;
use App\Images;
use App\Kabkot;
use App\Desa;
use App\Produk;
use App\ProdukToKategoriProduk;
use App\Sentra;
use App\IkmToSertifikasi;
use App\IkmToEvent;
use App\User;
use App\Pengguna;
use Carbon\Carbon;
use App\GenerateFormatDate;
use File;
use Response;
use App\Imports\IkmImport;
use Maatwebsite\Excel\Facades\Excel;

class IndustriBesarController extends Controller
{
    public function index()
    {
        return view('admin.industri-besar.index');
    }

    public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'IKMID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

    public function getData()
    {
        $ikm = ikm::where('IKM_KAT_ID', 'KATIKMID222222')->get();
        $data = Datatables::of($ikm)
               
                ->addColumn('IKM_NAMA', function($row){
                     return $html = '<a href="#" data-href="'.url('admin/industri-besar/edit/').'" data-id="'.$row->IKM_ID.'" onclick="actionButton(this)">'.$row->IKM_NAMA.'</a>'; 
                  })
                  ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="'.url('admin/industri-besar/produk/'.$row->IKM_ID).'" type="button" class="btn btn-default btn-sm" title="Produk">
                                  <i class="fa fa-dropbox"></i>
                                </a>
                                <a href="'.url('admin/industri-besar/sertifikasi/'.$row->IKM_ID).'" type="button" class="btn btn-default btn-sm" title="Sertifikasi">
                                  <i class="fa fa-folder"></i>
                                </a>
                                <a href="'.url('admin/industri-besar/event/'.$row->IKM_ID).'" type="button" class="btn btn-default btn-sm" title="Event">
                                  <i class="fa fa-calendar"></i>
                                </a>
                                <a href="#" style="display:none" onclick="confirmLink(this)" data-href="'.url('admin/ikm/hapus/'.$row->IKM_ID).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['IKM_NAMA','action','confirmed'])
                  ->make(true);

        return $data;
    }

    public function uploadExcel()
    {
        return view('admin.industri-besar.import');
    }

    public function importExcel(Request $request) 
    {
    	$idUser = Auth::id();
        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            $data = \Excel::load($path)->get();

            if($data->count()){
                foreach ($data as $key => $value) {
                    $rand = rand(1000, 9000);

                    $idProvinsi  = 36;
                    $idKabkot 	 = 3601;
                    $idKecamatan = 3601010;
                    $idDesa      = 3601010001;
                    $kategoriIkm = 'KATIKMID222222';
                    $idIkm       = 'IKMID'.$rand.date('His');

                DB::beginTransaction();
                try {  
                        $data = new Ikm;
                        $data->IKM_KAT_ID     = $kategoriIkm;
                        $data->IKM_ID         = $idIkm;
                        $data->IKM_KODE       = $rand.date('His');
                        $data->IKM_NAMA       = $value->perusahaan;
                        $data->IKM_NPWP       = '';
                        $data->IKM_NIKPEMILIK = '';
                        $data->IKM_PEMILIK    = $value->perusahaan;
                        $data->IKM_NOPENDIRIAN= '';
                        $data->IKM_DTBERDIRI  = date('Y-m-d');
                        $data->IKM_JENISUSAHA = '';
                        $data->IKM_TLP        = '';
                        $data->IKM_EMAIL      = '';
                        $data->IKM_LONGI      = '';
                        $data->IKM_LATI       = '';
                        $data->IKM_PROV       = $idProvinsi;
                        $data->IKM_BENTUKBADAN= '';
                        $data->IKM_THNDIKELUARKANIJIN= '';
                        $data->IKM_KABKOT     = $idKabkot;
                        $data->IKM_KEC        = $idKecamatan;
                        $data->IKM_DESA       = $idDesa;
                        $data->IKM_ALMTDET    = '';
                        $data->IKM_KET        = '';
                        $data->IKM_DTINS      = $this->dateInsert;
                        $data->IKM_DTUPDT     = $this->dateUpdate;
                        $data->IKM_USERINS    = $idUser;
                        $data->IKM_USERUPDT   = $idUser;
                        $data->save();

                        //update images
                        $rand = rand(1000, 9000);
                        $images = new Images;   
                        $images->IMG_ID        = 'IMG'.$rand.date('His'); 
                        $images->ID            = $idIkm; 
                        $images->IMG_GROUP     = 'IKM'; 
                        $images->IMG_NAMA      = ''; 
                        $images->IMG_KET       = 'IKM IMAGE'; 
                        $images->IMG_DTINS     = $this->dateInsert;
                        $images->IMG_DTUPDT    = $this->dateUpdate;
                        $images->IMG_USERINS   = $idUser;
                        $images->IMG_USERUPDT  = $idUser;
                        $images->save();

                        //Produk
                        $data = new Produk;
                        $prdkId = 'PRDKID'.$rand.date('His');
                        $data->PRDK_ID        = $prdkId;
                        $data->IKM_ID         = $idIkm;
                        $data->PRDK_KODE      = $rand.date('His');
                        $data->PRDK_NAMA      = $value->komoditi;
                        $data->PRDK_KOMPOSISI = '';
                        $data->PRDK_KET       = '';
                        $data->PRDK_KBLI      = $value->kelompok_industri;
                        $data->PRDK_TAMPIL    = 1;
                        $data->PRDK_DTINS     = $this->dateInsert;
                        $data->PRDK_DTUPDT    = $this->dateUpdate;
                        $data->PRDK_USERINS   = $idUser;
                        $data->PRDK_USERUPDT  = $idUser;
                        $data->PRDK_PEMASARAN = 0;
                        $data->PRDK_BBBP                    = 0;
                        $data->PRDK_NILAIPRODUKSI           = '';
                        $data->PRDK_SATUANKAPASITASPRODUKSI = '';
                        $data->PRDK_JUMLAHKAPASITASPRODUKSI = 0;
                        $data->PRDK_NILAIINVESTASI          = 0;
                        $data->PRDK_TENAGAKERJA             = 0;

                        $data->save();

                         //update images Produk
                        $rand = rand(1000, 9000);
                        $images = new Images;   
                        $images->IMG_ID        = 'IMG'.$rand.date('His'); 
                        $images->ID            = $prdkId; 
                        $images->IMG_GROUP     = 'PRDK'; 
                        $images->IMG_NAMA      = ''; 
                        $images->IMG_KET       = 'PRODUK IMAGE'; 
                        $images->IMG_DTINS     = $this->dateInsert;
                        $images->IMG_DTUPDT    = $this->dateUpdate;
                        $images->IMG_USERINS   = $idUser;
                        $images->IMG_USERUPDT  = $idUser;
                        $images->save();

                        //Kategori Produk
                        $rand = rand(1000, 9000);
                        $produkToKategoriProduk = new ProdukToKategoriProduk;
                        $produkToKategoriProduk->PTK_ID        = 'PTK'.$rand.date('His');
                        $produkToKategoriProduk->KTPRDK_ID     = 'KTPRDKID4533120446'; 
                        $produkToKategoriProduk->PRDK_ID       = $prdkId; 
                        $produkToKategoriProduk->PTK_KET       = ''; 
                        $produkToKategoriProduk->PTK_DTINS     = $this->dateInsert;
                        $produkToKategoriProduk->PTK_DTUPDT    = $this->dateUpdate;
                        $produkToKategoriProduk->PTK_USERINS   = $idUser;
                        $produkToKategoriProduk->PTK_USERUPDT  = $idUser;

                        $produkToKategoriProduk->save();


                        //Create User
                        $username = User::getUserName($value->perusahaan, date('His'));   
                        $user     = User::create([
                                    'name'     => $value->perusahaan,
                                    'email'    => $username,
                                    'username' => $username,
                                    'password' => bcrypt('123456'),
                                  ]); 


                        //Pengguna
                        $rand = rand(1000, 9000);
                        $pengguna = new Pengguna;
                        $pengguna->PNG_ID       = 'PNGID'.$rand.date('His'); 
                        $pengguna->IKM_ID       = $idIkm;
                        $pengguna->PNG_NIK      = '';
                        $pengguna->PNG_PEND     = '';
                        $pengguna->PNG_TLP      = '';
                        $pengguna->PNG_ALMNT    = '';
                        $pengguna->PNG_EMAIL    = $username;
                        $pengguna->USER_ID      = $user->id;
                        $pengguna->KTPNG_ID     = 'KTPNGID7663231943';
                        $pengguna->PNG_NAMA     = $value->perusahaan;
                        $pengguna->PNG_DTINS    = $this->dateInsert;
                        $pengguna->PNG_DTUPDT   = $this->dateUpdate;
                        $pengguna->PNG_USERINS  = '';
                        $pengguna->PNG_USERUPDT = '';
                        $pengguna->save();

                        $token                  = $user->createToken($username)-> accessToken; 
                        $updateToken            = User::find($user->id);
                        $updateToken->token     = $token;
                        $updateToken->save();


                        //Image User
                        $rand = rand(1000, 9000);
                        $images = new Images;   
                        $images->IMG_ID        = 'IMG'.$rand.date('His'); 
                        $images->ID            = $user->id; 
                        $images->IMG_GROUP     = 'USER'; 
                        $images->IMG_NAMA      = ''; 
                        $images->IMG_KET       = 'PRODUK IMAGE'; 
                        $images->IMG_DTINS     = $this->dateInsert;
                        $images->IMG_DTUPDT    = $this->dateUpdate;
                        $images->IMG_USERINS   = $idUser;
                        $images->IMG_USERUPDT  = $idUser;
                        $images->save();

                        DB::commit();
                }catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong
                }
                        
                }

            }
        } 

        return redirect('admin/industri-besar')->with('message','Transaction Success');
    }


    public function downloadExcel() 
    {
        $file= public_path().'/doc/format-industri-besar.xlsx';

        $headers = array(
                  'Content-Type: application/xlsx',
                );

        return Response::download($file, 'format-industri-besar.xlsx', $headers);
    }

    public function create()
    {
        $data = array(
            'provinsi' => Provinsi::all(),
            'kabkot'   => Kabkot::all(),
            'kecamatan'=> Kecamatan::all(),
            'desa'     => Desa::all()
        );
        return view('admin.industri-besar.add')->with($data);
    }

    public function store(Request $request)
    {
        $idUser = Auth::id();
        $request->validate([
            'ikmNama'       => 'required',
            'ikmNpwp'       => 'required',
            'nikPemilik'    => 'required',
            'ikmPemilik'    => 'required',
            //'ikmNoPendirian'=> 'required',
            //'ikmDtBerdiri'  => 'required',
            'ikmJenisUsaha' => 'required',
            //'ikmThnDiKeluarkanIjin' => 'required',
            'ikmBentukBadan' => 'required',
            'ikmTlp'        => 'required',
            'ikmEmail'      => 'required',
            'provinsi'      => 'required',
            'kabkot'        => 'required',
            'kecamatan'     => 'required',
            'desa'     => 'required',
        ]);

        DB::beginTransaction();
        try {

            $data = new Ikm;

            $kategoriIkm = 'KATIKMID222222';
            $data->IKM_ID         = $this->id;
            $data->IKM_KAT_ID     = $kategoriIkm;
            $data->IKM_KODE       = $this->kode;
            $data->IKM_NAMA       = $request->ikmNama;
            $data->IKM_NPWP       = $request->ikmNpwp;
            $data->IKM_NIKPEMILIK = $request->nikPemilik;
            $data->IKM_PEMILIK    = $request->ikmPemilik;
            $data->IKM_NOPENDIRIAN= '';
            $data->IKM_DTBERDIRI  = date('Y-m-d');;
            $data->IKM_JENISUSAHA = $request->ikmJenisUsaha;
            $data->IKM_TLP        = $request->ikmTlp;
            $data->IKM_EMAIL      = $request->ikmEmail;
            $data->IKM_LONGI      = $request->ikmLongi;
            $data->IKM_LATI       = $request->ikmLati;
            $data->IKM_PROV       = $request->provinsi;
            $data->IKM_BENTUKBADAN= $request->ikmBentukBadan;
            $data->IKM_THNDIKELUARKANIJIN= '';
            $data->IKM_KABKOT     = $request->kabkot;
            $data->IKM_KEC        = $request->kecamatan;
            $data->IKM_DESA       = $request->desa;
            $data->IKM_ALMTDET    = $request->ikmAlmtDet;
            $data->IKM_KET        = $request->ikmKet;
            $data->IKM_DTINS      = $this->dateInsert;
            $data->IKM_DTUPDT     = $this->dateUpdate;
            $data->IKM_USERINS    = $idUser;
            $data->IKM_USERUPDT   = $idUser;

            $data->save();

            //update images
            $foto         = "";
            $originalName = "";
            if($request->hasFile('ikmImage')){
                $originalName    = $request->file('ikmImage')->getClientOriginalName();
            
                $imageName = time().'.'.$request->ikmImage->getClientOriginalExtension();
                $foto      = 'images/ikm/'.$imageName;

                $request->ikmImage->move(public_path('/images/ikm/'), $imageName);   
            }

            $rand = rand(1000, 9000);
            $images = new Images;   
            $images->IMG_ID        = 'IMG'.$rand.date('His'); 
            $images->ID            = $this->id; 
            $images->IMG_GROUP     = 'IKM'; 
            $images->IMG_NAMA      = $foto; 
            $images->IMG_KET       = $originalName; 
            $images->IMG_DTINS     = $this->dateInsert;
            $images->IMG_DTUPDT    = $this->dateUpdate;
            $images->IMG_USERINS   = $idUser;
            $images->IMG_USERUPDT  = $idUser;

            $images->save();

            //Create User
            $username = User::getUserName($request->ikmPemilik, date('His'));   
            $user     = User::create([
                        'name'     => $request->ikmPemilik,
                        'email'    => $request->ikmEmail,
                        'username' => $username,
                        'password' => bcrypt('123456'),
                      ]); 


            //Pengguna
            $rand = rand(1000, 9000);
            $pengguna = new Pengguna;
            $pengguna->PNG_ID       = 'PNGID'.$rand.date('His'); 
            $pengguna->IKM_ID       = $this->id;
            $pengguna->PNG_NIK      = '';
            $pengguna->PNG_PEND     = '';
            $pengguna->PNG_TLP      = '';
            $pengguna->PNG_ALMNT    = '';
            $pengguna->PNG_EMAIL    = $username;
            $pengguna->USER_ID      = $user->id;
            $pengguna->KTPNG_ID     = 'KTPNGID7663231943';
            $pengguna->PNG_NAMA     = $request->ikmPemilik;
            $pengguna->PNG_DTINS    = $this->dateInsert;
            $pengguna->PNG_DTUPDT   = $this->dateUpdate;
            $pengguna->PNG_USERINS  = '';
            $pengguna->PNG_USERUPDT = '';
            $pengguna->save();

            $token                  = $user->createToken($username)-> accessToken; 
            $updateToken            = User::find($user->id);
            $updateToken->token     = $token;
            $updateToken->save();


            //Image User
            $rand = rand(1000, 9000);
            $images = new Images;   
            $images->IMG_ID        = 'IMG'.$rand.date('His'); 
            $images->ID            = $user->id; 
            $images->IMG_GROUP     = 'USER'; 
            $images->IMG_NAMA      = ''; 
            $images->IMG_KET       = 'USER IMAGE'; 
            $images->IMG_DTINS     = $this->dateInsert;
            $images->IMG_DTUPDT    = $this->dateUpdate;
            $images->IMG_USERINS   = $idUser;
            $images->IMG_USERUPDT  = $idUser;
            $images->save();

        DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        return redirect('admin/industri-besar')->with('message','Transaction Success');
    }

    public function edit($id)
    {
        $ikm = Ikm::where('IKM_ID', $id)->first();
        $data = array(
            'ikm'      => $ikm,
            'provinsi' => Provinsi::all(),
            'kabkot'   => Kabkot::where('id', $ikm->IKM_KABKOT)->first(),
            'kecamatan'=> Kecamatan::where('id', $ikm->IKM_KEC)->first(),
            'desa'     => Desa::where('id', $ikm->IKM_DESA)->first(),
            'image'    => Images::where('ID', $id)->first(),
        );
        return view('admin.industri-besar.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $idUser = Auth::id();
        $request->validate([
            'ikmNama'       => 'required',
            'ikmNpwp'       => 'required',
            'nikPemilik'    => 'required',
            // 'ikmNoPendirian'=> 'required',
            // 'ikmDtBerdiri'  => 'required',
            'ikmJenisUsaha' => 'required',
            'ikmTlp'        => 'required',
            // 'ikmThnDiKeluarkanIjin' => 'required',
            'ikmBentukBadan' => 'required',
            'ikmEmail'      => 'required',
            'provinsi'      => 'required',
            'kabkot'        => 'required',
            'kecamatan'     => 'required',
            'desa'     => 'required',
        ]);

        DB::beginTransaction();
            try {    

            $data = Ikm::where('IKM_ID', $id)->update([
                'IKM_NAMA'=> $request->ikmNama,
                'IKM_NPWP'=> $request->ikmNpwp,
                'IKM_NIKPEMILIK'=> $request->nikPemilik,
                'IKM_PEMILIK'=> $request->ikmPemilik,
                // 'IKM_NOPENDIRIAN'=> $request->ikmNoPendirian,
                // 'IKM_DTBERDIRI'=> GenerateFormatDate::formatDate($request->ikmDtBerdiri),
                'IKM_JENISUSAHA'=> $request->ikmJenisUsaha,
                'IKM_TLP'=> $request->ikmTlp,
                'IKM_EMAIL'=> $request->ikmEmail,
                'IKM_LONGI'=> $request->ikmLongi,
                'IKM_LATI'=> $request->ikmLati,
                'IKM_PROV'=> $request->provinsi,
                'IKM_BENTUKBADAN'=> $request->ikmBentukBadan,
                // 'IKM_THNDIKELUARKANIJIN'=> $request->ikmThnDiKeluarkanIjin,
                'IKM_KABKOT'=> $request->kabkot,
                'IKM_KEC'=> $request->kecamatan,
                'IKM_DESA'=> $request->desa,
                'IKM_ALMTDET'=> $request->ikmAlmtDet,
                'IKM_KET'=> $request->ikmKet,
                'IKM_DTUPDT'=> $this->dateUpdate,
                'IKM_USERUPDT'=> $idUser,
            ]);

            //update images
            if($request->hasFile('ikmImage')){

                $originalName    = $request->file('ikmImage')->getClientOriginalName();
            
                $imageName = time().'.'.$request->ikmImage->getClientOriginalExtension();
                $foto      = 'images/ikm/'.$imageName;

                $getImage = Images::where('ID', $id)->first();

                File::delete(public_path($getImage->IMG_NAMA));

                $request->ikmImage->move(public_path('/images/ikm/'), $imageName);   
            }else{

                if($request->oldIkmImage == ""){
                  $foto         = "";
                  $originalName = "";
                }else{
                  $foto         = $request->oldIkmImage;
                  $originalName = $request->oldIkmImage;
                }
            }

            $rand = rand(1000, 9000);
            $images = Images::where('ID', $id)->update([

              'IMG_NAMA'      => $foto, 
              'IMG_KET'       => $originalName, 
              'IMG_DTUPDT'    => $this->dateUpdate,
              'IMG_USERUPDT'  => $idUser,

            ]);   

         DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
        return redirect('admin/industri-besar')->with('message','Transaction Success');
    }

    public function cetakLaporan(Request $request)
    {
        $type  = "xlsx";
        $array = explode('-', $request->daterange);
        
        $startDate  = Carbon::parse($array[0])->format('Y-m-d');
        $endDate    = Carbon::parse($array[1])->format('Y-m-d');

        $datas = Ikm::with('produk')->where('IKM_DTINS', '>=', $startDate)->where('IKM_DTINS', '<=', $endDate)->where('IKM_KAT_ID', 'KATIKMID222222')->get();

        $no = 1;
        foreach($datas as $item){
            $provinsi    = Provinsi::where('id', $item->IKM_PROV)->first();
            $kabupaten   = Kabkot::where('id', $item->IKM_KABKOT)->first();
            $kecamatan   = Kecamatan::where('id', $item->IKM_KEC)->first();
            $desa        = Desa::where('id', $item->IKM_DESA)->first();

            foreach($item->produk as $itemProduk){
                $data[] = array(
                    'No'             => $no,
                    'Nama Perusahaan'=> $item->IKM_NAMA,
                    'Nama Pemilik'=> $item->IKM_PEMILIK,
                    'Alamat'=> $item->IKM_ALMTDET,
                    'Desa'=> $desa->name,
                    'Kecamatan'=> $kecamatan->name,
                    'Kab/Kota'=> $kabupaten->name,
                    'Telp/Fax'=> $item->IKM_TLP,
                    'Bentuk Badan'=> $item->IKM_BENTUKBADAN,
                    'Tahun Dikeluarkan Ijin'=> $item->IKM_THNDIKELUARKANIJIN,
                    'KBLI'=> $itemProduk->PRDK_KBLI,
                    'Nama Produk'=> $itemProduk->PRDK_NAMA,
                    'Tenaga Kerja'=> $itemProduk->TENAGAKERJA,
                    'Nilai Investasi'=> $itemProduk->PRDK_NILAIINVESTASI,
                    'Jumlah Kapasitas Produksi'=> $itemProduk->PRDK_JUMLAHKAPASITASPRODUKSI,
                    'Satuan kapasitas Produksi'=> $itemProduk->PRDK_SATUANKAPASITASPRODUKSI,
                    'Nilai Produksi'=> $itemProduk->PRDK_NILAIPRODUKSI,
                    'Nilai BB/BP'=> $itemProduk->PRDK_BBBP,
                    'Pemasaran Ekspor (%)'=> $itemProduk->PRDK_PEMASARAN,
                );
                $no++;
            }
        }

        if($datas->count() > 0){
            return \Excel::create('industri-besar', function($excel) use ($data) {
                $excel->sheet('industri-besar', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);
        }else{
            return redirect('admin/industri-besar')->with('message-failed','Transaction Success');
        }
    }
}
