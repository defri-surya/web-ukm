<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'role' => 'superadmin',
                'username' => 'superadmin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Pengelola Demo',
                'role' => 'pengelola',
                'username' => 'pengelola',
                'email' => 'pengelola@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Customer Demo',
                'role' => 'customer',
                'username' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => bcrypt('password'),
            ]
        ]);

        DB::table('pengelolas')->insert([
            'user_id' => 2,
            'kode_regis' => 'ADM-000001',
            'nama' => 'Pengelola Demo',
        ]);

        DB::table('customers')->insert([
            'user_id' => 3,
            'kode_regis' => 'CUST-000001',
            'nama' => 'Customer Demo',
        ]);
    }
}
