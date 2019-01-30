<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Notifications\MailNotification;
use App\Ikm;
use App\User;
use App\Pengguna;
use App\Event;
use App\Provinsi;
use App\Kabkot;
use App\Kecamatan;
use App\Desa;

class Notifications extends Model
{
	public static function mailInvitation($idUser, $idIkm, $idEvent)
	{
		//$user  = User::find($idUser);
		$ikm   = Ikm::where('IKM_ID', $idIkm)->first();
		$event = Event::where('EVT_ID', $idEvent)->first();

		$pengguna  = Pengguna::where('IKM_ID', $idIkm)->first(); 

		$user = User::where('id', $pengguna->USER_ID)->first();

		$provinsi = Provinsi::where('id', $event->EVT_PROV)->first();
		$kabkot   = Kabkot::where('id', $event->EVT_KABKOT)->first();
		$kecamatan= Kecamatan::where('id', $event->EVT_KEC)->first();
		$desa     = Desa::where('id', $event->EVT_DESA)->first();

		$invitation = (object) array(
    		'uid'   	=> '',
    		'subject'	=> 'Undangan Pelatihan '.$event->EVT_NAMA,
    		'pesan' 	=> 'Hallo '.$ikm->IKM_NAMA.', Sehubungan dengan akan diselenggarakan acara pelatihan dengan tema '.$event->EVT_TEMA.' yang berjudul '.$event->EVT_NAMA.' yang akan dilaksanakan pada '.date('d/m/Y', strtotime($event->EVT_DTDARI)).' sampai dengan '.date('d/m/Y',strtotime($event->EVT_DTSAMPAI)).' beralamat di '.$event->EVT_ALMTDET.' Desa '.$desa->name.' Kecamatan '.$kecamatan->name.' '.$kabkot->name.' Provinsi '.$provinsi->name,
    		'action'	=> '',
    		'role'  	=> 'admin',  
    	);

        $user->notify(new MailNotification($invitation)); 
	}

	public static function mailRegistration($user, $data)
	{
		$registration = (object) array(
    		'uid'   	=> '',
    		'subject'	=> 'Register Akun Baru BIP',
    		'pesan' 	=> 'Hallo '.$data['name'].' Terima kasih telah mendaftar untuk Banten Information Product! Silahkan login via aplikasi dengan menggunakan email dan kata sandi anda !' ,
    		'action'	=> '',
    		'role'  	=> 'user',  
    	);

        $user->notify(new MailNotification($registration)); 
	}
}
