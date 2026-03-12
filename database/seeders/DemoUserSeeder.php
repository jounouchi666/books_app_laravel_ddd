<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oldestDate = '1970/01/02 00:00:00';

        // ゲストユーザー
        User::updateOrInsert(
            ['email' => 'guest@example.com'],
            [
            'name' => 'ゲストユーザー',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'created_at' => $oldestDate,
            'updated_at' => $oldestDate
        ]);

        // デモユーザー
        User::factory(10)->create();
    }
}
