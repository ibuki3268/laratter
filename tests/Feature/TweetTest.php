<?php

use App\Models\Tweet;
use App\Models\User;

// �쐬��ʂ̃e�X�g
test('displays the create tweet page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $response = $this->get(route('tweets.create'));
    $response->assertStatus(200);
});

// �ꗗ�擾�̃e�X�g
test('displays tweets', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $tweet = Tweet::factory()->create(['user_id' => $user->id]);
    $response = $this->get(route('tweets.index'));
    $response->assertStatus(200);
    $response->assertSee($tweet->tweet);
    $response->assertSee($tweet->user->name);
});

// �쐬�����̃e�X�g
test('allows authenticated users to create a tweet', function () {
    // ���[�U���쐬
    $user = User::factory()->create();

    // ���[�U��F��
    $this->actingAs($user);

    // Tweet���쐬
    $tweetData = ['tweet' => 'This is a test tweet.'];

    // POST���N�G�X�g
    $response = $this->post(route('tweets.store'), $tweetData);

    // �f�[�^�x�[�X�ɕۑ����ꂽ���Ƃ��m�F
    $this->assertDatabaseHas('tweets', $tweetData);

    // ���X�|���X�̊m�F
    $response->assertStatus(302);
    $response->assertRedirect(route('tweets.index'));
});

// �ڍ׉�ʂ̃e�X�g
test('displays a tweet', function () {
    // ���[�U���쐬
    $user = User::factory()->create();

    // ���[�U��F��
    $this->actingAs($user);

    // Tweet���쐬
    $tweet = Tweet::factory()->create(['user_id' => $user->id]);

    // GET���N�G�X�g
    $response = $this->get(route('tweets.show', $tweet));

    // ���X�|���X��Tweet�̓��e���܂܂�Ă��邱�Ƃ��m�F
    $response->assertStatus(200);
    $response->assertSee($tweet->tweet);
    $response->assertSee($tweet->created_at->format('Y-m-d H:i'));
    $response->assertSee($tweet->updated_at->format('Y-m-d H:i'));
    $response->assertSee($tweet->user->name);
});

// �ҏW��ʂ̃e�X�g
test('displays the edit tweet page', function () {
    // �e�X�g�p�̃��[�U�[���쐬
    $user = User::factory()->create();

    // ���[�U�[��F�؁i���O�C���j
    $this->actingAs($user);

    // Tweet���쐬
    $tweet = Tweet::factory()->create(['user_id' => $user->id]);

    // �ҏW��ʂɃA�N�Z�X
    $response = $this->get(route('tweets.edit', $tweet));

    // �X�e�[�^�X�R�[�h��200�ł��邱�Ƃ��m�F
    $response->assertStatus(200);

    // �r���[��Tweet�̓��e���܂܂�Ă��邱�Ƃ��m�F
    $response->assertSee($tweet->tweet);
});

// �X�V�����̃e�X�g
test('allows a user to update their tweet', function () {
    // ���[�U���쐬
    $user = User::factory()->create();

    // ���[�U��F��
    $this->actingAs($user);

    // Tweet���쐬
    $tweet = Tweet::factory()->create(['user_id' => $user->id]);

    // �X�V�f�[�^
    $updatedData = ['tweet' => 'Updated tweet content.'];

    // PUT���N�G�X�g
    $response = $this->put(route('tweets.update', $tweet), $updatedData);

    // �f�[�^�x�[�X���X�V���ꂽ���Ƃ��m�F
    $this->assertDatabaseHas('tweets', ['id' => $tweet->id] + $updatedData);

    // ���X�|���X�̊m�F
    $response->assertStatus(302);
    $response->assertRedirect(route('tweets.show', $tweet));
});

// ? �������炪�A���Ȃ��̎w���ʂ�ɒǉ����������ł�
// �폜�����̃e�X�g
test('allows a user to delete their tweet', function () {
    // ���[�U���쐬
    $user = User::factory()->create();

    // ���[�U��F��
    $this->actingAs($user);

    // Tweet���쐬
    $tweet = Tweet::factory()->create(['user_id' => $user->id]);

    // DELETE���N�G�X�g
    $response = $this->delete(route('tweets.destroy', $tweet));

    // �f�[�^�x�[�X����폜���ꂽ���Ƃ��m�F
    $this->assertDatabaseMissing('tweets', ['id' => $tweet->id]);

    // ���X�|���X�̊m�F
    $response->assertStatus(302);
    $response->assertRedirect(route('tweets.index'));
});

it('can search tweets by content keyword', function () {
  $user = User::factory()->create();
  $this->actingAs($user);

  // �L�[���[�h���܂ރc�C�[�g���쐬
  Tweet::factory()->create([
    'tweet' => 'This is a test tweet',
    'user_id' => $user->id,
  ]);

  // �L�[���[�h���܂܂Ȃ��c�C�[�g���쐬
  Tweet::factory()->create([
    'tweet' => 'This is another tweet',
    'user_id' => $user->id,
  ]);

  // �L�[���[�h "test" �Ō���
  $response = $this->get(route('tweets.search', ['keyword' => 'test']));

  $response->assertStatus(200);
  $response->assertSee('This is a test tweet');
  $response->assertDontSee('This is another tweet');
});

it('shows no tweets if no match found', function () {
  $user = User::factory()->create();
  $this->actingAs($user);

  Tweet::factory()->create([
    'tweet' => 'This is a tweet',
    'user_id' => $user->id,
  ]);

  // ���݂��Ȃ��L�[���[�h�Ō���
  $response = $this->get(route('tweets.search', ['keyword' => 'nonexistent']));

  $response->assertStatus(200);
  $response->assertDontSee('This is a tweet');
  $response->assertSee('No tweets found.');
});