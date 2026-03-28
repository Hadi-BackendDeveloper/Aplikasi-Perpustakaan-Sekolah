<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Rizky Purnomo',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'kelas' => 'XII',
                'jurusan' => 'Bisnis Daring dan Pemasaran',
                'alamat' => 'Jl. Kesono kemari, RT: 005/RW: 02 NO.12 ',
                'no_telp' => '081234567890',
                'username' => 'purnomo_rizky40',
                'password' => Hash::make('purnomo_rizky40'),
            ],
            [
                'nama' => 'Justianoza Kukuh C.',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Kristen',
                'kelas' => 'XII',
                'jurusan' => 'Rekayasa Perangkat Lunak',
                'alamat' => 'Jl. Kaliurang, RT: 002/RW: 02 NO.11 ',
                'no_telp' => '081234567891',
                'username' => 'justin117',
                'password' => Hash::make('justin117'),
            ],
            [
                'nama' => 'Ursula Silalahi',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Kristen',
                'kelas' => 'X',
                'jurusan' => 'Bisnis Daring dan Pemasaran',
                'alamat' => 'Jl. Mangga, RT: 009/RW: 01 NO.09 ',
                'no_telp' => '081234567892',
                'username' => 'ursula112',
                'password' => Hash::make('ursula112'),
            ],
            [
                'nama' => 'Martinus Sipasak Pagar',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Katolik',
                'kelas' => 'XI',
                'jurusan' => 'Akuntansi Keuangan dan Lembaga',
                'alamat' => 'Jl. Maju mundur, RT: 009/RW: 01 NO.19 ',
                'no_telp' => '081234567893',
                'username' => 'martinus123',
                'password' => Hash::make('martinus123'),
            ],
        ];

        foreach ($data as $item) {
            Member::create($item);
        }
    }
}