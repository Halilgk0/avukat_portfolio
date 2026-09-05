<?php

namespace Database\Seeders;

use App\Models\LegalCase;
use Illuminate\Database\Seeder;

class CaseSeeder extends Seeder
{
    public function run()
    {
        $cases = [
            [
                'title' => 'Şirket Birleşmesi Davası',
                'category' => 'Ticaret Hukuku',
                'description' => 'İki büyük şirketin birleşme sürecinde ortaya çıkan hukuki sorunların çözümü.',
                'status' => 'Başarıyla Sonuçlandı',
                'year' => 2024,
            ],
            [
                'title' => 'Velayet Davası',
                'category' => 'Aile Hukuku',
                'description' => 'Karmaşık bir velayet davasında çocuğun üstün yararının korunması.',
                'status' => 'Başarıyla Sonuçlandı',
                'year' => 2023,
            ],
            [
                'title' => 'İşe İade Davası',
                'category' => 'İş Hukuku',
                'description' => 'Haksız yere işten çıkarılan çalışanın haklarının korunması.',
                'status' => 'Başarıyla Sonuçlandı',
                'year' => 2023,
            ],
            [
                'title' => 'Haksız Tutuklama Davası',
                'category' => 'Ceza Hukuku',
                'description' => 'Haksız yere tutuklanan müvekkilin beraat etmesi sağlandı.',
                'status' => 'Başarıyla Sonuçlandı',
                'year' => 2023,
            ],
            [
                'title' => 'Ticari Marka Davası',
                'category' => 'Ticaret Hukuku',
                'description' => 'Marka ihlali konusunda başarılı bir şekilde müvekkilin haklarının korunması.',
                'status' => 'Başarıyla Sonuçlandı',
                'year' => 2023,
            ],
            [
                'title' => 'Toplu İş Sözleşmesi',
                'category' => 'İş Hukuku',
                'description' => 'Büyük bir şirkette işçi haklarının korunması için yapılan hukuki mücadele.',
                'status' => 'Başarıyla Sonuçlandı',
                'year' => 2023,
            ],
        ];

        foreach ($cases as $case) {
            LegalCase::create($case);
        }
    }
}
