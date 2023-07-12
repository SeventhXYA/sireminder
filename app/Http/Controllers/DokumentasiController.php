<?php

namespace App\Http\Controllers;

use App\Dokumentasi;
use App\RencanaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DokumentasiController extends Controller
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
        $rencanakerja = RencanaKerja::find($id);
        return view('ajudan.rencanakerja.adddokumentasi', [
            "title" => "Ubah Kategori dan Status"
        ], compact('rencanakerja'));
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
            'foto' => 'image',
            //id_rencanakerja dimasukan ke validasi untuk syarat mengisi foreignkey id_dokumentasi
            //yang ada pada tabel rencana kerja
            'id_rencanakerja' => 'required',
        ]);

        $filename = 'uploads/dokumentasi/' . Auth::user()->username . time() . '.jpg';

        $image = Image::make($request->file('foto')->getRealPath());

        $image->fit(800, 600);
        $image->encode('jpg', 90);
        $image->stream();
        Storage::disk('local')->put('public/' . $filename, $image, 'public');

        //Validasi pertama untuk menyimpan dokumentasi kedalam tabel dokumentasi
        $validated_data['foto'] = 'storage/' . $filename;
        $dokumentasi = new Dokumentasi($validated_data);
        $dokumentasi->save();

        //Validasi kedua untuk mengisi foreignkey id_dokumentasi pada tabel rencana kerja
        //isinya sesuai dengan id dari dokumentasi yang telah dibuat sebelumnya
        $rencanaKerja = RencanaKerja::find($validated_data['id_rencanakerja']);
        $rencanaKerja->dokumentasi()->associate($dokumentasi);
        $rencanaKerja->save();

        return redirect('daftarrencanakerja/list')->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function edit(Dokumentasi $dokumentasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumentasi $dokumentasi)
    {
        $dokumentasi->delete();
        return redirect()->back()->with('success', 'Dokumentasi berhasil dihapus!');
    }
}
