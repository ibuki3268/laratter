<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * �c�C�[�g�̈ꗗ�\��
     */
public function index()
{
    // ? 'user' �� 'liked' �̏����ꏏ�Ɏ擾����悤�ɏC��
    $tweets = Tweet::with(['user', 'liked'])->latest()->get();
    return view('tweets.index', compact('tweets'));
}

    /**
     * �c�C�[�g�̐V�K�쐬���
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
     * �c�C�[�g�̕ҏW���
     */
    public function edit(Tweet $tweet)
    {
        return view('tweets.edit', compact('tweet'));
    }

    /**
     * �c�C�[�g�̍X�V����
     */
    public function update(Request $request, Tweet $tweet)
    {
        $request->validate([
            'tweet' => 'required|max:255',
        ]);

        $tweet->update($request->only('tweet'));

        // �X�V��́A���̃c�C�[�g�̏ڍ׉�ʂɖ߂�
        return redirect()->route('tweets.show', $tweet);
    }
   public function show(Tweet $tweet)
{
  $tweet->load('comments');
  return view('tweets.show', compact('tweet'));
}

    /**
     * �c�C�[�g�̍폜����
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

  // �L�[���[�h���w�肳��Ă���ꍇ�̂݌��������s
  if ($request->filled('keyword')) {
    $keyword = $request->keyword;
    $query->where('tweet', 'like', '%' . $keyword . '%');
  }

  // �y�[�W�l�[�V������ǉ��i1�y�[�W��10���\���j
  $tweets = $query
    ->latest()
    ->paginate(10);

  return view('tweets.search', compact('tweets'));
}
 

}

