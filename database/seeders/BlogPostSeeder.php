<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Featured Post
        BlogPost::create([
            'title' => 'Yeni İş Kanunu Değişiklikleri ve Etkileri',
            'slug' => Str::slug('Yeni İş Kanunu Değişiklikleri ve Etkileri'),
            'excerpt' => 'İş hukukunda yapılan son değişiklikler ve bu değişikliklerin işveren ve çalışanlar üzerindeki etkileri hakkında detaylı bir analiz.',
            'content' => 'Detaylı içerik buraya gelecek...',
            'image' => 'images/blog/featured-blog.jpg',
            'category' => 'İş Hukuku',
            'featured' => true,
            'published_at' => now(),
        ]);

        // Regular Posts
        $posts = [
            [
                'title' => 'Boşanma Sürecinde Dikkat Edilmesi Gerekenler',
                'excerpt' => 'Boşanma sürecinde tarafların hakları ve yükümlülükleri hakkında önemli bilgiler.',
                'category' => 'Aile Hukuku',
                'image' => 'images/blog/blog-1.jpg',
            ],
            [
                'title' => 'Ticari Sözleşmelerde Önemli Noktalar',
                'excerpt' => 'Ticari sözleşmelerin hazırlanması ve dikkat edilmesi gereken hususlar.',
                'category' => 'Ticaret Hukuku',
                'image' => 'images/blog/blog-2.jpg',
            ],
            [
                'title' => 'Ceza Davalarında Savunma Hakları',
                'excerpt' => 'Ceza davalarında sanık haklarının korunması ve etkili savunma yöntemleri.',
                'category' => 'Ceza Hukuku',
                'image' => 'images/blog/blog-3.jpg',
            ],
            [
                'title' => 'İş Kazalarında Hukuki Süreç',
                'excerpt' => 'İş kazalarında işçi ve işveren hakları, tazminat talepleri.',
                'category' => 'İş Hukuku',
                'image' => 'images/blog/blog-4.jpg',
            ],
            [
                'title' => 'Miras Hukukunda Yeni Düzenlemeler',
                'excerpt' => 'Miras hukukundaki güncel değişiklikler ve mirasçıların hakları.',
                'category' => 'Miras Hukuku',
                'image' => 'images/blog/blog-5.jpg',
            ],
            [
                'title' => 'Kira Hukukunda Sık Sorulan Sorular',
                'excerpt' => 'Kiracı ve ev sahiplerinin hakları, kira sözleşmeleri hakkında bilgiler.',
                'category' => 'Gayrimenkul Hukuku',
                'image' => 'images/blog/blog-6.jpg',
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'excerpt' => $post['excerpt'],
                'content' => 'Detaylı içerik buraya gelecek...',
                'image' => $post['image'],
                'category' => $post['category'],
                'featured' => false,
                'published_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
