<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('user.dashboard'));
});

//Pasar Tradisional
Breadcrumbs::for('pasar-tradisional', function ($trail) {
    $trail->push('Pasar Tradisional', route('user.pasar-tradisional'));
});
Breadcrumbs::for('tambah-pasar-tradisional', function ($trail) {
    $trail->parent('pasar-tradisional');
    $trail->push('Tambah Pasar Tradisional', route('user.tambah.pasar-tradisional'));
});
Breadcrumbs::for('edit-pasar-tradisional', function ($trail, $pasarTradisional) {
    $trail->parent('pasar-tradisional');
    $trail->push($pasarTradisional->nama_pasar, route('user.edit.pasar-tradisional', $pasarTradisional->id));
});

//Pasar Modern
Breadcrumbs::for('pasar-modern', function ($trail) {
    $trail->push('Pasar Modern', route('user.pasar-modern'));
});
Breadcrumbs::for('tambah-pasar-modern', function ($trail) {
    $trail->parent('pasar-modern');
    $trail->push('Tambah Pasar Modern', route('user.tambah.pasar-modern'));
});
Breadcrumbs::for('edit-pasar-modern', function ($trail, $pasarModern) {
    $trail->parent('pasar-modern');
    $trail->push($pasarModern->nama_toko, route('user.edit.pasar-modern', $pasarModern->id));
});

//Sentra
Breadcrumbs::for('sentra', function ($trail) {
    $trail->push('Sentra', route('user.sentra'));
});
Breadcrumbs::for('tambah-sentra', function ($trail) {
    $trail->parent('sentra');
    $trail->push('Tambah Sentra', route('user.tambah.sentra'));
});
Breadcrumbs::for('edit-sentra', function ($trail, $sentra) {
    $trail->parent('sentra');
    $trail->push($sentra->nama_sentra, route('user.edit.sentra', $sentra->id));
});

//Kategori Pengguna
Breadcrumbs::for('kategori-pengguna', function ($trail) {
    $trail->push('Kategori Pengguna', route('user.pengguna.kategori-pengguna'));
});
Breadcrumbs::for('tambah-kategori-pengguna', function ($trail) {
    $trail->parent('kategori-pengguna');
    $trail->push('Tambah Kategori Pengguna', route('user.pengguna.kategori-pengguna.tambah'));
});
Breadcrumbs::for('edit-kategori-pengguna', function ($trail, $kategoriPengguna) {
    $trail->parent('kategori-pengguna');
    $trail->push($kategoriPengguna->KTPNG_NAMA, route('user.pengguna.kategori-pengguna.edit', $kategoriPengguna->KTPNG_ID));
});

//Pengguna
Breadcrumbs::for('pengguna', function ($trail) {
    $trail->push('Pengguna', route('user.pengguna.list'));
});
Breadcrumbs::for('tambah-pengguna', function ($trail) {
    $trail->parent('pengguna');
    $trail->push('Tambah Pengguna', route('user.pengguna.tambah'));
});

Breadcrumbs::for('edit-pengguna', function ($trail, $user) {
    $trail->parent('pengguna');
    $trail->push($user->name, route('user.pengguna.edit', $user->id));
});

//Kategori Produk
Breadcrumbs::for('kategori-produk', function ($trail) {
    $trail->push('Kategori Produk', route('user.produk.kategori-produk'));
});
Breadcrumbs::for('tambah-kategori-produk', function ($trail) {
    $trail->parent('kategori-produk');
    $trail->push('Tambah Kategori Produk', route('user.produk.kategori-produk.tambah'));
});
Breadcrumbs::for('edit-kategori-produk', function ($trail, $kategoriProduk) {
    $trail->parent('kategori-produk');
    $trail->push($kategoriProduk->KTPRDK_NAMA, route('user.produk.kategori-produk.edit', $kategoriProduk->KTPRDK_ID));
});

//Produk
Breadcrumbs::for('produk', function ($trail) {
    $trail->push('Produk', route('user.produk.list'));
});

Breadcrumbs::for('tambah-produk', function ($trail) {
    $trail->parent('produk');
    $trail->push('Tambah Produk', route('user.produk.tambah'));
});

Breadcrumbs::for('edit-produk', function ($trail, $produk) {
    $trail->parent('produk');
    $trail->push($produk->PRDK_NAMA, route('user.produk.edit', $produk->PRDK_ID));
});

//Kategori Sertifikasi
Breadcrumbs::for('kategori-sertifikasi', function ($trail) {
    $trail->push('Kategori Sertifikasi', route('user.sertifikasi.kategori-sertifikasi'));
});
Breadcrumbs::for('tambah-kategori-sertifikasi', function ($trail) {
    $trail->parent('kategori-sertifikasi');
    $trail->push('Tambah Kategori Sertifikasi', route('user.sertifikasi.kategori-sertifikasi.tambah'));
});
Breadcrumbs::for('edit-kategori-sertifikasi', function ($trail, $kategoriSertifikasi) {
    $trail->parent('kategori-sertifikasi');
    $trail->push($kategoriSertifikasi->KTSRT_NAMA, route('user.sertifikasi.kategori-sertifikasi.edit', $kategoriSertifikasi->KTSRT_ID));
});

//Sertifikasi
Breadcrumbs::for('sertifikasi', function ($trail) {
    $trail->push('Sertifikasi', route('user.sertifikasi.list'));
});

Breadcrumbs::for('tambah-sertifikasi', function ($trail) {
    $trail->parent('sertifikasi');
    $trail->push('Tambah Sertifikasi', route('user.sertifikasi.tambah'));
});

Breadcrumbs::for('tambah-sertifikasi-ikm', function ($trail) {
    $trail->parent('sertifikasi');
    $trail->push('Tambah Sertifikasi IKM');
});


//Event

Breadcrumbs::for('event', function ($trail) {
    $trail->push('Event', route('user.event.index'));
});
Breadcrumbs::for('form-tambah-event', function ($trail) {
    $trail->parent('event');
    $trail->push('Tambah Event');
});
Breadcrumbs::for('edit-event', function ($trail, $event) {
    $trail->parent('event');
    $trail->push($event->EVT_NAMA, route('user.event.edit', $event->EVT_ID));
});
Breadcrumbs::for('tambah-event', function ($trail) {
    $trail->parent('sertifikasi');
    $trail->push('Tambah Event');
});

//IKM to Event
Breadcrumbs::for('tambah-ikm-to-event', function ($trail) {
    $trail->parent('sertifikasi');
    $trail->push('Tambah IKM');
});


//Ikm
Breadcrumbs::for('ikm', function ($trail) {
    $trail->push('IKM', route('user.ikm'));
});

Breadcrumbs::for('tambah-ikm', function ($trail) {
    $trail->parent('ikm');
    $trail->push('Tambah IKM', route('user.ikm.tambah'));
});


Breadcrumbs::for('edit-ikm', function ($trail, $ikm) {
    $trail->parent('ikm');
    $trail->push($ikm->IKM_NAMA, route('user.ikm.edit', $ikm->IKM_ID));
});