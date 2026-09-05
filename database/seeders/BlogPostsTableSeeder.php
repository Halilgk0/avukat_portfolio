<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // En az bir tane admin kullanıcısına ait blog yazısı oluştur
        $adminUser = User::where('is_admin', true)->first();
        
        if ($adminUser) {
            BlogPost::create([
                'user_id' => $adminUser->id,
                'title' => 'Örnek Blog Yazısı',
                'slug' => 'ornek-blog-yazisi',
                'excerpt' => 'Bu bir örnek blog yazısıdır. Düzenleme sayfasını test etmek için oluşturulmuştur.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod, nisi vel consectetur interdum, nisl nisi vestibulum nisl, eget vestibulum nisl nisi vel nisl. Proin euismod, nisi vel consectetur interdum, nisl nisi vestibulum nisl, eget vestibulum nisl nisi vel nisl.',
                'image' => 'images/blog/post-1.jpg',
                'category' => 'Ticaret Hukuku',
                'featured' => true,
                'published_at' => now(),
            ]);
        }
        
        // Her kullanıcı için 3-7 arası blog yazısı oluştur
        User::all()->each(function ($user) {
            BlogPost::factory()
                ->count(rand(3, 7))
                ->create([
                    'user_id' => $user->id
                ]);
        });
    }
}
