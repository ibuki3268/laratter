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
     * このツイートを投稿したユーザーを取得 (所属)
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
 
    // 🔽 お客様からご指示いただいたコードブロック
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class)->orderBy('created_at', 'desc');
    }
}