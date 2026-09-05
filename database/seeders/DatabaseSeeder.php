<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\BlogPostsTableSeeder;
use Database\Seeders\LegalCasesTableSeeder;
use Database\Seeders\AboutSectionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            BlogPostsTableSeeder::class,
            LegalCasesTableSeeder::class,
            AboutSectionSeeder::class,
        ]);
    }
}
