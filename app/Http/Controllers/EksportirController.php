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

    public function cetakLaporan(Request $request)
    {
        $type  = "xlsx";
        $array = explode('-', $request->daterange);
        
        $startDate  = Carbon::parse($array[0])->format('Y-m-d');
        $endDate    = Carbon::parse($array[1])->format('Y-m-d');

        $datas = Eksportir::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->get();

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
            return \Excel::create('eksportir', function($excel) use ($data) {
                $excel->sheet('eksportir', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);
        }else{
            return redirect('admin/eksportir/index')->with('message-failed','Transaction Success');
        }
    }
}
