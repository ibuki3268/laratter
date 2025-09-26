<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{
    /**
     * ツイートに「いいね」を追加する
     */
    public function store(Tweet $tweet)
    {
        // ? liked()というリレーションを通じて、現在ログインしているユーザーのIDを中間テーブルに保存します
        $tweet->liked()->attach(auth()->id());
        // ? 直前のページにリダイレクトします
        return back();
    }

    /**
     * ツイートの「いいね」を解除する
     */
    public function destroy(Tweet $tweet)
    {
        // ? liked()というリレーションを通じて、現在ログインしているユーザーのIDを中間テーブルから削除します
        $tweet->liked()->detach(auth()->id());
        // ? 直前のページにリダイレクトします
        return back();
    }
}