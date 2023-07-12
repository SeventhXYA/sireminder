<?php

namespace App\Http\Controllers;

use App\Status;
use App\SuratMasuk;
use App\Temp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratMasukController extends Controller
{
    //STAFF //menampilkan halaman surat masuk 
    public function index()
    {
        $suratmasuk = SuratMasuk::orderBy('created_at', 'DESC')->get();
        return view('staff.suratmasuk.suratmasuk', [
            "title" => "Kelola Surat Masuk",
        ], compact('suratmasuk'));
    }

    //STAFF //menampilkan halaman tambah data surat masuk
    public function create()
    {
        $user = User::all();
        return view('staff.suratmasuk.new', [
            "title" => "Tambah Surat Masuk"
        ], compact('user'));
    }

    //STAFF //menyimpan data surat masuk
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'pengirim' => 'required',
            'no_surat' => ['nullable', 'unique:tb_suratmasuk'],
            'tgl_surat' => 'sometimes',
            'perihal' => 'required',
            'id_status' => 'sometimes',
            'id_rencanakerja' => 'sometimes',
        ]);

        $suratmasuk = new SuratMasuk($validated_data);
        $suratmasuk->user()->associate(Auth::user());
        $suratmasuk->save();

        return redirect('suratmasuk')->with('success', 'Data berhasil disimpan!');
    }

    //STAFF //menampilkan halaman edit data surat masuk berdasarkan id surat masuk
    public function edit($id)
    {
        $suratmasuk = SuratMasuk::find($id);
        return view('staff.suratmasuk.edit', [
            "title" => "Ubah Suratmasuk"
        ], compact('suratmasuk'));
    }

    //STAFF //menyimpan hasil edit data surat masuk berdasarkan id surat masuk
    public function update(Request $request, $id)
    {
        $suratmasuk = SuratMasuk::find($id);

        $validated_data = $request->validate([
            'pengirim' => 'sometimes',
            'no_surat' => 'sometimes',
            'tgl_surat' => 'sometimes',
            'perihal' => 'sometimes',
            'id_status' => 'sometimes',
            'id_rencanakerja' => 'sometimes',
        ]);
        $suratmasuk->update($validated_data);
        $suratmasuk->save();

        return redirect('suratmasuk')->with('success', 'Data berhasil diubah!');
    }

    //AJUDAN //menampilkan halaman surat masuk untuk mengubah status dari surat masuk 
    //yang awalnya - menjadi pending jika memang memerlukan approval dari bupati
    public function indexKelola()
    {
        $suratmasuk = SuratMasuk::orderBy('created_at', 'DESC')->get();
        return view('ajudan.kelolasuratmasuk.kelolasuratmasuk', [
            "title" => "Kelola Surat Masuk",
        ], compact('suratmasuk'));
    }

    //AJUDAN //menampilkan halaman surat masuk yang memiliki kategori 1 (untuk bupati)
    public function bupati()
    {
        $status = Status::where('kategori', 1)->pluck('id');
        $suratmasuk = SuratMasuk::whereIn('id_status', $status)->get();
        return view('ajudan.kelolasuratmasuk.kelolasuratmasuk', [
            "title" => "Surat Masuk Untuk Bupati",
        ], compact('suratmasuk'));
    }

    //AJUDAN //menampilkan halaman surat masuk yang memiliki kategori 2 (kegiatan lain)
    public function others()
    {
        $status = Status::where('kategori', 2)->pluck('id');
        $suratmasuk = SuratMasuk::whereIn('id_status', $status)->get();
        return view('ajudan.kelolasuratmasuk.kelolasuratmasuk', [
            "title" => "Surat Masuk Kegiatan Lain",
        ], compact('suratmasuk'));
    }

    //AJUDAN //menampilkan halaman surat masuk yang memiliki status 1 (pending)
    public function pending()
    {
        $status = Status::where('status', 1)->pluck('id');
        $suratmasuk = SuratMasuk::whereIn('id_status', $status)->get();
        return view('ajudan.kelolasuratmasuk.kelolasuratmasuk', [
            "title" => "Surat Masuk Pending",
        ], compact('suratmasuk'));
    }

    //AJUDAN //menampilkan halaman surat masuk yang memiliki status 2 (approved)
    public function approved()
    {
        $status = Status::where('status', 2)->pluck('id');
        $suratmasuk = SuratMasuk::whereIn('id_status', $status)->get();
        return view('ajudan.kelolasuratmasuk.kelolasuratmasuk', [
            "title" => "Surat Masuk Approved",
        ], compact('suratmasuk'));
    }

    //AJUDAN //menampilkan halaman surat masuk yang memiliki status 3 (declined)
    public function declined()
    {
        $status = Status::where('status', 3)->pluck('id');
        $suratmasuk = SuratMasuk::whereIn('id_status', $status)->get();
        return view('ajudan.kelolasuratmasuk.kelolasuratmasuk', [
            "title" => "Surat Masuk Declined",
        ], compact('suratmasuk'));
    }

    // //AJUDAN //menampilkan halaman edit data surat masuk berdasarkan id surat masuk
    // public function editKelola($id)
    // {
    //     $suratmasuk = SuratMasuk::find($id);
    //     return view('ajudan.kelolasuratmasuk.edit', [
    //         "title" => "Ubah Kategori dan Status"
    //     ], compact('suratmasuk'));
    // }

    //AJUDAN //menyimpan hasil edit status surat masuk oleh Ajudan (status diubah menjadi pending agar masuk ke halaman Bupati)
    // public function updateKelola(Request $request, $id)
    // {
    //     $suratmasuk = SuratMasuk::find($id);

    //     $validated_data = $request->validate([
    //         'status' => 'sometimes',
    //     ]);
    //     $suratmasuk->update($validated_data);
    //     $suratmasuk->save();

    //     return redirect('kelolasuratmasuk')->with('success', 'Data berhasil diubah!');
    // }

    //STAFF & AJUDAN //menghapus surat masuk berdasarkan id surat masuk
    public function moveData($id)
    {
        DB::transaction(function () use ($id) {
            $item = SuratMasuk::find($id);

            if ($item) {
                $itemData = $item->toArray();
                $itemData['deleted_by'] = Auth::id();

                Temp::create($itemData);
                $item->delete();
            }
        });
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
    public function temp()
    {
        $suratmasuk = Temp::orderBy('id', 'DESC')->get();
        return view('temp', [
            "title" => "Tempat Sampah Surat Masuk",
        ], compact('suratmasuk'));
    }
    public function restoreData($id)
    {
        DB::transaction(function () use ($id) {
            $item = Temp::find($id);

            if ($item) {
                $itemData = $item->toArray();
                $itemData['deleted_by'] = null;

                SuratMasuk::create($itemData);
                $item->delete();
            }
        });
        return redirect()->back()->with('success', 'Data berhasil dipulihkan!');
    }

    //BUPATI //menampilkan halaman surat masuk untuk melihat data dan status dari surat masuk
    public function indexBupati()
    {
        $suratmasuk = SuratMasuk::orderBy('created_at', 'DESC')->get();
        return view('bupati.suratmasuk.suratmasuk', [
            "title" => "Daftar Surat Masuk",
        ], compact('suratmasuk'));
    }

    //BUPATI //menampilkan halaman surat masuk yang memiliki status 1 (pending)
    public function pendingBupati()
    {
        $status = Status::where('status', 1)->pluck('id');
        $suratmasuk = SuratMasuk::whereIn('id_status', $status)->get();
        return view('bupati.suratmasuk.kelolasuratmasuk', [
            "title" => "Surat Masuk Pending",
            "sub" => "Surat Masuk Pending"
        ], compact('suratmasuk'));
    }

    //BUPATI //menampilkan halaman surat masuk yang memiliki status 2 (approved)
    public function approvedBupati()
    {
        $status = Status::where('status', 2)->pluck('id');
        $suratmasuk = SuratMasuk::whereIn('id_status', $status)->get();
        return view('bupati.suratmasuk.kelolasuratmasuk', [
            "title" => "Surat Masuk Approved",
            "sub" => "Surat Masuk Approved"
        ], compact('suratmasuk'));
    }

    //BUPATI //menampilkan halaman surat masuk yang memiliki status 1 (declined)
    public function declinedBupati()
    {
        $status = Status::where('status', 3)->pluck('id');
        $suratmasuk = SuratMasuk::whereIn('id_status', $status)->get();
        return view('bupati.suratmasuk.kelolasuratmasuk', [
            "title" => "Surat Masuk Declined",
            "sub" => "Surat Masuk Declined"
        ], compact('suratmasuk'));
    }

    //BUPATI //menampilkan halaman edit data surat masuk berdasarkan id surat masuk
    public function editBupati($id)
    {
        $suratmasuk = SuratMasuk::find($id);
        return view('bupati.suratmasuk.edit', [
            "title" => "Approval Surat Masuk"
        ], compact('suratmasuk'));
    }

    //BUPATI //menyimpan hasil edit status surat masuk oleh Bupati (approval surat masuk)
    public function updateBupati(Request $request, $id)
    {
        $suratmasuk = SuratMasuk::find($id);

        $validated_data = $request->validate([
            'status' => 'sometimes',
        ]);
        $suratmasuk->update($validated_data);
        $suratmasuk->save();

        return redirect('suratmasuk/pendingBupati')->with('success', 'Data berhasil diubah!');
    }
}
