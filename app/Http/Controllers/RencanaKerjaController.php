<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\RencanaKerja;
use App\Status;
use App\SuratMasuk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RencanaKerjaController extends Controller
{
    //AJUDAN //menampilkan halaman surat masuk yang memiliki kategori 1 (untuk bupati) dan status 2 (approved)
    //berfungsi untuk mengetahui apakah surat masuk untuk bupati yang telah diapprove sudah memiliki rencana kerja atau belum
    //jika belum akan bertanda X, jika sudah akan bertanda V
    public function list()
    {
        $rencanakerja = RencanaKerja::all();
        return view('ajudan.rencanakerja.daftarrencanakerja', [
            "title" => "Rencana Kerja",
            "sub" => "Daftar Rencana Kerja"
        ], compact('rencanakerja'));
    }

    public function index()
    {
        $status = Status::where('kategori', 1)->where('status', 2)->pluck('id');
        $suratmasuk = SuratMasuk::whereIn('id_status', $status)->get();
        $pegawai = Pegawai::where('id_jabatan', 3)->first();
        $rencanakerja = RencanaKerja::all();
        return view('ajudan.rencanakerja.rencanakerja', [
            "title" => "Kelola Rencana Kerja",
        ], compact('rencanakerja', 'suratmasuk', 'pegawai'));
    }

    //AJUDAN //menampilkan halaman rencana kerja dan data rencana kerja yang kategorinya Luar Daerah Luar Provinsi
    public function ldlp()
    {
        $rencanakerja = RencanaKerja::where('kategori', 1)->get();
        return view('ajudan.rencanakerja.datarencanakerja', [
            "title" => "Daftar Rencana Kerja",
            "sub" => "Luar Daerah Luar Provinsi"
        ], compact('rencanakerja'));
    }

    //AJUDAN //menampilkan halaman rencana kerja dan data rencana kerja yang kategorinya Luar Daerah Dalam Provinsi
    public function lddp()
    {
        $rencanakerja = RencanaKerja::where('kategori', 2)->get();
        return view('ajudan.rencanakerja.datarencanakerja', [
            "title" => "Daftar Rencana Kerja",
            "sub" => "Luar Daerah Dalam Provinsi"
        ], compact('rencanakerja'));
    }

    //AJUDAN //menampilkan halaman rencana kerja dan data rencana kerja yang kategorinya Dalam Daerah Dalam Kabupaten
    public function dddk()
    {
        $rencanakerja = RencanaKerja::where('kategori', 3)->get();
        return view('ajudan.rencanakerja.datarencanakerja', [
            "title" => "Daftar Rencana Kerja",
            "sub" => "Dalam Daerah Dalam Kabupaten"
        ], compact('rencanakerja'));
    }
    //AJUDAN //menampilkan halaman kalender rencana kerja
    public function kalender()
    {
        $rencanakerja = RencanaKerja::all();
        return view('ajudan.rencanakerja.kalender', [
            "title" => "Daftar Rencana Kerja"
        ], compact('rencanakerja'));
    }

    //untuk memasukan rencana kerja kedalam kalender
    public function events()
    {
        $rencanakerja = RencanaKerja::select('id', 'rencana as title', 'start_date as start', 'end_date as end', 'color', 'lokasi')->get()->toArray();
        return response()->json($rencanakerja);
    }

    public function show($id)
    {
        $kalenderrencanakerja = RencanaKerja::findOrFail($id);
        return response()->json($kalenderrencanakerja);
    }

    //AJUDAN //menampilkan halaman tambah data rencana kerja
    public function create($id)
    {
        $user = User::all();
        $suratmasuk = SuratMasuk::find($id);
        return view('ajudan.rencanakerja.new', [
            "title" => "Tambah Rencana Kerja"
        ], compact('user', 'suratmasuk'));
    }

    //AJUDAN //menyimpan data rencana kerja
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'rencana' => 'required',
            'lokasi' => 'required',
            'kategori' => 'required',
            'color' => 'sometimes',
            //id_suratmasuk dimasukan ke validasi untuk syarat mengisi foreignkey id_rencanakerja
            //yang ada pada tabel surat masuk
            'id_suratmasuk' => 'required',
        ]);
        if ($validated_data['kategori'] == 1) {
            $validated_data['color'] = '#ffb0b0';
        } elseif ($validated_data['kategori'] == 2) {
            $validated_data['color'] = '#b0c7ff';
        } else {
            $validated_data['color'] = '#b0ffb4';
        }
        //Validasi pertama untuk menyimpan rencana kerja kedalam tabel rencana kerja
        $rencanakerja = new RencanaKerja($validated_data);
        $rencanakerja->user()->associate(Auth::user());
        $rencanakerja->save();

        //Validasi kedua untuk mengisi foreignkey id_rencanakerja pada tabel surat masuk
        //isinya sesuai dengan id dari rencana kerja yang telah dibuat sebelumnya
        $suratMasuk = SuratMasuk::find($validated_data['id_suratmasuk']);
        $suratMasuk->rencanakerja()->associate($rencanakerja);
        $suratMasuk->save();

        return redirect('kelolarencanakerja')->with('success', 'Data berhasil disimpan!');
    }

    //AJUDAN //menampilkan halaman edit data rencana kerja berdasarkan id rencana kerja
    public function edit($id)
    {
        $rencanakerja = RencanaKerja::find($id);
        return view('ajudan.rencanakerja.edit', [
            "title" => "Ubah Rencana Kerja"
        ], compact('rencanakerja'));
    }

    //AJUDAN //menyimpan hasil edit data rencana kerja berdasarkan id rencana kerja
    public function update(Request $request, $id)
    {
        $rencanakerja = RencanaKerja::find($id);

        $validated_data = $request->validate([
            'start_date' => 'sometimes',
            'end_date' => 'sometimes',
            'rencana' => 'sometimes',
            'lokasi' => 'sometimes',
            'kategori' => 'sometimes',
            'color' => 'sometimes',
            'id_suratmasuk' => 'sometimes',
        ]);
        if (isset($validated_data['kategori'])) {
            if ($validated_data['kategori'] == 1) {
                $validated_data['color'] = '#ffb0b0';
            } elseif ($validated_data['kategori'] == 2) {
                $validated_data['color'] = '#b0c7ff';
            } else {
                $validated_data['color'] = '#b0ffb4';
            }
        } else {
            // Jika kategori tidak ada dalam data yang divalidasi, tetapkan nilai kategori dan warna sebelumnya
            $validated_data['kategori'] = $rencanakerja->kategori;
            $validated_data['color'] = $rencanakerja->color;
        }
        $rencanakerja->update($validated_data);
        $rencanakerja->save();

        return redirect('kelolarencanakerja')->with('success', 'Data berhasil disimpan!');
    }

    //AJUDAN //menghapus rencana kerja berdasarkan id rencana kerja
    public function destroy(RencanaKerja $rencanakerja)
    {
        $rencanakerja->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    //BUPATI //menampilkan halaman rencana kerja dan data rencana kerja yang kategorinya Luar Daerah Luar Provinsi
    public function ldlpBupati()
    {
        $rencanakerja = RencanaKerja::where('kategori', 1)->get();
        return view('bupati.rencanakerja.rencanakerja', [
            "title" => "Daftar Rencana Kerja",
            "sub" => "Luar Daerah Luar Provinsi"
        ], compact('rencanakerja'));
    }

    //BUPATI //menampilkan halaman rencana kerja dan data rencana kerja yang kategorinya Luar Daerah Dalam Provinsi
    public function lddpBupati()
    {
        $rencanakerja = RencanaKerja::where('kategori', 2)->get();
        return view('bupati.rencanakerja.rencanakerja', [
            "title" => "Daftar Rencana Kerja",
            "sub" => "Luar Daerah Dalam Provinsi"
        ], compact('rencanakerja'));
    }

    //BUPATI //menampilkan halaman rencana kerja dan data rencana kerja yang kategorinya Dalam Daerah Dalam Kabupaten
    public function dddkBupati()
    {
        $rencanakerja = RencanaKerja::where('kategori', 3)->get();
        return view('bupati.rencanakerja.rencanakerja', [
            "title" => "Daftar Rencana Kerja",
            "sub" => "Dalam Daerah Dalam Kabupaten"
        ], compact('rencanakerja'));
    }
}
