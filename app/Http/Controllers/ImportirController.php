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
        $request->validate([
            'namaPerusahaan' => 'required',
            'alamatPerusahaan'=> 'required',
            'npwp'=> 'required',
            'namaPemilik'=> 'required',
            'email'=> 'required',
            'telp'=> 'required',
            'nomorApi'=> 'required',
            'uraianBarang'=> 'required',
            'posTaris'=> 'required',
            'volumeKuantitas'=> 'required',
            'volumeSatuan'=> 'required',
            'nilai'=> 'required',
            'nilaiSatuan'=> 'required',
            'negaraAsal'=> 'required',
            'pelabuhanBongkar'=> 'required',
            'pibNomor'=> 'required',
            'pibTanggal'=> 'required',
        ]);

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
        $request->validate([
            'namaPerusahaan' => 'required',
            'alamatPerusahaan'=> 'required',
            'npwp'=> 'required',
            'namaPemilik'=> 'required',
            'email'=> 'required',
            'telp'=> 'required',
            'nomorApi'=> 'required',
            'uraianBarang'=> 'required',
            'posTaris'=> 'required',
            'volumeKuantitas'=> 'required',
            'volumeSatuan'=> 'required',
            'nilai'=> 'required',
            'nilaiSatuan'=> 'required',
            'negaraAsal'=> 'required',
            'pelabuhanBongkar'=> 'required',
            'pibNomor'=> 'required',
            'pibTanggal'=> 'required',
        ]);
        
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

    public function cetakLaporan(Request $request)
    {
        $type  = "xlsx";
        $array = explode('-', $request->daterange);
        
        $startDate  = Carbon::parse($array[0])->format('Y-m-d');
        $endDate    = Carbon::parse($array[1])->format('Y-m-d');

        $datas = Importir::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->get();

        $no = 1;
        foreach($datas as $item){

            $data[] = array(
                'No'             => $no,
                'Nama Perusahaan'=> $item->nama_perusahaan,
                'Alamat Perusahaan'=> $item->alamat_perusahaan,
                'NPWP' => $item->npwp,
                'Nama Pemilik' => $item->nama_pemilik,  
                'Email' => $item->email, 
                'Telp' => $item->telp, 
                'Nomor Api' => $item->nomor_api,
                'Uraian Barang' => $item->uraian_barang,
                'Pos Taris' => $item->pos_taris, 
                'Volume Kuantitas' => $item->volume_kuantitas, 
                'Volume Satuan' => $item->volume_satuan, 
                'Nilai' => $item->nilai,
                'Nilai Satuan' => $item->nilai_satuan, 
                'Negara Asal' => $item->negara_asal,
                'Pelabuhan Bongkar' => $item->pelabuhan_bongkar,
                'Pib Nomor' => $item->pib_nomor, 
                'Pib Tanggal' => $item->pib_tanggal, 
                'Keterangan' => $item->keterangan,
            );
            $no++;
        }


        if($datas->count() > 0){
            return \Excel::create('importir', function($excel) use ($data) {
                $excel->sheet('importir', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);
        }else{
            return redirect('admin/importir/index')->with('message-failed','Transaction Success');
        }
    }
}
