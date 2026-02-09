<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => '小説'],
            ['title' => 'ビジネス・経済'],
            ['title' => '自己啓発'],
            ['title' => 'IT・プログラミング'],
            ['title' => '科学・技術'],
            ['title' => '歴史・地理'],
            ['title' => '社会・政治'],
            ['title' => '芸術・デザイン'],
            ['title' => '趣味・実用'],
            ['title' => '教育・学習'],
        ];

        $now = Carbon::now();

        Category::insert(
            array_map(
                fn ($category) => [
                    'title' => $category['title'],
                    'created_at' => $now,
                    'updated_at' => $now
                ],
                $categories
            )
        );
    }
}
