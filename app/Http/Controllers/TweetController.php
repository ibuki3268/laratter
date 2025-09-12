<?php

namespace App\Http-Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * ツイートの一覧表示
     */
    public function index()
    {
        $tweets = Tweet::with('user')->latest()->get();
        return view('tweets.index', compact('tweets'));
    }

    /**
     * ツイートの新規作成画面
     */
    public function create()
    {
        return view('tweets.create');
    }

    /**
     * ツイートの保存処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'tweet' => 'required|max:255',
        ]);

        $request->user()->tweets()->create($request->only('tweet'));

        return redirect()->route('tweets.index');
    }

    /**
     * ツイートの詳細表示
     */
    public function show(Tweet $tweet)
    {
        // ? 追加したメソッド
        return view('tweets.show', compact('tweet'));
    }
}