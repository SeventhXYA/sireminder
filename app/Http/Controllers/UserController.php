<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //AJUDAN //menampilkan halaman user atau akun pengguna dan data user atau akun pengguna kedalam tabel
    public function index()
    {
        $user = User::all();
        $role = Role::all();
        $pegawai = Pegawai::all();
        return view('ajudan.akun.akun', [
            "title" => "Kelola Akun Pengguna",
        ], compact('user', 'pegawai', 'role'));
    }

    //AJUDAN //menampilkan halaman tambah data user atau akun pengguna
    public function create($id)
    {
        $pegawai = Pegawai::find($id);
        $role = Role::all();
        return view('ajudan.akun.new', [
            "title" => "Tambah Akun Pengguna"
        ], compact('pegawai', 'role'));
    }

    //AJUDAN //menyimpan data user atau akun pengguna
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'username'  => ['required', 'min:4', 'max:50', 'unique:tb_user'],
            'password' => 'required',
            'email' => ['required', 'email:dns', 'unique:tb_user'],
            'id_role' => 'required',
            'id_pegawai' => 'required',
        ]);
        $validated_data['password'] = Hash::make($validated_data['password']);
        $user = new User($validated_data);
        $user->save();
        $pegawai = Pegawai::find($validated_data['id_pegawai']);
        $pegawai->user()->associate($user);
        $pegawai->save();

        return redirect('akun')->with('success', 'Data berhasil disimpan!');
    }

    //AJUDAN //menampilkan halaman edit data user atau akun pengguna berdasarkan id user atau akun pengguna
    public function edit($id)
    {
        $user = User::find($id);
        $pegawai = Pegawai::where('user_id', $user->id)->get();
        $role = Role::all();
        return view('ajudan.akun.edit', [
            "title" => "Edit Akun Pengguna"
        ], compact('pegawai', 'role', 'user'));
    }

    //AJUDAN //menyimpan hasil edit data user atau akun pengguna berdasarkan id user atau akun pengguna
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validatedData = Validator::make($request->all(), [
            'id_pegawai' => ['sometimes', 'exists:tb_pegawai,id'],
            'username' => [
                'sometimes',
                'min:4',
                'max:50',
                Rule::unique('tb_user')->ignore($id, 'id')
            ],
            'password' => 'sometimes',
            'email' => [
                'sometimes',
                'email:dns',
                Rule::unique('tb_user')->ignore($user->id),
            ],
            'id_role' => 'sometimes',
        ])->validate();

        if (is_null($request->input('password'))) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($request->input('password'));
        }

        $user->update($validatedData);

        return redirect('akun')->with('success', 'Data berhasil diubah!');
    }

    //AJUDAN //menghapus user atau akun pengguna berdasarkan id user atau akun pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
