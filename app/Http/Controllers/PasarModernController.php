<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
use App\Kecamatan;
use App\Kabkot;
use App\Desa;
use App\PasarModern;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class PasarModernController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pasar-modern.index');
    }

    public function getData()
    {
        $pasarModern = PasarModern::all();

        $data = Datatables::of($pasarModern)
                ->editColumn('created_at', function ($row) {
                     return $row->created_at ? with(new Carbon($row->created_at))->format('m/d/Y') : '';
                 })
                ->editColumn('kecamatan', function ($row) {
                     return $row->kecamatan->name ;
                 })
                ->editColumn('provinsi', function ($row) {
                     return $row->provinsi->name ;
                 })
                ->editColumn('kabupaten', function ($row) {
                     return $row->kabkot->name ;
                 })
                ->addColumn('nama_toko', function($row){
                     return $html = '<a href="#" data-href="'.url('admin/edit/pasar-modern/').'" data-id="'.$row->id.'" onclick="actionButton(this)">'.$row->nama_toko.'</a>'; 
                  })
                  ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" onclick="confirmLink(this)" data-href="'.url('admin/hapus/pasar-modern/'.$row->id).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['nama_toko','icon','action', 'confirmed'])
                  ->make(true);

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'provinsi' => Provinsi::all(),
            'kabkot'   => Kabkot::all(),
            'kecamatan'=> Kecamatan::all(),
            'desa'     => Desa::all()
        );
        return view('admin.pasar-modern.add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategoriPasar'   => 'required',
            'namaToko'        => 'required',
            'kecamatan'       => 'required',
            'provinsi'        => 'required',
            'kabkot'          => 'required',
            'alamat'          => 'required',
            'luasTanah'       => 'required',
            'luasBangunan'    => 'required',
            'namaPerusahaan'  => 'required',
            'alamatPerusahaan'=> 'required',
        ]);
        $data = new PasarModern;
        $data->kategori_pasar    = $request->kategoriPasar;
        $data->nama_toko         = $request->namaToko;
        $data->id_kecamatan      = $request->kecamatan;
        $data->id_provinsi       = $request->provinsi;
        $data->id_kabkot         = $request->kabkot;
        $data->alamat            = $request->alamat;
        $data->luas_tanah        = $request->luasTanah;
        $data->luas_bangunan     = $request->luasBangunan;
        $data->nama_perusahaan   = $request->namaPerusahaan;
        $data->alamat_perusahaan = $request->alamatPerusahaan;
        $data->desa              = "";


        $data->save();
        return redirect('admin/pasar-modern')->with('message','Transaction Success');
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
        $data = array(
            'pasarModern'       => PasarModern::find($id),
            'provinsi'          => Provinsi::all(),
            'kabkot'            => Kabkot::all(),
            'kecamatan'         => Kecamatan::all(),
            'desa'              => Desa::all()
        );
        return view('admin.pasar-modern.edit')->with($data);
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
        $request->validate([
            'kategoriPasar'   => 'required',
            'namaToko'        => 'required',
            'kecamatan'       => 'required',
            'provinsi'        => 'required',
            'kabkot'          => 'required',
            'alamat'          => 'required',
            'luasTanah'       => 'required',
            'luasBangunan'    => 'required',
            'namaPerusahaan'  => 'required',
            'alamatPerusahaan'=> 'required',
        ]);
        $data = PasarModern::find($id);
        $data->kategori_pasar    = $request->kategoriPasar;
        $data->nama_toko         = $request->namaToko;
        $data->id_kecamatan      = $request->kecamatan;
        $data->id_provinsi       = $request->provinsi;
        $data->id_kabkot         = $request->kabkot;
        $data->alamat            = $request->alamat;
        $data->luas_tanah        = $request->luasTanah;
        $data->luas_bangunan     = $request->luasBangunan;
        $data->nama_perusahaan   = $request->namaPerusahaan;
        $data->alamat_perusahaan = $request->alamatPerusahaan;
        $data->desa              = "";


        $data->save();
        return redirect('admin/pasar-modern')->with('message','Transaction Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PasarModern::find($id);
        $data->delete();
        return redirect('admin/pasar-modern')->with('message','Transaction Success');
    }

    public function cetakLaporan(Request $request)
    {
        $type  = "xlsx";
        $array = explode('-', $request->daterange);
        
        $startDate  = Carbon::parse($array[0])->format('Y-m-d');
        $endDate    = Carbon::parse($array[1])->format('Y-m-d');

        $datas = PasarModern::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->get();

        $no = 1;
        foreach($datas as $item){
            $provinsi    = Provinsi::where('id', $item->id_provinsi)->first();
            $kabupaten   = Kabkot::where('id', $item->id_kabkot)->first();
            $kecamatan   = Kecamatan::where('id', $item->id_kecamatan)->first();

            $data[] = array(
                'No'             => $no,
                'Nama Toko'     => $item->nama_toko,
                'Alamat'         => $item->alamat,
                'Provinsi'       => $provinsi->name,
                'Kabupaten/Kota' => $kabupaten->name,
                'Kecamatan'      => $kecamatan->name,
                'Luas Tanah'     => $item->luas_tanah,
                'Luas Bangunan'  => $item->luas_bangunan,
                'Nama Perusahaan'  => $item->nama_perusahaan,
                'Alamat Perusahaan'  => $item->alamat_perusahaan,
            );
            $no++;
        }

        if($datas->count() > 0){

            return \Excel::create('pasar-modern', function($excel) use ($data) {
                $excel->sheet('pasar-modern', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);

        }else{
            return redirect('admin/pasar-modern')->with('message-failed','Transaction Success');
        }
    }
}
