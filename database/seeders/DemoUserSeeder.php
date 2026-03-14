<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

        $users = json_decode(
            File::get(database_path('seeders/demo/users.json')),
            true
        );

        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'] ?? bcrypt('password'),
                'is_admin' => $user['is_admin'],
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at']
            ]);
        }
    }
}
