<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // マスタ
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
        ]);

        // デモデータ
        $this->call([
            DemoUserSeeder::class,
            DemoCategorySeeder::class,
            DemoBookSeeder::class
        ]);

        // テストデータ
        // if (app()->environment('local')) {
        //     $this->call([
        //         TestUserSeeder::class,
        //         TestCategorySeeder::class,
        //         TestBookSeeder::class
        //     ]);
        // }
    }
}
