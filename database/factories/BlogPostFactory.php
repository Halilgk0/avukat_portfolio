<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        $categories = ['Ticaret Hukuku', 'Aile Hukuku', 'Ceza Hukuku', 'İş Hukuku', 'Borçlar Hukuku'];

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => \Str::slug($title),
            'excerpt' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(5, true),
            'image' => 'images/blog/post-' . $this->faker->numberBetween(1, 5) . '.jpg',
            'category' => $this->faker->randomElement($categories),
            'featured' => $this->faker->boolean(20),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
