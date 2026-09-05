<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutSection::create([
            'title' => 'Profesyonel Deneyim',
            'content' => '20 yılı aşkın süredir, müvekkillerime en yüksek kalitede hukuki hizmet sunmaktayım. Her davayı titizlikle ele alarak, müvekkillerimin haklarını en iyi şekilde korumak için çalışıyorum.',
            'lawyer_name' => 'Av. Mehmet Yılmaz',
            'lawyer_title' => '20 yıllık hukuki tecrübe ve uzmanlık',
            'experience' => '<ul class="space-y-4">
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                    <span>500\'den fazla başarılı dava sonucu</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                    <span>Ticaret, aile, ceza ve iş hukuku uzmanlık alanları</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                    <span>Müvekkil odaklı yaklaşım ve sürekli iletişim</span>
                </li>
            </ul>',
            'education' => '<ul class="space-y-4">
                <li class="flex items-start">
                    <div class="mr-4">
                        <span class="text-gray-600">2000-2005</span>
                    </div>
                    <div>
                        <h4 class="font-semibold">Hukuk Fakültesi</h4>
                        <p class="text-gray-600">İstanbul Üniversitesi</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <div class="mr-4">
                        <span class="text-gray-600">2005-2006</span>
                    </div>
                    <div>
                        <h4 class="font-semibold">Avukatlık Stajı</h4>
                        <p class="text-gray-600">İstanbul Barosu</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <div class="mr-4">
                        <span class="text-gray-600">2009-2010</span>
                    </div>
                    <div>
                        <h4 class="font-semibold">Yüksek Lisans - Ticaret Hukuku</h4>
                        <p class="text-gray-600">İstanbul Üniversitesi</p>
                    </div>
                </li>
            </ul>',
            'certificates' => '<ul class="space-y-4">
                <li class="flex items-start">
                    <i class="fas fa-certificate text-yellow-500 mt-1 mr-3"></i>
                    <div>
                        <h4 class="font-semibold">İstanbul Barosu Üyeliği</h4>
                        <p class="text-gray-600">2006 - Günümüz</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-certificate text-yellow-500 mt-1 mr-3"></i>
                    <div>
                        <h4 class="font-semibold">Arabuluculuk Sertifikası</h4>
                        <p class="text-gray-600">2018</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-certificate text-yellow-500 mt-1 mr-3"></i>
                    <div>
                        <h4 class="font-semibold">Uluslararası Ticaret Hukuku Sertifikası</h4>
                        <p class="text-gray-600">2015</p>
                    </div>
                </li>
            </ul>',
            'is_active' => true
        ]);
    }
}
