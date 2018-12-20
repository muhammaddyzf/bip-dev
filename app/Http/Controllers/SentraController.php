<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
use App\Kecamatan;
use App\Kabkot;
use App\Desa;
use App\Sentra;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class SentraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.sentra.index');
    }

    public function getData()
    {
        $sentra = Sentra::all();

        $data = Datatables::of($sentra)
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
                ->addColumn('nama_sentra', function($row){
                     return $html = '<a href="#" data-href="'.url('user/edit/sentra/').'" data-id="'.$row->id.'" onclick="actionButton(this)">'.$row->nama_sentra.'</a>'; 
                  })
                  ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" onclick="confirmLink(this)" data-href="'.url('user/hapus/sentra/'.$row->id).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['nama_sentra','icon','action', 'confirmed'])
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
        return view('user.sentra.add')->with($data);
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
            'namaSentra'        => 'required',
            'jenisProduk'       => 'required',
            'jumlahUnitUsaha'   => 'required',
            'kontakPerson'      => 'required',
            'kecamatan'         => 'required',
            'provinsi'          => 'required',
            'kabkot'            => 'required',
            'alamat'            => 'required',
            'tenagaKerja'       => 'required',
            'nilaiInvestasi'    => 'required',
            'kapasitasProduksi' => 'required',
        ]);

        $data = new Sentra;

        $data->nama_sentra       = $request->namaSentra;
        $data->jenis_produk      = $request->jenisProduk;
        $data->jumlah_unit_usaha = $request->jumlahUnitUsaha;
        $data->kontak_person     = $request->kontakPerson;
        $data->id_kecamatan      = $request->kecamatan;
        $data->id_provinsi       = $request->provinsi;
        $data->id_kabkot         = $request->kabkot;
        $data->alamat            = $request->alamat;
        $data->tenaga_kerja      = $request->tenagaKerja;
        $data->nilai_investasi   = $request->nilaiInvestasi;
        $data->kapasitas_produksi= $request->kapasitasProduksi;

        $data->save();
        return redirect('user/sentra')->with('message','Transaction Success');
        
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
            'sentra'       => Sentra::find($id),
            'provinsi'     => Provinsi::all(),
            'kabkot'       => Kabkot::all(),
            'kecamatan'    => Kecamatan::all(),
            'desa'         => Desa::all()
        );
        return view('user.sentra.edit')->with($data);
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
            'namaSentra'        => 'required',
            'jenisProduk'       => 'required',
            'jumlahUnitUsaha'   => 'required',
            'kontakPerson'      => 'required',
            'kecamatan'         => 'required',
            'provinsi'          => 'required',
            'kabkot'            => 'required',
            'alamat'            => 'required',
            'tenagaKerja'       => 'required',
            'nilaiInvestasi'    => 'required',
            'kapasitasProduksi' => 'required',
        ]);

        $data = Sentra::find($id);

        $data->nama_sentra       = $request->namaSentra;
        $data->jenis_produk      = $request->jenisProduk;
        $data->jumlah_unit_usaha = $request->jumlahUnitUsaha;
        $data->kontak_person     = $request->kontakPerson;
        $data->id_kecamatan      = $request->kecamatan;
        $data->id_provinsi       = $request->provinsi;
        $data->id_kabkot         = $request->kabkot;
        $data->alamat            = $request->alamat;
        $data->tenaga_kerja      = $request->tenagaKerja;
        $data->nilai_investasi   = $request->nilaiInvestasi;
        $data->kapasitas_produksi= $request->kapasitasProduksi;

        $data->save();
        return redirect('user/sentra')->with('message','Transaction Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Sentra::find($id);
        $data->delete();
        return redirect('user/sentra')->with('message','Transaction Success');
    }
}
