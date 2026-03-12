<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DemoBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = json_decode(
            File::get(database_path('seeders/demo/books.json')),
            true
        );

        foreach ($books as $book) {
            DB::table('books')->insert($book);
        }
    }
}
