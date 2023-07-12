<?php

use App\Jabatan;
use App\Pegawai;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::create([
            'jabatan' => 'Ajudan II'
        ]);

        Jabatan::create([
            'jabatan' => 'Staff'
        ]);

        Jabatan::create([
            'jabatan' => 'Bupati'
        ]);

        Role::create([
            'role' => 'Ajudan'
        ]);
        Role::create([
            'role' => 'Staff'
        ]);
        Role::create([
            'role' => 'Bupati'
        ]);

        User::create([
            // 'id_pegawai' => 1,
            'username' => 'ajudan',
            'password' => bcrypt('ajudan'),
            'email' => 'rahmatnor123@gmail.com',
            'id_role' => 1,
        ]);
        User::create([
            // 'id_pegawai' => 2,
            'username' => 'staff',
            'password' => bcrypt('staff'),
            'email' => 'erninm25@gmail.com',
            'id_role' => 2,
        ]);
        User::create([
            // 'id_pegawai' => 3,
            'username' => 'bupati',
            'password' => bcrypt('bupati'),
            'email' => 'bupatibalangan@gmail.com',
            'id_role' => 3,
        ]);

        Pegawai::create([
            'nama_pegawai' => 'Rahmat Nor Fahmi',
            'jk' => 'Laki-Laki',
            'nohp' => '6282258898310',
            'id_jabatan' => 1,
            'user_id' => 1
        ]);
        Pegawai::create([
            'nama_pegawai' => 'Erni Nisa Mahmudah',
            'jk' => 'Perempuan',
            'nohp' => '6282248599122',
            'id_jabatan' => 2,
            'user_id' => 2
        ]);
        Pegawai::create([
            'nama_pegawai' => 'H. Abdul Hadi, S.Ag., M.I.Kom.',
            'jk' => 'Laki-Laki',
            'nohp' => '6282245906013',
            'id_jabatan' => 3,
            'user_id' => 3
        ]);
    }
}
