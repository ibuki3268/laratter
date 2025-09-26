<?php

namespace Database\Factories;

// ? 2�s�ǉ�
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
    // ? �ǉ�
    return [
      'comment' => fake()->sentence,
      'user_id' => User::factory(),
      'tweet_id' => Tweet::factory(),
    ];
  }
}