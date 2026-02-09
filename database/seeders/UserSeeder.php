<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        User::updateOrInsert(
            ['email' => env('ADMIN_EMAIL', 'admin@example.com')],
            [
            'name' => 'admin',
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
            'is_admin' => true,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
