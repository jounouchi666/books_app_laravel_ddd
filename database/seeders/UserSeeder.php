<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oldestDate = '1970/01/02 00:00:00';

        User::updateOrInsert(
            ['email' => env('ADMIN_EMAIL', 'admin@example.com')],
            [
            'name' => 'admin',
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
            'is_admin' => true,
            'created_at' => $oldestDate,
            'updated_at' => $oldestDate
        ]);
    }
}
