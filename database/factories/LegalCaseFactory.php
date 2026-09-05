<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\LegalCase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LegalCase>
 */
class LegalCaseFactory extends Factory
{
    protected $model = LegalCase::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        $categories = ['Ticaret Hukuku', 'Aile Hukuku', 'Ceza Hukuku', 'İş Hukuku', 'Borçlar Hukuku'];
        $statuses = ['ongoing', 'won', 'lost', 'settled'];

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => \Str::slug($title),
            'description' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(5, true),
            'image' => 'images/cases/case-' . $this->faker->numberBetween(1, 5) . '.jpg',
            'category' => $this->faker->randomElement($categories),
            'status' => $this->faker->randomElement($statuses),
            'case_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
