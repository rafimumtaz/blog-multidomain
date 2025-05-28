<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Institution;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $institutions = Institution::all();

        foreach ($institutions as $institution) {
            Article::create([
                'title' => 'Welcome to ' . $institution->name,
                'content' => 'Ini artikel pertama dari ' . $institution->name,
                'institution_id' => $institution->id,
            ]);
        }
    }
}
