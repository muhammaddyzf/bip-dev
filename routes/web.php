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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('test-update-user', function(){
        return view('edit-user');
    });

Route::group(['prefix' => 'user',  'middleware' => 'auth'], function()
{

	// Route::resource('users', 'UserController');
    Route::get('dashboard', 'DashboardController@index')->name('user.dashboard');

    //Route IKM
    Route::get('ikm', 'IkmController@index')->name('user.ikm');
    Route::get('ikm/tambah', 'IkmController@create')->name('user.ikm.tambah');
    Route::get('ikm/import', 'IkmController@import')->name('user.ikm.import');
    Route::get('ikm/download-excel', 'IkmController@downloadExcel')->name('user.ikm.download-excel');

    Route::post('ikm/simpan', 'IkmController@store')->name('user.ikm.simpan');
    Route::get('ikm/data-ikm', 'IkmController@getData')->name('user.ikm.get-data');
    Route::get('ikm/edit/{id}', 'IkmController@edit')->name('user.ikm.edit');
    Route::post('ikm/update/{id}', 'IkmController@update')->name('user.ikm.update');
    Route::get('ikm/produk/{id}', 'IkmController@produk')->name('user.ikm.produk');
    Route::get('ikm/sertifikasi/{id}', 'IkmController@sertifikasi')->name('user.ikm.sertifikasi');
    Route::get('ikm/event/{id}', 'IkmController@event')->name('user.ikm.event');
    
    //Route Pasar Tradisional
    Route::get('pasar-tradisional', 'PasarTradisionalController@index')->name('user.pasar-tradisional');
    Route::get('data-pasar-tradisional', 'PasarTradisionalController@getData')->name('user.data-pasar-tradisional');
    Route::get('tambah/pasar-tradisional', 'PasarTradisionalController@create')->name('user.tambah.pasar-tradisional');
    Route::get('hapus/pasar-tradisional/{id}', 'PasarTradisionalController@destroy')->name('user.hapus.pasar-tradisional');
    Route::get('edit/pasar-tradisional/{id}', 'PasarTradisionalController@edit')->name('user.edit.pasar-tradisional');
    Route::post('simpan/pasar-tradisional', 'PasarTradisionalController@store')->name('user.simpan.pasar-tradisional');
    Route::post('update/pasar-tradisional/{id}', 'PasarTradisionalController@update')->name('user.update.pasar-tradisional');
    //Route Pasar Modern
    Route::get('pasar-modern', 'PasarModernController@index')->name('user.pasar-modern');
    Route::get('data-pasar-modern', 'PasarModernController@getData')->name('user.data-pasar-modern');
    Route::get('tambah/pasar-modern', 'PasarModernController@create')->name('user.tambah.pasar-modern');
    Route::get('hapus/pasar-modern/{id}', 'PasarModernController@destroy')->name('user.hapus.pasar-modern');
    Route::get('edit/pasar-modern/{id}', 'PasarModernController@edit')->name('user.edit.pasar-modern');
    Route::post('simpan/pasar-modern', 'PasarModernController@store')->name('user.simpan.pasar-modern');
    Route::post('update/pasar-modern/{id}', 'PasarModernController@update')->name('user.update.pasar-modern');
    //Route Sentra
    Route::get('sentra', 'SentraController@index')->name('user.sentra');
    Route::get('data-sentra', 'SentraController@getData')->name('user.data-sentra');
    Route::get('tambah/sentra', 'SentraController@create')->name('user.tambah.sentra');
    Route::get('hapus/sentra/{id}', 'SentraController@destroy')->name('user.hapus.sentra');
    Route::get('edit/sentra/{id}', 'SentraController@edit')->name('user.edit.sentra');
    Route::post('simpan/sentra', 'SentraController@store')->name('user.simpan.sentra');
    Route::post('update/sentra/{id}', 'SentraController@update')->name('user.update.sentra');


    //Route Kategori Pengguna
    Route::group(['prefix' => 'pengguna'],function(){      
        Route::get('kategori-pengguna', 'KategoriPenggunaController@index')->name('user.pengguna.kategori-pengguna');
        Route::get('data-kategori-pengguna', 'KategoriPenggunaController@getData')->name('user.pengguna.data-kategori-pengguna');
        Route::get('kategori-pengguna/tambah', 'KategoriPenggunaController@create')->name('user.pengguna.kategori-pengguna.tambah');
        Route::get('kategori-pengguna/hapus/{id}', 'KategoriPenggunaController@destroy')->name('user.pengguna.kategori-pengguna.hapus');
        Route::get('kategori-pengguna/edit/{id}', 'KategoriPenggunaController@edit')->name('user.pengguna.kategori-pengguna.edit');
        Route::post('kategori-pengguna/simpan', 'KategoriPenggunaController@store')->name('user.pengguna.kategori-pengguna.simpan');
        Route::post('kategori-pengguna/update/{id}', 'KategoriPenggunaController@update')->name('user.pengguna.kategori-pengguna.update');


        Route::get('list', 'PenggunaController@index')->name('user.pengguna.list');
        Route::get('data-pengguna', 'PenggunaController@getData')->name('user.pengguna.data-pengguna');
        Route::get('tambah', 'PenggunaController@create')->name('user.pengguna.tambah');
        Route::post('simpan', 'PenggunaController@store')->name('user.pengguna.simpan');
        Route::get('edit/{id}', 'PenggunaController@edit')->name('user.pengguna.edit');
        Route::get('hapus/{id}', 'PenggunaController@destroy')->name('user.pengguna.hapus');
        Route::post('update/{id}', 'PenggunaController@update')->name('user.pengguna.update');
    });

    //Route Kategori Produk
    Route::group(['prefix' => 'produk'],function(){    
        Route::get('kategori-produk', 'KategoriProdukController@index')->name('user.produk.kategori-produk');
        Route::get('data-kategori-produk', 'KategoriProdukController@getData')->name('user.produk.data-kategori-produk');
        Route::get('kategori-produk/tambah', 'KategoriProdukController@create')->name('user.produk.kategori-produk.tambah');
        Route::get('kategori-produk/hapus/{id}', 'KategoriProdukController@destroy')->name('user.produk.kategori-produk.hapus');
        Route::get('kategori-produk/edit/{id}', 'KategoriProdukController@edit')->name('user.produk.kategori-produk.edit');
        Route::post('kategori-produk/simpan', 'KategoriProdukController@store')->name('user.kategori-produk.simpan');
        Route::post('kategori-produk/update/{id}', 'KategoriProdukController@update')->name('user.kategori-produk.update');


        Route::get('tambah', 'ProdukController@create')->name('user.produk.tambah');
        Route::post('simpan', 'ProdukController@store')->name('user.produk.simpan');
        Route::get('list', 'ProdukController@index')->name('user.produk.list');
        Route::get('data-produk', 'ProdukController@getData')->name('user.produk.data-produk');
        Route::get('edit/{id}', 'ProdukController@edit')->name('user.produk.edit');
        Route::post('update/{id}', 'ProdukController@update')->name('user.produk.update');
        Route::get('hapus/{id}', 'ProdukController@destroy')->name('user.produk.hapus');


        Route::get('generate-qr/{id}', 'ProdukController@generateQr')->name('user.produk.generate-qr');  
    });

    //Route Kategori Sertifikasi
    Route::group(['prefix' => 'sertifikasi'],function(){
        Route::get('kategori-sertifikasi', 'KategoriSertifikasiController@index')->name('user.sertifikasi.kategori-sertifikasi');
        Route::get('kategori-sertifikasi/tambah', 'KategoriSertifikasiController@create')->name('user.sertifikasi.kategori-sertifikasi.tambah');
        Route::get('data-kategori-sertifikasi', 'KategoriSertifikasiController@getData')->name('user.data-kategori-sertifikasi');
        Route::get('kategori-sertifikasi/hapus/{id}', 'KategoriSertifikasiController@destroy')->name('user.sertifikasi.kategori-sertifikasi.hapus');
        Route::get('kategori-sertifikasi/edit/{id}', 'KategoriSertifikasiController@edit')->name('user.sertifikasi.kategori-sertifikasi.edit');
        Route::post('kategori-sertifikasi/simpan', 'KategoriSertifikasiController@store')->name('user.sertifikasi.kategori-sertifikasi.simpan');
        Route::post('kategori-sertifikasi/update/{id}', 'KategoriSertifikasiController@update')->name('user.sertifikasi.kategori-sertifikasi.update');

        Route::get('list', 'SertifikasiController@index')->name('user.sertifikasi.list');
        Route::get('tambah', 'SertifikasiController@create')->name('user.sertifikasi.tambah');
        Route::post('simpan', 'SertifikasiController@store')->name('user.sertifikasi.simpan');
        Route::get('data-sertifikasi', 'SertifikasiController@getData')->name('user.sertifikasi.data-sertifikasi');
        Route::get('hapus/{id}', 'SertifikasiController@destroy')->name('user.sertifikasi.hapus');


        //ikm to sertifikasi
        Route::get('tambah-ikm/{id}', 'SertifikasiController@createIkmToSertifikasi')->name('user.sertifikasi.tambah-ikm');
        Route::post('simpan-ikm', 'SertifikasiController@storeIkmToSertifikasi')->name('user.sertifikasi.simpan-ikm');
        
    });

    //Route Event
    Route::group(['prefix' => 'event'], function(){
        Route::get('tambah/{id}', 'EventController@create')->name('user.event.tambah');  
        Route::get('data-event', 'EventController@getData')->name('user.event.data-event');  
        Route::post('simpan', 'EventController@store')->name('user.event.simpan');    

        Route::get('generate-qr/{id}', 'EventController@generateQr')->name('user.event.generate-qr'); 

        Route::get('index', 'EventController@index')->name('user.event.index'); 
        Route::get('tambah-event', 'EventController@createEvent')->name('user.event.tambah-event');  
        Route::get('edit/{id}', 'EventController@edit')->name('user.event.edit');
        Route::post('update/{id}', 'EventController@update')->name('user.event.update');

        Route::get('tambah-ikm/{id}', 'EventController@createIkm')->name('user.event.tambah-ikm');
        Route::get('data-ikmToEvent/{id}', 'EventController@getDataIkmToEvent')->name('user.event.data-ikmToEvent');
    });

    // Route Ikm To Event
    Route::group(['prefix' => 'ikm-to-event'], function(){
        Route::get('tambah/{id}', 'IkmToEventController@create')->name('user.ikm-to-event.tambah');
        Route::post('kirim-undangan', 'IkmToEventController@kirimUndangan')->name('user.ikm-to-event.kirim-undangan');
    });

    //Route Wilayah
    Route::get('provinsi/{provinsi}/kabkot', 'ProvinsiController@getKabkot');
    Route::get('kabkot/{kabkot}/kecamatan', 'KabkotController@getKecamatan');
    Route::get('kecamatan/{kecamatan}/desa', 'KecamatanController@getdesa');

    // Route::get('pasar-modern', 'PasarModernController@index')->name('user.pasar-modern');
    // Route::get('sentra', 'PasarTradisionalController@index')->name('user.sentra'); 
});

Route::get('qr-code', function () {
    return QrCode::size(500)->generate('Welcome to kerneldev.com!');
});
