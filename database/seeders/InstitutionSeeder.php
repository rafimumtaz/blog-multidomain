<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        Institution::create([
            'name' => 'Universitas A',
            'domain' => 'univ-a.localhost',
        ]);

        Institution::create([
            'name' => 'Universitas B',
            'domain' => 'univ-b.localhost',
        ]);
    }
}
