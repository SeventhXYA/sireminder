<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Pegawai;
use App\RencanaKerja;
use App\Status;
use App\SuratMasuk;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //SEMUA //cek siapa yang login (identitas dan rolenya)
        $user = Auth::user();

        //STAFF //menghitung data surat masuk 1 bulan terakhir
        $suratmasuk = SuratMasuk::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

        //AJUDAN //mengambil data surat masuk 1 bulan terakhir ke dalam tabel
        $suratmasuktable = SuratMasuk::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();

        //STAFF & AJUDAN //menghitung jumlah data pegawai, jabatan, dan akun pengguna
        $pegawai = Pegawai::count();
        $jabatan = Jabatan::count();
        $akun = User::count();

        //BUPATI //menghitung data surat masuk yang untuk bupati 1 bulan terakhir
        $suratmasukbupati = Status::where('kategori', 1)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

        //AJUDAN & BUPATI //menghitung data rencana kerja 1 bulan terakhir
        $rencanakerja = RencanaKerja::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

        //BUPATI //mengambil data rencanakerja untuk dimasukan kedalam kalender bupati
        $kalenderrencanakerja = RencanaKerja::all();

        //BUPATI //mengambil data rencanakerja untuk dimasukan kedalam kalender bupati
        $pending = Status::where('status', 1)->count();

        //SEMUA //mengambil data surat masuk berdasarkan kategori untuk ditampilkan kedalam chart
        $data1 = Status::where('kategori', 1)->count();
        $data2 = Status::where('kategori', 2)->count();

        $rencana1 = RencanaKerja::where('kategori', 1)->count();
        $rencana2 = RencanaKerja::where('kategori', 2)->count();
        $rencana3 = RencanaKerja::where('kategori', 3)->count();
        return view('dashboard', [
            "title" => "Beranda"
        ], compact('user', 'pegawai', 'suratmasuk', 'jabatan', 'suratmasuktable', 'data1', 'data2', 'akun', 'suratmasukbupati', 'rencanakerja', 'kalenderrencanakerja', 'pending', 'rencana1', 'rencana2', 'rencana3'));
    }
    //BUPATI //mengambil dan menampilkan kalender rencana kerja dari tabel rencanakerja
    public function events()
    {
        $kalenderrencanakerja = RencanaKerja::select('id', 'rencana as title', 'start_date as start', 'end_date as end', 'color', 'lokasi')->get()->toArray();
        return response()->json($kalenderrencanakerja);
    }

    //BUPATI //menampilkan detail dari kalender rencana kerja dari tabel rencanakerja
    public function show($id)
    {
        $kalenderrencanakerja = RencanaKerja::findOrFail($id);
        return response()->json($kalenderrencanakerja);
    }
}
