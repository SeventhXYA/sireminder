<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Pegawai;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //STAFF //menampilkan halaman pegawai dan data pegawai kedalam tabel
    public function index()
    {
        $pegawai = Pegawai::all();
        // dd($pegawai->toArray());
        return view('staff.pegawai.pegawai', [
            "title" => "Kelola Pegawai",
        ], compact('pegawai'));
    }

    //STAFF //menampilkan halaman tambah data pegawai
    public function create()
    {
        $jabatan = Jabatan::all();
        return view('staff.pegawai.new', [
            "title" => "Tambah Pegawai"
        ], compact('jabatan'));
    }

    //STAFF //menyimpan data pegawai
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'nama_pegawai' => 'required',
            'jk'  => 'required',
            'nohp' => 'required',

            'id_jabatan' => 'required',
            'user_id' => 'sometimes',
        ]);
        $pegawai = new Pegawai($validated_data);
        $pegawai->save();

        return redirect('pegawai')->with('success', 'Data berhasil disimpan!');
    }

    //STAFF //menampilkan halaman edit data pegawai berdasarkan id pegawai
    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        $jabatan = Jabatan::all();
        return view('staff.pegawai.edit', [
            "title" => "Ubah Pegawai"
        ], compact('pegawai', 'jabatan'));
    }

    //STAFF //menyimpan hasil edit data pegawai berdasarkan id pegawai
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        $validated_data = $request->validate([
            'nama_pegawai' => 'required',
            'jk' => 'sometimes',
            'nohp' => 'required',

            'id_jabatan' => 'required',
        ]);

        $pegawai->update($validated_data);
        return redirect('pegawai')->with('success', 'Data berhasil diubah!');
    }

    //STAFF //menghapus pegawai berdasarkan id pegawai
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
