<?php
namespace Database\Factories;

// ? 2�s�ǉ�
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class TweetFactory extends Factory
{
  // ? �ǉ�
  protected $model = Tweet::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    // ? �ǉ�
    return [
      'user_id' => User::factory(), // User���f����Factory���g�p���ă��[�U�𐶐�
      'tweet' => $this->faker->text(200) // �_�~�[�̃e�L�X�g�f�[�^
    ];
  }
}