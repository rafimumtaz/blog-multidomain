<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Cari institusi berdasarkan nama
        $institutionA = Institution::where('name', 'Universitas A')->first();
        $institutionB = Institution::where('name', 'Universitas B')->first();

        // Hanya jalankan jika institusi ditemukan
        if ($institutionA) {
            User::create([
                'institution_id'    => $institutionA->id,
                'name'              => 'Universitas A',
                'email'             => 'univ-a@gmail.com',
                'password'          => Hash::make('12345678'), // Password di-hash
                'remember_token'    => 'akuanaksehat',
                'email_verified_at' => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
        }

        if ($institutionB) {
            User::create([
                'institution_id'    => $institutionB->id,
                'name'              => 'Universitas B',
                'email'             => 'univ-b@gmail.com',
                'password'          => Hash::make('12345678'), // Password di-hash
                'remember_token'    => 'akuanaksehatbanget',
                'email_verified_at' => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
        }
    }
}