<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'tweet',
    ];

    /**
     * このツイートを投稿したユーザーを取得 (1対多)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * このツイートを「いいね」したユーザーを取得 (多対多)
     */
    public function liked()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

