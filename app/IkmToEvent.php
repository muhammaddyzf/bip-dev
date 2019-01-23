<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IkmToEvent extends Model
{
	protected $table = 'tb_ikm_to_event';
	public $timestamps = false;

	public function ikm()
	{
		return $this->belongsTo('App\Ikm', 'IKM_ID', 'IKM_ID');
	}

	public function event()
	{
		return $this->belongsTo('App\Event', 'EVT_ID', 'EVT_ID');
	}

	public static function getAgendaIkm($idIkm, $keyword)
	{
		$agendaIkm = DB::table('tb_ikm_to_event AS ITE')
					->leftjoin('tb_event AS E', 'E.EVT_ID', '=', 'ITE.EVT_ID')
					->leftjoin('tb_provinsi AS PRV', 'PRV.id', '=', 'E.EVT_PROV')
					->leftjoin('tb_kabkot AS KABKOT', 'KABKOT.id', '=', 'E.EVT_KABKOT')
					->leftjoin('tb_kecamatan AS KEC', 'KEC.id', '=', 'E.EVT_KEC')
					->leftjoin('tb_desa AS DES', 'DES.id', '=', 'E.EVT_DESA')
					->select(
						DB::raw("
								ITE.EVT_ID AS id_pelatihan
								, E.EVT_NAMA AS nama 
								, E.EVT_PANITIA AS panitia
								, UNIX_TIMESTAMP(E.EVT_DTDARI) AS tgl_dari
								, UNIX_TIMESTAMP(E.EVT_DTSAMPAI) AS tgl_sampai
								, PRV.name AS provinsi
								, KABKOT.name AS kabkot
								, KEC.name AS kecamatan
								, DES.name AS desa
								, E.EVT_ALMTDET AS alamat_detail
								, E.EVT_LATI AS latitude
								, E.EVT_LONGI AS longitude
								, E.EVT_TEMA AS tema
								, ITE.ITE_HADIR AS hadir
								, ITE.IKM_ID
							")
					)
					->where('ITE.IKM_ID', $idIkm)
					->where('E.EVT_NAMA' , 'like', '%'.$keyword.'%')
					->orwhere('E.EVT_TEMA' , 'like', '%'.$keyword.'%')
					->paginate(30);

		return $agendaIkm;
	}

	public static function getDetailAgendaIkm($idPelatihan)
	{
		$agendaIkm = DB::table('tb_ikm_to_event AS ITE')
					->leftjoin('tb_event AS E', 'E.EVT_ID', '=', 'ITE.EVT_ID')
					->leftjoin('tb_provinsi AS PRV', 'PRV.id', '=', 'E.EVT_PROV')
					->leftjoin('tb_kabkot AS KABKOT', 'KABKOT.id', '=', 'E.EVT_KABKOT')
					->leftjoin('tb_kecamatan AS KEC', 'KEC.id', '=', 'E.EVT_KEC')
					->leftjoin('tb_desa AS DES', 'DES.id', '=', 'E.EVT_DESA')
					->select(
						DB::raw("
								ITE.EVT_ID AS id_pelatihan
								, E.EVT_NAMA AS nama 
								, E.EVT_PANITIA AS panitia
								, UNIX_TIMESTAMP(E.EVT_DTDARI) AS tgl_dari
								, UNIX_TIMESTAMP(E.EVT_DTSAMPAI) AS tgl_sampai
								, PRV.name AS provinsi
								, KABKOT.name AS kabkot
								, KEC.name AS kecamatan
								, DES.name AS desa
								, E.EVT_ALMTDET AS alamat_detail
								, E.EVT_LATI AS latitude
								, E.EVT_LONGI AS longitude
								, E.EVT_TEMA AS tema
								, ITE.ITE_HADIR AS hadir
								, ITE.IKM_ID
							")
					)
					->where('ITE.EVT_ID', $idPelatihan)
					->first();

		return $agendaIkm;
	}

	public static function getScanAgendaIkm($idEvent, $idIkm)
	{
		$agendaIkm = DB::table('tb_ikm_to_event AS ITE')
			->leftjoin('tb_event AS E', 'E.EVT_ID', '=', 'ITE.EVT_ID')
			->leftjoin('tb_provinsi AS PRV', 'PRV.id', '=', 'E.EVT_PROV')
			->leftjoin('tb_kabkot AS KABKOT', 'KABKOT.id', '=', 'E.EVT_KABKOT')
			->leftjoin('tb_kecamatan AS KEC', 'KEC.id', '=', 'E.EVT_KEC')
			->leftjoin('tb_desa AS DES', 'DES.id', '=', 'E.EVT_DESA')
			->select(
				DB::raw("
						ITE.EVT_ID AS id_pelatihan
						, E.EVT_NAMA AS nama 
						, E.EVT_PANITIA AS panitia
						, UNIX_TIMESTAMP(E.EVT_DTDARI) AS tgl_dari
						, UNIX_TIMESTAMP(E.EVT_DTSAMPAI) AS tgl_sampai
						, PRV.name AS provinsi
						, KABKOT.name AS kabkot
						, KEC.name AS kecamatan
						, DES.name AS desa
						, E.EVT_ALMTDET AS alamat_detail
						, E.EVT_LATI AS latitude
						, E.EVT_LONGI AS longitude
						, E.EVT_TEMA AS tema
						, ITE.ITE_HADIR AS hadir
						, ITE.IKM_ID
					")
			)
			->where('ITE.EVT_ID', $idEvent)
			->where('ITE.IKM_ID', $idIkm)
			->first();
			
		return $agendaIkm;
	}
}
