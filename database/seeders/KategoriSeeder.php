<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'tumb' => null,
                'slug' => Str::slug('Makanan', '-')
            ],
            [
                'title' => 'Baju',
                'tumb' => null,
                'slug' => Str::slug('Baju', '-')
            ],
            [
                'title' => 'Oleh-Oleh',
                'tumb' => null,
                'slug' => Str::slug('Oleh-Oleh', '-')
            ]
        ]);
    }
}
