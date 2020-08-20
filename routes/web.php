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

use App\Http\Controllers\penilaian_akademikController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'App\Http\Middleware\GuruSekolahMiddleware'], function(){
    Route::get('/penilaian_akademik', 'c_penilaianAkademik@index');
    Route::post('/storeBobotNilai', 'c_penilaianAkademik@storeBobotNilai');
    Route::post('/updateBobotNilai', 'c_penilaianAkademik@updateBobotNilai');
    Route::post('/storeNilaiUlanganHarian', 'c_penilaianAkademik@storeNilaiUlanganHarian');
    Route::post('/storeNilaiUTS', 'c_penilaianAkademik@storeNilaiUTS');
    Route::post('/storeNilaiUAS', 'c_penilaianAkademik@storeNilaiUAS');
    Route::post('/storeNilaiKeterampilan', 'c_penilaianAkademik@storeNilaiKeterampilan');
    Route::post('/storeNilaiSekolah', 'c_penilaianAkademik@storeNilaiSekolah');
    Route::get('/getCountNilaiUjian', 'c_penilaianAkademik@getCountNilaiUjian');
    Route::get('/getCountNilaiUjianKategori', 'c_penilaianAkademik@getCountNilaiUjianKategori');
    Route::get('/getCountNilaiUAS', 'c_penilaianAkademik@getCountNilaiUAS');
    Route::post('/dataSiswa', 'c_penilaianAkademik@data_siswa');
    Route::post('/storeNilaiSikapKeterampilan', 'c_penilaianAkademik@storeNilaiSikapKeterampilan');
    Route::get('/getCountNilaiUjianSikap', 'c_penilaianAkademik@getCountNilaiUjianSikap');
    Route::get('/getCountDeskripsi', 'c_penilaianAkademik@getCountDeskripsi');
    Route::post('/storeDeskripsiRaport', 'c_penilaianAkademik@storeDeskripsiRaport');
    
    Route::post('/storeNilaiSekolahUnit', 'c_penilaianAkademik@storeNilaiSekolahUnit');
    Route::post('/storeNilaiSekolahIntegrasi', 'c_penilaianAkademik@storeNilaiSekolahIntegrasi');
    Route::get('/penilaian/{nama_kelas}','c_penilaianAkademik@get_penilaian_siswa');
    
    Route::get('/hasil_penilaianAkademikOrangTua', 'c_penilaianAkademik@hasilPenilaianSiswaOrangTua');
    Route::get('/edit_nilai', 'c_penilaianAkademik@indexEditNilaiAkademik');
    Route::get('/editnilai/{nama_kelas}','c_penilaianAkademik@get_siswa');
    Route::get('/getnilai','c_penilaianAkademik@get_nilai');
    Route::post('/updatenilai','c_penilaianAkademik@updateNilai');
    Route::post('/deleteNilaiSekolah/{id}','c_penilaianAkademik@deleteNilaiSekolah');

    Route::get('/presensi_sekolah', 'c_presensiSekolah@index');
    Route::post('/simpan_presensi/{nama_kelas}', 'c_presensiSekolah@storePresensiSekolah');
    Route::get('/presensi/{nama_kelas}','c_presensiSekolah@get_siswa');
    Route::get('/get_data_presensi_sekolah/{nama_kelas}','c_presensiSekolah@get_data_presensi_sekolah');
    Route::get('/get_siswa_count', 'c_presensiSekolah@get_siswa_count');
    Route::post('/updatePresensiSekolah', 'c_presensiSekolah@updatePresensiSekolah');
    Route::post('/simpanPresensiSekolahUnit', 'c_presensiSekolah@simpanPresensiSekolahUnit');

    Route::get('/jadwal_mengajar_gurusekolah', 'c_jadwalMataPelajaran@indexJadwalMengajarGuruSekolah');
    Route::get('/lihat_kritik_dan_saran', 'c_kritikDanSaran@getKritikSaran');
});


Route::group(['middleware' => 'App\Http\Middleware\GuruAsramaMiddleware'], function(){
    Route::get('/penilaian_asrama', 'c_penilaianAsrama@index');
    Route::get('/getMateriAsrama', 'c_penilaianAsrama@getMateriAsrama');

    Route::get('/getCountNilaiAsrama','c_penilaianAsrama@getCountNilaiAsrama');
    Route::post('/storeNilaiAsrama', 'c_penilaianAsrama@storeNilaiAsrama');
    Route::get('/getNilaiAsramaSiswa','c_penilaianAsrama@getNilaiAsramaSiswa');
    Route::post('/updateKelasAsrama', 'c_penilaianAsrama@updateKelasAsrama');

    Route::post('/storeNilaiAsramaUnit', 'c_penilaianAsrama@storeNilaiAsramaUnit');
    Route::post('/storeNilaiAsramaIntegrasi', 'c_penilaianAsrama@storeNilaiAsramaIntegrasi');
    Route::get('/getCountNilaiAsrama/{kodemateri}', 'c_penilaianAsrama@getCountNilaiAsrama');
    Route::get('/getCount/{kodemateri}', 'c_penilaianAsrama@getCount');

    Route::get('/edit_nilai_asrama', 'c_penilaianAsrama@indexEditNilaiAsrama');
    Route::get('/get_nilai_asrama','c_penilaianAsrama@get_nilai_asrama');
    Route::post('/updateNilaiAsrama','c_penilaianAsrama@updateNilaiAsrama');
    Route::post('/deleteNilaiAsrama/{id}','c_penilaianAsrama@deleteNilaiAsrama');

    Route::get('/presensi_asrama', 'c_presensiAsrama@index');
    Route::get('/get_kegiatan', 'c_presensiAsrama@get_kegiatan');
    Route::get('/get_kegiatan_edit', 'c_presensiAsrama@get_kegiatan_edit');
    Route::post('/storePresensiAsrama', 'c_presensiAsrama@storePresensiAsrama');
    Route::get('/get_data_presensi', 'c_presensiAsrama@get_data_presensi');
    Route::get('/get_siswa_asrama_count', 'c_presensiAsrama@get_siswa_asrama_count');
    Route::get('/get_data_presensi_count', 'c_presensiAsrama@get_data_presensi_count');
    Route::post('/updatePresensiAsrama', 'c_presensiAsrama@updatePresensiAsrama');
    Route::get('/getDataSiswa', 'c_presensiAsrama@getDataSiswa');
    
    Route::get('/lihat_kritik_dan_saran', 'c_kritikDanSaran@getKritikSaran');
    Route::get('/jadwal_mengajar_guruasrama', 'c_jadwalKegiatanAsrama@indexJadwalMengajarGuruAsrama');

    Route::post('/storeSuratSakit', 'c_suratSakit@storeSuratSakit');
    Route::get('/surat_sakit', 'c_suratSakit@index');
});


Route::group(['middleware' => 'App\Http\Middleware\SiswaOrangTuaMiddleware'], function(){
    Route::get('/getNilaiMataPelajaranSikap', 'c_penilaianAkademik@getNilaiMataPelajaranSikap');
    Route::get('/getNilaiMataPelajaranKeterampilan', 'c_penilaianAkademik@getNilaiMataPelajaranKeterampilan');
    Route::get('/getNilaiMataPelajaran', 'c_penilaianAkademik@getNilaiMataPelajaran');
    Route::get('/getDeskripsiMataPelajaran', 'c_penilaianAkademik@getDeskripsiMataPelajaran');
    Route::get('/getMataPelajaran', 'c_penilaianAkademik@getMataPelajaran');

    Route::get('/getNilaiAsramaSiswaMateri','c_penilaianAsrama@getNilaiAsramaSiswaMateri');
    Route::get('/getNilaiAsramaSiswaPraktikum','c_penilaianAsrama@getNilaiAsramaSiswaPraktikum');
    Route::get('/getNilaiAsramaSiswaSikap','c_penilaianAsrama@getNilaiAsramaSiswaSikap');
    Route::get('/getNilaiAsramaSiswaEkstrakulikuler','c_penilaianAsrama@getNilaiAsramaSiswaEkstrakulikuler');
    Route::get('/getNilaiAsramaSiswaSaran','c_penilaianAsrama@getNilaiAsramaSiswaSaran');

    Route::get('/jadwal_mata_pelajaran', 'c_jadwalMataPelajaran@index');
    Route::get('/jadwal_kegiatan_asrama', 'c_jadwalKegiatanAsrama@index');

    Route::get('/kritik_dan_saran', 'c_kritikDanSaran@index');
    Route::post('/updateKritikSaran', 'c_kritikDanSaran@updateKritikSaran');
    Route::post('/storeKritikSaran', 'c_kritikDanSaran@storeKritikSaran');

    Route::get('/kritik_dan_saran_siswa', 'c_kritikDanSaran@kritikDanSaranSiswaView'); 
    Route::post('/store_kritik_dan_saran_siswa', 'c_kritikDanSaran@storeKritikSaranSiswa');

    Route::get('/hasil_presensi', 'c_presensiSekolah@indexHasilPresensi');
    Route::get('/getDataPresensiAsramaCount/{month}', 'c_presensiAsrama@getDataPresensiAsramaCount');
    Route::get('/getDataPresensiSekolahCount/{month}', 'c_presensiSekolah@getDataPresensiSekolahCount');

    Route::get('/hasil_penilaianAkademik', 'c_penilaianAkademik@hasilPenilaianSiswa');
    Route::get('/hasil_penilaianAsrama', 'c_penilaianAsrama@materiAsrama');
});


Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
    Route::get('/kelola_akun', 'c_kelolaAkun@index');
    Route::post('/storeAkunSiswa', 'c_kelolaAkun@storeAkunSiswa');
    Route::post('/storeAkunAdmin', 'c_kelolaAkun@storeAkunAdmin');
    Route::post('/storeAkunOrangTua', 'c_kelolaAkun@storeAkunOrangTua');
    Route::post('/storeAkunGuruSekolah', 'c_kelolaAkun@storeAkunGuruSekolah');
    Route::post('/storeAkunGuruAsrama', 'c_kelolaAkun@storeAkunGuruAsrama');
    Route::post('/update_kelas_siswa', 'c_kelolaAkun@updateKelasSiswa');
    Route::post('/update_gedung_siswa', 'c_kelolaAkun@updateGedungSiswa');
    Route::get('/get_data_kelas_siswa', 'c_kelolaAkun@getDataKelasSiswa');
    Route::get('/get_data_gedung_siswa', 'c_kelolaAkun@getDataGedungSiswa');

    Route::get('/kelola_tahun_ajaran', 'c_tahunAjaran@index');
    Route::post('/store_tahun_ajaran', 'c_tahunAjaran@storeTahunAjaran');
    Route::post('/update_tahun_ajaran', 'c_tahunAjaran@updateTahunAjaran');
    Route::post('/update_tahun_ajaran_tidak_aktif', 'c_tahunAjaran@updateTahunAjaranTidakAktif');

    Route::get('/kelola_data_sekolah', 'c_jadwalMataPelajaran@KelolaDataSekolahView');
    Route::get('/get_mata_pelajaran/{kelas}', 'c_jadwalMataPelajaran@getJadwalMataPelajaran');
    Route::get('/get_kode_mapel', 'c_jadwalMataPelajaran@getKodeMapel');
    Route::post('/store_tambah_kelas', 'c_jadwalMataPelajaran@storeTambahKelas');
    Route::post('/delete_jadwal/{id}','c_jadwalMataPelajaran@deleteJadwal');
    Route::post('/store_mata_pelajaran','c_jadwalMataPelajaran@storeMataPelajaran');
    Route::post('/store_jadwal_mata_pelajaran','c_jadwalMataPelajaran@storeJadwalMataPelajaran');
    Route::post('/store_tambah_kelas_siswa','c_jadwalMataPelajaran@storeTambahKelasSiswa');

    Route::get('/kelola_data_asrama', 'c_jadwalKegiatanAsrama@KelolaDataAsramaView');
    Route::post('/store_materi_asrama', 'c_jadwalKegiatanAsrama@storeMateriAsrama');    
    Route::post('/store_kegiatan_asrama', 'c_jadwalKegiatanAsrama@storeKegiatanAsrama');
    Route::post('/delete_kegiatan_asrama/{id}','c_jadwalKegiatanAsrama@deleteKegiatanAsrama');
    Route::get('/get_kegiatan_asrama', 'c_jadwalKegiatanAsrama@getKegiatanAsrama');
    Route::get('/get_gedung_siswa', 'c_jadwalKegiatanAsrama@getGedungSiswa');
});
