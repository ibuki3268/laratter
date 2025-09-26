<?php

namespace Database\Factories;

// ? 2s’Ç‰Á
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    // ? ’Ç‰Á
    return [
      'comment' => fake()->sentence,
      'user_id' => User::factory(),
      'tweet_id' => Tweet::factory(),
    ];
  }
}