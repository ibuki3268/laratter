<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * ツイートの一覧表示
     */
public function index()
{
    // ? 'user' と 'liked' の情報を一緒に取得するように修正
    $tweets = Tweet::with(['user', 'liked'])->latest()->get();
    return view('tweets.index', compact('tweets'));
}

    /**
     * ツイートの新規作成画面
     */
    public function create()
    {
        return view('tweets.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'tweet' => 'required|max:255',
        ]);

        $request->user()->tweets()->create($request->only('tweet'));

        return redirect()->route('tweets.index');
    }


    /**
     * ツイートの編集画面
     */
    public function edit(Tweet $tweet)
    {
        return view('tweets.edit', compact('tweet'));
    }

    /**
     * ツイートの更新処理
     */
    public function update(Request $request, Tweet $tweet)
    {
        $request->validate([
            'tweet' => 'required|max:255',
        ]);

        $tweet->update($request->only('tweet'));

        // 更新後は、そのツイートの詳細画面に戻る
        return redirect()->route('tweets.show', $tweet);
    }
   public function show(Tweet $tweet)
{
  $tweet->load('comments');
  return view('tweets.show', compact('tweet'));
}

    /**
     * ツイートの削除処理
     */
    public function destroy(Tweet $tweet)
    {
        $tweet->delete();

        return redirect()->route('tweets.index');
    }

/**
 * Search for tweets containing the keyword.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\View\View
 */
public function search(Request $request)
{

  $query = Tweet::query();

  // キーワードが指定されている場合のみ検索を実行
  if ($request->filled('keyword')) {
    $keyword = $request->keyword;
    $query->where('tweet', 'like', '%' . $keyword . '%');
  }

  // ページネーションを追加（1ページに10件表示）
  $tweets = $query
    ->latest()
    ->paginate(10);

  return view('tweets.search', compact('tweets'));
}
 

}

