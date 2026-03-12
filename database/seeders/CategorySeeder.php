<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // マスタのインポート
        $categories = json_decode(
            File::get(database_path('seeders/master/categories.json')),
            true
        );

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}
