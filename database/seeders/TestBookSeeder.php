<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(10)->reading()->create();
        Book::factory(30)->completed()->create();
        Book::factory(60)->old()->create();
        Book::factory(40)->deleted()->create();
    }
}
