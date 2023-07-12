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

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RencanaKerjaController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Route;

//route jika belum login dan akan login
Route::group(['middleware' => ['guest']], function () {
    //halaman login
    Route::get('login', [LoginController::class, 'login'])->name('login');
    //proses autentikasi
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
    Route::get('forget', [LoginController::class, 'forget'])->name('forget');
    Route::post('forget', [LoginController::class, 'sendResetEmail'])->name('sendemail');

    Route::get('reset', [LoginController::class, 'reset'])->name('reset');
    Route::post('reset', [LoginController::class, 'resetPassword'])->name('resetPassword');
});

//route logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//route yang menggunakan middleware untuk membedakan hak akses (role)
Route::group(['middleware' => ['auth']], function () {
    //route yang bisa diakses oleh semua hak akses (role)
    Route::get('/', [DashboardController::class, 'index'])->name('/');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/store', [ProfileController::class, 'updatePicture'])->name('profile.store');
    Route::get('profile/edit', [ProfileController::class, 'editData'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'updateData'])->name('profile.update');

    //route yang hanya bisa diakses oleh Ajudan
    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        Route::post('/kirim-pesan-whatsapp', [WhatsAppController::class, 'sendMessage'])->name('kirim.pesan.whatsapp');
        // Route::post('/send-whatsapp', [WhatsAppController::class, 'sendWhatsApp'])->name('send-whatsapp');
        //semua yang berhubungan dengan surat masuk
        Route::get('kelolasuratmasuk', [SuratMasukController::class, 'indexKelola'])->name('kelolasuratmasuk');
        Route::get('suratmasuk/bupati', [SuratMasukController::class, 'bupati'])->name('suratmasuk.bupati');
        Route::get('suratmasuk/lain', [SuratMasukController::class, 'others'])->name('suratmasuklain');
        Route::get('suratmasuk/pending', [SuratMasukController::class, 'pending'])->name('suratmasuk.pending');
        Route::get('suratmasuk/approved', [SuratMasukController::class, 'approved'])->name('suratmasuk.approved');
        Route::get('suratmasuk/declined', [SuratMasukController::class, 'declined'])->name('suratmasuk.declined');
        Route::get('kelolasuratmasuk/edit/{id}', [SuratMasukController::class, 'editKelola'])->name('kelolasuratmasuk.edit');
        Route::post('kelolasuratmasuk/update/{id}', [SuratMasukController::class, 'updateKelola'])->name('kelolasuratmasuk.update');
        Route::get('status/add/{id}', [StatusController::class, 'create'])->name('status.add');
        Route::post('status/store/{id}', [StatusController::class, 'store'])->name('status.store');
        Route::get('status/edit/{id}', [StatusController::class, 'edit'])->name('status.edit');
        Route::post('status/update/{id}', [StatusController::class, 'update'])->name('status.update');

        //semua yang berhubungan dengan akun pengguna
        Route::get('akun', [UserController::class, 'index'])->name('akun');
        Route::get('akun/add/{id}', [UserController::class, 'create'])->name('akun.add');
        Route::post('akun/store', [UserController::class, 'store'])->name('akun.store');
        Route::get('akun/edit/{id}', [UserController::class, 'edit'])->name('akun.edit');
        Route::post('akun/update/{id}', [UserController::class, 'update'])->name('akun.update');
        Route::delete('user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');

        //semua yang berhubungan dengan rencana kerja
        Route::get('daftarrencanakerja/list', [RencanaKerjaController::class, 'list'])->name('kelolarencanakerja.list');
        Route::get('dokumentasi/add/{id}', [DokumentasiController::class, 'create'])->name('dokumentasi.add');
        Route::post('dokumentasi/store/{id}', [DokumentasiController::class, 'store'])->name('dokumentasi.store');
        Route::delete('dokumentasi/delete/{dokumentasi}', [DokumentasiController::class, 'destroy'])->name('dokumentasi.delete');
        Route::get('kelolarencanakerja', [RencanaKerjaController::class, 'index'])->name('kelolarencanakerja');
        Route::get('kelolarencanakerja/kalender', [RencanaKerjaController::class, 'kalender'])->name('kelolarencanakerja.kalender');
        Route::get('kelolarencanakerja/events', [RencanaKerjaController::class, 'events'])->name('kelolarencanakerja.events');
        Route::get('kelolarencanakerja/events/{id}', [RencanaKerjaController::class, 'show'])->name('kelolarencanakerja.show');
        Route::get('kelolarencanakerja/add/{id}', [RencanaKerjaController::class, 'create'])->name('kelolarencanakerja.add');
        Route::post('kelolarencanakerja/store', [RencanaKerjaController::class, 'store'])->name('kelolarencanakerja.store');
        Route::get('kelolarencanakerja/edit/{id}', [RencanaKerjaController::class, 'edit'])->name('kelolarencanakerja.edit');
        Route::post('kelolarencanakerja/update/{id}', [RencanaKerjaController::class, 'update'])->name('kelolarencanakerja.update');
        Route::delete('rencanakerja/delete/{rencanakerja}', [RencanaKerjaController::class, 'destroy'])->name('rencanakerja.delete');
        Route::get('rencanakerja/lddp', [RencanaKerjaController::class, 'lddp'])->name('rencanakerja.lddp');
        Route::get('rencanakerja/ldlp', [RencanaKerjaController::class, 'ldlp'])->name('rencanakerja.ldlp');
        Route::get('rencanakerja/dddk', [RencanaKerjaController::class, 'dddk'])->name('rencanakerja.dddk');
    });

    //route yang hanya bisa diakses oleh Staff
    Route::group(['middleware' => ['cekUserLogin:2']], function () {

        //semua yang berhubungan dengan data jabatan
        Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan');
        Route::get('jabatan/add', [JabatanController::class, 'create'])->name('jabatan.add');
        Route::post('jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store');
        Route::get('jabatan/edit/{id}', [JabatanController::class, 'edit'])->name('jabatan.edit');
        Route::post('jabatan/update/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
        Route::delete('jabatan/delete/{jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.delete');

        //semua yang berhubungan dengan data pegawai
        Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai');
        Route::get('pegawai/add', [PegawaiController::class, 'create'])->name('pegawai.add');
        Route::post('pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
        Route::get('pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
        Route::post('pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
        Route::delete('pegawai/delete/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.delete');

        //semua yang berhubungan dengan data surat masuk
        Route::get('suratmasuk', [SuratMasukController::class, 'index'])->name('suratmasuk');
        Route::get('suratmasuk/add', [SuratMasukController::class, 'create'])->name('suratmasuk.add');
        Route::post('suratmasuk/store', [SuratMasukController::class, 'store'])->name('suratmasuk.store');
        Route::get('suratmasuk/edit/{id}', [SuratMasukController::class, 'edit'])->name('suratmasuk.edit');
        Route::post('suratmasuk/update/{id}', [SuratMasukController::class, 'update'])->name('suratmasuk.update');
    });

    //route yang hanya bisa diakses oleh Bupati
    Route::group(['middleware' => ['cekUserLogin:3']], function () {
        //mengambil data kalender
        Route::get('events', [DashboardController::class, 'events'])->name('events');

        //menampilkan data kalender
        Route::get('events/{id}', [DashboardController::class, 'show'])->name('show');

        //semua yang berhubungan dengan data surat masuk
        Route::get('daftarsuratmasuk', [SuratMasukController::class, 'indexBupati'])->name('daftarsuratmasuk');
        Route::get('statusapproval/edit/{id}', [StatusController::class, 'editBupati'])->name('statusapproval.edit');
        Route::post('statusapproval/update/{id}', [StatusController::class, 'updateBupati'])->name('statusapproval.update');
        Route::get('daftarsuratmasuk/edit/{id}', [SuratMasukController::class, 'editBupati'])->name('daftarsuratmasuk.edit');
        Route::post('daftarsuratmasuk/update/{id}', [SuratMasukController::class, 'updateBupati'])->name('daftarsuratmasuk.update');
        Route::get('suratmasuk/pendingBupati', [SuratMasukController::class, 'pendingBupati'])->name('suratmasuk.pendingBupati');
        Route::get('suratmasuk/approvedBupati', [SuratMasukController::class, 'approvedBupati'])->name('suratmasuk.approvedBupati');
        Route::get('suratmasuk/declinedBupati', [SuratMasukController::class, 'declinedBupati'])->name('suratmasuk.declinedBupati');

        //semua yang berhubungan dengan rencana kerja
        Route::get('rencanakerja/lddpBupati', [RencanaKerjaController::class, 'lddpBupati'])->name('rencanakerja.lddpBupati');
        Route::get('rencanakerja/ldlpBupati', [RencanaKerjaController::class, 'ldlpBupati'])->name('rencanakerja.ldlpBupati');
        Route::get('rencanakerja/dddkBupati', [RencanaKerjaController::class, 'dddkBupati'])->name('rencanakerja.dddkBupati');

        //print pdf
        // Route::get('/cetak-pdf', [PdfController::class, 'generatePdf'])->name('cetak-pdf');
    });

    //route yang hanya bisa diakses oleh Bupati
    Route::group(['middleware' => ['cekUserLogin:1,3']], function () {
        Route::get('/cetak-pdf-suratmasuk', [PdfController::class, 'generatePdfSuratMasuk'])->name('cetak.pdf.suratmasuk');
        Route::get('/cetak-pdf-rencanakerja', [PdfController::class, 'generatePdfRencanaKerja'])->name('cetak.pdf.rencanakerja');
    });

    //route yang hanya bisa diakses oleh Bupati
    Route::group(['middleware' => ['cekUserLogin:1,2']], function () {
        Route::post('/move-data/{id}', [SuratMasukController::class, 'moveData'])->name('move-data');
        Route::post('/restore-data/{id}', [SuratMasukController::class, 'restoreData'])->name('restore-data');
        Route::get('temp', [SuratMasukController::class, 'temp'])->name('temp');
        // Route::delete('suratmasuk/delete/{suratmasuk}', [SuratMasukController::class, 'destroy'])->name('suratmasuk.delete');
    });
});
