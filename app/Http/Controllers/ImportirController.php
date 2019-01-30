<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Importir;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\GenerateFormatDate;

class ImportirController extends Controller
{
	public function index()
	{
		return view('admin.importir.index');
	}

	public function getData()
    {
        $importir = Importir::all();

        $data = Datatables::of($importir)

                ->addColumn('nama_perusahaan', function($row){
                     return $html = '<a href="'.route('importir.edit', $row->id).'">'.$row->nama_perusahaan.'</a>'; 
                  })
                ->editColumn('created_at', function ($row) {
                     return $row->created_at ? with(new Carbon($row->created_at))->format('m/d/Y') : '';
                 })
                 ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" onclick="confirmLink(this)" data-href="'.route('importir.destroy',$row->id).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                                </a>
                            </div>
                            ';
                      return $html;
                  })
                  ->rawColumns(['nama_perusahaan','action', 'confirmed'])
                  ->make(true);

        return $data;
    }

    public function create()
    {
      return view('admin.importir.add');
    }

    public function store(Request $request)
    {
        $importir = new Importir;
        $importir->nama_perusahaan = $request->namaPerusahaan;
        $importir->alamat_perusahaan = $request->alamatPerusahaan;
        $importir->npwp = $request->npwp;
        $importir->nama_pemilik = $request->namaPemilik;
        $importir->email = $request->email;
        $importir->telp = $request->telp;
        $importir->nomor_api = $request->nomorApi;
        $importir->uraian_barang = $request->uraianBarang;
        $importir->pos_taris = $request->posTaris;
        $importir->volume_kuantitas = $request->volumeKuantitas;
        $importir->volume_satuan = $request->volumeSatuan;
        $importir->nilai = $request->nilai;
        $importir->nilai_satuan = $request->nilaiSatuan;
        $importir->negara_asal = $request->negaraAsal;
        $importir->pelabuhan_bongkar = $request->pelabuhanBongkar;
        $importir->pib_nomor = $request->pibNomor;
        $importir->pib_tanggal = GenerateFormatDate::formatDate($request->pibTanggal);
        $importir->keterangan = $request->keterangan;

        $importir->save();

        return redirect('admin/importir/index')->with('message','Transaction Success');
    }

    public function edit($id)
    {
      $importir = Importir::find($id);
      return view('admin.importir.edit', compact('importir'));
    }

    public function update(Request $request, $id)
    {
        $importir = Importir::find($id);
        $importir->nama_perusahaan = $request->namaPerusahaan;
        $importir->alamat_perusahaan = $request->alamatPerusahaan;
        $importir->npwp = $request->npwp;
        $importir->nama_pemilik = $request->namaPemilik;
        $importir->email = $request->email;
        $importir->telp = $request->telp;
        $importir->nomor_api = $request->nomorApi;
        $importir->uraian_barang = $request->uraianBarang;
        $importir->pos_taris = $request->posTaris;
        $importir->volume_kuantitas = $request->volumeKuantitas;
        $importir->volume_satuan = $request->volumeSatuan;
        $importir->nilai = $request->nilai;
        $importir->nilai_satuan = $request->nilaiSatuan;
        $importir->negara_asal = $request->negaraAsal;
        $importir->pelabuhan_bongkar = $request->pelabuhanBongkar;
        $importir->pib_nomor = $request->pibNomor;
        $importir->pib_tanggal = GenerateFormatDate::formatDate($request->pibTanggal);
        $importir->keterangan = $request->keterangan;

        $importir->save();

        return redirect('admin/importir/index')->with('message','Transaction Success');
    }

    public function destroy($id)
    {
       Importir::find($id)->delete();
       return redirect('admin/importir/index')->with('message','Transaction Success');
    }
}
