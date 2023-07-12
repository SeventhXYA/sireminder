<?php

namespace App\Http\Controllers;

use App\Status;
use App\SuratMasuk;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $suratmasuk = SuratMasuk::find($id);
        return view('ajudan.kelolasuratmasuk.add', [
            "title" => "Ubah Kategori dan Status"
        ], compact('suratmasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'kategori' => 'required',
            'status' => 'required',
            //id_suratmasuk dimasukan ke validasi untuk syarat mengisi foreignkey id_rencanakerja
            //yang ada pada tabel surat masuk
            'id_suratmasuk' => 'required',
        ]);

        //Validasi pertama untuk menyimpan rencana kerja kedalam tabel rencana kerja
        $status = new Status($validated_data);
        $status->save();

        //Validasi kedua untuk mengisi foreignkey id_rencanakerja pada tabel surat masuk
        //isinya sesuai dengan id dari rencana kerja yang telah dibuat sebelumnya
        $suratMasuk = SuratMasuk::find($validated_data['id_suratmasuk']);
        $suratMasuk->status()->associate($status);
        $suratMasuk->save();

        return redirect('kelolasuratmasuk')->with('success', 'Status berhasil diubah!');
    }

    public function edit($id)
    {
        $status = Status::find($id);
        return view('ajudan.kelolasuratmasuk.edit', [
            "title" => "Ubah Kategori dan Status"
        ], compact('status'));
    }

    public function update(Request $request, $id)
    {
        $status = Status::find($id);

        $validated_data = $request->validate([
            'kategori' => 'sometimes',
            'status' => 'sometimes',
            //id_suratmasuk dimasukan ke validasi untuk syarat mengisi foreignkey id_rencanakerja
            //yang ada pada tabel surat masuk
            'id_suratmasuk' => 'sometimes',
        ]);
        $status->update($validated_data);
        $status->save();

        return redirect('kelolasuratmasuk')->with('success', 'Status berhasil diubah!');
    }

    public function editBupati($id)
    {
        $status = Status::find($id);
        return view('bupati.suratmasuk.edit', [
            "title" => "Ubah Kategori dan Status"
        ], compact('status'));
    }

    public function updateBupati(Request $request, $id)
    {
        $status = Status::find($id);

        $validated_data = $request->validate([
            'kategori' => 'sometimes',
            'status' => 'sometimes',
            //id_suratmasuk dimasukan ke validasi untuk syarat mengisi foreignkey id_rencanakerja
            //yang ada pada tabel surat masuk
            'id_suratmasuk' => 'sometimes',
        ]);
        $status->update($validated_data);
        $status->save();

        return redirect('suratmasuk/pendingBupati')->with('success', 'Status berhasil diubah!');
    }
}
