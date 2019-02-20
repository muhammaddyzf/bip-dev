<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('auth.login');
    return view('auth/login');
});

// Auth::routes();
// Route::get('logout', 'Auth\LoginController@logout')->name('logout');
// Route::get('test-update-user', function(){
//     return view('edit-user');
// });

Auth::routes();

Route::group(['prefix' => 'admin',  'middleware' => ['admin','auth:admin']], function() {   
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');


     //Route Pasar Tradisional
    Route::get('pasar-tradisional', 'PasarTradisionalController@index')->name('admin.pasar-tradisional');
    Route::get('data-pasar-tradisional', 'PasarTradisionalController@getData')->name('admin.data-pasar-tradisional');
    Route::get('tambah/pasar-tradisional', 'PasarTradisionalController@create')->name('admin.tambah.pasar-tradisional');
    Route::get('hapus/pasar-tradisional/{id}', 'PasarTradisionalController@destroy')->name('admin.hapus.pasar-tradisional');
    Route::get('edit/pasar-tradisional/{id}', 'PasarTradisionalController@edit')->name('admin.edit.pasar-tradisional');
    Route::post('simpan/pasar-tradisional', 'PasarTradisionalController@store')->name('admin.simpan.pasar-tradisional');
    Route::post('update/pasar-tradisional/{id}', 'PasarTradisionalController@update')->name('admin.update.pasar-tradisional');
    Route::post('pasar-tradisional/cetak-laporan', 'PasarTradisionalController@cetakLaporan')->name('pasar-tradisional.cetak-laporan');

    //Route Pasar Modern
    Route::get('pasar-modern', 'PasarModernController@index')->name('admin.pasar-modern');
    Route::get('data-pasar-modern', 'PasarModernController@getData')->name('admin.data-pasar-modern');
    Route::get('tambah/pasar-modern', 'PasarModernController@create')->name('admin.tambah.pasar-modern');
    Route::get('hapus/pasar-modern/{id}', 'PasarModernController@destroy')->name('admin.hapus.pasar-modern');
    Route::get('edit/pasar-modern/{id}', 'PasarModernController@edit')->name('admin.edit.pasar-modern');
    Route::post('simpan/pasar-modern', 'PasarModernController@store')->name('admin.simpan.pasar-modern');
    Route::post('update/pasar-modern/{id}', 'PasarModernController@update')->name('admin.update.pasar-modern');
    Route::post('pasar-modern/cetak-laporan', 'PasarModernController@cetakLaporan')->name('pasar-modern.cetak-laporan');

    //Route Sentra
    Route::get('sentra', 'SentraController@index')->name('admin.sentra');
    Route::get('data-sentra', 'SentraController@getData')->name('admin.data-sentra');
    Route::get('tambah/sentra', 'SentraController@create')->name('admin.tambah.sentra');
    Route::get('hapus/sentra/{id}', 'SentraController@destroy')->name('admin.hapus.sentra');
    Route::get('edit/sentra/{id}', 'SentraController@edit')->name('admin.edit.sentra');
    Route::post('simpan/sentra', 'SentraController@store')->name('admin.simpan.sentra');
    Route::post('update/sentra/{id}', 'SentraController@update')->name('admin.update.sentra');
    Route::post('sentra/cetak-laporan', 'SentraController@cetakLaporan')->name('sentra.cetak-laporan');

    //Route IKM
    Route::get('ikm', 'IkmController@index')->name('admin.ikm');
    Route::get('ikm/tambah', 'IkmController@create')->name('admin.ikm.tambah');
    Route::post('ikm/import', 'IkmController@importExcel')->name('admin.ikm.import');
    Route::get('ikm/upload', 'IkmController@uploadExcel')->name('admin.ikm.upload');
    Route::get('ikm/download-excel', 'IkmController@downloadExcel')->name('admin.ikm.download-excel');
    Route::get('ikm/cetak-laporan-excel/{type}', 'IkmController@cetakLaporan')->name('admin.ikm.cetak-laporan-excel');
    Route::get('ikm/hapus/{id}', 'IkmController@destroy')->name('admin.ikm.hapus');


    Route::post('ikm/simpan', 'IkmController@store')->name('admin.ikm.simpan');
    Route::get('ikm/data-ikm', 'IkmController@getData')->name('admin.ikm.get-data');
    Route::get('ikm/edit/{id}', 'IkmController@edit')->name('admin.ikm.edit');
    Route::post('ikm/update/{id}', 'IkmController@update')->name('admin.ikm.update');
    Route::get('ikm/produk/{id}', 'IkmController@produk')->name('admin.ikm.produk');
    Route::get('ikm/sertifikasi/{id}', 'IkmController@sertifikasi')->name('admin.ikm.sertifikasi');
    Route::get('ikm/event/{id}', 'IkmController@event')->name('admin.ikm.event');

    Route::post('ikm/cetak-laporan', 'IkmController@cetakLaporanIkm')->name('ikm.cetak-laporan');


    //Industri Besar
    Route::get('industri-besar', 'IndustriBesarController@index')->name('admin.industri-besar');
    Route::get('industri-besar/data-industri-besar', 'IndustriBesarController@getData')->name('admin.industri-besar.get-data');
    Route::get('industri-besar/upload', 'IndustriBesarController@uploadExcel')->name('admin.industri-besar.upload');
    Route::post('industri-besar/import', 'IndustriBesarController@importExcel')->name('admin.industri-besar.import');
    Route::get('industri-besar/download-excel', 'IndustriBesarController@downloadExcel')->name('admin.industri-besar.download-excel');
    Route::get('industri-besar/tambah', 'IndustriBesarController@create')->name('admin.industri-besar.tambah');
    Route::post('industri-besar/simpan', 'IndustriBesarController@store')->name('admin.industri-besar.simpan');

    Route::get('industri-besar/edit/{id}', 'IndustriBesarController@edit')->name('admin.industri-besar.edit');
    Route::post('industri-besar/update/{id}', 'IndustriBesarController@update')->name('admin.industri-besar.update');

    Route::get('industri-besar/produk/{id}', 'IkmController@produk')->name('admin.industri-besar.produk');
    Route::get('industri-besar/sertifikasi/{id}', 'IkmController@sertifikasi')->name('admin.industri-besar.sertifikasi');
    Route::get('industri-besar/event/{id}', 'IkmController@event')->name('admin.industri-besar.event');


    Route::post('industri-besar/cetak-laporan', 'IndustriBesarController@cetakLaporan')->name('industri-besar.cetak-laporan');

    //Route Wilayah
    Route::get('provinsi/{provinsi}/kabkot', 'ProvinsiController@getKabkot');
    Route::get('kabkot/{kabkot}/kecamatan', 'KabkotController@getKecamatan');
    Route::get('kecamatan/{kecamatan}/desa', 'KecamatanController@getdesa');

    //Route Kategori Pengguna
    Route::group(['prefix' => 'pengguna'],function(){      
        Route::get('kategori-pengguna', 'KategoriPenggunaController@index')->name('admin.pengguna.kategori-pengguna');
        Route::get('data-kategori-pengguna', 'KategoriPenggunaController@getData')->name('admin.pengguna.data-kategori-pengguna');
        Route::get('kategori-pengguna/tambah', 'KategoriPenggunaController@create')->name('admin.pengguna.kategori-pengguna.tambah');
        Route::get('kategori-pengguna/hapus/{id}', 'KategoriPenggunaController@destroy')->name('admin.pengguna.kategori-pengguna.hapus');
        Route::get('kategori-pengguna/edit/{id}', 'KategoriPenggunaController@edit')->name('admin.pengguna.kategori-pengguna.edit');
        Route::post('kategori-pengguna/simpan', 'KategoriPenggunaController@store')->name('admin.pengguna.kategori-pengguna.simpan');
        Route::post('kategori-pengguna/update/{id}', 'KategoriPenggunaController@update')->name('admin.pengguna.kategori-pengguna.update');


        Route::get('list', 'PenggunaController@index')->name('admin.pengguna.list');
        Route::get('data-pengguna', 'PenggunaController@getData')->name('admin.pengguna.data-pengguna');
        Route::get('tambah', 'PenggunaController@create')->name('admin.pengguna.tambah');
        Route::post('simpan', 'PenggunaController@store')->name('admin.pengguna.simpan');
        Route::get('edit/{id}', 'PenggunaController@edit')->name('admin.pengguna.edit');
        Route::get('hapus/{id}', 'PenggunaController@destroy')->name('admin.pengguna.hapus');
        Route::post('update/{id}', 'PenggunaController@update')->name('admin.pengguna.update');
    });

    //Route Kategori Produk
    Route::group(['prefix' => 'produk'],function(){    
        Route::get('kategori-produk', 'KategoriProdukController@index')->name('admin.produk.kategori-produk');
        Route::get('data-kategori-produk', 'KategoriProdukController@getData')->name('admin.produk.data-kategori-produk');
        Route::get('kategori-produk/tambah', 'KategoriProdukController@create')->name('admin.produk.kategori-produk.tambah');
        Route::get('kategori-produk/hapus/{id}', 'KategoriProdukController@destroy')->name('admin.produk.kategori-produk.hapus');
        Route::get('kategori-produk/edit/{id}', 'KategoriProdukController@edit')->name('admin.produk.kategori-produk.edit');
        Route::post('kategori-produk/simpan', 'KategoriProdukController@store')->name('admin.kategori-produk.simpan');
        Route::post('kategori-produk/update/{id}', 'KategoriProdukController@update')->name('admin.kategori-produk.update');


        Route::get('tambah', 'ProdukController@create')->name('admin.produk.tambah');
        Route::post('simpan', 'ProdukController@store')->name('admin.produk.simpan');
        Route::get('list', 'ProdukController@index')->name('admin.produk.list');
        Route::get('data-produk', 'ProdukController@getData')->name('admin.produk.data-produk');
        Route::get('edit/{id}', 'ProdukController@edit')->name('admin.produk.edit');
        Route::post('update/{id}', 'ProdukController@update')->name('admin.produk.update');
        Route::get('hapus/{id}', 'ProdukController@destroy')->name('admin.produk.hapus');

        Route::get('generate-qr/{id}', 'ProdukController@generateQr')->name('admin.produk.generate-qr');  
    });

    //Route Kategori Sertifikasi
    Route::group(['prefix' => 'sertifikasi'],function(){
        Route::get('kategori-sertifikasi', 'KategoriSertifikasiController@index')->name('admin.sertifikasi.kategori-sertifikasi');
        Route::get('kategori-sertifikasi/tambah', 'KategoriSertifikasiController@create')->name('admin.sertifikasi.kategori-sertifikasi.tambah');
        Route::get('data-kategori-sertifikasi', 'KategoriSertifikasiController@getData')->name('admin.data-kategori-sertifikasi');
        Route::get('kategori-sertifikasi/hapus/{id}', 'KategoriSertifikasiController@destroy')->name('admin.sertifikasi.kategori-sertifikasi.hapus');
        Route::get('kategori-sertifikasi/edit/{id}', 'KategoriSertifikasiController@edit')->name('admin.sertifikasi.kategori-sertifikasi.edit');
        Route::post('kategori-sertifikasi/simpan', 'KategoriSertifikasiController@store')->name('admin.sertifikasi.kategori-sertifikasi.simpan');
        Route::post('kategori-sertifikasi/update/{id}', 'KategoriSertifikasiController@update')->name('admin.sertifikasi.kategori-sertifikasi.update');

        Route::get('list', 'SertifikasiController@index')->name('admin.sertifikasi.list');
        Route::get('tambah', 'SertifikasiController@create')->name('admin.sertifikasi.tambah');
        Route::post('simpan', 'SertifikasiController@store')->name('admin.sertifikasi.simpan');
        Route::get('data-sertifikasi', 'SertifikasiController@getData')->name('admin.sertifikasi.data-sertifikasi');
        Route::get('hapus/{id}', 'SertifikasiController@destroy')->name('admin.sertifikasi.hapus');
        Route::get('edit/{id}', 'SertifikasiController@edit')->name('admin.sertifikasi.edit');
        Route::post('update/{id}', 'SertifikasiController@update')->name('admin.sertifikasi.update');


        //ikm to sertifikasi
        Route::get('tambah-ikm/{id}', 'SertifikasiController@createIkmToSertifikasi')->name('admin.sertifikasi.tambah-ikm');
        Route::post('simpan-ikm', 'SertifikasiController@storeIkmToSertifikasi')->name('admin.sertifikasi.simpan-ikm');
        
    });

    //Route Event
    Route::group(['prefix' => 'event'], function(){
        Route::get('tambah/{id}', 'EventController@create')->name('admin.event.tambah');  
        Route::get('data-event', 'EventController@getData')->name('admin.event.data-event');  
        Route::post('simpan', 'EventController@store')->name('admin.event.simpan');    

        Route::get('generate-qr/{id}', 'EventController@generateQr')->name('admin.event.generate-qr'); 

        Route::get('index', 'EventController@index')->name('admin.event.index'); 
        Route::get('tambah-event', 'EventController@createEvent')->name('admin.event.tambah-event');  
        Route::get('edit/{id}', 'EventController@edit')->name('admin.event.edit');
        Route::post('update/{id}', 'EventController@update')->name('admin.event.update');

        Route::get('tambah-ikm/{id}', 'EventController@createIkm')->name('admin.event.tambah-ikm');
        Route::get('data-ikmToEvent/{id}', 'EventController@getDataIkmToEvent')->name('admin.event.data-ikmToEvent');
    });


    Route::post('event/cetak-laporan', 'EventController@cetakLaporan')->name('event.cetak-laporan');

    // Route Ikm To Event
    Route::group(['prefix' => 'ikm-to-event'], function(){
        Route::get('tambah/{id}', 'IkmToEventController@create')->name('admin.ikm-to-event.tambah');
        Route::post('kirim-undangan', 'IkmToEventController@kirimUndangan')->name('admin.ikm-to-event.kirim-undangan');
    });


    // Route::get('pasar-modern', 'PasarModernController@index')->name('admin.pasar-modern');
    // Route::get('sentra', 'PasarTradisionalController@index')->name('admin.sentra'); 


    // Kehadiran Event
    Route::group(['prefix' => 'kehadiran-event'], function(){
        Route::get('index', 'KehadiranEventController@index')->name('kehadiran-event.index'); 
        Route::get('get-data', 'KehadiranEventController@getData')->name('kehadiran-event.get-data'); 
        Route::get('show/{id}', 'KehadiranEventController@show')->name('kehadiran-event.show'); 
        Route::get('edit/{idEvent}/{idIkm}', 'KehadiranEventController@edit')->name('kehadiran-event.edit'); 
        Route::post('update/{idEvent}/{idIkm}', 'KehadiranEventController@update')->name('kehadiran-event.update'); 
    });

    Route::post('kehadiran-event/cetak-laporan', 'KehadiranEventController@cetakLaporan')->name('kehadiran-event.cetak-laporan');


    // Importir
    Route::get('importir/index', 'ImportirController@index')->name('importir.index');
    Route::get('importir/add', 'ImportirController@create')->name('importir.add');
    Route::post('importir/store', 'ImportirController@store')->name('importir.store');    
    Route::get('importir/edit/{id}', 'ImportirController@edit')->name('importir.edit');
    Route::post('importir/update/{id}', 'ImportirController@update')->name('importir.update');
    Route::get('importir/delete/{id}', 'ImportirController@destroy')->name('importir.destroy');
    Route::get('data-importir', 'ImportirController@getData')->name('data-importir'); 
    Route::post('importir/cetak-laporan', 'ImportirController@cetakLaporan')->name('importir.cetak-laporan');

    // Eksportir
    Route::get('eksportir/index', 'EksportirController@index')->name('eksportir.index');
    Route::get('eksportir/add', 'EksportirController@create')->name('eksportir.add');
    Route::post('eksportir/store', 'EksportirController@store')->name('eksportir.store');    
    Route::get('eksportir/edit/{id}', 'EksportirController@edit')->name('eksportir.edit');
    Route::post('eksportir/update/{id}', 'EksportirController@update')->name('eksportir.update');
    Route::get('eksportir/delete/{id}', 'EksportirController@destroy')->name('eksportir.destroy');
    Route::get('data-eksportir', 'EksportirController@getData')->name('data-eksportir'); 
    Route::post('eksportir/cetak-laporan', 'EksportirController@cetakLaporan')->name('eksportir.cetak-laporan');
});


Route::get('qr-code', function () {
    return QrCode::size(500)->generate('Welcome to kerneldev.com!');
});
