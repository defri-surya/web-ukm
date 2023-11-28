<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            [
                'title' => 'Makanan',
                'tumb' => null
            ],
            [
                'title' => 'Baju',
                'tumb' => null
            ],
            [
                'title' => 'Oleh-Oleh',
                'tumb' => null
            ]
        ]);
    }
}
