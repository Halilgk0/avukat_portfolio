<?php

namespace Database\Seeders;

use App\Models\LegalCase;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LegalCasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Her kullanıcı için 2-5 arası dava oluştur
        User::all()->each(function ($user) {
            LegalCase::factory()
                ->count(rand(2, 5))
                ->create([
                    'user_id' => $user->id
                ]);
        });
    }
}
