<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    //STAFF //menampilkan halaman jabatan dan data jabatan kedalam tabel
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('staff.jabatan.jabatan', [
            "title" => "Kelola Jabatan",
        ], compact('jabatan'));
    }

    //STAFF //menampilkan halaman tambah data jabatan
    public function create()
    {
        // $user = User::all();
        return view('staff.jabatan.new', [
            "title" => "Tambah Jabatan"
        ]);
    }

    //STAFF //menyimpan data jabatan
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'jabatan' => 'required'
        ]);
        $jabatan = new Jabatan($validated_data);
        $jabatan->save();

        return redirect('jabatan')->with('success', 'Data berhasil disimpan!');
    }

    //STAFF //menampilkan halaman edit data jabatan berdasarkan id jabatan
    public function edit($id)
    {
        $jabatan = Jabatan::find($id);
        return view('staff.jabatan.edit', [
            "title" => "Ubah Jabatan"
        ], compact('jabatan'));
    }

    //STAFF //menyimpan hasil edit data jabatan berdasarkan id jabatan
    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::find($id);
        $validated_data = $request->validate([
            'jabatan' => 'required'
        ]);

        $jabatan->update($validated_data);
        return redirect('jabatan')->with('success', 'Data berhasil diubah!');
    }

    //STAFF //menghapus jabatan berdasarkan id jabatan
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
