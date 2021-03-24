<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[[
            'nim' => '2942728394',
            'nama' =>'Asep Sunandar',
            'kelas' => 'TI-2D',
            'jurusan' => 'Informatika',
            'no_hp' => '084232775001'
        ],[
            'nim' => '2942728032',
            'nama' =>'Budi Hasari',
            'kelas' => 'MI-1C',
            'jurusan' => 'Informatika',
            'no_hp' => '082380175001'
        ],[
            'nim' => '2942728444',
            'nama' =>'Supriyadi',
            'kelas' => 'TI-2D',
            'jurusan' => 'Informatika',
            'no_hp' => '081788475001'
        ]
    ];
    DB::table('mahasiswa')->insert($data);

    }
}
