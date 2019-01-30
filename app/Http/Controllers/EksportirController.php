<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eksportir;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\GenerateFormatDate;

class EksportirController extends Controller
{
	public function index()
	{
		return view('admin.eksportir.index');
	}

	public function getData()
    {
        $eksportir = Eksportir::all();

        $data = Datatables::of($eksportir)

                ->addColumn('nama_perusahaan', function($row){
                     return $html = '<a href="'.route('eksportir.edit', $row->id).'">'.$row->nama_perusahaan.'</a>'; 
                  })
                ->editColumn('created_at', function ($row) {
                     return $row->created_at ? with(new Carbon($row->created_at))->format('m/d/Y') : '';
                 })
                 ->addColumn('action', function($row){
                      $html = '<div class="text-center">
                                <a href="#" onclick="confirmLink(this)" data-href="'.route('eksportir.destroy',$row->id).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
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
      return view('admin.eksportir.add');
    }

    public function store(Request $request)
    {
        $eksportir = new Eksportir;
        $eksportir->nama_perusahaan = $request->namaPerusahaan;
        $eksportir->alamat_perusahaan = $request->alamatPerusahaan;
        $eksportir->npwp = $request->npwp;
        $eksportir->nama_pemilik = $request->namaPemilik;
        $eksportir->email = $request->email;
        $eksportir->telp = $request->telp;
        $eksportir->nomor_api = $request->nomorApi;
        $eksportir->uraian_barang = $request->uraianBarang;
        $eksportir->pos_taris = $request->posTaris;
        $eksportir->volume_kuantitas = $request->volumeKuantitas;
        $eksportir->volume_satuan = $request->volumeSatuan;
        $eksportir->nilai = $request->nilai;
        $eksportir->nilai_satuan = $request->nilaiSatuan;
        $eksportir->negara_asal = $request->negaraAsal;
        $eksportir->pelabuhan_bongkar = $request->pelabuhanBongkar;
        $eksportir->pib_nomor = $request->pibNomor;
        $eksportir->pib_tanggal = GenerateFormatDate::formatDate($request->pibTanggal);
        $eksportir->keterangan = $request->keterangan;

        $eksportir->save();

        return redirect('admin/eksportir/index')->with('message','Transaction Success');
    }

    public function edit($id)
    {
      $eksportir = Eksportir::find($id);
      return view('admin.eksportir.edit', compact('eksportir'));
    }

    public function update(Request $request, $id)
    {
        $eksportir = Eksportir::find($id);
        $eksportir->nama_perusahaan = $request->namaPerusahaan;
        $eksportir->alamat_perusahaan = $request->alamatPerusahaan;
        $eksportir->npwp = $request->npwp;
        $eksportir->nama_pemilik = $request->namaPemilik;
        $eksportir->email = $request->email;
        $eksportir->telp = $request->telp;
        $eksportir->nomor_api = $request->nomorApi;
        $eksportir->uraian_barang = $request->uraianBarang;
        $eksportir->pos_taris = $request->posTaris;
        $eksportir->volume_kuantitas = $request->volumeKuantitas;
        $eksportir->volume_satuan = $request->volumeSatuan;
        $eksportir->nilai = $request->nilai;
        $eksportir->nilai_satuan = $request->nilaiSatuan;
        $eksportir->negara_asal = $request->negaraAsal;
        $eksportir->pelabuhan_bongkar = $request->pelabuhanBongkar;
        $eksportir->pib_nomor = $request->pibNomor;
        $eksportir->pib_tanggal = GenerateFormatDate::formatDate($request->pibTanggal);
        $eksportir->keterangan = $request->keterangan;

        $eksportir->save();

        return redirect('admin/eksportir/index')->with('message','Transaction Success');
    }

    public function destroy($id)
    {
       Eksportir::find($id)->delete();
       return redirect('admin/eksportir/index')->with('message','Transaction Success');
    }
}
