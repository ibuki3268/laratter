<?php

namespace App\Http-Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * �c�C�[�g�̈ꗗ�\��
     */
    public function index()
    {
        $tweets = Tweet::with('user')->latest()->get();
        return view('tweets.index', compact('tweets'));
    }

    /**
     * �c�C�[�g�̐V�K�쐬���
     */
    public function create()
    {
        return view('tweets.create');
    }

    /**
     * �c�C�[�g�̕ۑ�����
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
     * �c�C�[�g�̏ڍו\��
     */
    public function show(Tweet $tweet)
    {
        // ? �ǉ��������\�b�h
        return view('tweets.show', compact('tweet'));
    }
}