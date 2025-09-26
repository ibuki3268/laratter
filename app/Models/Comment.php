<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// È—ª

class Comment extends Model
{
  use HasFactory;

  // ? Ý’è‚Å‚«‚éƒJƒ‰ƒ€‚ð’Ç‰Á
  protected $fillable = ['comment', 'tweet_id', 'user_id'];

  // ? ‘½‘Î1‚ÌŠÖŒW
  public function tweet()
  {
    return $this->belongsTo(Tweet::class);
  }

  // ? ‘½‘Î1‚ÌŠÖŒW
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}