<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// �ȗ�

class Comment extends Model
{
  use HasFactory;

  // ? �ݒ�ł���J������ǉ�
  protected $fillable = ['comment', 'tweet_id', 'user_id'];

  // ? ����1�̊֌W
  public function tweet()
  {
    return $this->belongsTo(Tweet::class);
  }

  // ? ����1�̊֌W
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}